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

    public function apiLogin(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'token' => 'required|exists:api_keys,token',
        ]);
        $credentials = request(['email', 'password']);


        if ($valiadator->fails()) {
            return response()->json($valiadator->errors(), 422);
        } else {
            $credentials = request(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            DB::table('user_tokens')->insert(['user_id'=>Auth::id(),'token'=>$token]);
            return $this->respondWithToken($token, request(['token']));
        }
    }

    protected function respondWithToken($token, $key)
    {
        //////////////set user with app token////////////
        $user_key = ApiKey::where('token', $key)->first();
        $user_key->user_id = Auth::id();
        $user_key->save();
        /////////////////////////////
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 600,
            'user' => new UserResource(User::find(Auth::id())),
        ]);
    }

}
    