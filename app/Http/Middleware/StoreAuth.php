<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class StoreAuth
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
        if (Auth::check() && Auth::user()->type == 'customer' && Auth::user()->status == 'ACTIVE') {
            return $next($request);
        } else {
            if ($request->get('goToCheckout'))
                return redirect('/login?goToCheckout=1');
            return redirect('/login');

        }
    }
}
