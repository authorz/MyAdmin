<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('UserLoginData.loginstate')) {
            return redirect()->route('index');
        } else {
            $request->session()->pull('UserLoginData.username');
            $request->session()->pull('UserLoginData.loginstate');
            $request->session()->pull('UserLoginData.logintime');
        }

        return view('auth/login', [
            'loginUserName' => $request->cookie('loginUserName'),
            'loginRemember' => $request->cookie('loginRemember'),
            'loginPassWord' => $request->cookie('loginPassWord'),
        ]);
    }
}
