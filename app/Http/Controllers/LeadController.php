<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;

class LeadController extends AuthController
{
    public function index()
    {
        $leads = Auth::user('lead')->comapny->leads()
                ->orwhere('email', 'like', '%'.Input::get('query').'%')
                ->orwhere('phonePrimary', 'like', '%'.Input::get('query').'%')
                ->orwhere('PhoneSecondary', 'like', '%'.Input::get('query').'%')
                ->with(['photo'])->orderBy('id', 'desc')->paginate(10);
        return response()->json($leads);
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
            $admin = new Lead();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->save();
            return response()->json('New Lead Created Suceessfully');
        }
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,'.$lead->id,
            'email' => 'required|email|unique:users,email,'.$lead->id,
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $lead->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $this->blockTokens($lead);
    
        return response()->json('Customer Updated Suceessfully');
    }

    public function block(Lead $lead)
    {
        $lead->disabled = !$lead->disabled;
        $lead->save();
        $this->blockTokens($lead);
        return response()->json($lead);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'lead';
    }


}
