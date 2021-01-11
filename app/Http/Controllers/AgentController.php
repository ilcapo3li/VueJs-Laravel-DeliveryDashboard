<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;

class AgentController extends AuthController
{
    
    public function index()
    {
        $agents = Auth::user('user')->agents()
                    ->where('name', 'like', '%'.Input::get('query').'%')
                    ->orwhere('email', 'like', '%'.Input::get('query').'%')
                    ->orwhere('phonePrimary', 'like', '%'.Input::get('query').'%')
                    ->orwhere('PhoneSecondary', 'like', '%'.Input::get('query').'%')
                    ->with(['photo'])->orderBy('id', 'desc')->paginate(10);

        return response()->json($agents);
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
            $admin = new Agent();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->save();

            return response()->json('Agent Created Suceessfully');
        }
    }

    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,'.$agent->id,
            'email' => 'required|email|unique:users,email,'.$agent->id,
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $agent->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);
        $this->blockTokens($agent);
        $agent->permissions()->detach();
        $agent->permissions()->attach($request->permissions);

        return response()->json('Agent Updated Suceessfully');
    }

    public function block(Agent $agent)
    {
        $agent->disabled = !$agent->disabled;
        $agent->save();
        $this->blockTokens($agent);
        return response()->json($agent);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'agent';
    }
}
