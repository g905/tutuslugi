<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class AdvertCategories extends Model {

    use HasFactory;

    private static $RegionHasMany = 0;
    protected $fillable = [
        'name',
        'parent_id',
        'url',
        'icon',
        'title',
        'h1',
        'description',
        'text',
        'name_bread',
        'master_1',
        'master_2',
        'master_3',
        'name_adv',
        'favorite',
        'footer',
        'show_short_description',
        'popular',
        'show_col',
        'service',
        'measure',
    ];

    //Смена региона для количества объявлений
    public static function ChangeRegion($Region) {
        if ($Region != 0) {
            self::$RegionHasMany = $Region;
        }
    }

    protected static function boot() {
        parent::boot();

        static::saving(function ($Category) {

            Cache::forget("get_current_category_{$Category->url}");
            Cache::forget("get_current_category_{$Category->id}");
            Cache::forget("GetCategoryURL_{$Category->id}");
        });
    }

    //Количество активных объявлений по категории
    public function GetAdvertsCountByRegion() {

        if ($this->parent_id == 0) {
            return Cache::get("advert_count_cache_0_" . request()->session()->get('city') . "_{$this->id}_0");
        } else {
            return Cache::get("advert_count_cache_0_" . request()->session()->get('city') . "_{$this->parent_id}_{$this->id}");
        }
    }

    //Количество объявлений категории
    public function AdvertsCategory() {
        if (self::$RegionHasMany) {
            return $this->hasMany(Adverts::class, 'category', 'id')->where('region_id', self::$RegionHasMany)->where('status', 2);
        } else {
            return $this->hasMany(Adverts::class, 'category', 'id')->where('status', 2);
        }
    }

    //Количество объявлений по подкатегории
    public function AdvertsSubCategory() {

        if (self::$RegionHasMany) {
            return $this->hasMany(Adverts::class, 'sub_category', 'id')->where('region_id', self::$RegionHasMany)->where('status', 2);
        } else {
            return $this->hasMany(Adverts::class, 'sub_category', 'id')->where('status', 2);
        }
    }

    public static function GetHomeCategories() {
        $Categories = AdvertCategories::where(['favorite' => 1]);
        $Categories = $Categories->orderBy('name', 'asc')->get();
        if ($Categories) {
            foreach ($Categories as &$category) {
                if ($category->parent_id) {
                    $category->parent_url = AdvertCategories::GetSubCategoryURL($category->parent_id, request()->session()->get('city'));
                }
            }
        }
        return $Categories;
    }

    public static function GetFooterCategories() {
        $Categories = AdvertCategories::where(['footer' => 1]);
        $Categories = $Categories->orderBy('name', 'asc')->get();
        if ($Categories) {
            foreach ($Categories as &$category) {
                if ($category->parent_id) {
                    $category->parent_url = AdvertCategories::GetSubCategoryURL($category->parent_id, request()->session()->get('city'));
                }
            }
        }
        return $Categories;
    }

    public static function GetAllCategories($ParentID, $Region = 0, $WithCounts = 0, $Chunk = 0, $Footer = 0) {

        if ($Footer == 1) {
            $Categories = AdvertCategories::where(['footer' => 1]);
        } else {
            $Categories = AdvertCategories::where(['parent_id' => $ParentID]);
        }
        $Categories = $Categories->orderBy('name', 'asc');

        if ($Chunk > 0) {
            $CategoriesCount = $Categories->count();
            $Categories = $Categories->get()->chunk(ceil($CategoriesCount / $Chunk));

            if ($Categories) {
                foreach ($Categories as &$category) {
                    foreach ($category as &$scategory) {
                        if ($scategory->parent_id) {
                            $scategory->parent_url = AdvertCategories::GetSubCategoryURL($scategory->parent_id, request()->session()->get('city'));
                        }
                    }
                }
            }
        } else {
            $Categories = $Categories->get();
            if ($Categories) {
                foreach ($Categories as &$category) {
                    if ($category->id > 0)
                        $category->items = AdvertCategories::where('parent_id', $category->id)->orderBy('name', 'asc')->get();
                }
            }
        }
        /* foreach($Categories as &$subCategory){
          $subCategory->adverts_count =  Cache::get("advert_count_cache_0_{$Region}_{$subCategory['parent_id']}_{$subCategory['id']}");

          } */
        return $Categories;
        if ($WithCounts == 0) {
            $Categories = AdvertCategories::where(['parent_id' => $ParentID]);
        } else {
            $Categories = AdvertCategories::select(['advert_categories.*'])->selectRaw('COUNT(adverts.id) as adverts_count')->leftJoin('adverts', 'adverts.sub_category', '=', 'advert_categories.id')->where(['advert_categories.parent_id' => $ParentID, 'adverts.region_id' => $Region]);
        }
        if ($Region != 0 && $WithCounts == 1) {
            //  $Categories = $Categories->where(['region_id' => $Region]);
        }
        /*  $Categories = AdvertCategories::where(['parent_id' => $ParentID]);
          if ($Region != 0) {
          self::$RegionHasMany = $Region;
          }

          if ($WithCounts == 1) {
          $Categories = $Categories->withCount(['AdvertsSubCategory as adverts_count']);
          } */
        if ($WithCounts == 1) {
            $Categories = $Categories->groupBy('advert_categories.id');
        }

        $Categories = $Categories->orderBy('name', 'asc');

        // $addSlashes = str_replace('?', "'?'", $Categories->toSql());
        //echo vsprintf(str_replace('?', '%s', $addSlashes), $Categories->getBindings());
        //exit();

        $Categories = $Categories->get();
        return $Categories;
    }

    //УРЛ для категории
    public static function GetCategoryURL($CategoryID, $RegionID = '') {
        $Region = Regions::GetRegionURL($RegionID);
        if (Cache::has("GetCategoryURL_{$CategoryID}_{$RegionID}")) {
            $Category = Cache::get("GetCategoryURL_{$CategoryID}_{$RegionID}");
        } else {
            $Category = AdvertCategories::where(['id' => $CategoryID])->first();
            Cache::put("GetCategoryURL_{$CategoryID}_{$RegionID}", $Category, 3600);
        }

        return array('name' => $Category->name, 'slug' => $Category->url,
            'url' => route('region.category', ['region' => $Region['url'], 'category' => $Category->url]));
    }

    //Урл для подкатегории
    public static function GetSubCategoryURL($CategoryID, $RegionID = '') {
        if (!$RegionID OR $RegionID == '') {
            $RegionID = 450;
        }
        $Category = array();
        $Region = Regions::GetRegionURL($RegionID);
        if (Cache::has("get_current_category_{$CategoryID}")) {
            $SubCategory = Cache::get("get_current_category_{$CategoryID}");
        } else {
            $SubCategory = AdvertCategories::where(['id' => $CategoryID])->first();
            Cache::put("get_current_category_{$CategoryID}", $SubCategory, 3600);
        }

        if (!empty($SubCategory->parent_id)) {
            if (Cache::has("get_current_category_{$SubCategory->parent_id}")) {
                $Category = Cache::get("get_current_category_{$SubCategory->parent_id}");
            } else {
                $Category = AdvertCategories::where(['id' => $SubCategory->parent_id])->first();
                Cache::put("get_current_category_{$SubCategory->parent_id}", $Category, 3600);
            }
        }



        return array('name' => !empty($SubCategory->name) ? $SubCategory->name : '', 'slug' => !empty($SubCategory->url) ? $SubCategory->url : '', 'parent_name' => !empty($Category->name) ? $Category->name : '', 'url' => !empty($Category->url) ? route(
                    'region.subcategory',
                    ['region' => $Region['url'], 'category' => !empty($Category->url) ? $Category->url : 0, 'subcategory' => !empty($SubCategory->url) ? $SubCategory->url : 0]
            ) : '');
    }

    //Список каатегорий со вложенностью
    public static function GetCategoryTree() {
        $Categories = self::GetAllCategories(0, 0, 1);
        foreach ($Categories as &$category) {
            $category['children'] = self::GetAllCategories($category->id, 0, 1);
            foreach ($category['children'] as &$scategory) {
                $scategory['children'] = self::GetAllCategories($scategory->id, 0, 1);
            }
        }
        return $Categories;
    }

    //Информация о категории с регионом
    public static function GetCategoryUrlInfoRegion($URL, $Region) {

        if (Cache::has("get_current_category_{$URL}")) {
            $CheckCategory = Cache::get("get_current_category_{$URL}");
        } else {
            $CheckCategory = AdvertCategories::where(['url' => $URL])->first();
            Cache::put("get_current_category_{$URL}", $CheckCategory, 3600);
        }
        if (!empty($CheckCategory))
            $CheckCategory->adverts_count = 0;
        return $CheckCategory;
        //adverts_count
    }

    public static function GetPopular($parent_id) {
        return self::where(['popular' => true, 'parent_id' => $parent_id])->get();
    }

    public static function GetSide() {
        return self::where(['show_col' => true])->get();
    }

    //Склонение услуг
    public static function GetCategoryTextCount($Number) {
        return Lang::choice('услуга|услуги|услуг', $Number, [], 'ru');
    }

    public static function GetCategoryTextCountO($Number) {
        return Lang::choice('объявление|объявления|объявлений', $Number, [], 'ru');
    }

    public static function GetCategoryTextCountU($Number) {
        return Lang::choice('услуга|услуги|услуг', $Number, [], 'ru');
    }

    public static function GetCategoryTextCountP($Number) {
        return Lang::choice('предложение|продложения|предложений', $Number, [], 'ru');
    }

    public static function GetCategoryTextCountDefault($Number, $String) {
        return Lang::choice($String, $Number, [], 'ru');
    }

}
