<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Image;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable
        = [
            'name',
            'email',
            'user_type',
            'phone',
            'password',
            'hash',
            'user_type',
            'confirm_phone',
            'confirm_email',
            'last_login',
            'last_phone_call',
            'views_total',
            'views_today',
            'status',
            'photo',
            'work_experience',
            'discount_text',
            'discount',
            'about_text',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public static function GetMasureList()
    {
        return [
            1  => 'за услугу',
            2  => 'за урок',
            3  => 'за 1 м²',
            4  => 'за 1 м³',
            5  => 'за 1 пог. метр',
            6  => 'за 1 шт.',
            7  => 'за 1 метр',
            8  => 'за кг.',
            9  => 'за 1 км',
            10 => 'за 45 мин.',
            11 => 'за 1 час +',
            12 => 'за 1 сутки',
            13 => 'за 1 неделю',
            14 => 'за 1 месяц',
        ];
    }

    public static function GetUserServices($UserID = 0){
        if(!$UserID){
            $UserID = Auth::user()->id;
        }

        $UserCitys = UserServices::select(['user_services.price','advert_categories.measure','advert_categories.name'])->leftJoin('advert_categories', 'advert_categories.id', '=', 'user_services.services_id') ->where('user_id', $UserID)->get();

        return $UserCitys;
    }

    public static function GetUsersList($Filter = array())
    {
        $Users = User::where('user_type', '>=', 0);
        //Поиск по ID
        if (isset($Filter['id'])) {
            $Users = $Users->where('id', $Filter['id']);
        }

        //Поиск по E-mail
        if (isset($Filter['email'])) {
            $Users = $Users->orwhere('email', 'LIKE', '%' . $Filter['email'] . '%');
        }

        return $Users->orderBy('id', 'DESC')->paginate(50);
    }

    public static function UploadUserPhoto(string $Image, int $UserID = 0)
    {
        if (!$UserID) {
            $userID = Auth::user()->id;
        }
        if ($Image) {
            $Image = trim($Image);
            $filePath = public_path('storage');
            if (!file_exists($filePath . "/users/{$userID}/")) {
                mkdir($filePath . "/users/{$userID}", 0777);
            }
            $FileName = "/users/{$userID}/" . md5(time() . '_' . rand(100, 200));
            $urlMainImage = '' . $FileName . ".jpg";
            $img = Image::make(file_get_contents($Image));
            $img->resize(
                300, 300, function ($const) {
                $const->aspectRatio();
            }
            )->save($filePath . '' . $FileName . '.jpg', 80, 'jpg');


            $User = User::find($userID);
            if ($User->photo) {
                @unlink($filePath . $User->photo);
            }
            $User->photo = $urlMainImage;
            $User->save();
            return $urlMainImage;
        }
        return FALSE;
    }

    public static function GetUsersSite($Filter){
        $Users = User::select('users.*');



        //Джоины
        if (isset($Filter['region_id'])) {
            $Users->leftJoin('user_regions', 'user_regions.user_id', '=', 'users.id');
        }
        if (isset($Filter['category_id'])) {
            $Users->leftJoin('user_categories', 'user_categories.user_id', '=', 'users.id');
        }
        if (isset($Filter['sub_category_id'])) {
            $Users->leftJoin('user_categories', 'user_categories.user_id', '=', 'users.id');
        }


        //Условия для джоинов
        if (isset($Filter['region_id'])) {
            $Users->where('user_regions.city_id', $Filter['region_id']);
        }
        if (isset($Filter['category_id'])) {
            $Users->where('user_categories.category_id', $Filter['category_id']);
        }
        if (isset($Filter['sub_category_id'])) {
            $Users->where('user_categories.sub_category_id', $Filter['sub_category_id']);
        }

        $Users = $Users->where('status','>=', 1)->where('user_type','=', 0);



        if(isset($Filter['page'])){
            $Page = $Filter['page'];
        }else{
            $Page = 0;
        }

        if(isset($Filter['limit'])){
            $Users = $Users->offset($Page*$Filter['limit'])->limit($Filter['limit']);
            $Users = $Users->groupBy('users.id')->get();
        }else{
            $Users = $Users->paginate(20);
        }

        if ($Users) {
            foreach ($Users as &$user) {
                $user = self::GetUserData($user);

            }
        }

        return $Users;
    }

    public static function GetUserData($advert){

        $advert->categories = self::GetUserCategories($advert->id);
        $advert->photos = self::GetUserPhotos($advert->id);
        $advert->services = self::GetUserServices($advert->id);
        $advert->phone = \App\Http\Helpers\Url::PhoneHidden($advert->phone);
        return $advert;
    }

    public static function GetUserPhotos($UserID = 0){
        if (!$UserID) {
            $userID = Auth::user()->id;
        }
        $UserPhotos = UserImages::where('user_id', $UserID)->get();

        return $UserPhotos;
    }

    public static function GetUserCategories($UserID = 0){
        if (!$UserID) {
            $userID = Auth::user()->id;
        }

        $UserCategories = UserCategories::select(['advert_categories.name','advert_categories.master_1'])->leftJoin('advert_categories', 'advert_categories.id', '=', 'user_categories.sub_category_id')->where('user_id',$UserID)->get();
        return $UserCategories;
    }

    public static function GetUserServices1($UserID = 0){
        if (!$UserID) {
            $userID = Auth::user()->id;
        }

        $UserCategories = UserCategories::select(['user_services.price','advert_categories.measure','advert_categories.name'])->leftJoin('advert_categories', 'advert_categories.id', '=', 'user_services.services_id') ->where('user_id', Auth::user()->id)->get();
        return $UserCategories;
    }
}
