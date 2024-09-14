<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log the current user and their account type for debugging
        Log::info('Middleware check for user: ' . auth()->user()->name . ' with type: ' . auth()->user()->account_type);

        if (auth()->check() && auth()->user()->account_type === 'admin') {
            return $next($request);
        }

        // Log access denied for non-admin users
        Log::info('Access denied for user: ' . auth()->user()->name);

        // Redirect non-admin users to a "Members Only Content" page or a different route
        return redirect()->route('members-only');
    }
}
