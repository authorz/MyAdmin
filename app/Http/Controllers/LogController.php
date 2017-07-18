<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Info\Builders;
    use App\Model\InfoClass;
    use Illuminate\Database\Schema\Builder;
    use Illuminate\Http\Request;

    class LogController extends Controller
    {
        use Builders;

        public function index()
        {
            $builder = \App\Builder\Builder::tables();

            $builder->display();
        }

    }
