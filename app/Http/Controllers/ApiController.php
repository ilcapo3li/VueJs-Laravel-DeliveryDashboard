<?php

namespace App\Http\Controllers;

use App\ApiKey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    
    public function deviceTokenRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|unique:api_keys',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 'false'], 422);
        } else {
            $token = new ApiKey();
            $token->token = $request->token;
            $token->save();

            return response()->json(['message' => 'Token Set Successfully', 'status' => 'true']);
        }
    }

    public function register(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:50',
            'name' => 'required|min:2|max:50',
            'photo' => 'required',
            'token' => 'required|exists:api_keys,token',
        ]);

        if ($valiadator->fails()) {
            return response()->json($valiadator->errors(), 422);
        } else {
            $image = $request->photo;  // your base64 encoded
            $photo = new PhotoHelper();
            $photo_id = $photo->constructPhoto($image, 'user');
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->photo_id = $photo_id;
            $user->save();

            $token = auth()->login($user);

            return $this->respondWithToken($token, request(['token']));
        }
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
    