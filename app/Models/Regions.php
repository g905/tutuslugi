<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Regions extends Model
{
    use HasFactory;

   /* protected $dispatchesEvents = [
        'retrieved' => \App\Events\Regions::class,
    ];*/

    protected static function boot() {
        parent::boot();

        static::saving(function ($Region) {
            Cache::forget("current_region_{$Region->url}");
            Cache::forget("current_region_{$Region->id}");
        });
    }

    protected $fillable
        = [
            'type',
            'name',
            'name_case',
            'url',
            'favorite',
            'parent_id',
            'public',
            'footer',
        ];

    //Количество объявлений по региону
    public function AdvertsRegion()
    {
        return $this->hasMany(Adverts::class, 'parent_region_id', 'id')->where('status', 2);
    }

    //Количество объявлений по городу
    public function AdvertsCity()
    {
        return $this->hasMany(Adverts::class, 'region_id', 'id')->where('status', 2);
    }

    //Количество активных объявлений по региону
    public function GetAdvertsCountByRegion(){
        if(Cache::has("advert_count_cache_{$this->id}_0_0_0"))
            return Cache::get("advert_count_cache_{$this->id}_0_0_0");
        else
            return  0;
    }

    public static function GetAllRegions($WithCounts = 0, $Chunk=0, $isAdmin = 0)
    {
        if($WithCounts==1){
            if($Chunk){
                $RegionsCount = Regions::select(['regions.id'])->where(['type'=> 1,'public'=>1])->orderBy('name', 'asc')->count();

                $Regions = Regions::select(['regions.id','regions.type','regions.public','regions.name','regions.url','regions.favorite','regions.parent_id'])->where(['type'=> 1]);

                if($isAdmin==0){
                    $Regions->where('public',1);
                }
                $Regions = $Regions->orderBy('name', 'asc')->get()->chunk(ceil($RegionsCount/3));

            }else{
                $Regions = Regions::select(['regions.id','regions.name','regions.public','regions.url','regions.favorite','regions.parent_id'])->where(['type'=> 1]);
                if($isAdmin==0){
                    $Regions->where('public',1);
                }
                $Regions = $Regions->orderBy('name', 'asc')->get();
            }
        }else{
            $Regions = Regions::where(['type'=> 1])->orderBy('name', 'asc')->get();
        }
        return $Regions;

    }

    public static function GetAllCitys($RegionID, $WithCounts = 0,$Chunk=0,$isAdmin = 0)
    {
        if ($WithCounts == 1) {
            if($Chunk){

                $CitysCount = Regions::select(['regions.id'])->where(['type'=>2,'public'=>1,'parent_id' => $RegionID])->orderBy('name', 'asc')->count();

                $Citys = Regions::select(['regions.id','regions.public','regions.parent_id','regions.type','regions.name','regions.url','regions.favorite','regions.parent_id'])->where(['type'=>2,'public'=>1,'parent_id' => $RegionID])->groupBy('regions.id')->orderBy('name', 'asc')->get()->chunk(ceil($CitysCount/3));;
            }else{

                $Citys = Regions::select(['regions.id','regions.public','regions.parent_id','regions.type','regions.name','regions.url','regions.favorite','regions.parent_id'])->where(['type'=>2,'parent_id' => $RegionID])->groupBy('regions.id')->orderBy('name', 'asc')->get();
            }
        } else {
            $Citys = Regions::where(['type' => 2, 'parent_id' => $RegionID])->orderBy('name', 'asc')->get();
        }
        return $Citys;

    }

    public static function GetRegionURL($RegionID)
    {
        if (Cache::has("current_region_$RegionID")) {
            $Region = Cache::get("current_region_$RegionID");
        }else{
            $Region = Regions::where('id', $RegionID)->first();
            Cache::put("current_region_$RegionID", $Region, 3600);
        }

        return array('name' => $Region->name, 'url' => '/' . $Region->url);
    }

    public static function GetRegionByURL($Url){
        if (Cache::has("current_region_$Url")) {
            $Region = Cache::get("current_region_$Url");
        }else{
            $Region = Regions::where('url', $Url)->first();
            Cache::put("current_region_$Url", $Region, 3600);
        }
        return $Region;
    }

    public static function GetRegionsFooter(){
        if (Cache::has("current_regions_footer")) {
            $Regions = Cache::get("current_regions_footer");
        }else{
            $Regions = Regions::where(['type' => 2, 'footer' => 1, 'public' => 1])->orderBy('name', 'ASC')->get();
            Cache::put("current_regions_footer", $Regions, 3600);
        }
        return $Regions;
    }
}
