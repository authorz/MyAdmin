<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
    public function boot(Request $request, Node $nodeModel)
    {
        $nodeData = $this->_getMenu($nodeModel::all());

        $nodeName = $nodeModel::where('Href', $request->path())->value('NodeName');

        View::share('nodeName', $nodeName);

        View::share('nodeData', $nodeData);


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
