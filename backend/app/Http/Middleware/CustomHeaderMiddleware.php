<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomHeaderMiddleware
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
        // قم بتعديل أو إضافة رؤوس الطلبات هنا
        $request->headers->set('X-Forwarded-For', 'your_value_here');

        return $next($request);
    }
}
