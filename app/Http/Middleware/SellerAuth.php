<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class SellerAuth
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
        if (Auth::check() && Auth::user()->type == 'seller' && Auth::user()->status == 'ACTIVE') {
            return $next($request);
        } else {
            return redirect('/seller/login');
        }
    }
}
