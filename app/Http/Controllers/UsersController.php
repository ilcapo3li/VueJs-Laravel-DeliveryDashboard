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

class UsersController extends Controller
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

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new' => 'required',
            'old' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $user = Auth::user();
            $credentials = ['email' => $user->email, 'password' => $request->old];

            if (Auth()->attempt($credentials)) {
                // Right password
                $check = ['email' => $user->email, 'password' => $request->new];
                if (Auth()->attempt($check)) {
                    return response()->json(['status' => 'false', 'message' => 'you can not use password you used before as new password'], 422);
                } else {
                    $user->password = $request->new;
                    foreach ($user->userTokens as $userToken) {
                        $userToken->blocked = 1;
                        $userToken->save();
                    }
                    $user->save();
                    auth()->logout();

                    return response()->json(['status' => 'true']);
                }
            } else {
                // Wrong one
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    }

    public function user()
    {
        $user = new UserResource(Auth::user());

        return response()->json($user);
    }

    public function changeName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $user = Auth::user();
            $user->name = $request->name;
            $user->save();

            return response()->json(['name' => $user->name, 'status' => 'true']);
        }
    }

    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $image = $request->photo;  // your base64 encoded
            $photo = new PhotoHelper();
            $new_photo = $photo->constructPhoto($image, 'user');
            $user = Auth::user();
            $photo = Photo::find($user->photo_id);
            File::delete(storage_path().DIRECTORY_SEPARATOR.$photo->path);
            $photo->delete();
            $user->photo_id = $new_photo;
            $user->save();

            return response()->json(['photo' => $user->photo->path, 'status' => 'true']);
        }
    }
}
