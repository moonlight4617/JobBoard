<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Top extends Controller
{
    public function test()
    {
        if (Auth::guard('companies')->check()) {
            return view('company.welcome');
        } else {
            return view('user.welcome');
        }
    }
}
