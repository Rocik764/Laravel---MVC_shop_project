<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() == null) return redirect('/shop/index');
        if(Auth::user()->hasAnyRoles(['ADMIN', 'EMPLOYEE'])) {
            return $next($request);
        }

        return redirect('/shop/index');
    }
}
