<?php

namespace App\Http\Controllers;

use App\Representative;
use Illuminate\Http\Request;

class RepresentativeController extends AuthController
{
    

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return 'representative';
    }
}
