<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ValidatePasswordReset
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


        $check = User::where('email', $request->get('email', ''))->first();
        if ($check)
            return $next($request);
        return redirect('/');
    }
}
