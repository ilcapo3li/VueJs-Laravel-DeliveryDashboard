<?php

namespace App\Http\Controllers;

use App\Helpers\PhotoHelper;
use App\User;
use App\Photo;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsersController extends AuthController
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return  new UserResource(
                Auth::user('user')->comapny->users()
                ->where('email', 'like', '%'.Input::get('query').'%')
                ->orwhere('name', 'like', '%'.Input::get('query').'%')
                ->orwhere('phonePrimary', 'like', '%'.Input::get('query').'%')
                ->orwhere('PhoneSecondary', 'like', '%'.Input::get('query').'%')
                ->with(['photo','role'])->orderBy('id', 'desc')->paginate(10)
        );
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

    


    /**
     * Display the specified reuser.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $user->load(['photo', 'orders', 'locations']);

        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
            $this->blockTokens($user);
        return response()->json('Company Admin Updated Suceessfully');
    }

    public function block(User $user)
    {
        $user->disabled = !$user->disabled;
        $user->save();
        $this->blockTokens($user);

        return response()->json($user);
    }

    /**
     * Remove the specified reuser from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json('Record Deleted Successfully', 200);
        } else {
            return response()->json(['error' => 'Error in Deleting Record'], 422);
        }
    }

    

    public function user()
    {
        $user = new UserResource(Auth::user());

        return response()->json($user);
    }

  

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'user';
    }
}
