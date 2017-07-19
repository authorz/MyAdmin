<?php
    namespace App\Module\TestC;

    use App\Http\Controllers\Controller;

    class ConsoleController extends Controller
    {
        public function __invoke()
        {
            return view('index');
        }
    }