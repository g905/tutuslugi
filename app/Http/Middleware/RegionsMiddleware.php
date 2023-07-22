<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RegionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $regionRouteName = $request->route('region');
        $City = Regions::where(['type'=>2,'public'=>1,'url'=>$regionRouteName])->first();
        if ($City === null) {
            abort(404);
        }
        $request->session()->put('city', $City->id);
        $request->session()->put('city_url', $City->url);
        $request->session()->save();
        return $next($request);
    }
}
