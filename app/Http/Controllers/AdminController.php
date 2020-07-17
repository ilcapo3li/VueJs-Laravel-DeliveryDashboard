<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Auth;
use JWTAuth;

class AdminController extends Controller
{
    public function index()
    {
        $users=User::with(['role','permissions','photo'])->where('role_id', 2)->orderBy('id', 'desc')->paginate(10);
        return response()->json($users);
    }

    public function saveAdmin(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name'=>'required|string|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $admin=new User();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->role_id = 2;
            $admin->save();
            $admin->permissions()->attach($request->permissions);

            return response()->json("User Created Suceessfully");
        }
    }

    public function EditAdmin(Request $request, $id)
    {
        $validator=Validator::make($request->all(), [
            'name'=>'required|string|unique:users,name,'.$id,
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|confirmed|min:6',
            'password_confirmation'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $admin=User::find($id);
            $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            ]);
            foreach($admin->userTokens as $userToken){
                $userToken->blocked=1;
                $userToken->save();
            }
            $admin->permissions()->detach();
            $admin->permissions()->attach($request->permissions);
            return response()->json("User Updated Suceessfully");
        }
    }

    public function removeAdmin($id)
    {
        User::find($id)->delete();
        return response()->json('Admin deleted successfully', 200);
    }

}
