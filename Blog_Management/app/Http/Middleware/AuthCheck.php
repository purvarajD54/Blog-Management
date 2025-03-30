<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('LoggedUser')) {
            return redirect('/user/login');
        }

        return $next($request);
    }
}
