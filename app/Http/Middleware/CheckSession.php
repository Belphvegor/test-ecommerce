<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Closure;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        if (Session::get('level') == null) {
            return Redirect::to('login');
        } else if (\Auth::user()->level == $level) {
            return $next($request);
        } 
        abort(403);
        // return redirect()->back();
    }
}
