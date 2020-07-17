<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiKey;
class Mobily
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
        if ($request->headers->has('device-token')) {
            $token = ApiKey::where('token',$request->header('device-token'))->first();
            if ($token) {
                return $next($request);
            } else {
            return response()->json(['error' => 'You Do Not Have Permission To Take This Action'], 422);
            }
        } else {
                return response()->json(['error' => 'Wait a Minute Where Are You Go...!!!'], 422);
        }
    }
}
