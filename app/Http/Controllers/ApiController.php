<?php

namespace App\Http\Controllers;

use App\ApiKey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    
    public function register(Request $request)
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

}
    