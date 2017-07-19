<?php
    namespace App\Module\<{{moduleName}}>;

    use App\Http\Controllers\Controller;

    class ConsoleController extends Controller
    {
        public function __invoke()
        {
            return view('index');
        }
    }