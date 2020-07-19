<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role=auth()->user()->role->name;
        if($role=="Super"){
            return $next($request);
        }
        $permissions=auth()->user()->permissions->toArray();
        $permissions=array_map(function($permission){
                 return $permission['name'];
        },$permissions);
        $route_name=Route::CurrentRouteName();
        if(count($permissions)>0){
            if(in_array($route_name,$permissions)){
                return $next($request);
            }
            else{
                return response()->json(['error'=>'You do not have permission to take this action'],422);
            }
        }
        else{
            return response()->json(['error'=>'You do not have permission to take this action'],422);
        }

        
    }
}
