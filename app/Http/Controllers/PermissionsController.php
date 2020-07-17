<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(){
        $permissions=Permission::all();
        return response()->json($permissions);
    }
}
