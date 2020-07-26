<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class SuperPowerController extends Controller
{
    public function index()
    {
        $users = User::where('name', 'like', '%'.Input::get('query').'%')->orwhere('email', 'like', '%'.Input::get('query').'%')->with(['role', 'permissions', 'photo'])->where('role_id',9)->orderBy('id', 'desc')->paginate(10);

        return response()->json($users);
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
            $admin->role_id = 9;
            $admin->save();
            $admin->permissions()->attach($request->permissions);

            return response()->json('New SuperPower Created Suceessfully');
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

        return response()->json('SuperPower Updated Suceessfully');
    }
}
