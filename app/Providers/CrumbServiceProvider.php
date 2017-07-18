<?php

    namespace App\Providers;

    use App\Libarary\NodeFunc;
    use App\Model\Module;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;
    use App\Model\Node;

    class CrumbServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot(Request $request, Node $nodeModel, Module $module)
        {
            error_reporting(0);

            if ($request->path() != '/' && $request->path() != 'admin/index') {

                $moduleId = $module::where('ModuleName', NodeFunc::moduleName($request->path()))->value('Id');


                $path = explode('/', $request->path());

                unset($path[0], $path[1]);

                $path = implode('/', array_merge($path));

                $href = $nodeModel::where('Href', $path)->where('Module',$moduleId)->first();

                $parentId = $nodeModel->getParentNode($href->Pid, 'Id', $moduleId);

                $crumb = $nodeModel->getTreeNodeCrumb($href->Pid);

                array_push($crumb, $href);

                if (count($crumb) != 1) {
                    $path = $crumb[1]->Href;
                }


                View::share('NodeCrumb', ['id' => $parentId, 'href' => $path, 'Crumb' => $crumb, 'moduleId' => $moduleId]);
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
