<?php

namespace App\Http\Controllers;

use App\Models\AdvertCategories;
use App\Models\Adverts;
use App\Models\Regions;
use App\Models\SeoPage;
use App\Models\User;
use App\Http\Helpers\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

ini_set('max_execution_time', 180000);
ini_set("pcre.backtrack_limit", "99999999999");
set_time_limit(0);

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('backend/index');
    }

    //Список категорий
    public function CategoryList(Request $request)
    {
        $listItems = AdvertCategories::GetCategoryTree();
        return view('backend/category/list', ['listItems' => $listItems]);
    }

    //Форма категорий
    public function CategoryEdit($ID, Request $request)
    {
        $Item = array();
        $CategoryList = AdvertCategories::GetAllCategories(0);
        if ($ID) {
            $Item = AdvertCategories::where('id', $ID)->first();
        }
        if($request->get('sub')==2 OR !empty($Item)&&$Item->service>0){
            $isService = 1;
        }else{
            $isService = 0;
        }


        return view('backend/category/edit', ['Item' => $Item, 'CategoryList' => $CategoryList,'isService'=>$isService]);
    }

    //Удаление категории
    public function CategoryDelete($ID, Request $request)
    {
        if ($ID) {
            $CheckElemets = Adverts::where('category', $ID)->orwhere('sub_category', $ID)->first();
            if ($CheckElemets) {
                return redirect(route('admin.category.list'))->with(
                    'error', 'Категория не удалена. В категории есть услуги.'
                );
            } else {
                $Item = AdvertCategories::where('id', $ID)->first();
                $Item->delete();
                return redirect(route('admin.category.list'))->with('success', 'Категория удалена');
            }
        } else {
            return redirect(route('admin.category.list'))->with('error', 'Категория не удалена');
        }
    }

    //Сохранение категории
    public function CategoryEditSave(Request $request)
    {
        $request['favorite'] = $request['favorite'] ? $request['favorite'] : 0;
        $request['footer'] = $request['footer'] ? $request['footer'] : 0;
        $request['show_short_description'] = $request['show_short_description'] ? $request['show_short_description']
            : 0;

        if(empty($request['url'])){
            $request['url'] = Str::slug($request['name'], '-');
        }
        if(empty($request['icon'])){
            $request['icon'] = Str::slug($request['icon'], '-');
        }

        if ($request->input('item_id')) {
            AdvertCategories::where('id', $request->input('item_id'))->first()->fill($request->all())->save();
            return redirect(route('admin.category.list'))->with('success', 'Категория сохранена');
        } else {
            AdvertCategories::create($request->all());
            return redirect(route('admin.category.list'))->with('success', 'Категория добавлена');
        }
    }

    //Список областей
    public function RegionList(Request $request)
    {
        $listItems = Regions::GetAllRegions(1, 0, 1);
        return view('backend/region/list', ['listItems' => $listItems]);
    }

    //Список городов по области
    public function RegionListCity($Region, Request $request)
    {
        $RegionCurrent = Regions::where('id', $Region)->first();
        $listItems = Regions::GetAllCitys($Region, 1);
        return view('backend/region/list', ['listItems' => $listItems, 'Region' => $RegionCurrent]);
    }

    //Форма регоина
    public function RegionEdit($ID, Request $request)
    {
        $Item = array();
        $RegionsList = Regions::GetAllRegions(0);
        if ($ID) {
            $Item = Regions::where('id', $ID)->first();
        }

        return view('backend/region/edit', ['Item' => $Item, 'RegionsList' => $RegionsList]);
    }

    //Удаление категории
    public function RegionDelete($ID, Request $request)
    {
        if ($ID) {
            $Item = Regions::where('id', $ID)->first();
            $Item->delete();
            Cache::forget("current_regions_footer");
            return redirect(route('admin.region.list'))->with('success', 'Регион удален');
        } else {
            return redirect(route('admin.region.list'))->with('error', 'Регион не удален');
        }
    }

    //Сохранение регоина
    public function RegionEditSave(Request $request)
    {
        if($request['url'])
            $request['url'] = $request->input('url');
        else
            $request['url'] = Url::str2url($request->input('name'));

        $request['favorite'] = $request['favorite'] ? $request['favorite'] : 0;
        $request['public'] = $request['public'] ? $request['public'] : 0;
        $request['footer'] = $request['footer'] ? $request['footer'] : 0;
        Cache::forget("current_regions_footer");
        if ($request->input('item_id')) {
            Regions::where('id', $request->input('item_id'))->first()->fill($request->all())->save();
            return redirect(route('admin.region.list'))->with('success', 'Регион сохранен');
        } else {
            Regions::create($request->all());
            return redirect(route('admin.region.list'))->with('success', 'Регион добавлен');
        }
    }

    //Список пользователей
    public function UsersList(Request $request)
    {
        $Filter = array();

        if ($request->input('search')) {
            $Filter['id'] = $request->input('search');
            $Filter['email'] = $request->input('search');
        }

        $listItems = User::GetUsersList($Filter);

        return view('backend/users/list', ['listItems' => $listItems]);
    }

    //Форма пользователя
    public function UsersEdit($ID, Request $request)
    {
        $Item = array();
        if ($ID) {
            $Item = User::where('id', $ID)->first();
        }

        return view('backend/users/edit', ['Item' => $Item]);
    }

    //Сохранение пользователя
    public function UsersEditSave(Request $request)
    {

        if ($request->input('item_id')) {
            User::where('id', $request->input('item_id'))->first()->fill($request->all())->save();
            return redirect(route('admin.users.list'))->with('success', 'Пользователь сохранен');
        } else {

        }
    }

    //Удаление пользователя
    public function UsersDelete($ID, Request $request)
    {
        if ($ID) {
            $Item = User::where('id', $ID)->first();
            $Item->delete();
            return redirect(route('admin.users.list'))->with('success', 'Пользователь удален');
        } else {
            return redirect(route('admin.users.list'))->with('error', 'Пользователь не удален');
        }
    }

    //Список импорт отбъявлений
    public function ItemsListImport(Request $request)
    {
        $ImportInfo['current_position'] = 1;
        $request->session()->put('import_stats', serialize($ImportInfo));
        $request->session()->save();
        /* if($request->file('csv')) {
             $fileName = time().'_'.$request->csv->getClientOriginalName();
             $filePath = $request->file('csv')->storeAs('csv', $fileName, 'public');

             $file_path = '/storage/' . $filePath;

             $FileData = array();
             if (($handle = fopen(asset($file_path), "r")) !== FALSE) {
                 while (($CurrentADV = fgetcsv($handle, 2000, ";")) !== FALSE) {
                     $FileData[] = $CurrentADV;
                 }
             }
             $LogImport = array();

             $Row = -1;
             if($FileData){
                 foreach($FileData as $AdvertData){
                     $errorRow = [];
                     $successRow = [];
                     $Row++;
                     if($Row==0){
                         continue;
                     }
                     $CheckAdvert = Adverts::select('id')->where('id',$AdvertData[0])->first();
                     if(!$CurrentADV){

                         $CategoryCheck = AdvertCategories::where('name',trim($AdvertData[3]))->first();
                         if(empty($CategoryCheck->id))
                             $errorRow[] = "Строка $Row - не найдена категория";

                         $CategorySubCheck = AdvertCategories::where('name',trim($AdvertData[4]))->first();
                         if(empty($CategorySubCheck->id))
                             $errorRow[] = "Строка $Row - не найдена подкатегория";

                         $RegionCheck = Regions::where('name',trim($AdvertData[5]))->first();
                         if(empty($RegionCheck->id))
                             $errorRow[] = "Строка $Row - не найден регион";

                         $CityCheck = Regions::where('name',trim($AdvertData[6]))->first();
                         if(empty($CityCheck->id))
                             $errorRow[] = "Строка $Row - не найден город";


                         if(empty($errorRow)){
                             $DataAdd = [
                                 'name'             => $AdvertData[1],
                                 'user_name'             => $AdvertData[8],
                                 'phone'             => $AdvertData[7],
                                 'category'         => $CategoryCheck->id,
                                 'sub_category'     => $CategorySubCheck->id,
                                 'description'      => $AdvertData[2],
                                 'region_id'        => $CityCheck->id,
                                 'parent_region_id' => $RegionCheck->id,
                                 'price'           => '',
                                 'status'           => 1,
                                 'user_id'          => 0,
                                 'images'           => $AdvertData[10],
                             ];
                             $AdvertID = Adverts::AddAdvert($DataAdd);
                             $successRow[] = "Строка $Row - объявление $AdvertID добавлено";
                         }else{
                             $errorRow[] = "Строка $Row - объявление не добавлено.";
                         }
                     }else{
                         $errorRow[] = "Строка $Row - объявление существует.";
                     }
                     $Log[0] = $successRow;
                     $Log[1] = $errorRow;
                     $LogImport[] = $Log;
                 }
             }
             // return back()->with('success','Файл успешно загружен!');

             return view(
                 'backend/items/import',
                 ['LogImport'=>$LogImport]
             );
         }*/
        return view(
            'backend/items/import',
            []
        );
    }

    public function ItemsListImportUploadInfo(Request $request)
    {
        $Final = 0;
        $Procent = 1;
        $ImportStats = unserialize($request->session()->get('import_stats'));
        if (!empty($ImportStats['current_position']) && !empty($ImportStats['count_all'])
            && $ImportStats['current_position'] > 0
            && $ImportStats['count_all'] > 0) {
            $Procent = intval($ImportStats['current_position'] * 100 / $ImportStats['count_all']);
            if ($ImportStats['count_all'] == $ImportStats['current_position']) {
                $Final = 1;
                $Procent = 100;
            }
        }
        if ($Procent <= 0) {
            $Procent = 1;
        }
        return response()->json(
            ['success'    => 1, 'final' => $Final, 'procent' => $Procent, 'import_stats' => $ImportStats,
             'import_log' => '']
        );

    }

    //Список импорт отбъявлений
    public function ItemsListImportUpload(Request $request)
    {
        $ImportInfo = array();

        if ($request->file('csv')) {
            $fileName = time() . '.csv';
            $filePath = $request->file('csv')->storeAs('csv', $fileName, 'public');

            $file_path = '/storage/' . $filePath;

            $FileData = array();
            $opts = array(
                "ssl" => array(
                    "verify_peer"      => FALSE,
                    "verify_peer_name" => FALSE,
                ),
            );

            if (($handle = fopen(asset($file_path), "r", FALSE, stream_context_create($opts))) !== FALSE) {
                while (($CurrentADV = fgetcsv($handle, 100000, ";")) !== FALSE) {
                    $FileData[] = $CurrentADV;
                }
            }
            $ImportInfo['count_all'] = count($FileData) - 1;
            $ImportInfo['current_position'] = 0;
            $LogImport = array();

            $Row = -1;
            if ($FileData) {
                foreach ($FileData as $AdvertData) {
                    $errorRow = [];
                    $successRow = [];
                    $Row++;
                    if ($Row == 0) {
                        continue;
                    }
                    if ($Row == 5) {
                        // sleep(5);
                    }
                    if ($Row == 10) {
                        // sleep(1);
                    }

                    $ImportInfo['current_position'] = $Row;
                    $CheckAdvert = Adverts::select('import_id')->where('import_id', $AdvertData[0])->first();
                    //$CheckAdvert = array();
                    if (!$CheckAdvert) {
                       // $AdvertData[3] = "IT, интернет, телеком";
                        $CategoryCheck = AdvertCategories::where('name', trim($AdvertData[3]))->first();
                        if (empty($CategoryCheck->id)) {
                            $errorRow[$Row][] = "Строка $Row - не найдена категория";
                        }
                        $CategorySubCheck = AdvertCategories::where('name', trim($AdvertData[4]))->first();
                        /* $CategorySubCheck = AdvertCategories::where('name', trim($AdvertData[4]))->first();
                         if (empty($CategorySubCheck->id)) {
                             $errorRow[$Row][] = "Строка $Row - не найдена подкатегория";
                         }*/

                        $RegionCheck = Regions::where('name', trim($AdvertData[5]))->first();
                        if (empty($RegionCheck->id)) {
                            $errorRow[$Row][] = "Строка $Row - не найден регион";
                        }

                        $CityCheck = Regions::where('name', trim($AdvertData[6]))->first();
                        if (empty($CityCheck->id)) {
                            $errorRow[$Row][] = "Строка $Row - не найден город";
                        }


                        if (empty($errorRow)) {

                            $DataPricesAll = array();
                            if (!empty($AdvertData[11])) {
                                $DataPrices = explode(',', $AdvertData[11]);
                                if ($DataPrices) {
                                    foreach ($DataPrices as $priceKey => $pricecValue) {
                                        $priceData = explode('|', $pricecValue);
                                        if(!empty($priceData[0])){

                                            $Masure = !empty($priceData[2]) ? $priceData[2] : 1;
                                            $Masure = array_search($Masure, Adverts::GetMasureListImport());
                                            if ($Masure === FALSE) {
                                                $Masure = 1;
                                            }
                                            $DataPricesAll['measure'][$priceKey] = $Masure;
                                            $DataPricesAll['name'][$priceKey] = $priceData[0] ? $priceData[0] : '';
                                            $DataPricesAll['price'][$priceKey] = $priceData[1] ? $priceData[1] : '';

                                        }
                                    }
                                }
                            }

                            $DataAdd = [
                                'import_id'        => $AdvertData[0],
                                'name'             => $AdvertData[1],
                                'user_name'        => $AdvertData[8],
                                'phone'            => $AdvertData[7],
                                'category'         => $CategoryCheck->id,
                                'sub_category'     => !empty($CategorySubCheck->id) ? $CategorySubCheck->id : 0,
                                'description'      => $AdvertData[2],
                                'region_id'        => $CityCheck->id,
                                'parent_region_id' => $RegionCheck->id,
                                'status'           => 2,
                                'user_id'          => 0,
                                'images'           => $AdvertData[10],
                                'price'           => $DataPricesAll,
                            ];

                            $AdvertID = Adverts::AddAdvert($DataAdd);

                            $successRow[$Row][] = "Строка $Row - объявление $AdvertID добавлено";
                        } else {
                            $errorRow[$Row][] = "Строка $Row - объявление не добавлено.";
                        }
                    } else {
                        $errorRow[$Row][] = "Строка $Row - объявление существует.";
                    }
                    $Log[0] = $successRow;
                    $Log[1] = $errorRow;
                    $LogImport[$Row] = $Log;

                    $request->session()->put('import_stats', serialize($ImportInfo));
                    $request->session()->save();
                    //  $request->session()->put('import_log', serialize($LogImport));

                }
            }
        } else {

        }

        return response()->json(['success' => 1, 'import_log' => $LogImport]);
    }

    //Список объявлений
    public function ItemsList(Request $request)
    {


        $Filter = array();
        $CategoryList = AdvertCategories::GetCategoryTree();
        $RegionsList = Regions::GetAllRegions(1);
        $StatusList = Adverts::GetStatusList();
        foreach ($RegionsList as $key => &$Region) {
            if ($Region->adverts_count == 0) {
                unset($RegionsList[$key]);
            } else {
                $Region['citys'] = Regions::GetAllCitys($Region->id, 1);
            }
        }


        if ($request->input('search')) {
            $Filter['id'] = $request->input('search');
            $Filter['email'] = $request->input('search');
        }
        if ($request->input('search_category')) {
            $Filter['sub_category_id'] = $request->input('search_category');
        }
        if ($request->input('search_city')) {
            $Filter['region_id'] = $request->input('search_city');
        }
        if ($request->input('search_status')) {
            $Filter['status'] = $request->input('search_status');
        }
        if ($request->input('search_text')) {
            $Filter['search_text_admin'] = $request->input('search_text');
        }
        $Filter['status_admin'] = 1;
        $listItems = Adverts::GetAdverts($Filter);

        if ($request->input('ajax')) {
            return view(
                'backend/items/items',
                ['listItems'  => $listItems, 'CategoryList' => $CategoryList, 'RegionsList' => $RegionsList,
                 'StatusList' => $StatusList, 'isAjax' => 1]
            );

            $returnHTML = view('backend/items/list')->with(
                ['listItems'  => $listItems, 'CategoryList' => $CategoryList, 'RegionsList' => $RegionsList,
                 'StatusList' => $StatusList, 'isAjax' => 1]
            )->render();

            return response()->json(['success' => 1, 'html' => $returnHTML]);
        }


        return view(
            'backend/items/list',
            ['listItems'  => $listItems, 'CategoryList' => $CategoryList, 'RegionsList' => $RegionsList,
             'StatusList' => $StatusList, 'isAjax' => 0]
        );
    }

    public function ItemsEdit($ID, Request $request)
    {
        $Item = array();
        $Citys = array();
        $subCategories = array();
        $AdvertData = array();
        $User = array();
        $CategoryList = AdvertCategories::GetAllCategories(0);
        if ($ID) {
            $Item = Adverts::where('id', $ID)->first();
            $Regions = Regions::GetAllRegions();
            $Citys = Regions::GetAllCitys($Item->parent_region_id);
            $Categories = AdvertCategories::GetAllCategories(0);
            $subCategories = AdvertCategories::GetAllCategories($Item->category);
            $AdvertData = Adverts::GetAdvertData($Item);
            $User = User::where('id', $Item->user_id)->first();
        } else {
            $Regions = Regions::GetAllRegions();
            $Categories = AdvertCategories::GetAllCategories(0);
        }
        $MasureList = Adverts::GetMasureList();

        return view(
            'backend/items/edit',
            ['Item'  => $Item, 'Regions' => $Regions, 'Categories' => $Categories, 'MasureList' => $MasureList,
             'Citys' => $Citys, 'subCategories' => $subCategories, 'AdvertData' => $AdvertData, 'User' => $User]
        );
    }

    public function ItemsEditSave(Request $request)
    {
        if (!$request->has('validation_success')) {
            $Errors = Adverts::ValidationAddForm($request->input('advert'));
            if ($Errors->fails()) {
                return response()->json(['errors' => $Errors->errors()->toArray()], 400);
            } else {
                return response()->json(['success' => 1]);
            }
        }

        if ($request->input('item_id')) {

            $DataAdd = [
                'name'             => $request->input('advert')['title'],
                'user_name'        => $request->input('advert')['user_name'],
                'phone'            => $request->input('advert')['phone'],
                'category'         => $request->input('advert')['category'],
                'sub_category'     => $request->input('advert')['subcategory'],
                'description'      => $request->input('advert')['description'],
                'price'            => $request->input('advert')['price'],
                'region_id'        => $request->input('advert')['city'],
                'parent_region_id' => $request->input('advert')['region'],
                'status'           => 2,
                'user_id'          => $request->input('advert')['user_id'],
                'images'           => !empty($request->file('advert')['images']) ? $request->file('advert')['images']
                    : '',
            ];
            $AdvertID = Adverts::EditAdvert($request->input('item_id'), $DataAdd);
            Adverts::SetSeoPage($request->input('item_id'));
            return redirect(route('admin.items.list'))->with('success', 'Объявление сохранено');
        } else {
            $DataAdd = [
                'name'             => $request->input('advert')['title'],
                'category'         => $request->input('advert')['category'],
                'sub_category'     => $request->input('advert')['subcategory'],
                'description'      => $request->input('advert')['description'],
                'price'            => $request->input('advert')['price'],
                'region_id'        => $request->input('advert')['city'],
                'user_name'        => $request->input('advert')['user_name'],
                'phone'            => $request->input('advert')['phone'],
                'parent_region_id' => $request->input('advert')['region'],
                'status'           => 2,
                'user_id'          => $request->input('advert')['user_id'],
                'images'           => !empty($request->file('advert')['images']) ? $request->file('advert')['images']
                    : '',
            ];
            $AdvertID = Adverts::AddAdvert($DataAdd);
            Adverts::SetSeoPage($AdvertID);
            return redirect(route('admin.items.list'))->with('success', 'Объявление добавлено');
        }

    }

    public function ItemsGet($ID, Request $request)
    {

        $Advert = Adverts::where('id', $ID)->first();
        $AdvertData = Adverts::GetAdvertData($Advert);

        return response()->json(['success' => 1, 'data' => $AdvertData, 'MeasureList' => Adverts::GetMasureList()]);
    }

    public function ItemsDelete($ID, Request $request)
    {

        if ($ID) {
            $Item = Adverts::where('id', $ID)->first();
            Adverts::DeleteAdvert($Item);
            return redirect(route('admin.items.list'))->with('success', 'Объявление удалено');
        } else {
            return redirect(route('admin.items.list'))->with('error', 'Объявление не удалено');
        }
    }

    public function ItemsChangeStatus(Request $request)
    {
        $Item = Adverts::where('id', $request->input('id'))->first();
        $Item->status = $request->input('status');
        $Item->save();
        Adverts::SetSeoPage($request->input('id'));
        return response()->json(['success' => 1]);
    }


    //Список пользователей
    public function SeoPagesList(Request $request)
    {
        $Filter = array();
        $CategoryList = AdvertCategories::GetCategoryTree();
        if ($request->input('search_category')) {
            $Filter['category_id'] = $request->input('search_category');
        }
        if ($request->input('search_text')) {
            $Filter['search_text'] = $request->input('search_text');
        }

        $listItems = SeoPage::GetSeoPages($Filter);

        return view('backend/seopages/list', ['listItems' => $listItems, 'CategoryList' => $CategoryList]);
    }


    public function SeoPagesReload($ID, Request $request)
    {
        /*$Adverts = Adverts::select('id')->get();
        if ($Adverts) {
            foreach ($Adverts as $advert) {
                Adverts::SetSeoPage($advert->id);
            }
        }

        return redirect(route('admin.seopages.list'))->with('success', 'Объявления перезагружены');*/
    }

    public function SeoPagesEdit($ID, Request $request)
    {
        $Item = array();
        $Categories = array();
        $subCategories = array();
        if ($ID) {
            $Item = SeoPage::where('id', $ID)->first();
            $Categories = AdvertCategories::GetAllCategories(0);
            $subCategories = AdvertCategories::GetAllCategories($Item->category);
        } else {
            $Categories = AdvertCategories::GetAllCategories(0);
        }

        return view(
            'backend/seopages/edit', ['Item' => $Item, 'Categories' => $Categories, 'subCategories' => $subCategories]
        );
    }

    //Сохранение пользователя
    public function SeoPagesEditSave(Request $request)
    {
        $request['popular_adv'] = $request['popular_adv'] ? $request['popular_adv'] : 0;
        $request['name_adv'] = $request['name_adv'] ? $request['name_adv'] : 0;
        $request['block_adv'] = $request['block_adv'] ? $request['block_adv'] : 0;
        $request['public'] = $request['public'] ? $request['public'] : 0;
        $request['show_short_description'] = $request['show_short_description'] ? $request['show_short_description']
            : 0;


        if ($request->input('item_id')) {
            SeoPage::where('id', $request->input('item_id'))->first()->fill($request->all())->save();
            return redirect(route('admin.seopages.list'))->with('success', 'Посадочная страница сохранена');
        } else {
            SeoPage::create($request->all());
            return redirect(route('admin.seopages.list'))->with('success', 'Посадочная страница добавлена');
        }
    }

    //Удаление пользователя
    public function SeoPagesDelete($ID, Request $request)
    {
        if ($ID) {
            $Item = SeoPage::where('id', $ID)->first();
            $Item->delete();
            return redirect(route('admin.seopages.list'))->with('success', 'Посадочная страница удалена');
        } else {
            return redirect(route('admin.seopages.list'))->with('error', 'Посадочная страница не удалена');
        }
    }

    //Редактирование сео настроек
    public function SeoEdit(Request $request)
    {
        $Items = DB::table('seo_settings')->orderBy('position', 'ASC')->get();
        $Banners = DB::table('banners')->orderBy('id', 'ASC')->get();
        return view('backend/seopages/settings', ['Items' => $Items, 'Banners'=>$Banners]);
    }

    //Сохранение сео настроек
    public function SeoEditSave(Request $request)
    {
        //$Page = first();
        DB::table('seo_settings')->where('id', $request->input('item_id'))->update(
            ['title' => $request->input('title'), 'h1' => $request->input('h1'),
             'text'  => $request->input('text'), 'description' => $request->input('description'),]
        );

        return redirect(route('admin.seo.edit'))->with('success', 'Настройки сохранены');
    }


    //Сохранение баннеров
    public function SeoBannersSave(Request $request)
    {
        if($request->input('link')){
            foreach( $request->input('link') as $key=>$Item){
                DB::table('banners')->where('id', $key)->update(
                    ['link' =>$Item,'path' =>$request->input('path')[$key]]
                );
            }
        }
        //$Page = first();
       /* DB::table('seo_settings')->where('id', $request->input('item_id'))->update(
            ['title' => $request->input('title'), 'h1' => $request->input('h1'),
             'text'  => $request->input('text'), 'description' => $request->input('description'),]
        );*/

        return redirect(route('admin.seo.edit'))->with('success', 'Баннеры сохранены');
    }

    //Список контактов
    public function ListContacts(Request $request)
    {
        $Contacts = DB::table('contacts')->where('type', 1)->orderBy('id', 'DESC')->paginate(50);
        return view('backend/contacts', ['listItems' => $Contacts]);

    }

    public function ListAdvertsContacts(Request $request)
    {
        $Contacts = DB::table('contacts')->where('type', 2)->orderBy('id', 'DESC')->paginate(1);
        return view('backend/contacts-adverts', ['listItems' => $Contacts]);

    }

}
