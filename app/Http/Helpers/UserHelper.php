<?php
namespace App\Http\Helpers;
class UserHelper
{
    public static function ClearUserPhone($str)
    {
        return preg_replace( '/[^0-9]/', '', $str);;
    }
}
