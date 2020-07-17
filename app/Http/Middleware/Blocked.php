<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Blocked
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
         
        if (Auth::user()->blocked) {
            return response()->json(['data'=>['isblocked'=>Auth::user()->blocked],'status'=>'false','error' => 'You Are Blocked Keep Contact With Support Team'], 403);
        } else {
            return $next($request);
        }
    }
}
