<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AuthAdmin
{
    use AuthenticatesUsers;
    public function handle($request, Closure $next, $guard = null)
    {


         if ( !Auth::check() || Auth::user()->user_type!=2 ) {
             return redirect('/');
         }

        return $next($request);
    }
}
