<?php

namespace App\Http\Middleware;

use App\Models\Adverts;
use App\Models\Regions;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GlobalSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->route('region')){
            $CityRegion = Regions::GetRegionByURL($request->route('region'));
            $CityRegionDefault = $CityRegion;
        }

        if(!isset($CityRegion) || !$CityRegion){
            if(!empty($request->session()->get('city_url'))&&$request->session()->get('city_url')!=''){
                $CityRegionDefault = Regions::GetRegionByURL($request->session()->get('city_url'));
                $CityRegion = $CityRegionDefault;
            }else{
                $CityRegionDefault = Regions::GetRegionByURL('moskva');
                $CityRegion = $CityRegionDefault;
            }

        }

        $Banners = DB::table('banners')->get();

        $HeaderNotification = DB::table('seo_settings')->where('page_type','header_text')->first();

        view()->share('MeasureList', User::GetMasureList());
        view()->share('CityRegion', $CityRegion);
        view()->share('CityRegionDefault', $CityRegionDefault);
        view()->share('BannersPages', $Banners);
        view()->share('HeaderNotification', $HeaderNotification);
        view()->share('Version', time());
        return $next($request);
    }
}
