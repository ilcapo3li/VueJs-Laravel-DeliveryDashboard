<?php

namespace App\Http\Controllers;

use DB; 
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;

class AdminController extends AuthController
{
    public function index()
    {
        $admins = Auth::user('user')->company->admins()
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

    public function update(Request $request, Admin $admin)
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

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'admin';
    }

}
