<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     * If a user is not admin and try to access to an admin view, 
     * he is redirected to the HOME view.
     * 
     * If a user is not admin and try to access to an admin resource (through
     * an API for example), an Unauthorized response is sent to him.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $group = null)
    {
        /**  @var App\User */
        $user = Auth::user();
        
        if (!$user->isAdmin())
        {
            if ($group === 'api')
                return response('Unauthorized', 401);
            else
                return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
