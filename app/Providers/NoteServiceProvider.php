<?php

    namespace App\Providers;

    use App\Model\Module;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Http\Request;
    use App\Model\Node;

    class NoteServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot(Request $request, Node $nodeModel, Module $module)
        {

            if ($request->getPathInfo() != '/') {

                $path = explode('/', $request->getPathInfo())[2];

                $moduleId = $module->moduleId($path);


                if (empty($moduleId)) {

                    $moduleId['Id'] = 0;
                } else {

                    $moduleId = (array)$moduleId;

                }

                $nodeData = $this->_getMenu($nodeModel::where('Module', $moduleId['Id'])->get());

                $url = explode('/', $request->path());

                unset($url[0], $url[1]);

                $url = implode('/', array_merge($url));

                $nodeName = $nodeModel::where('Href', $url)->value('NodeName');

                $module = $module->getAll();

                View::share('moduleName', $path);

                View::share('nodeName', $nodeName);

                View::share('nodeData', $nodeData);

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

        public function _getMenu($list, $pk = 'Id', $pid = 'Pid', $child = "children", $root = 0)
        {

            $tree = [];

            foreach ($list as $key => $value) {

                if ($value[$pid] == $root) {

                    unset($list[$key]);

                    if (!empty($list)) {

                        $child = $this->_getMenu($list, $pk, $pid, $child, $value[$pk]);

                        if (!empty($child)) {
                            $value['children'] = $child;
                        }
                    }

                    $tree[] = $value;

                }

            }
            return $tree;

        }
    }
