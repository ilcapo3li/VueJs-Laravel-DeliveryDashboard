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
            User::where('name', 'like', '%'.Input::get('query').'%')
            ->orwhere('email', 'like', '%'.Input::get('query').'%')
            ->with(['role', 'photo'])->orderBy('id', 'desc')->paginate(10)
        );
    }

    public function block(User $user)
    {
        $user->blocked = !$user->blocked;
        $user->save();

        return response()->json($user);
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
        foreach ($user->userTokens as $userToken) {
            $userToken->blocked = 1;
            $userToken->save();
        }

        return response()->json('Recored Updated Suceessfully');
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
            return response()->json('Record deleted successfully', 200);
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
