<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class auth {
    public function handle(Request $request, Closure $next) {
        if(!$request->session()->has("USER_ID")) {
            return redirect("/");
        }
        return $next($request);
    }
}