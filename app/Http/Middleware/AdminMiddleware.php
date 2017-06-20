<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (Auth::user()->usertype == '1') {
            return redirect('/home');
        }

        if (Auth::user()->usertype == '2') {
            return redirect('/home');
        }
        return $next($request);
    }
}
