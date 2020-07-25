<?php

namespace App\Http\Controllers;

use App\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::where('role_id', Auth::user()->role_id)->get();

        return response()->json($permissions);
    }
}
