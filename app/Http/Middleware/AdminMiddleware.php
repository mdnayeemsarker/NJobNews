<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Check if the user is authenticated and has admin privileges
        // if (Auth::check() && Auth::user()->type === 'admin') {
        //     return $next($request);
        // }
        // dd('here');
        if (Auth::check()) {
            return $next($request);
        }

        // Optionally, redirect to login or an unauthorized page
        
        flush_data('error', 'Alert', 'You do not have access to the admin panel.!');
        return redirect()->route('login');
    }
}
