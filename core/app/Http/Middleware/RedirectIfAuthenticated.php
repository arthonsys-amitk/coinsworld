<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $fullUrl = $request->fullUrl();
        $is_ajax = $request->ajax();
		$is_ajaxLogin = (strpos($fullUrl, "ajaxLogin") === false)? 0: 1;
		if (Auth::guard($guard)->check()) {
            if($is_ajaxLogin)
				return $next($request);
			return redirect('/home');			
        }

        return $next($request);
    }
}
