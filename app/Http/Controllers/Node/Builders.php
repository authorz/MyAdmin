<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/6/3
     * Time: 16:39
     */
    namespace App\Http\Controllers\Node;

    use App\Builder\Builder;
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
                    ->addTopButton(['name' => '新增', 'value' => 'add', 'url' => '/admin/system/node/add?Id=' . $_GET['Id'] . '&moduleId=' . $_GET['moduleId'], 'type' => 'url'])
                    ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => '/admin/system/node/enable', 'type' => 'checkbox'])
                    ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => '/admin/system/node/disable', 'type' => 'checkbox'])
                    ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => '/admin/system/node/delete', 'type' => 'checkbox']);


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
                    ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => '/admin/system/node/update', 'custom' => ['Id', 'Module'], 'way' => 'get'])
                    ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => '/admin/system/node/enable', 'custom' => ['Id'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => '/admin/system/node/disable', 'custom' => ['Id'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => '/admin/system/node/delete', 'custom' => ['Id'], 'way' => 'post']);

                return $list;
            };

            return $view($data)->display();
        }

        public function createBuilder(array $data = [])
        {
            $form = Builder::forms();

            $view = function (array $data) use ($form) {

                $form
                    ->setSubWay('post')
                    ->setFormUrl(route($this->className . '.store'));

                $form
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => route($this->className . '.index')])
                    ->addFormItem(['name' => 'Module', 'type' => 'hidden', 'value' => $_GET['Id']])
                    ->addFormItem(['name' => 'Type', 'type' => 'select', 'title' => '栏目类型', 'value' => 1, 'parameter' => MainType::getMainTypeList()])
                    ->addFormItem(['name' => 'Title', 'type' => 'text', 'title' => '栏目标题'])
                    ->addFormItem(['name' => "seo", 'type' => 'text', 'title' => 'SEO标题'])
                    ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'title' => '关键字'])
                    ->addFormItem(['name' => 'description', 'type' => 'textarea', 'title' => '栏目描述'])
                    ->addFormItem(['name' => 'sort', 'type' => 'text', 'title' => '排序', 'value' => '15'])
                    ->addFormItem(['name' => 'hide', 'type' => 'radio', 'title' => '隐藏栏目', 'parameter' => [
                        '0' => '显示',
                        '1' => '隐藏'
                    ]]);

                return $form;

            };

            return $view($data)->display();
        }

        public function editBuilder(array $data = [])
        {
            $form = Builder::forms();

            $view = function (array $data) use ($form) {

                $form
                    ->setSubWay('post')
                    ->setFormUrl('/admin/infoclass/update');

                $form
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => route($this->className . '.index')])
                    ->addFormItem(['name' => 'Id', 'type' => 'hidden', 'value' => $data['Id']])
                    ->addFormItem(['name' => 'Type', 'type' => 'select', 'title' => '栏目类型', 'value' => $data['Type'], 'parameter' => MainType::getMainTypeList()])
                    ->addFormItem(['name' => 'Title', 'type' => 'text', 'title' => '栏目标题', 'value' => $data['Title']])
                    ->addFormItem(['name' => "seo", 'type' => 'text', 'title' => 'SEO标题', 'value' => $data['seo']])
                    ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'title' => '关键字', 'value' => $data['keywords']])
                    ->addFormItem(['name' => 'description', 'type' => 'textarea', 'title' => '栏目描述', 'value' => $data['description']])
                    ->addFormItem(['name' => 'sort', 'type' => 'text', 'title' => '排序', 'value' => $data['sort']])
                    ->addFormItem(['name' => 'hide', 'type' => 'radio', 'title' => '隐藏栏目', 'value' => $data['hide'], 'parameter' => [
                        '0' => '显示',
                        '1' => '隐藏'
                    ]]);

                return $form;

            };

            return $view($data)->display();
        }
    }