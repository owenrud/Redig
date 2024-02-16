<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has the 'admin' role
            if (Auth::user()->role == 'admin') {
                return $next($request);
            }
        }

        // Redirect or return an error response for unauthorized users
        abort(403, 'Unauthorized');

        // Alternatively, you can redirect to a specific route:
        // return redirect()->route('unauthorized');

        // You can customize this logic based on your application's requirements

        // If the user doesn't have the 'admin' role, handle accordingly
    }
}
