<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertPrice extends Model
{
    use HasFactory;
    protected $fillable
        = [
            'advert_id',
            'masure',
            'name',
            'price',
        ];

    public static function AddAdvertPrice($AdvertId,$Prices){
        AdvertPrice::where('advert_id',$AdvertId)->delete();
        if($Prices){
            foreach($Prices['name'] as $Key=>$Price){
                if($Prices['name'][$Key]){
                    AdvertPrice::create([
                        'advert_id'=>$AdvertId,
                        'masure'=>$Prices['measure'][$Key],
                        'name'=>$Prices['name'][$Key],
                        'price'=>$Prices['price'][$Key],
                    ]);
                }
            }
        }
    }
}
