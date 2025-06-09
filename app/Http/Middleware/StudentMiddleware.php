<?php

namespace App\Http\Middleware;

use Closure;

class StudentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('student')) {
            return redirect()->route('student.login')->withErrors('Please login first.');
        }

        return $next($request);
    }
}

