<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;


class IsAdmin
{
    protected $addHttpCookie = true;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->name=="admin") {
             return $next($request);
        }
        return redirect(route('login.dashboard'))->with(['error' => 'Please Login']);
    }
}
