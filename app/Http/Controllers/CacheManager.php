<?php

namespace App\Http\Controllers;

use App\Models\Adverts;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
ini_set('max_execution_time', 10000);
class CacheManager extends Controller
{
    //Переиндексация страниц-подборок
    public function SeoPagesReload(Request $request){
        $start = microtime(TRUE);

        $db = DB::connection('sphinx');

        $SeoPages = SeoPage::where('public',1)->get();

        foreach ($SeoPages as $seoPage) {
            DB::table('seo_pages_relations')->where('page_id',$seoPage->id)->delete();
            $SeoQuery = explode(',', $seoPage->seo_query);
            $SearchQuery = "";
            $SearchQueryPlus = array();
            foreach($SeoQuery as $seoQuery){
                if(strpos($seoQuery,"+")===false){
                    $SearchQuery .= '"'.trim($seoQuery).'" |';
                }else{
                    $SearchQueryPlus[] = trim(str_replace("+",'',$seoQuery));
                }

            }

            //На случай поиска по % совпадений
            //option('field_weights', 'text=0')->
            //$Adverts = $db->table('test1')->select('*, WEIGHT()')->option('ranker', "expr('doc_word_count')")->match('text',$SearchQuery,true);
            $Adverts = $db->table('test1')->match('text',$SearchQuery,true);

            if(!empty($SearchQueryPlus)){
               foreach($SearchQueryPlus as $searchQueryPlus)
                   $Adverts->match('text',"*$searchQueryPlus*");
            }
            $Adverts =  $Adverts->where(['status'=>2])->limit(100000000)->get();//,'category'=>$seoPage->category,'sub_category'=>$seoPage->subcategory



            if($Adverts){
                foreach($Adverts as $advert){
                    DB::table('seo_pages_relations')->insert(['advert_id'=>$advert->id,'page_id'=>$seoPage->id,'city_id'=>$advert->region_id,'category_id'=>$advert->category,'sub_category'=>$advert->sub_category]);
                }
            }

        }
        echo '<b>' . (microtime(TRUE) - $start) . '</b>';
    }

    //Получаем категории с объявлениями
    private function getCategoriesWithAdverts($CityID = 0)
    {
        $Categories = DB::table('advert_categories')->select(['advert_categories.id', 'advert_categories.parent_id'])
            ->selectRaw('COUNT(adverts.id) as adverts_count')->leftJoin(
                'adverts', 'adverts.category', '=', 'advert_categories.id'
            )->where('adverts.status', 2)->where('adverts.region_id', $CityID)->groupBy(
                'advert_categories.id'
            )->get();
        return $Categories;
    }

    //Получаем категории с объявлениями
    private function getCategoriesWithAdvertsDistinct($CityID = 0)
    {
        $Categories = DB::table('advert_categories')->select(['advert_categories.id', 'advert_categories.parent_id'])
            ->selectRaw('COUNT(DISTINCT(user_id)) as adverts_count')->leftJoin(
                'adverts', 'adverts.category', '=', 'advert_categories.id'
            )->where('adverts.status', 2)->where('adverts.region_id', $CityID)->groupBy(
                'advert_categories.id'
            )->get();
        return $Categories;
    }




    //Получаем подкатегории с объявлениями
    private function getSubCategoriesWithAdverts($CityID = 0)
    {
        $Categories = DB::table('advert_categories')->select(['advert_categories.id', 'advert_categories.parent_id'])
            ->selectRaw('COUNT(adverts.id) as adverts_count')->leftJoin(
                'adverts', 'adverts.sub_category', '=', 'advert_categories.id'
            )->where('adverts.status', 2)->where('adverts.region_id', $CityID)->groupBy('advert_categories.id')->get();
        return $Categories;
    }
    //Получаем подкатегории с объявлениями
    private function getSubCategoriesWithAdvertsDistinct($CityID = 0)
    {
        $Categories = DB::table('advert_categories')->select(['advert_categories.id', 'advert_categories.parent_id'])
            ->selectRaw('COUNT(DISTINCT(user_id)) as adverts_count')->leftJoin(
                'adverts', 'adverts.sub_category', '=', 'advert_categories.id'
            )->where('adverts.status', 2)->where('adverts.region_id', $CityID)->groupBy('advert_categories.id')->get();
        return $Categories;
    }

    //Получаем регионы с объявлениями
    private function getRegionsWithAdverts()
    {
        $Regions = DB::table('regions')->select(['regions.id', 'regions.type', 'regions.parent_id'])->selectRaw(
            'COUNT(adverts.id) as adverts_count'
        )->leftJoin(
            'adverts', 'adverts.parent_region_id', '=', 'regions.id'
        )->where('adverts.status', 2)->groupBy('regions.id')->get();
        if(count($Regions)==0){
            $Regions = DB::table('regions')->select(['regions.id', 'regions.type', 'regions.parent_id'])->get();
        }
        return $Regions;
    }


    //Получаем города с объявлениями
    private function getCitysWithAdverts()
    {
        $Citys = DB::table('regions')->select(['regions.id', 'regions.type', 'regions.parent_id'])->selectRaw(
            'COUNT(adverts.id) as adverts_count'
        )->leftJoin(
            'adverts', 'adverts.region_id', '=', 'regions.id'
        )->where('adverts.status', 2)->groupBy('regions.id')->get();
        return $Citys;
    }


    public function AdvertsCountManager(Request $request)
    {
        $start = microtime(TRUE);
        $Regions = $this->getRegionsWithAdverts();
        $Citys = $this->getCitysWithAdverts();

        //Создаем кэш для регионов
        foreach ($Regions as $Region) {
            $this->SetAdvertCountCache($Region->id, 0, 0, 0, !empty($Region->adverts_count) ? $Region->adverts_count : 0);
        }

        //Проходим по городам, где есть активные объявления
        foreach ($Citys as $City) {
            $this->SetAdvertCountCache($City->id, 0, 0, 0, $City->adverts_count);

            //Получаем категории с объявлениями для города
            $Categories = $this->getCategoriesWithAdverts($City->id);
            if ($Categories) {
                foreach ($Categories as $Category) {
                    $this->SetAdvertCountCache(0, $City->id, $Category->id, 0, $Category->adverts_count);
                }
            }
            $Categories = $this->getCategoriesWithAdvertsDistinct($City->id);
            if ($Categories) {
                foreach ($Categories as $Category) {
                    $this->SetAdvertCountCacheDistinct(0, $City->id, $Category->id, 0, $Category->adverts_count);
                }
            }

            //Получаем подкатегории с объявлениями для города
            $Categories = $this->getSubCategoriesWithAdverts($City->id);
            if ($Categories) {
                foreach ($Categories as $Category) {
                    $this->SetAdvertCountCache(
                        0, $City->id, $Category->parent_id, $Category->id, $Category->adverts_count
                    );
                }
            }
            //Получаем подкатегории с объявлениями для города
            $Categories = $this->getSubCategoriesWithAdvertsDistinct($City->id);
            if ($Categories) {
                foreach ($Categories as $Category) {
                    $this->SetAdvertCountCacheDistinct(
                        0, $City->id, $Category->parent_id, $Category->id, $Category->adverts_count
                    );
                }
            }
        }

        echo '<b>' . (microtime(TRUE) - $start) . '</b>';
    }

    private function SetAdvertCountCache($RegionID = 0, $CityID = 0, $CategoryID = 0, $SubCategoryID = 0, $Count = 0)
    {
        if ($Count > 0 || Cache::has("advert_count_cache_{$RegionID}_{$CityID}_{$CategoryID}_{$SubCategoryID}")) {
            Cache::put("advert_count_cache_{$RegionID}_{$CityID}_{$CategoryID}_{$SubCategoryID}", $Count, 3600 * 24);
        }
    }

    private function SetAdvertCountCacheDistinct(
        $RegionID = 0, $CityID = 0, $CategoryID = 0, $SubCategoryID = 0, $Count = 0
    ) {
        if ($Count > 0 || Cache::has("advert_count_distinct_cache_{$RegionID}_{$CityID}_{$CategoryID}_{$SubCategoryID}")) {
            Cache::put(
                "advert_count_distinct_cache_{$RegionID}_{$CityID}_{$CategoryID}_{$SubCategoryID}", $Count, 3600 * 24
            );
        }
    }
}
