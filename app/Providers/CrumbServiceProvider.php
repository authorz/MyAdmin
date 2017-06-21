<?php

namespace App\Providers;

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
    public function boot(Request $request, Node $nodeModel)
    {
        error_reporting(0);

        if ($request->path() != '/' && $request->path() != 'admin/index') {

            $href = $nodeModel::where('Href', $request->path())->first();

            $parentId = $nodeModel->getParentNode($href->Pid);

            $crumb = $nodeModel->getTreeNodeCrumb($href->Pid);

            array_push($crumb, $href);

            if (count($crumb) == 1) {
                $path = $request->path();
            } else {
                $path = $crumb[1]->Href;
            }

            View::share('NodeCrumb', ['id' => $parentId, 'href' => $path, 'Crumb' => $crumb]);
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
