<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Adminstration
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
        $role = Auth::user()?Auth::user()->role->name:null;
        if ($role == 'super' || $role == 'admin') {
            return $next($request);
        } else {
            return response()->json(['error' => 'You do not have permission to take this action'], 422);
        }
    }
}
