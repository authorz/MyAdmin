<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Info\Builders;
    use App\Model\InfoClass;
    use Illuminate\Http\Request;

    class InfoController extends Controller
    {
        use Builders;

        public function index()
        {
            $infoClass = InfoClass::getInfoPageClass();
            dd($infoClass);
            $this->indexBuilder($infoClass->toArray()['data'], $infoClass->links());
        }

    }
