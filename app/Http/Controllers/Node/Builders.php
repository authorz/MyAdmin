<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/6/3
     * Time: 16:39
     */
    namespace App\Http\Controllers\Node;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;
    use App\Model\Module;

    trait Builders
    {
        public function indexBuilder($data)
        {

            $list = Builder::tables();

            $view = function (array $data) use ($list) {

                $list->setNav(Module::getModuleForNode(), 'Module');

                $list->setTableDataListKey('Id');

                $list
                    ->addTopButton(['name' => '新增', 'value' => 'add', 'url' => UrlFunc::jumpUrl('node/add', ['Module' => $_GET['Module']]), 'type' => 'url'])
                    ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => UrlFunc::jumpUrl('node/enable'), 'type' => 'checkbox'])
                    ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => UrlFunc::jumpUrl('node/disable'), 'type' => 'checkbox'])
                    ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => UrlFunc::jumpUrl('node/delete'), 'type' => 'checkbox']);


                $list
                    ->addTableColumn(['name' => 'Id', 'value' => 'Id', 'type' => 'default'])
                    ->addTableColumn(['name' => '节点名称', 'value' => 'title_show', 'type' => 'default'])
                    ->addTableColumn(['name' => '图标', 'value' => 'Icon', 'type' => 'default'])
                    ->addTableColumn(['name' => '链接', 'value' => 'Href', 'type' => 'default'])
                    ->addTableColumn(['name' => '排序', 'value' => 'Sort', 'type' => 'default'])
                    ->addTableColumn(['name' => '状态', 'value' => 'State', 'type' => 'default'])
                    ->addTableColumn(['name' => '操作', 'type' => 'btn']);

                $list->addListData($data);

                $list
                    ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('node/update'), 'custom' => ['Id', 'Module'], 'way' => 'get'])
                    ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('node/enable'), 'custom' => ['Id'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('node/disable'), 'custom' => ['Id'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('node/delete'), 'custom' => ['Id'], 'way' => 'post']);

                return $list;
            };

            return $view($data)->display();
        }


    }