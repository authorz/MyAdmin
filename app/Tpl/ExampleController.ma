<?php
    namespace App\Module\<{{moduleName}}>\Controller;

    use App\Http\Controllers\Controller;

    use App\Builder;

    class ExampleController extends Controller
    {
        public function __invoke()
        {
            $builder = Builder\Builder::tables();

            $builder->display();
        }
    }