<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLawyerIsApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'avocat') {
            return $next($request);
        }

        if ($user->isApproved()) {
            return $next($request);
        }

        if ($request->routeIs('lawyer.profile.*') || $request->routeIs('lawyer.pending') || $request->routeIs('verification.*') || $request->routeIs('logout')) {
            return $next($request);
        }

        return redirect()->route('lawyer.pending');
    }
}
