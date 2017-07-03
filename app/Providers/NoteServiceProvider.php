<?php

    namespace App\Providers;

    use App\Libarary\NodeFunc;
    use App\Model\Module;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Http\Request;
    use App\Model\Node;

    class NoteServiceProvider extends ServiceProvider
    {
        protected $moduleModel;

        public function __construct()
        {
            $this->moduleModel = new Module();
        }

        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot(Request $request, Node $nodeModel)
        {
            $pathInfo = $request->path();

            if (!$request->ajax() && !in_array($pathInfo, [
                    '/'
                ])
            ) {

                $moduleId = $this->moduleModel->moduleId(
                    NodeFunc::moduleName($pathInfo)
                );

                $nodeData = NodeFunc::node(
                    $nodeModel::where('Module', NodeFunc::moduleId($moduleId->Id))->get()
                );

                $url = NodeFunc::url($pathInfo);

                $nodeName = $nodeModel::where('Href', $url)->value('NodeName');

                $module = $this->moduleModel->getAll();

                View::share('nodeName', $nodeName);

                View::share('nodeData', $nodeData);

                View::share('moduleName', NodeFunc::moduleName($pathInfo));

                View::share('moduleData', $module);


            }

        }


        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }

    }
