<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SuppliersController extends Controller
{
    public function index()
    {
        $users = User::where('name', 'like', '%'.Input::get('query').'%')->orwhere('email', 'like', '%'.Input::get('query').'%')->with(['photo', 'role'])->where('role_id', 3)->orderBy('id', 'desc')->paginate(10);

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
            $admin->role_id = 3;
            $admin->save();

            return response()->json('New Supplier Created Suceessfully');
        }
    }
}
