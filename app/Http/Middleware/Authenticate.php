<?php

namespace App\Http\Middleware;

use App\UserToken;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function authenticate($request, array $guards)
    {
        $token=explode('Bearer ',$request->header('Authorization'));

        if(auth()->user()&&auth()->user()->userTokens){
            if(in_array($token[1],auth()->user()->userTokens->pluck('token')->toArray())){
                $user_token=UserToken::where('token',$token[1])->first();
                if($user_token->blocked==1){
                    JWTAuth::setToken($token[1])->invalidate();
                    auth()->logout();
                }
             }
        }


    }
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {
            return route('login');
        }

    }
}
