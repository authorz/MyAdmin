<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/7/3
     * Time: 18:31
     */
    namespace App\Module\Business;

    use App\Http\Controllers\Controller;

    use App\Builder;

    class IndexController extends Controller
    {
        public function index()
        {
            $builder = Builder\Builder::tables();


            $builder->setTableDataListKey('ID');

            $builder
                ->addTopButton(['name' => '新增', 'value' => 'add', 'url' => '/admin/role/add', 'type' => 'url'])
                ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => '/admin/node/enable', 'type' => 'checkbox'])
                ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => '/admin/node/disable', 'type' => 'checkbox'])
                ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => '/admin/node/delete', 'type' => 'checkbox']);


            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'ID', 'type' => 'default'])
                ->addTableColumn(['name' => '角色名称', 'value' => 'Title', 'type' => 'default'])
                ->addTableColumn(['name' => '角色描述', 'value' => 'Description', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder->addListData([]);

            $builder
                ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => '/admin/system/role/update', 'custom' => ['ID'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => '/admin/node/enable', 'custom' => ['Id'], 'way' => 'post'])
                ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => '/admin/node/disable', 'custom' => ['Id'], 'way' => 'post'])
                ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => '/admin/node/delete', 'custom' => ['Id'], 'way' => 'post']);

            $builder->display();
        }
    }