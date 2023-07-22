<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\AdvertCategories;
use App\Models\UserImages;
use App\Models\Adverts;
use App\Models\SeoPage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Regions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdvertsController extends Controller {
    /* public function AdvertCurrentAjax($City, $Categroy, $SubCategory, $Advert, Request $request)
      {
      $Advert = str_replace('t-', '', $Advert);

      $CheckCity = Regions::where(['url' => $City])->first();
      $CheckCategory = AdvertCategories::where(['url' => $SubCategory])->first();
      $CheckParentCategory = AdvertCategories::where(['url' => $Categroy])->first();
      if(!$CheckCategory){
      $AdvertItem = Adverts::where(
      ['id'        => $Advert, 'status'=>2, 'sub_category' => 0, 'category' => $CheckParentCategory->id,
      'region_id' => $CheckCity['id']]
      )->first();
      }



      if ((!$CheckCategory&&!$AdvertItem) || !$CheckParentCategory || !$CheckCity) {
      abort(404);
      }

      if(empty($AdvertItem)){
      $AdvertItem = Adverts::where(
      ['id'        => $Advert,'status'=>2, 'sub_category' => $CheckCategory->id, 'category' => $CheckParentCategory->id,
      'region_id' => $CheckCity['id']]
      )->first();
      }
      if (!$AdvertItem) {
      abort(404);
      }

      $AdvertItem->update(['views' => $AdvertItem->views + 1]);
      $AdvertItem = Adverts::GetAdvertData($AdvertItem);


      return response()->json(['success' => $AdvertItem->phone_clear ?  $AdvertItem->phone_clear : $AdvertItem['user_info']->phone_clear]);
      } */

    public function AdvertCurrent($City, $Categroy, $SubCategory, $Advert, Request $request) {
        $Advert = str_replace('t-', '', $Advert);

        $CheckCity = Regions::where(['url' => $City])->first();
        $CheckCategory = AdvertCategories::where(['url' => $SubCategory])->first();
        $CheckParentCategory = AdvertCategories::where(['url' => $Categroy])->first();
        if (!$CheckCategory) {
            $AdvertItem = Adverts::where(
                            ['id' => $Advert, 'sub_category' => 0, 'category' => $CheckParentCategory->id,
                                'region_id' => $CheckCity['id']]
                    )->first();
            if (empty($AdvertItem->status) || (!empty(Auth::user()->id) && $AdvertItem->status != 2 && $AdvertItem->user_id != Auth::user()->id)) {
                abort(404);
            }
        }



        if ((!$CheckCategory && !$AdvertItem) || !$CheckParentCategory || !$CheckCity) {
            abort(404);
        }

        if (empty($AdvertItem)) {
            $AdvertItem = Adverts::where(
                            ['id' => $Advert, 'sub_category' => $CheckCategory->id, 'category' => $CheckParentCategory->id,
                                'region_id' => $CheckCity['id']]
                    )->first();
            if (empty($AdvertItem->status) || ($AdvertItem->status != 2 && $AdvertItem->user_id != Auth::user()->id)) {
                abort(404);
            }
        }

        if (!$AdvertItem) {
            abort(404);
        }


        $AdvertItem->update(['views' => $AdvertItem->views + 1]);
        $AdvertItem = Adverts::GetAdvertData($AdvertItem);

        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = $AdvertItem->name;
        $dataPageDefault->description = Str::substr($AdvertItem->text, 0, 140);

        $Adverts = array();
        if ($AdvertItem->user_id > 0) {
            $Adverts = Adverts::GetAdverts(
                            array('limit' => 10, 'status' => 2, 'exclude' => $AdvertItem->id, 'region_id' => $request->session()->get('city'), 'user_id' => $AdvertItem->user_id)
            );
        }

        return view(
                'adverts.current',
                ['HeaderSearchShow' => 1, 'CheckParentCategory' => $CheckParentCategory, 'CheckCategory' => $CheckCategory,
                    'advert' => $AdvertItem, 'Adverts' => $Adverts, 'dataPageDefault' => $dataPageDefault]
        );
    }

    //Главная страница для города
    public function CityIndex(Request $request) {

        $SeoBottomCity = SeoPage::GetSeoCityBottom($request);
        if ($request->input('search')) {
            $Adverts = Adverts::GetAdverts(
                            array('limit' => 20, 'search' => $request->input('search'), 'search_id' => 1,
                                'region_id' => $request->session()->get('city'))
            );
            //$Categories = AdvertCategories::GetAllCategories(0);
            return view(
                    'adverts.search', ['Adverts' => $Adverts, 'HeaderSearchShow' => 1,
                'SeoBottomCity' => $SeoBottomCity, 'searchText' => $request->input('search')]
            );
        } else {

            $dataPageDefault = SeoPage::GetSeoPageData('home_region');
            $Adverts = User::GetUsersSite(array('limit' => 20, 'region_id' => $request->session()->get('city')));
            $Categories = AdvertCategories::GetHomeCategories();
            return view(
                    'home', ['Users' => $Adverts, 'HeaderSearchShow' => 1, 'Categories' => $Categories,
                'SeoBottomCity' => $SeoBottomCity, 'dataPageDefault' => $dataPageDefault]
            );
        }
    }

    //Главная категория для города
    public function CategoryPageAjax(Request $request) {

        $CheckCategory = AdvertCategories::where(['url' => $request->route('category')])->first();
        if (!$CheckCategory) {
            //abort(404);
            return $this->SeoPageAjax($request);
        }

        $Adverts = Adverts::GetAdverts(
                        array('limit' => 50, 'page' => $request->input('page'),
                            'region_id' => $request->session()->get('city'), 'category_id' => $CheckCategory->id)
        );

        return view('adverts.category_ajax', ['Adverts' => $Adverts]);
    }

    //Главная категория для города
    public function SeoPageAjax(Request $request) {

        $CheckCategory = SeoPage::where(['url' => $request->route('category')])->first();
        if (!$CheckCategory) {
            abort(404);
        }

        $SeoPageAdverts = DB::table('seo_pages_relations')->select('advert_id')->where(
                        'city_id', $request->session()->get('city')
                )->where('page_id', $CheckCategory->id)->get()->keyBy('advert_id')->toArray();
        $SeoPageAdverts = array_keys($SeoPageAdverts);

        $Adverts = Adverts::GetAdverts(
                        array('limit' => 50, 'region_id' => $request->session()->get('city'), 'page' => $request->input('page'), 'ids' => $SeoPageAdverts)
        );

        return view('adverts.category_ajax', ['Adverts' => $Adverts]);
    }

    public function SeoPagePage(Request $request) {
        $CheckCategory = SeoPage::where(['url' => $request->route('category')])->first();
        if (!$CheckCategory) {
            abort(404);
        }
        $CheckCategory->name_bread = $CheckCategory->name;

        $countTextBread = '';

        $SeoBottomCategories = AdvertCategories::GetAllCategories(
                        0, $request->session()->get('city'), 0, 4, 1
        );

        $SubCategories = array();
        $PopularPages = array();

        $SeoBottomCity = SeoPage::GetSeoCityBottom($request);
        $SeoPageAdverts = DB::table('seo_pages_relations')->select('advert_id')->where(
                        'city_id', $request->session()->get('city')
                )->where('page_id', $CheckCategory->id)->get()->keyBy('advert_id')->toArray();

        $SeoPageAdverts = array_keys($SeoPageAdverts);

        $Adverts = Adverts::GetAdverts(
                        array('limit' => 50, 'region_id' => $request->session()->get('city'), 'ids' => $SeoPageAdverts)
        );

        $AdvertsCountAll = 0;
        $AdvertsCountAllUnique = 0;

        $AdvertsCountAll = Adverts::GetAdverts(
                        array('limit' => 50, 'seopage' => 1, 'region_id' => $request->session()->get('city'), 'ids' => $SeoPageAdverts), 1
        );
        $AdvertsCountAllUnique = Adverts::GetAdverts(
                        array('limit' => 50, 'seopage' => 1, 'group_by_user_id' => 1, 'region_id' => $request->session()->get('city'), 'ids' => $SeoPageAdverts), 1
        );

        $Categories = AdvertCategories::GetAllCategories(0);
        $DisableSearchBots = 0;
        if ($AdvertsCountAll <= 0) {
            $DisableSearchBots = 1;
        }

        $CheckCategory->title = SeoPage::GetSeoTextByMarkers($CheckCategory->title, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->description = SeoPage::GetSeoTextByMarkers($CheckCategory->description, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->text = SeoPage::GetSeoTextByMarkers($CheckCategory->text, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->h1 = SeoPage::GetSeoTextByMarkers($CheckCategory->h1, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->name_bread = SeoPage::GetSeoTextByMarkers($CheckCategory->name_bread, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);

        //СЕО ДАННЫЕ
        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = $CheckCategory->title;
        $dataPageDefault->description = $CheckCategory->description;
        $dataPageDefault->text = $CheckCategory->text;

        //SEO
        /* $SeoMarkerCategory = AdvertCategories::where('id',$CheckCategory->category)->first();
          $SeoMarkerSunCategory = AdvertCategories::where('id',$CheckCategory->subcategory)->first();


          $CheckCategory->h1 = str_replace("{category.parent}",$SeoMarkerCategory->name,$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{category}",$SeoMarkerSunCategory->name,$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{total.u}",$AdvertsCountAll,$CheckCategory->h1);

          $CheckCategory->h1 = str_replace("{totalu.textu}", AdvertCategories::GetCategoryTextCountU($AdvertsCountAll),$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{totalu.texto}", AdvertCategories::GetCategoryTextCountO($AdvertsCountAll),$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{totalu.textp}", AdvertCategories::GetCategoryTextCountP($AdvertsCountAll),$CheckCategory->h1);

          $City = Regions::where('id',$request->session()->get('city'))->first();
          if(!empty($City)&&$City->parent_id>0){
          $Region = Regions::where('id',$City->parent_id)->first();
          }
          if(!empty($City)){
          $CheckCategory->h1 = str_replace("{city}", $City->name,$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{city.in}", $City->name_case,$CheckCategory->h1);        }
          if(!empty($Region)){
          $CheckCategory->h1 = str_replace("{region}", $Region->name,$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{region.in}", $Region->name_case,$CheckCategory->h1);
          }
          $CheckCategory->h1 = str_replace("{totalu.textp}", AdvertCategories::GetCategoryTextCountP($AdvertsCountAll),$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{master.text}", AdvertCategories::GetCategoryTextCountDefault($AdvertsCountAll," {$CheckCategory->master_1}}|{$CheckCategory->master_2}|{$CheckCategory->master_3}"),$CheckCategory->h1);
          $CheckCategory->h1 = str_replace("{total.m}", $AdvertsCountAllUnique,$CheckCategory->h1); */

        //Выводить карточки из категории/подкатегории, если в подборке меньше 10 карточек
        $AdvertsMore = array();
        if ($AdvertsCountAll < 10) {
            if (!empty($CheckCategory->subcategory)) {
                $AdvertsMore = Adverts::GetAdverts(
                                array('limit' => 30, 'region_id' => $request->session()->get('city'), 'excludes' => $SeoPageAdverts, 'sub_category_id' => $CheckCategory->subcategory));
            } else if (!empty($CheckCategory->category)) {
                $AdvertsMore = Adverts::GetAdverts(
                                array('limit' => 30, 'region_id' => $request->session()->get('city'), 'excludes' => $SeoPageAdverts, 'category_id' => $CheckCategory->category));
            }
        }





        return view(
                'adverts.category', ['Adverts' => $Adverts, 'HeaderSearchShow' => 1, 'Categories' => $Categories,
            'SeoBottomCity' => $SeoBottomCity, 'CheckCategory' => $CheckCategory,
            'SubCategories' => $SubCategories, 'AdvertsCountAll' => $AdvertsCountAll,
            'dataPageDefault' => $dataPageDefault, 'countTextBread' => $countTextBread,
            'PopularPages' => $PopularPages, 'SeoBottomCategories' => $SeoBottomCategories, 'DisableSearchBots' => $DisableSearchBots, 'SeoPage' => 1, 'AdvertsMore' => $AdvertsMore]
        );

        // abort(404);
    }

    public function CategoryPage(Request $request) {
        $CheckCategory = AdvertCategories::GetCategoryUrlInfoRegion($request->route('category'), $request->session()->get('city'));

        if (!$CheckCategory) {
            return $this->SeoPagePage($request);
        }





        $SubCategories = AdvertCategories::GetAllCategories($CheckCategory->id, $request->session()->get('city'), 0, 0);
        if ($SubCategories) {
            foreach ($SubCategories as $key => $SubCategory) {
                /* foreach($SubCategory as $keySub=>$subCategory){
                  if($subCategory->GetAdvertsCountByRegion()==0)
                  unset($SubCategories[$key][$keySub]);
                  } */
            }
        }





        $SeoBottomCity = SeoPage::GetSeoCityBottom($request);
        $SeoBottomCategories = AdvertCategories::GetAllCategories(
                        0, $request->session()->get('city'), 0, 4, 1
        );

        /* $Adverts = Adverts::GetAdverts(
          array('limit' => 50, 'region_id' => $request->session()->get('city'), 'category_id' => $CheckCategory->id)
          ); */
        $Adverts = User::GetUsersSite(array('limit' => 20, 'region_id' => $request->session()->get('city'), 'category_id' => $CheckCategory->id));
        $AdvertsCountAll = Adverts::GetAdverts(
                        array('limit' => 50, 'region_id' => $request->session()->get('city'), 'category_id' => $CheckCategory->id), 1
        );
        $AdvertsCountAllUnique = Adverts::GetAdverts(
                        array('limit' => 50, 'group_by_user_id' => 1, 'category_id' => $CheckCategory->id, 'region_id' => $request->session()->get('city')), 1
        );

        $CheckCategory->title = SeoPage::GetSeoTextByMarkers($CheckCategory->title, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->description = SeoPage::GetSeoTextByMarkers($CheckCategory->description, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->text = SeoPage::GetSeoTextByMarkers($CheckCategory->text, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->h1 = SeoPage::GetSeoTextByMarkers($CheckCategory->h1, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);

        //СЕО ДАННЫЕ
        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = $CheckCategory->title;
        $dataPageDefault->h1 = $CheckCategory->h1;
        $dataPageDefault->description = $CheckCategory->description;
        $dataPageDefault->text = $CheckCategory->text;
        $countTextBread = $CheckCategory->GetAdvertsCountByRegion() . " " . AdvertCategories::GetCategoryTextCount(
                        $AdvertsCountAll
        );

        $PopularPages = SeoPage::GetSeoPopularPagesByCategory($CheckCategory->id, 0, $request);
        $BlockPages = SeoPage::GetSeoColumnPagesByCategory($CheckCategory->id, 0, $request);
        /*     echo"<pre>";
          echo print_r($BlockPages,1);
          echo"</pre>"; */

        $DisableSearchBots = 0;
        if ($AdvertsCountAll <= 0) {
            $DisableSearchBots = 1;
        }

        return view(
                'adverts.category', ['Users' => $Adverts, 'HeaderSearchShow' => 1,
            'SeoBottomCity' => $SeoBottomCity, 'CheckCategory' => $CheckCategory,
            'SubCategories' => $SubCategories, 'AdvertsCountAll' => $AdvertsCountAll,
            'dataPageDefault' => $dataPageDefault, 'countTextBread' => $countTextBread,
            'PopularPages' => $PopularPages, 'BlockPages' => $BlockPages, 'DisableSearchBots' => $DisableSearchBots, 'SeoBottomCategories' => $SeoBottomCategories]
        );
    }

    //Подкатегория категория для города
    public function SubCategoryPage(Request $request) {
        //  AdvertCategories::ChangeRegion($request->session()->get('city'));
        /* $CheckCategory = AdvertCategories::where(['url' => $request->route('subcategory')])->withCount(
          ['AdvertsSubCategory as adverts_count']
          )->first();
          $CheckParentCategory = AdvertCategories::where(['url' => $request->route('category')])->first(); */


        $CheckCategory = AdvertCategories::GetCategoryUrlInfoRegion($request->route('subcategory'), $request->session()->get('city'));
        $CheckParentCategory = AdvertCategories::GetCategoryUrlInfoRegion($request->route('category'), $request->session()->get('city'));

        if (!$CheckCategory || !$CheckParentCategory) {
            if (!$CheckCategory) {
                return $this->AdvertCurrent($request->route('region'), $request->route('category'), '', $request->route('subcategory'), $request);
                exit();
            }
            abort(404);
        }





        $SubCategories = AdvertCategories::GetAllCategories(
                        $CheckCategory->parent_id, $request->session()->get('city'), 0
                )->toArray();
        if ($SubCategories) {
            $SubCategories = array_chunk($SubCategories, ceil(count($SubCategories) / 3));
        } else {
            $SubCategories = array();
        }

        $SeoBottomCategories = AdvertCategories::GetAllCategories(
                        0, $request->session()->get('city'), 0, 4, 1
        );
        $SubCategories = array();

        $SeoBottomCity = SeoPage::GetSeoCityBottom($request);

        /* $Adverts = Adverts::GetAdverts(
          array('limit'           => 50, 'region_id' => $request->session()->get('city'),
          'sub_category_id' => $CheckCategory->id, 'children_sub_category_id' => $CheckParentCategory->id)
          ); */
        $Adverts = User::GetUsersSite(array('limit' => 20, 'region_id' => $request->session()->get('city'), 'sub_category_id' => $CheckCategory->id));
        $AdvertsCountAll = Adverts::GetAdverts(
                        array('limit' => 50, 'region_id' => $request->session()->get('city'),
                            'sub_category_id' => $CheckCategory->id, 'children_sub_category_id' => $CheckParentCategory->id), 1
        );

        $DisableSearchBots = 0;
        if ($AdvertsCountAll <= 0) {
            $DisableSearchBots = 1;
        }
        $AdvertsCountAllUnique = Adverts::GetAdverts(
                        array('limit' => 50, 'group_by_user_id' => 1, 'sub_category_id' => $CheckCategory->id, 'region_id' => $request->session()->get('city'), 'children_sub_category_id' => $CheckParentCategory->id), 1
        );

        $CheckCategory->title = SeoPage::GetSeoTextByMarkers($CheckCategory->title, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->description = SeoPage::GetSeoTextByMarkers($CheckCategory->description, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->text = SeoPage::GetSeoTextByMarkers($CheckCategory->text, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);
        $CheckCategory->h1 = SeoPage::GetSeoTextByMarkers($CheckCategory->h1, $request, $CheckCategory, $AdvertsCountAll, $AdvertsCountAllUnique);

        //СЕО ДАННЫЕ
        $dataPageDefault = new \stdClass();
        $dataPageDefault->title = $CheckCategory->title;
        $dataPageDefault->h1 = $CheckCategory->h1;
        $dataPageDefault->description = $CheckCategory->description;
        $dataPageDefault->text = $CheckCategory->text;
        $countTextBread = $CheckCategory->GetAdvertsCountByRegion() . " " . AdvertCategories::GetCategoryTextCount(
                        $AdvertsCountAll
        );

        $PopularPages = SeoPage::GetSeoPopularPagesByCategory(0, $CheckCategory->id, $request);
        $BlockPages = SeoPage::GetSeoColumnPagesByCategory(0, $CheckCategory->id, $request);

        $pop = AdvertCategories::where(['popular' => true, 'parent_id' => $CheckCategory->id])->get();
        $side = AdvertCategories::where(['show_col' => true])->get();

        return view(
                'adverts.category', ['Users' => $Adverts, 'PopularPages' => $PopularPages, 'BlockPages' => $BlockPages, 'HeaderSearchShow' => 1,
            'SeoBottomCity' => $SeoBottomCity,
            'CheckCategory' => $CheckCategory, 'dataPageDefault' => $dataPageDefault, 'CheckParentCategory' => $CheckParentCategory,
            'SubCategories' => $SubCategories, 'AdvertsCountAll' => $AdvertsCountAll,
            'countTextBread' => $countTextBread, 'SeoBottomCategories' => $SeoBottomCategories,
            'subcategory' => 1, 'DisableSearchBots' => $DisableSearchBots,
            'pop' => $pop,
            'side' => $side]
        );
    }

    //Подкатегория категория для города
    public function SubCategoryPageAjax(Request $request) {
        $CheckCategory = AdvertCategories::where(['url' => $request->route('subcategory')])->first();
        $CheckParentCategory = AdvertCategories::where(['url' => $request->route('category')])->first();

        if (!$CheckCategory || !$CheckParentCategory) {
            if (!$CheckCategory) {
                return $this->AdvertCurrentAjax($request->route('region'), $request->route('category'), '', $request->route('subcategory'), $request);
                exit();
            }
            abort(404);
        }

        if (!$CheckCategory || !$CheckParentCategory) {
            abort(404);
        }



        $Adverts = Adverts::GetAdverts(
                        array('limit' => 50, 'page' => $request->input('page'),
                            'region_id' => $request->session()->get('city'), 'sub_category_id' => $CheckCategory->id)
        );
        return view('adverts.category_ajax', ['Adverts' => $Adverts, 'isajax' => 1]);
    }

    //Список городов по региону
    public function getCitysByRegion(Request $request) {
        $Citys = Regions::GetAllCitys($request->input('regionID'));
        return response()->json(['success' => $Citys]);
    }

    //Список подкатегория по категории
    public function getCategoriesByParent(Request $request) {
        $Categories = AdvertCategories::GetAllCategories($request->input('parentID'));
        return response()->json(['success' => $Categories]);
    }

    //Форма добавления объявления
    public function AddForm(Request $request) {
        $Regions = Regions::GetAllRegions();
        $Categories = AdvertCategories::GetAllCategories(0);
        $MasureList = Adverts::GetMasureList();
        return view('adverts.add', ['Regions' => $Regions, 'Categories' => $Categories, 'MasureList' => $MasureList]);
    }

    //Форма редактирования объявления
    public function EditForm($ID, Request $request) {



        $Item = array();
        $Citys = array();
        $subCategories = array();
        $AdvertData = array();
        $User = array();
        $CategoryList = AdvertCategories::GetAllCategories(0);
        if ($ID) {
            $Item = Adverts::where('id', $ID)->where('user_id', Auth::user()->id)->first();
            $Regions = Regions::GetAllRegions();
            $Citys = Regions::GetAllCitys($Item->parent_region_id);
            $Categories = AdvertCategories::GetAllCategories(0);
            $subCategories = AdvertCategories::GetAllCategories($Item->category);
            $AdvertData = Adverts::GetAdvertData($Item);
            $User = User::where('id', $Item->user_id)->first();
        } else {
            abort(404);
        }
        $MasureList = Adverts::GetMasureList();
        return view('adverts.edit', ['Item' => $Item, 'Regions' => $Regions, 'Categories' => $Categories, 'MasureList' => $MasureList, 'Citys' => $Citys, 'subCategories' => $subCategories, 'AdvertData' => $AdvertData, 'User' => $User]);
    }

    //Добавление объявления
    public function Add(Request $request) {
        $Errors = $this->ValidationAddForm($request->input('advert'));
        if ($Errors->fails()) {
            return response()->json(['errors' => $Errors->errors()->toArray()], 400);
        } else {

            $DataAdd = [
                'name' => $request->input('advert')['title'],
                'user_name' => $request->input('advert')['user_name'],
                'phone' => $request->input('advert')['user_phone'],
                'category' => $request->input('advert')['category'],
                'sub_category' => !empty($request->input('advert')['subcategory']) ? $request->input('advert')['subcategory'] : 0,
                'description' => $request->input('advert')['description'],
                'price' => $request->input('advert')['price'],
                'region_id' => $request->input('advert')['city'],
                'parent_region_id' => $request->input('advert')['region'],
                'status' => 1,
                'user_id' => Auth::user()->id,
                'images' => $request->file('advert')['images'],
            ];
            $AdvertID = Adverts::AddAdvert($DataAdd);
            $UserInfo = User::where('id', Auth::user()->id)->first();
            if (!$UserInfo->phone) {
                $UserInfo->phone = $request->input('advert')['user_phone'];
                $UserInfo->save();
            }
            if (!$UserInfo->name) {
                $UserInfo->name = $request->input('advert')['user_name'];
                $UserInfo->save();
            }

            $mData = array();
            $mData['id'] = $AdvertID;
            $mData['title'] = $request->input('advert')['title'];
            $mData['description'] = $request->input('advert')['description'];

            dispatch(new SendEmailJob($mData));

            /*  Mail::send(
              'mail.newadv', ["mData" => $mData], function ($message) use ($mData) {
              $message->to(env('APP_ADMIN_EMAIL'));
              $message->subject('Служба поддержки');
              }
              ); */

            session()->put('success', 'Объявление добавлено!');

            return response()->json(['success' => 1]);
        }
    }

    public function Edit(Request $request) {

        $Errors = $this->ValidationAddForm($request->input('advert'));
        if ($Errors->fails()) {
            return response()->json(['errors' => $Errors->errors()->toArray()], 400);
        } else {
            if ($request->input('item_id')) {
                $Item = Adverts::where('id', $request->input('item_id'))->where('user_id', Auth::user()->id)->first();
                if (!$Item) {
                    session()->put('success', 'Ошибка при сохранении!');
                    return response()->json(['success' => 0]);
                }
                $DataAdd = [
                    'user_name' => $request->input('advert')['user_name'],
                    'phone' => $request->input('advert')['user_phone'],
                    'name' => $request->input('advert')['title'],
                    'category' => $request->input('advert')['category'],
                    'sub_category' => $request->input('advert')['subcategory'],
                    'description' => $request->input('advert')['description'],
                    'price' => $request->input('advert')['price'],
                    'region_id' => $request->input('advert')['city'],
                    'parent_region_id' => $request->input('advert')['region'],
                    'status' => 1,
                    'user_id' => Auth::user()->id,
                    'images' => $request->file('advert')['images'],
                ];
                $AdvertID = Adverts::EditAdvert($request->input('item_id'), $DataAdd);
                Adverts::SetSeoPage($request->input('item_id'));
                session()->put('success', 'Объявление сохранено!');

                return response()->json(['success' => 1]);
            }

            session()->put('success', 'Объявление добавлено!');

            return response()->json(['success' => 1]);
        }
    }

    //Проверяем изображение к требованиям
    public function UploadImage(Request $request) {
        return response()->json(['errors' => UserImages::ImageUploadCheck($request->all())]);
    }

    //Валидация формы для добавления объетка
    private function ValidationAddForm($data) {
        return Validator::make(
                        $data, [
                    'user_name' => 'required|string|max:190',
                    'user_phone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/|unique:users,phone,'
                    . Auth::user()->id,
                    'region' => 'required|integer',
                    'city' => 'required|integer',
                    'title' => 'required|string|max:190',
                    'category' => 'required|integer',
                    //'subcategory' => 'required|integer',
                    'description' => 'required|string',
                        //'accept'      => 'required|string',
                        ], [
                    'user_name.required' => 'Укажите имя',
                    'user_phone.required' => 'Укажите телефон',
                    'user_phone.regex' => 'Введите корректный телефон, например 79221110500',
                    'user_phone.unique' => 'Пользователь с данным телефоном уже зарегистрирован. Используйте другой телефон',
                    'region.required' => 'Укажите регион',
                    'region.integer' => 'Укажите регион',
                    'city.required' => 'Укажите город',
                    'city.integer' => 'Укажите город',
                    'title.required' => 'Заполните название объявления',
                    'category.required' => 'Выберите категорию',
                    'category.integer' => 'Выберите категорию',
                    //'subcategory.required' => 'Выберите подкатегорию',
                    // 'subcategory.integer'  => 'Выберите подкатегорию',
                    'description.required' => 'Заполните название описание',
                        //'accept.required'      => 'Вы должны согласиться с условиями',
                        ]
        );
    }

    //Обновление объявления
    public function UpdateAdvert(Request $request) {
        $ID = $request->input('id');
        if (!empty(Auth::user()->id)) {
            $Advert = Adverts::where('id', $ID)->where('user_id', Auth::user()->id)->first();
            if ($Advert) {
                $Advert->date_up = date('Y-m-d H:i:s');
                $Advert->save();
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    //Удаление объявления
    public function DeleteAdvert(Request $request) {
        $ID = $request->input('id');
        if (!empty(Auth::user()->id)) {
            $Advert = Adverts::where('id', $ID)->where('user_id', Auth::user()->id)->first();
            if ($Advert) {
                Adverts::DeleteAdvert($Advert);
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    //Закрытие объявления
    public function CloseAdvert(Request $request) {
        $ID = $request->input('id');
        if (!empty(Auth::user()->id)) {
            $Advert = Adverts::where('id', $ID)->where('user_id', Auth::user()->id)->where('status', 2)->first();
            if ($Advert) {
                $Advert->status = 4;
                $Advert->save();
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    //Показать телефон
    public function getphone(Request $request) {

        $AdvertItem = User::where(
                        ['id' => $request->input('item')]
                )->first();

        return response()->json(['success' => !empty($AdvertItem->phone) ? $AdvertItem->phone : ""]);
    }

    //Открытие объявления
    public function OpenAdvert(Request $request) {
        $ID = $request->input('id');
        if (!empty(Auth::user()->id)) {
            $Advert = Adverts::where('id', $ID)->where('user_id', Auth::user()->id)->where('status', 4)->first();
            if ($Advert) {
                $Advert->status = 2;
                $Advert->save();
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    //Лист избранного
    public function UpdateWish(Request $request) {
        $ID = $request->input('id');
        if (!empty(Auth::user()->id)) {
            $Advert = DB::table('wishlist')->where('user_id', Auth::user()->id)->where('advert_id', $ID)->first();
            if (!$Advert) {
                DB::table('wishlist')->insert(
                        ['user_id' => Auth::user()->id, 'advert_id' => $ID, 'datetime' => date('Y-m-d H:i:s')]
                );
                return response()->json(['success' => 1]);
            } else {
                DB::table('wishlist')->where('user_id', Auth::user()->id)->where('advert_id', $ID)->delete();
                return response()->json(['success' => 0]);
            }
        } else {
            $Advert = DB::table('wishlist')->where('session_id', session()->getId())->where('advert_id', $ID)->first();
            if (!$Advert) {
                DB::table('wishlist')->insert(
                        ['session_id' => session()->getId(), 'advert_id' => $ID, 'datetime' => date('Y-m-d H:i:s')]
                );
                return response()->json(['success' => 1]);
            } else {
                DB::table('wishlist')->where('session_id', session()->getId())->where('advert_id', $ID)->delete();
                return response()->json(['success' => 0]);
            }
        }
    }

    public function WishList(Request $request) {
        if (!empty(Auth::user()->id)) {

            $IDS = DB::table('wishlist')->select('advert_id')->where('user_id', Auth::user()->id)->get()->keyBy(
                            'advert_id'
                    )->toArray();
            $IDS = array_keys($IDS);
        } else {
            $IDS = DB::table('wishlist')->select('advert_id')->where('session_id', session()->getId())->get()->keyBy(
                            'advert_id'
                    )->toArray();
            $IDS = array_keys($IDS);
        }


        $Adverts = Adverts::GetAdverts(array('ids' => $IDS));
        return view('user.wishlist', ['Adverts' => $Adverts]);
    }

    public function Sitemap(Request $request) {
        $dataPageDefault = SeoPage::GetSeoPageData('map');

        $SEOPages = SeoPage::where('public', 1)->get();

        if ($SEOPages) {
            foreach ($SEOPages as $key => $SEOPage) {
                $SEOPage->count = DB::table('seo_pages_relations')->where('page_id', $SEOPage->id)->where(
                                'city_id', $request->session()->get('city')
                        )->count();
                if ($SEOPage->count == 0) {
                    unset($SEOPages[$key]);
                }
                $SEOPage->name = SeoPage::GetSeoTextByMarkers($SEOPage->name, $request, $SEOPage, 0, 0);
            }
        }


        return view('sitemap', ['dataPageDefault' => $dataPageDefault, 'SEOPages' => $SEOPages]);
    }

}
