<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     * Expect role(s) passed as middleware parameter, e.g. 'role:admin' or 'role:avocat,client'
     */
    public function handle(Request $request, Closure $next, $roles = null)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (is_null($roles)) {
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));

        if (!in_array(auth()->user()->role, $allowed)) {
            abort(403);
        }

        return $next($request);
    }
}
