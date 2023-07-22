<?php

namespace App\Providers;

use App\Models\UserImages;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Валидация количества фотографий для пользователя
        Validator::extend('userphotos', function($attribute, $value, $parameters) {
            $photos = UserImages::where('user_id',Auth::user()->id)->count();
            return $photos  < 20;
        });

        //Прослушивание всех запросов к БД
       /* DB::listen(function($query) {

            $query1 = str_replace(array('?'), array('\'%s\''), $query->sql);
            $query1 = vsprintf($query1,$query->bindings);
            //dump($query);

            Log::info(
                $query1."!!!". $query->time/1000
            );
        });*/
    }
}
