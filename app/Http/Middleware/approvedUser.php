<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class approvedUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            if ($request->user()->approved == 1) {
                return $next($request);
            } else {
                return redirect()->route('need-approval');
            }
        } else {
            return redirect()->route('login');
        }
    }
}