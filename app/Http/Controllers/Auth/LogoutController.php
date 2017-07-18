<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->flush();

        return response()->json(['message' => '已注销,正在跳转', 'code' => '200', 'return' => []]);
    }
}
