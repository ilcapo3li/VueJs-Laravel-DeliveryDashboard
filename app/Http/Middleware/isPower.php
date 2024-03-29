<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isPower
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role->name == 'Power' || Auth::user()->role->name == 'Super') {
            return $next($request);
        } else {
            return response()->json(['error' => 'You do not have permission to take this action'], 422);
        }
    }
}
