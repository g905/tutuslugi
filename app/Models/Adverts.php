<?php

namespace App\Models;

use App\Models\UserImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Console\Commands\TraitAdvert;
class Adverts extends Model
{
    use HasFactory;
    public static $AdvertTime  = 30;

    protected $fillable
        = [
            'name',
            'import_id',
            'phone',
            'user_name',
            'category',
            'sub_category',
            'text',
            'price',
            'user_id',
            'region_id',
            'parent_region_id',
            'status',
            'date_start',
            'date_up',
            'views',
        ];

    //Список значений измерений
    public static function GetMasureList()
    {
        return [
            1=>'за услугу',
            2=>'за 1 м²',
            3=>'за 1 м³',
            4=>'за 1 пог. метр',
            5=>'за 1 шт.',
            6=>'за 1 метр',
            7=>'за 1 км',
            8=>'за 45 мин.',
            9=>'за 1 час',
            10=>'за 1 сутки',
            11=>'за 1 неделю',
            12=>'за 1 месяц'];
    }
    public static function GetMasureListImport()
    {
        return [
            1=>'за услугу',
            2=>'за 1 м2',
            3=>'за 1 м3',
            4=>'за 1 пог. метр',
            5=>'за 1 шт.',
            6=>'за 1 метр',
            7=>'за 1 км',
            8=>'за 45 мин.',
            9=>'за 1 час',
            10=>'за 1 сутки',
            11=>'за 1 неделю',
            12=>'за 1 месяц'];
    }

    //Список статусов
    public static function GetStatusList()
    {
        return [
            1=>'Ожидает проверки',
            2=>'Опубликовано',
            3=>'Заблокировано',
            4=>'Скрыто пользователем',];
    }


    //Добавление объявления
    public static function AddAdvert($Data)
    {
        if(!isset($Data['import_id'])){

            $Data['import_id'] = 0;
        }else{
            $Data['status'] = 2;
        }
        $AdvertID = Adverts::create(
            [
                'name'         => $Data['name'],
                'user_name'         => $Data['user_name'],
                'import_id'         => $Data['import_id'],
                'phone'         => $Data['phone'],
                'category'     => $Data['category'],
                'sub_category' => $Data['sub_category'],
                'text'         => $Data['description'],
                'user_id'      => $Data['user_id'],
                'region_id'    => $Data['region_id'],
                'parent_region_id'    => $Data['parent_region_id'],
                'status'       => $Data['status'],
                'date_start' => date('Y-m-d H:i:s'),
                'date_up' => date('Y-m-d H:i:s'),
            ]
        );
        if(is_string($Data['images'])){
            UserImages::ImageUploadString($AdvertID->id, $Data['images']);
        }else{
            UserImages::ImageUpload($AdvertID->id, $Data['images']);
        }

        AdvertPrice::AddAdvertPrice($AdvertID->id,$Data['price']);

        return $AdvertID->id;
    }


    //Изменение объявления
    public static function EditAdvert($ID, $Data)
    {
        $Advert = Adverts::where('id',$ID)->first();
        $Advert->update(
            [
                'name'         => $Data['name'],
                'category'     => $Data['category'],
                'user_name'         => $Data['user_name'],
                'phone'         => $Data['phone'],
                'sub_category' => $Data['sub_category'],
                'text'         => $Data['description'],
                'user_id'      => $Data['user_id'],
                'region_id'    => $Data['region_id'],
                'parent_region_id'    => $Data['parent_region_id'],
                'status'       => $Data['status'],

            ]
        );
        $Advert->save();

        UserImages::ImageUpload($ID, $Data['images']);
        AdvertPrice::AddAdvertPrice($ID,$Data['price']);

        return $ID;
    }

    public static function GetAdverts($Filter = array(),$GetCount = 0)
    {

        if($GetCount==1&&isset($Filter['group_by_user_id'])&&!isset($Filter['seopage'])){
            if(isset($Filter['category_id']))
                return Cache::get("advert_count_distinct_cache_0_{$Filter['region_id']}_{$Filter['category_id']}_0");
            if(isset($Filter['sub_category_id']))
                return Cache::get("advert_count_distinct_cache_0_{$Filter['region_id']}_{$Filter['children_sub_category_id']}_{$Filter['sub_category_id']}");

        }else{
            if($GetCount==1){
                if(isset($Filter['category_id']))
                    return Cache::get("advert_count_cache_0_{$Filter['region_id']}_{$Filter['category_id']}_0");
                if(isset($Filter['sub_category_id']))
                    return Cache::get("advert_count_cache_0_{$Filter['region_id']}_{$Filter['children_sub_category_id']}_{$Filter['sub_category_id']}");
            }
            $Adverts = Adverts::select('*');
        }


        if(isset($Filter['status_admin'])){
            if(!isset($Filter['status'])){
                $Adverts = $Adverts->where('status','>=', 0);
            }else{
                $Adverts = $Adverts->where('status', $Filter['status']);
            }
        }else{
            if(!isset($Filter['user_id'])){
                $Adverts = $Adverts->where('status',2);
            }else{
                if(!isset($Filter['status'])){
                    $Adverts = $Adverts->where('status','>=', 0);
                }else{
                    $Adverts = $Adverts->where('status',2);
                }

            }
        }

        if (isset($Filter['user_id'])) {
            $Adverts->where('user_id', $Filter['user_id']);
        }

        if (isset($Filter['ids'])) {
            $Adverts->whereIn('id', $Filter['ids']);
        }
        if (isset($Filter['exclude'])) {
            $Adverts->where('id','!=',$Filter['exclude']);
        }
        if (isset($Filter['excludes'])) {
            $Adverts->whereNotIn('id',$Filter['excludes']);
        }

        if (isset($Filter['region_id'])) {
            $Adverts->where('region_id', $Filter['region_id']);
        }

        if (isset($Filter['category_id'])) {
            $Adverts->where('category', $Filter['category_id']);
        }

        if (isset($Filter['sub_category_id'])) {
            $Adverts->where('sub_category', $Filter['sub_category_id']);
        }

        if (isset($Filter['search'])) {
            $Adverts->where('name', 'LIKE', '%'.$Filter['search'].'%')->orwhere('text', 'LIKE', '%'.$Filter['search'].'%');

            if (isset($Filter['search_id'])) {
                $Adverts->orwhere('id', $Filter['search']);
            }
        }
        if (isset($Filter['search_text_admin'])) {
            $Adverts->where('name', 'LIKE', '%'.$Filter['search_text_admin'].'%')->orwhere('text', 'LIKE', '%'.$Filter['search_text_admin'].'%')->orwhere('id', 'LIKE', '%'.$Filter['search_text_admin'].'%')->orwhere('user_id', 'LIKE', '%'.$Filter['search_text_admin'].'%');
        }

        if($GetCount==1&&isset($Filter['group_by_user_id'])){

/*

            $query = str_replace(array('?'), array('\'%s\''), $Adverts->toSql());
            $query = vsprintf($query, $Adverts->getBindings());
            echo $query;*/
            return $Adverts->count('user_id');
        }

        $Adverts = $Adverts->orderBy('date_up', 'desc');




        if($GetCount==1){
            if(isset($Filter['seopage'])){
              //  return $Adverts->groupBy('id')->count();
            }
            return $Adverts->count();
        }
        if(isset($Filter['page'])){
            $Page = $Filter['page'];
        }else{
            $Page = 0;
        }
        if(isset($Filter['limit'])){
            $Adverts = $Adverts->offset($Page*$Filter['limit'])->limit($Filter['limit']);
            $Adverts = $Adverts->get();
        }else{
            $Adverts = $Adverts->paginate(20);
        }




        if ($Adverts) {
            foreach ($Adverts as &$advert) {
                $advert = self::GetAdvertData($advert);


            }
        }

        /*echo"<pre>";
        	echo print_r($Adverts,1);
        echo"</pre>";*/

        return $Adverts;
    }


    public static function GetAdvertData($advert){
       /* echo"<pre>";
        	echo print_r($advert->getText(),1);
        echo"</pre>";exit();*/

        $advert['region_data'] = Regions::GetRegionURL($advert->region_id);
        $advert['category_data'] = AdvertCategories::GetCategoryURL($advert->category,$advert->region_id);
        $advert['subcategory_data'] = AdvertCategories::GetSubCategoryURL($advert->sub_category,$advert->region_id);
        $Images = UserImages::where('advert_id', $advert->id)->get();
        $advert['images_all'] = $Images;
        if(isset($Images[0]))
            $advert['images'] = $Images[0];
        else
            $advert['images'] = '';

        $advert['images_count'] = count($Images);
        if($advert->user_id>0)
            $advert['user_info'] = User::where('id', $advert->user_id)->first();
        else
            $advert['user_info'] = array();

        if($advert->import_id){
            $advert['date_end'] = "...";
            $advert['date_end_format'] = "...";
        }else{
            $advert['date_end'] = date('d.m.Y', strtotime($advert->date_start) + 60*60*24*self::$AdvertTime);
            $advert['date_end_format'] = date('Y-m-d H:i:s', strtotime($advert->date_start) + 60*60*24*self::$AdvertTime);
        }


        $advert['date_start_format'] = date('d.m.Y в H:i:s', strtotime($advert->date_start));
        $advert['date_start_format_short'] = date('d.m.Y', strtotime($advert->date_start));

        $date_up_now = date('d.m.Y H:i:s');
        $date_up_new = date('d.m.Y H:i:s', strtotime($advert->date_up) + 60*60*24);
        if(strtotime($date_up_now)>=strtotime($date_up_new)){
            $advert['update_can'] = 1;
        }else{
            $advert['update_can'] = date('H',strtotime($date_up_new)-strtotime($date_up_now));;
        }


        if(!empty(Auth::user()->id)){
            $Advert = DB::table('wishlist')->where('user_id',Auth::user()->id)->where('advert_id',$advert->id)->first();
        }else{
            $Advert = DB::table('wishlist')->where('session_id', session()->getId())->where('advert_id',$advert->id)->first();
        }
        if($Advert){
            $advert['wish_active'] = 1;
        }else{
            $advert['wish_active'] = 0;
        }


        $advert->phone_clear = $advert->phone;
        if($advert->phone){
            $advert->phone = \App\Http\Helpers\Url::PhoneHidden($advert->phone);
        }

        if(!empty($advert['user_info']->phone)){
            $advert['user_info']->phone_clear = $advert['user_info']->phone;
            if($advert['user_info']->phone){
                $advert['user_info']->phone =  \App\Http\Helpers\Url::PhoneHidden($advert['user_info']->phone);
            }
        }



        $advert['pricecs'] = AdvertPrice::where('advert_id',$advert->id)->get();
        $advert['status_text'] = Adverts::GetStatusList()[$advert->status];

        return $advert;
    }

    public static function SetSeoPage($AdvertID = 0){
        return true;
        $Advert = Adverts::where('id',$AdvertID)->first();
        $Pages = SeoPage::where('category',$Advert->category)->where('subcategory',$Advert->sub_category)->get();
        DB::table('seo_pages_relations')->where('advert_id',$AdvertID)->delete();
        if($Pages){
            foreach($Pages as $page){
                $Search = explode(',',$page->seo_query);
                $QueryYes = 0;
                foreach($Search as $search){
                    $search = mb_strtolower(trim($search));
                    $Advert->name = mb_strtolower(trim($Advert->name));
                    $Advert->text = mb_strtolower(trim($Advert->text));

                    if(strpos($Advert->name,$search)!==false || strpos($Advert->text,$search)!==false){
                        $QueryYes++;

                    }

                }
                if($QueryYes==count($Search))
                    DB::table('seo_pages_relations')->insert(['advert_id'=>$AdvertID,'page_id'=>$page->id,'city_id'=>$Advert->region_id]);
            }
        }



    }

    //Удаление объявления
    public static function DeleteAdvert(Adverts $Advert){
        $Advert->delete();
        Storage::deleteDirectory("public/catalog/" . $Advert->id);
        AdvertPrice::where('advert_id',$Advert->id)->delete();
        DB::table('seo_pages_relations')->where(
            'advert_id', $Advert->id)->delete();
        DB::table('wishlist')->where(
            'advert_id', $Advert->id)->delete();
        return true;
    }

    //Валидация формы для добавления объетка
    public static function ValidationAddForm($data)
    {


        return Validator::make(
            $data, [
            'user_name'   => 'required|string|max:190',
            //'phone'  => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/',
            'region'      => 'required|integer|min:1',
            'city'        => 'required|integer|min:1',
            'title'       => 'required|string|max:190',
            'category'    => 'required|integer',
            //'subcategory' => 'required|integer',
            'description' => 'required|string',
            //'accept'      => 'required|string',
        ], [
                'user_name.required'   => 'Укажите имя',
                'phone.required'  => 'Укажите телефон',
                'phone.regex'     => 'Введите корректный телефон, например 79221110500',
                'region.required'      => 'Укажите регион',
                'region.integer'       => 'Укажите регион',
                'city.required'        => 'Укажите город',
                'city.integer'         => 'Укажите город',
                'title.required'       => 'Заполните название объявления',
                'category.required'    => 'Выберите категорию',
                'category.integer'     => 'Выберите категорию',
                //'subcategory.required' => 'Выберите подкатегорию',
                // 'subcategory.integer'  => 'Выберите подкатегорию',
                'description.required' => 'Заполните название описание',
                //'accept.required'      => 'Вы должны согласиться с условиями',
            ]
        );
    }


   public function getText(){
        echo $this->id."!!!".$this->category;
    }
}
