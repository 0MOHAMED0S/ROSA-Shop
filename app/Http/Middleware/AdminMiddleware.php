<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has admin status
        if (auth()->check() && auth()->user()->status == 1) {
            return $next($request);
        }

        // If not an admin, you can redirect or handle it as needed
        return redirect()->route('Home'); // Change 'some.route' to the desired route
    }
}
