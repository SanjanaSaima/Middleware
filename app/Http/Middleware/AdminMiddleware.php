<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        if(auth()->user()->role !== 'admin'){
            return redirect()->route('products.index')->with('error', 'You do not have permission to access this page.');
        }
        return $next($request);
    }
}
