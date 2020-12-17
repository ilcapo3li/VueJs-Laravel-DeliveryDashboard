<?php

namespace App\Http\Controllers;

use DB; 
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($valiadator->fails()) {
            return response()->json($valiadator->errors(), 422);
        } 
        else 
        {
            Config::set('jwt.user', 'App\Admin'); 
            Config::set('auth.providers.users.model', \App\Admin::class);
            $credentials = request(['email', 'password']);
            dd(auth('admin')->attempt($credentials));

            if (!$token = auth('admin')->attempt($credentials)) 
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            DB::table('owner_tokens')->insert(['owner_id'=>auth('admin')->id(),'owner_type'=>"Admin",'token'=>$token]);
            return $this->respondWithToken($token);
        }
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('agent');
    }

    protected function respondWithToken($token)
    {
        /////////////////////////////
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 600,
            // 'user' => new UserResource(User::find(Auth::id())),
        ]);
    }


    public function index()
    {
        $admins = Auth::user()->company->admins()
                ->where('name', 'like', '%'.Input::get('query').'%')
                ->orwhere('role_id', 2)->where('email', 'like', '%'.Input::get('query').'%')
                ->with(['role', 'permissions', 'photo'])->orderBy('id', 'desc')->paginate(10);
                return response()->json($admins);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $admin = new User();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->role_id = 2;
            $admin->save();
            $admin->permissions()->attach($request->permissions);

            return response()->json('Admin Created Suceessfully');
        }
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);
        foreach ($admin->userTokens as $userToken) {
            $userToken->blocked = 1;
            $userToken->save();
        }
        $admin->permissions()->detach();
        $admin->permissions()->attach($request->permissions);

        return response()->json('Admin Updated Suceessfully');
    }
}
