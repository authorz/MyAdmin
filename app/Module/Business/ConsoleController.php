<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/7/6
     * Time: 18:55
     */
    namespace App\Module\Business;

    use App\Http\Controllers\Controller;

    class ConsoleController extends Controller
    {
        public function __invoke()
        {
            return view('index');
        }
    }