<?php

namespace App\Http\Controllers\Error;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoAuthController extends Controller
{
    public function __invoke()
    {
        return view('error.noauth');
    }
}
