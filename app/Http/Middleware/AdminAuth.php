<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type == 'admin' && Auth::user()->status == 'ACTIVE') {
            return $next($request);
        } else {
            return redirect('/admin/login');
        }
    }
}
