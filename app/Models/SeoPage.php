<?php

namespace App\Models;

use App\Models\Regions;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'category',
            'subcategory',
            'seo_query',
            'url',
            'title',
            'name',
            'description',
            'h1',
            'master_1',
            'master_2',
            'master_3',
            'text',
            'popular_adv',
            'name_adv',
            'block_adv',
            'public',
            'show_short_description',
        ];

    public static function GetSeoCityBottom($request)
    {
        $CityList = Regions::GetRegionsFooter();

        foreach ($CityList as &$City) {

            if ($request->route('region')) {
                $URL = str_replace($request->route('region') . "", $City['url'] . '', $request->path());
                $City['url'] = "/" . $URL;
            } else {
                $City['url'] = "/" . $City['url'];

            }


            /* echo"<pre>";
                 echo print_r($City,1);
             echo"</pre>";*/
        }

        return $CityList;

    }

    public static function GetSeoPages($Filter = array())
    {
        $SeoPagesList = SeoPage::where('id', '>', 0);
        if (isset($Filter['category_id'])) {
            $SeoPagesList->where('category', $Filter['category_id']);
            $SeoPagesList->orwhere('subcategory', $Filter['category_id']);
        }

        if (isset($Filter['search_text'])) {
            $SeoPagesList->where('seo_query', 'LIKE', '%' . $Filter['search_text'] . '%');
            $SeoPagesList->orwhere('title', 'LIKE', '%' . $Filter['search_text'] . '%');
            $SeoPagesList->orwhere('h1', 'LIKE', '%' . $Filter['search_text'] . '%');
            $SeoPagesList->orwhere('description', 'LIKE', '%' . $Filter['search_text'] . '%');
            $SeoPagesList->orwhere('text', 'LIKE', '%' . $Filter['search_text'] . '%');
        }

        $SeoPagesList = $SeoPagesList->paginate(20);
        if ($SeoPagesList) {
            foreach ($SeoPagesList as &$seoPage) {
                $seoPage->category_name = AdvertCategories::select('name')->where('id', $seoPage->category)->first();
                if(!empty($seoPage->category_name['name']))
                    $seoPage->category_name = $seoPage->category_name['name'];

                $seoPage->subcategory_name = AdvertCategories::select('name')->where('id', $seoPage->subcategory)
                                                 ->first();
                if(!empty($seoPage->subcategory_name['name']))
                    $seoPage->subcategory_name = $seoPage->subcategory_name['name'];


            }

        }

        return $SeoPagesList;
    }

    public static function GetSeoPageData($PageType = '')
    {
        if ($PageType) {
            $Page = DB::table('seo_settings')->where('page_type', $PageType)->first();
            $City = Regions::where('id', request()->session()->get('city'))->first();
            if(!empty($City)){
            $Page->title = str_replace("{city.in}", $City->name_case, $Page->title);
            $Page->description = str_replace("{city.in}", $City->name_case, $Page->description);
            $Page->h1 = str_replace("{city.in}", $City->name_case, $Page->h1);
            $Page->text = str_replace("{city.in}", $City->name_case, $Page->text);
            }



            return $Page;
        } else {
            return FALSE;
        }
    }

    public static function GetSeoPopularPagesByCategory($CategoryID = 0, $SubCategory = 0, $request)
    {
        $Pages = SeoPage::where('popular_adv', 1)->where('public',1);
        if ($CategoryID) {
            $Pages->where('category', $CategoryID);
        }
        if ($SubCategory) {
            $Pages->where('subcategory', $SubCategory);
        }
        $Pages = $Pages->get();

        foreach ($Pages as $key=>&$page) {

            $page->count = DB::table('seo_pages_relations')->where('page_id', $page->id)->where(
                'city_id', $request->session()->get('city')
            )->count();
            if($page->count==0)
            {
                unset($Pages[$key]);
            }
            $page->name = SeoPage::GetSeoTextByMarkers($page->name, $request,  $page,0,0);
        }

        return $Pages;
    }


    public static function GetSeoColumnPagesByCategory($CategoryID = 0, $SubCategory = 0, $request)
    {
        $Pages = SeoPage::where('block_adv', 1)->where('public',1);
        if ($CategoryID) {
            $Pages->where('category', $CategoryID);
           // $Pages->orwhere('category', 0);
        }
        if ($SubCategory) {
            $Pages->where('subcategory', $SubCategory);
          //  $Pages->orwhere('subcategory', 0);
        }
        $Pages = $Pages->get();

        foreach ($Pages as $key=>&$page) {
            $page->count = DB::table('seo_pages_relations')->where('page_id', $page->id)->where(
                'city_id', $request->session()->get('city')
            )->count();

            if($page->count==0)
            {
                unset($Pages[$key]);
            }

            $page->name = SeoPage::GetSeoTextByMarkers($page->name, $request,  $page,0,0);
        }

        return $Pages;
    }

    public static function GetSeoTextByMarkers(
        $String = '', $request, $CheckCategory, $AdvertsCountAll = 0, $AdvertsCountAllUnique = 0
    ) {


        $SeoMarkerCategory = AdvertCategories::where('id', $CheckCategory->category)->first();
        $SeoMarkerSubCategory = AdvertCategories::where('id', $CheckCategory->subcategory)->first();

        if (!empty($SeoMarkerCategory)) {
            $String = str_replace("{category.parent}", $SeoMarkerCategory->name, $String);
        } else {
            $SeoMarkerCategory = AdvertCategories::where('id', $CheckCategory->id)->first();
            $SeoMarkerSubCategory = AdvertCategories::where('id', $CheckCategory->parent_id)->first();
            if (!empty($SeoMarkerSubCategory)) {
                $String = str_replace("{category.parent}", $SeoMarkerSubCategory->name, $String);
            }
            if (!empty($SeoMarkerCategory)) {
                $String = str_replace("{category}", $SeoMarkerCategory->name, $String);

            }
        }

        if (!empty($SeoMarkerSubCategory)) {
            $String = str_replace("{category}", $SeoMarkerSubCategory->name, $String);

        }

        $String = str_replace("{total.u}", $AdvertsCountAll, $String);

        $String = str_replace("{totalu.textu}", AdvertCategories::GetCategoryTextCountU($AdvertsCountAll), $String);
        $String = str_replace("{totalu.texto}", AdvertCategories::GetCategoryTextCountO($AdvertsCountAll), $String);
        $String = str_replace("{totalu.textp}", AdvertCategories::GetCategoryTextCountP($AdvertsCountAll), $String);

        $City = Regions::where('id', $request->session()->get('city'))->first();
        if (!empty($City) && $City->parent_id > 0) {
            $Region = Regions::where('id', $City->parent_id)->first();
        }
        if (!empty($City)) {
            $String = str_replace("{city}", $City->name, $String);
            $String = str_replace("{city.in}", $City->name_case, $String);
        }
        if (!empty($Region)) {
            $String = str_replace("{region}", $Region->name, $String);
            $String = str_replace("{region.in}", $Region->name_case, $String);
        }
        $String = str_replace("{totalu.textp}", AdvertCategories::GetCategoryTextCountP($AdvertsCountAll), $String);
        $String = str_replace(
            "{master.text}", AdvertCategories::GetCategoryTextCountDefault(
            $AdvertsCountAll, "{$CheckCategory->master_1}|{$CheckCategory->master_2}|{$CheckCategory->master_3}"
        ), $String
        );


        $String = str_replace("{total.m}", $AdvertsCountAllUnique, $String);

        return $String;


    }

}
