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
    
    public function login(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($valiadator->fails()) {
            return response()->json($valiadator->errors(), 422);
        } 
        else 
        {         
            $credentials = request(['email', 'password']);
            if (!$token = auth($this->guard())->attempt($credentials)) 
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            DB::table('owner_tokens')->insert(['owner_id'=>auth($this->guard())->id(),'owner_type'=>$this->guard(),'token'=>$token]);
            return $this->respondWithToken($token);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'data'=>[
                'access_token' => $token,
                'token_type' => 'bearer',
                // 'expires_in' => auth()->factory()->getTTL() * 600,
                'user' => new UserResource(auth($this->guard())->user()),
                'user_type'=> $this->guard(),
            ],
            'status' => 'true']);
        
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
            $user = auth($this->guard())->user();
            $credentials = ['email' => $user->email, 'password' => $request->old];

            if (auth($this->guard())->attempt($credentials)) {       // Right password
                $check = ['email' => $user->email, 'password' => $request->new];
                if (auth($this->guard())->attempt($check)) {
                    return response()->json(['status' => 'false', 'message' => 'You Can\'t Use Old Password As New Password'], 422);
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
            } else {            // Wrong one
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        auth($this->guard)->logout();
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
