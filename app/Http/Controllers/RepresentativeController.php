<?php

namespace App\Http\Controllers;

use App\Representative;
use Illuminate\Http\Request;

class RepresentativeController extends AuthController
{
    public function index()
    {
        $customers = Auth::user('representative')->comapny->leads()->orwhere('email', 'like', '%'.Input::get('query').'%')
                ->orwhere('phonePrimary', 'like', '%'.Input::get('query').'%')
                ->orwhere('PhoneSecondary', 'like', '%'.Input::get('query').'%')
                ->with(['photo'])->orderBy('id', 'desc')->paginate(10);
        return response()->json($customers);
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
            $admin = new Representative();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->save();
            return response()->json('Representative Created Suceessfully');
        }
    }

    public function update(Request $request, Representative $representative)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,'.$representative->id,
            'email' => 'required|email|unique:users,email,'.$representative->id,
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $representative->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $this->blockTokens($representative);
        return response()->json('Representative Updated Suceessfully');
    }


    public function block(Representative $representative)
    {
        $representative->disabled = !$representative->disabled;
        $representative->save();
        $this->blockTokens($representative);
        return response()->json($representative);
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'representative';
    }
}
