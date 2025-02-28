<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->usertype === 'admin') {
                return $next($request);
            }

            // Redirect employees to their dashboard if they try to access admin pages
            return redirect()->route('employee.dashboard')->withErrors('Access Denied.');
        }

        return redirect()->route('login')->withErrors('Unauthorized access.');
    }
}
