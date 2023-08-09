<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CoockieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $r = $next($request);
        $c = $r->getContent();

        $cookis[0] = 'undefined';

        if(Cookie::has('CookieDE')){
            $cookis[0] = \Illuminate\Support\Facades\Crypt::decryptString($request->cookie('CookieDE'));
        }

        $value = md5($request->ip());
        $cookis[2] = \Illuminate\Support\Facades\Crypt::encryptString($value);

        if($cookis[0] == 1){
            return $r;
        }

        $cookis[1] = "CookieDE";
        $views = $c.view('cookieStart')->with(compact('cookis'))->render();
        return $r->setContent($views);

    }
}
