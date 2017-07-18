<?php

    namespace App\Http\Controllers;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;
    use App\Model\Module;

    class ModuleController extends Controller
    {
        protected $moduleModel;

        public function __construct(Module $module)
        {
            $this->moduleModel = $module;
        }

        public function index()
        {
            $builder = Builder::tables();

            $builder->setTableDataListKey('Id');

            $builder
                ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => '/admin/infoclass/enable', 'type' => 'checkbox'])
                ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => '/admin/infoclass/disable', 'type' => 'checkbox']);

            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'Id', 'type' => 'default'])
                ->addTableColumn(['name' => '名称', 'value' => 'ModuleName', 'type' => 'url', 'extend' => [
                    'url' => UrlFunc::jumpUrl('module/detail'),
                    'param' => ['ModuleName','Id']

                ]])
                ->addTableColumn(['name' => '别名', 'value' => 'Title', 'type' => 'default'])
                ->addTableColumn(['name' => '作者', 'value' => 'Author', 'type' => 'default'])
                ->addTableColumn(['name' => '安装时间', 'value' => 'InstallTime', 'type' => 'default'])
                ->addTableColumn(['name' => '状态', 'value' => 'type', 'type' => 'state', 'extend' => [
                    'param' => [
                        0 => '正常',
                        1 => '禁用'
                    ]
                ]])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder->addListData($this->moduleModel->getAll()->toArray());

            $builder->page([]);

            $builder
                ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => '/admin/infoclass/enable', 'custom' => ['Id'], 'way' => 'post'])
                ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => '/admin/infoclass/disable', 'custom' => ['Id'], 'way' => 'post']);


            $builder->display();
        }

    }
