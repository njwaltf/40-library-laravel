<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! auth()->check() || ! auth()->user()->role) {
            return redirect()->route('you-dont-have-access');
        }

        // Check if the user's role matches the required role
        if (auth()->user()->role !== $role) {
            return redirect()->route('you-dont-have-access');
        }

        return $next($request);
    }

}
