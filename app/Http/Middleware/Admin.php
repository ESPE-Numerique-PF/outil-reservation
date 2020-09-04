<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     * If a user is not admin, it is redirected to the current page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**  @var App\User */
        $user = Auth::user();
        
        if (!$user->isAdmin())
            return redirect(RouteServiceProvider::HOME);

        return $next($request);
    }
}
