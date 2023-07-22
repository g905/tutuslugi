<?php

namespace App\Http\Controllers;

use App\Models\AdvertCategories;
use App\Models\Adverts;
use App\Models\Regions;
use App\Models\SeoPage;
use App\Models\UserCategories;
use App\Models\UserImages;
use App\Models\UserRegions;
use App\Models\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\SmsaeroApiV2;
use App\Http\Helpers\UserHelper;
use Intervention\Image\Point;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware(
            function ($request, $next) {
                if ($request->is('logout')) {
                    return $next($request);
                }

                if (!empty(Auth::user()) && Auth::user()->status == 0) {
                    return redirect(route('user.confirm.page'));
                }

                if (!empty(Auth::user()->user_type) && Auth::user()->user_type == 2) {
                    return redirect(route('admin.index'));
                }
                return $next($request);
            }
        );
    }


    public function CurrentUser($ID, Request $request){
        $User = User::find($ID);
        $User->views_today = $User->views_today + 1;
        $User->views_total = $User->views_total + 1;
        $User->save();
        $User = User::GetUserData($User);

        return view(
            'user.current',
            ['User'=>$User]
        );
    }

    //Загрузка и обработка аватара пользователя
    public function UploadUserPhoto(Request $request)
    {
        $Errors = $this->UserImageUploadCheck($request->all());
        if (!empty($Errors) && $Errors->fails()) {


            return response()->json(
                ['success' => 0, 'errors' => $Errors->errors()->toArray(), 'alert' => view(
                    'notifications.error', ['Title' => "Загрузка фотографии", 'Errors' => $Errors->errors()]
                )->render()]
            );
        } else {
            $Image = User::UploadUserPhoto($request->file('file'));
            return response()->json(
                ['success' => 1, 'image' => $Image, 'alert' => view(
                    'notifications.success',
                    ['Title' => "Загрузка фотографии", 'Text' => "Ваша фотография успешно обновлена"]
                )->render()]
            );
        }
    }


    //Страница с объявлениями пользователя
    public function UserProfile()
    {
        $Adverts = Adverts::GetAdverts(array('user_id' => Auth::user()->id));
        $Photos = UserImages::where('user_id', Auth::user()->id)->get();
        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = "Личный кабинет";
        $User = User::where('id', Auth::user()->id)->first();
        $UserCitys = UserRegions::select('regions.name')->leftJoin('regions', 'regions.id', '=', 'user_regions.city_id')
            ->where('user_id', Auth::user()->id)->get();

        $UserServices = User::GetUserServices();

        return view('user.profile', ['Adverts'         => $Adverts, 'Photos' => $Photos, 'User' => $User,
                                     'dataPageDefault' => $dataPageDefault, 'UserCitys' => $UserCitys, 'UserServices' => $UserServices]
        );
    }

    //Страница с категориями и услугами
    public function UserServicesForm()
    {
        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = "Услуги и цены";
        $Categories = AdvertCategories::GetCategoryTree();


        $Services =  UserCategories::where('user_id', Auth::user()->id)->get();
        if($Services){
            foreach ($Services as &$service){
                $service->category = AdvertCategories::where('id',$service->sub_category_id)->first();
                $service->children = AdvertCategories::GetAllCategories($service->sub_category_id);
                if($service->children){
                    foreach($service->children as &$child){
                        $child->service = UserServices::where(['services_id'=>$child->id,'user_id'=>Auth::user()->id])->first();
                    }
                }
            }
        }
        $UserCategories = UserCategories::select('sub_category_id')->where('user_id', Auth::user()->id)->get()->keyBy('sub_category_id')
            ->toArray();

        return view('user.services', ['dataPageDefault' => $dataPageDefault,'Categories'=>$Categories,'Services'=>$Services, 'UserCategories'=>$UserCategories]);
    }

    //Сохранение цен на услуги в кабинете пользователя
    public function UserServicesPrice(Request $request){
        UserServices::where('user_id', Auth::user()->id)->delete();
        foreach ($request->input('service') as $key=>$category) {
            $Category = AdvertCategories::find($key);
            foreach ($category as $scategory) {
                UserServices::create(['user_id' => Auth::user()->id, 'price'=>$request->input('service_price')[$scategory][0], 'services_id'=>$scategory,  'category_id' => $Category->parent_id, 'sub_category_id' => $key]);
            }
        }

        return response()->json(
            ['success' => 1, 'alert' => view(
                'notifications.success', ['Title' => "Услуги и цены ", 'Text' => "Список цен на услуги успешно сохранен"]
            )->render()]
        );
    }

    //Сохранение категорий услуг
    public function UserServices(Request $request)
    {
        UserCategories::where('user_id', Auth::user()->id)->delete();
        if($request->input('category')){
        foreach ($request->input('category') as $key=>$category) {
            foreach ($category as $scategory) {
                UserCategories::create(['user_id' => Auth::user()->id, 'category_id' => $key, 'sub_category_id' => $scategory]);
            }
        }

        }

        $Categories = AdvertCategories::GetCategoryTree();


        $Services =  UserCategories::where('user_id', Auth::user()->id)->get();
        if($Services){
            foreach ($Services as &$service){
                $service->category = AdvertCategories::where('id',$service->sub_category_id)->first();
                $service->children = AdvertCategories::GetAllCategories($service->sub_category_id);
                if($service->children){
                    foreach($service->children as &$child){
                        $child->service = UserServices::where(['services_id'=>$child->id,'user_id'=>Auth::user()->id])->first();

                    }
                }
            }
        }
        $UserCategories = UserCategories::select('sub_category_id')->where('user_id', Auth::user()->id)->get()->keyBy('sub_category_id')
            ->toArray();


        return response()->json(
            ['success' => 1, 'alert' => view(
                'notifications.success', ['Title' => "Услуги и цены ", 'Text' => "Список услуг успешно сохранен"]
            )->render(),'prices'=>view(
                'user.prices', ['Categories'=>$Categories,'Services'=>$Services, 'UserCategories'=>$UserCategories]
            )->render(),'ServicesCount'=>count($Services)]
        );
    }

    //Страница настроек пользователя
    public function UserSettingsForm(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        if ($request->session()->get('sms_code_phone_change')) {
            $ShowCodeForm = 1;
        } else {
            $ShowCodeForm = 0;
        }
        $request->session()->put('sms_code_phone_change', '');

        return view('user.settings', ['User' => $User, 'ShowCodeForm' => $ShowCodeForm]);
    }

    //Страница регионов пользователя
    public function UserRegionsForm(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $Regions = Regions::GetAllRegions();
        $UserRegions = UserRegions::select('city_id')->where('user_id', Auth::user()->id)->get()->keyBy('city_id')
            ->toArray();

        if ($Regions) {
            foreach ($Regions as &$region) {
                $region->citys = Regions::GetAllCitys($region->id);
            }
        }

        return view('user.regions', ['User' => $User, 'Regions' => $Regions, 'UserRegions' => $UserRegions]);
    }

    public function UserRegions(Request $request)
    {
        UserRegions::where('user_id', Auth::user()->id)->delete();
        foreach ($request->input('city') as $city) {
            UserRegions::create(['user_id' => Auth::user()->id, 'city_id' => $city]);
        }
        return response()->json(
            ['success' => 1, 'alert' => view(
                'notifications.success', ['Title' => "Города", 'Text' => "Список городов успешно сохранен"]
            )->render()]
        );
    }

    //Редактирование информации о пользователе
    public function UserAbout(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $User->work_experience = $request->input('work_experience');
        $User->about_text = $request->input('about_text');
        $User->save();
        $User = User::where('id', Auth::user()->id)->first();
        return response()->json(
            ['success'          => 1, 'alert' => view(
                'notifications.success', ['Title' => "О себе", 'Text' => "Ваши данные успешно сохранены"]
            )->render(), 'view' => view('user.about',['User'=>$User])->render()]
        );

    }

    //Редактирование скидки пользователя
    public function UserDiscount(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $User->discount = $request->input('discount');
        $User->discount_text = $request->input('discount_text');
        $User->save();
        $User = User::where('id', Auth::user()->id)->first();
        return response()->json(
            ['success'          => 1, 'alert' => view(
                'notifications.success', ['Title' => "Скидка", 'Text' => "Информация о вашей скидке успешно сохранена"]
            )->render(), 'view' => view('user.discount',['User'=>$User])->render()]
        );

    }

    //Страница портфолио пользователя
    public function UserPortfolioForm(Request $request)
    {
        $User = User::where('id', Auth::user()->id)->first();
        $UserPhotos = UserImages::where('user_id', Auth::user()->id)->get();
        return view('user.portfolio', ['User' => $User, 'UserPhotos' => $UserPhotos]);
    }

    public function UploadPortfolio(Request $request)
    {
        $Errors = UserImages::ImageUploadCheck($request->all());
        if (!empty($Errors) && $Errors->fails()) {
            return response()->json(
                ['success' => 0, 'errors' => $Errors, 'alert' => view(
                    'notifications.error', ['Title' => "Загрузка портфолио", 'Errors' => $Errors->errors()]
                )->render()]
            );
        } else {
            $Image = UserImages::ImageUpload(Auth::user()->id, $request->file('file'));
            return response()->json(
                ['success' => 1, 'image_id' => $Image['image_id'], 'image_url' => $Image['image_url'], 'alert' => view(
                    'notifications.success', ['Title' => "Загрузка портфолио", 'Text' => "Изображение загружено"]
                )->render()]
            );
        }
    }

    public function deletePortfolio(Request $request)
    {
        $Image = UserImages::where(['user_id' => Auth::user()->id, 'id' => $request->input('image_id')])->first();
        @unlink(public_path('storage') . "" . $Image->path);
        UserImages::where(['user_id' => Auth::user()->id, 'id' => $request->input('image_id')])->delete();
    }

    //Страница смены пароляя пользователя
    public function UserPasswordForm()
    {
        $User = User::where('id', Auth::user()->id)->first();
        return view('user.password', ['User' => $User]);
    }


    //TODO Пересмотреть логику изменения, сейчас всё работает
    public function UserSettings(Request $request)
    {
        $Errors = $this->ValidationFormEdit($request->all());

        if (!empty($Errors) && $Errors->fails()) {
            return redirect()->back()->withErrors($Errors)->withInput($request->all())->with('UserSettings', 1);
        } else {
            $UserPhone = UserHelper::ClearUserPhone($request->input('phone'));
            $User = User::where(['id' => Auth::user()->id])->first();
            if (($User->phone == $UserPhone)
                || ($User->phone != $UserPhone && $request->input('code')
                    && $request->input('code') != ''
                    && $request->input('code') == $request->session()->get('sms_code'))) {
                $User->update(
                    [
                        'email' => $request->input('email'),
                        'name'  => $request->input('name'),
                        'phone' => $UserPhone,
                    ]
                );
                return redirect(route('user.profile'))->with('success', 'Настройки')->with(
                    'success_text', 'Личные данные сохранены'
                );
            } else {
                if ($User->phone != $UserPhone && !$request->input('code')) {
                    $Code = rand(1111, 9999);
                    $Code = 1111;
                    $request->session()->put('sms_code', $Code);
                    /*$smsaero_api = new SmsaeroApiV2('','');
                     $res = $smsaero_api->flash($Phone, $Code);*/
                }
                if ($User->phone != $UserPhone || $request->input('code')) {
                    $request->session()->put('sms_code_phone_change', $UserPhone);
                }
                if ($request->input('code') && $request->input('code') != $request->session()->get('sms_code')) {
                    return redirect(route('user.settings'))->withErrors(array('code' => "Не верный код"))->withInput(
                        $request->all()
                    )->with('needcodeconfirm', '1')->with('UserSettings', 1);;
                }

                return redirect(route('user.settings'))->withInput($request->all())->with('needcodeconfirm', '1')->with(
                    'UserSettings', 1
                );;
            }
        }
    }

    public function UserPassword(Request $request)
    {


        $User = User::where(['id' => Auth::user()->id])->first();


        $Errors = $this->ValidationChangePassword($request->all());
        if ($Errors->fails()) {
            return redirect()->back()->withErrors($Errors)->withInput()->with('UserPassword', 1);
        } else {
            $User->update(['password' => Hash::make($request->input('password'))]);
        }

        return redirect(route('user.profile'))->with('success', 'Изменение пароля')->with(
            'success_text', 'Пароль успешно изменен'
        );

    }


    private function ValidationFormEdit($data)
    {
        return Validator::make(
            $data, [
            // 'email' => 'required|string|email|max:190|unique:users,email,' . Auth::user()->id,
            'name'  => 'required|string|max:190',
            'phone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/|unique:users,phone,'
                . Auth::user()->id,/*
            'phone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/|unique:users,phone,' . Auth::user()->id,*/
        ], [
                'name.required'      => 'Укажите Имя',
                'email.required'     => 'Укажите свой E-mail',
                'email.email'        => 'Проверьте E-mail',
                'email.unique'       => 'Пользователь с данным email уже зарегистрирован. Используйте другой email',
                'phone.required'     => 'Укажите телефон',
                'phone.regex'        => 'Введите корректный телефон, например 79221110500',
                'phone.unique'       => 'Пользователь с данным телефоном уже зарегистрирован. Используйте другой телефон',
                'password.required'  => 'Укажите пароль',
                'password.min'       => 'Короткий пароль, минимум 6 символов',
                'password.confirmed' => 'Пароли не совпадают. Повторите попытку',
            ]
        );
    }

    private function ValidationChangePassword($data)
    {
        return Validator::make(
            $data, [
            'password-old' => 'required|string|min:6|current_password',
            'password'     => 'required|string|min:6|confirmed',
            /*'email' => 'required|string|email|max:190|unique:users,email,' . Auth::user()->id,
            'name'  => 'required|string|max:190',
            'phone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/|unique:users,phone,'
                . Auth::user()->id,*/
        ], [
                'password-old.required'         => 'Укажите текущий пароль',
                'password-old.current_password' => 'Текущий пароль указан не верно',
                'password.required'             => 'Укажите новый пароль',
                'password.min'                  => 'Короткий пароль, минимум 6 символов',
                'password.confirmed'            => 'Пароли не совпадают. Повторите попытку',
            ]
        );
    }

    //Страница выхода
    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //Страница авторизации пользователя
    public function UserLoginForm(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('login');
        return view('auth.login', ['dataPageDefault' => $dataPageDefault]);
    }

    //Страница регистрации пользователя
    public function UserRegistrationForm(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('registration');
        return view('auth.register', ['dataPageDefault' => $dataPageDefault]);
    }

    //Страница регистрации пользователя
    public function UserResetForm(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('reset');
        return view('auth.passwords.email', ['dataPageDefault' => $dataPageDefault]);
    }

    public function UserResetPassForm($Hash, Request $request)
    {
        return view('auth.passwords.reset', ['token' => $Hash]);
    }

    public function UserReset(Request $request)
    {
        if (!$request->input('email')) {
            return response()->json(['errors' => ['email' => 'Укажите e-mail']], 400);
        }
        $Check = User::where('email', $request->input('email'))->first();
        if (!$Check) {
            return response()->json(
                ['errors' => ['Такого пользователя не существует. Проверьте правильность введённого email или зарегистрируйтесь']],
                400
            );
        } else {

            $Hash = md5($request->input('email') . time());

            $Check->update(
                ['hash' => $Hash]
            );


            $mData = array();
            $mData['email'] = $request->input('email');
            $mData['hash'] = $Hash;
            Mail::send(
                'mail.reset', ["mData" => $mData], function ($message) use ($mData) {
                $message->to($mData['email']);
                $message->subject('Восстановление пароля');
            }
            );

            return response()->json(
                ['success' => 'На указанный вами email было отправлено письмо со ссылкой на изменение пароля. Проверьте ваш почтовый ящик']
            );

        }
    }


    public function UserResetSave(Request $request)
    {
        $Check = User::where('hash', $request->input('token'))->first();

        if (!$Check) {
            return response()->json(['errors' => ['Истек срок действия ссылки']], 400);
        } else {
            if (!$request->input('password') || !$request->input('password_confirmation')
                || $request->input('password') != $request->input('password_confirmation')) {
                return response()->json(['errors' => ['password' => 'Пароли не совпадают. Повторите попытку']], 400);
            } else {

                $Check->update(
                    ['hash' => '', 'password' => Hash::make($request->input('password'))]
                );
                Auth::attempt(['email' => $Check->email, 'password' => $request->input('password')]);
                return response()->json(['success' => '1', 'redirect' => '/']);
            }
        }
    }

    public function UserLogin(Request $request)
    {
        $Errors = $this->ValidationLoginForm($request->only('phone', 'password'));

        if ($Errors->fails()) {
            return response()->json(['errors' => $Errors->errors()->toArray()], 400);
        } else {
            $phone = UserHelper::ClearUserPhone($request->input('phone'));
            $password = $request->input('password');
            if (Auth::attempt(array('phone' => $phone, 'password' => $password), $request->input('remember'))) {
                User::where('id', Auth::user()->id)->update(['last_login' => date('Y-m-d H:i:s')]);
                return response()->json(
                    ['success' => 'Вы успешно авторизовались', 'redirect' => route('user.profile')]
                );
            } else {
                return response()->json(['errors' => ['Вы указали не верный логин/пароль']], 401);
            }
        }
    }

    //Регистрация пользователя
    public function UserRegistrationCheck(Request $request)
    { //$smsaero_api = new SmsaeroApiV2('', '');
        /*echo"<pre>";
        	echo print_r($smsaero_api->balance(),1);
        echo"</pre>";exit();*/
        $Errors = $this->ValidationRegistrationForm($request->all());
        if ($Errors->fails()) {
            return response()->json(['errors' => $Errors->errors()->toArray()], 400);
        } else {
            $Phone = UserHelper::ClearUserPhone($request->input('phone'));
            $Code = rand(1111, 9999);
            $request->session()->put('sms_code', $Code);
            $smsaero_api = new SmsaeroApiV2('', '');
            $res = $smsaero_api->flash($Phone, $Code);

            return response()->json(
                ['success' => '1', 'call' => $res]
            );
        }
    }

    public function UserRegistration(Request $request)
    {
        $Errors = $this->ValidationRegistrationForm($request->all());
        if ($Errors->fails()) {
            return response()->json(['errors' => $Errors->errors()->toArray()], 400);
        } else {
            if ($request->input('code') && $request->input('code') != ''
                && $request->input('code') == $request->session()->get('sms_code')) {
                $Hash = md5($request->input('email') . time());
                User::create(
                    [
                        'name'     => $request->input('name'),
                        'phone'    => UserHelper::ClearUserPhone($request->input('phone')),
                        'hash'     => $Hash,
                        'status'   => 1,
                        'password' => Hash::make($request->input('password')),
                    ]
                );


                Auth::attempt(
                    ['phone'    => UserHelper::ClearUserPhone($request->input('phone')),
                     'password' => $request->input('password')]
                );
                return response()->json(
                    ['success' => 'Учетная запись успешно создана!', 'redirect' => route('user.profile')]
                );
            } else {
                if (!$request->input('code') || $request->input('code') == '') {
                    return response()->json(['errors' => array(0 => "Введите код")], 400);
                } else {
                    return response()->json(['errors' => array(0 => "Не верный код")], 400);
                }

            }

        }

    }

    //Валидация формы авторизации
    private function ValidationLoginForm(array $data)
    {
        return Validator::make(
            $data, [
            'phone'    => 'required|string|max:190',
            'password' => 'required|string',
        ], [
                'phone.required'    => 'Укажите свой телефон',
                'password.required' => 'Укажите пароль',
            ]
        );
    }

    //Валидация формы для регистрации
    private function ValidationRegistrationForm($data)
    {
        return Validator::make(
            $data, [
            'name'     => 'required|string|max:190',
            'phone'    => 'required|string|max:190|unique:users',
            //'phone'    => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/|unique:users',
            'password' => 'required|string|min:6',
        ], [

                'name.required'      => 'Укажите свое ФИО',
                'email.required'     => 'Укажите свой E-mail',
                'email.email'        => 'Проверьте E-mail',
                'email.unique'       => 'Пользователь с данным email уже зарегистрирован. Авторизуйтесь или используйте при регистрации другой email',
                'phone.required'     => 'Укажите телефон',
                'phone.regex'        => 'Введите корректный телефон, например 79221110500',
                'phone.unique'       => 'Пользователь с данным телефоном уже зарегистрирован.',
                'password.required'  => 'Укажите пароль',
                'password.min'       => 'Короткий пароль, минимум 6 символов',
                'password.confirmed' => 'Пароли не совпадают. Повторите попытку',
            ]
        );
    }

    public function UserImageUploadCheck($ImageFile)
    {

        $validator = Validator::make(
            $ImageFile, [
            'file' => 'required|mimes:jpg,jpeg,png,gif|max:10240',
        ], $messages = [
            'mimes' => 'Доступные форматы: jpg, gif, png',
            'max'   => 'Максимальны размер фото 10МБ'
        ]
        );

        return $validator;
    }
}
