<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use App\Http\Helpers\Url;

class RegionsController extends Controller
{
    public function ShowRegionList(Request $request){
        $Regions = Regions::GetAllRegions(1,3);
        $dataPageDefault = SeoPage::GetSeoPageData('select_region');
        return view('regions.list',['HeaderSearchShow'=>1,'Regions'=>$Regions,'dataPageDefault'=>$dataPageDefault]);
    }

    public function ShowRegionCityList($Region,Request $request){

        $Regions = Regions::GetAllCitys($Region,1,3);
        //$Regions = array_chunk($Regions, ceil(count($Regions)/3));
        $Region = Regions::find($Region);
        $dataPageDefault = SeoPage::GetSeoPageData('select_city');
        $dataPageDefault->title = str_replace('{region.in}',$Region->name_case, $dataPageDefault->title);
        $dataPageDefault->h1 = str_replace('{region.in}',$Region->name_case, $dataPageDefault->h1);
        $dataPageDefault->text = str_replace('{region.in}',$Region->name_case, $dataPageDefault->text);
        $dataPageDefault->description = str_replace('{region.in}',$Region->name_case, $dataPageDefault->description);

        $BreadsRegion = [
            route('region.index')=>'Россия',
            '0'=>$Region->name
        ];




        return view('regions.list',['HeaderSearchShow'=>1,'Regions'=>$Regions,'BreadsRegion'=>$BreadsRegion,'dataPageDefault'=>$dataPageDefault]);
    }
    //
}
