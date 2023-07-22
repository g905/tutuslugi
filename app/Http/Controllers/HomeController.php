<?php

namespace App\Http\Controllers;

use App\Models\AdvertCategories;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use App\Models\Adverts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $Users = User::GetUsersSite(array('limit' => 20));
        $Categories = AdvertCategories::GetHomeCategories();


        $SeoBottomCity = SeoPage::GetSeoCityBottom($request);

        $dataPageDefault = SeoPage::GetSeoPageData('home');


        return view('home', ['Users'       => $Users, 'HeaderSearchShow' => 1, 'Categories' => $Categories,
                             'SeoBottomCity' => $SeoBottomCity, 'dataPageDefault' => $dataPageDefault]
        );
    }


    public function contacts(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('support');
        $advert_id = $request->input('advert_id');
        return view('contacts', ['dataPageDefault' => $dataPageDefault, 'advert_id' => $advert_id]);
    }

    public function userterms(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('user_terms');
        return view('userterms', ['dataPageDefault' => $dataPageDefault]);
    }
    public function News(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('news_page');
        return view('userterms', ['dataPageDefault' => $dataPageDefault]);
    }

    public function userpolitics(Request $request)
    {
        $dataPageDefault = SeoPage::GetSeoPageData('user_politics');
        return view('userterms', ['dataPageDefault' => $dataPageDefault]);
    }

    public function confirm(Request $request)
    {

        return view('confirm');
    }

    public function confirmsend($Hash, Request $request)
    {
        $Check = User::where('hash', $Hash)->first();
        $Error = 0;
        if (!$Check) {
            $Error = 1;
        } else {
            $Check->update(
                ['hash' => '', 'status' => 1]
            );
        }

        return redirect(route('user.profile'));
    }

    public function ContactsSend(Request $request)
    {
        if ($request->input('email') != '') {
            return response()->json(['errors' => array()], 400);
        }
        //Отправка со страницы объявления
        if (!empty($request->input('field')['adv_id_current'])) {
            $Errors = $this->ValidationAdvertContactsForm($request->input('field'));
            if ($Errors->fails()) {
                return response()->json(['errors' => $Errors->errors()->toArray()], 400);
            } else {
                DB::table('contacts')->insert(
                    [
                        'adv_id' => $request->input('field')['adv_id_current'], 'name' => '',
                        'email'  => $request->input('field')['contact'], 'theme' => '',
                        'text'   => $request->input('field')['text'], 'date_add' => date('Y-m-d H:i:s'), 'type' => 2
                    ]
                );
                return response()->json(['success' => 1,'text'=>'Ваше сообщение отправленно. По возможности, мастер свяжется с вами.']);
                /*$mData = array();
                $mData['inputs'] = $request->input('field');
                Mail::send(
                    'mail.contacts', ["mData" => $mData], function ($message) use ($mData) {
                    $message->to(env('APP_ADMIN_EMAIL'));
                    $message->subject('Служба поддержки');
                }
                );*/
            }
        } else {
            //Отправка со страницы контактов
            $Errors = $this->ValidationContactsForm($request->input('field'));
            if ($Errors->fails()) {
                return response()->json(['errors' => $Errors->errors()->toArray()], 400);
            } else {
                DB::table('contacts')->insert(
                    [
                        'adv_id' => $request->input('field')['adv_id'], 'name' => $request->input('field')['name'],
                        'email'  => $request->input('field')['email'], 'theme' => $request->input('field')['theme'],
                        'text'   => $request->input('field')['text'], 'date_add' => date('Y-m-d H:i:s'), 'type' => 1
                    ]
                );
                $mData = array();
                $mData['inputs'] = $request->input('field');
                Mail::send(
                    'mail.contacts', ["mData" => $mData], function ($message) use ($mData) {
                    $message->to(env('APP_ADMIN_EMAIL'));
                    $message->subject('Служба поддержки');
                }
                );
            }

        }

        return response()->json(['success' => 1,'text'=>'Ваша заявка успешно отправлена!']);
    }

    //Валидация формы контактов
    private function ValidationContactsForm($data)
    {
        return Validator::make(
            $data, [
            'name'  => 'required|string|max:190',
            'text'  => 'required|string|max:10000',
            'email' => 'required|string|email|max:190',
        ], [

                'name.required'  => 'Укажите имя',
                'text.required'  => 'Введите сообщение',
                'email.required' => 'Укажите свой E-mail',
                'email.email'    => 'Проверьте E-mail',

            ]
        );
    }
    //Валидация формы контактов в объявлении
    private function ValidationAdvertContactsForm($data)
    {
        return Validator::make(
            $data, [
            'contact'  => 'required|string|max:190',
            'text'  => 'required|string|max:10000',
        ], [

                'contact.required'  => 'Укажите контакты',
                'text.required'  => 'Введите сообщение',

            ]
        );
    }

}
