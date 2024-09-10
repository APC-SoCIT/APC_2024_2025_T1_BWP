<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->account_type !== 'member' && auth()->user()->account_type !== 'admin') {
            // Redirect non-members and non-admins to the appropriate page or show an error
            return redirect()->route('members-only');
        }

        return $next($request);
    }
}
