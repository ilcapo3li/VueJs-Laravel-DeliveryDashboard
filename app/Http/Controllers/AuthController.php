<?php

namespace App\Http\Controllers;

use Auth;
use JWTAuth;
use App\User;
use App\ApiKey;
use Validator;
use Illuminate\Http\Request;
use App\Helpers\PhotoHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
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

    public function login(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = request(['email', 'password']);
        if ($valiadator->fails()) 
        {
            return response()->json($valiadator->errors(), 422);
        } 
        else 
        {
            $credentials = request(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) 
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            DB::table('user_tokens')->insert(['user_id'=>Auth::id(),'token'=>$token]);
            return $this->respondWithToken($token);
        }
    }

  
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 600,
            'user' => new UserResource(User::find(Auth::id())),
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        auth()->logout();
    }

    public function AuthCheck()
    {
        try {
            return  JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json($e->getMessage(), 401);
        }
    }
}
