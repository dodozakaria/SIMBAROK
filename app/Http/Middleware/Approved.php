<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Approved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->status == 1) {
                return $next($request);
            } elseif (auth()->user()->status == 0) {
                return redirect('/waiting-approval');
            } else {
                return redirect('/rejected');
            }
        } else {
            return redirect('/login');
        }
        
    }
}
