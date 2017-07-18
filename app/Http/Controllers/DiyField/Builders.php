<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/6/3
     * Time: 16:39
     */
    namespace App\Http\Controllers\DiyField;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;


    trait Builders
    {
        public function indexBuilder($data, $page, $id)
        {

            $list = Builder::tables();

            $view = function (array $data) use ($list, $page, $id) {

                $list->setTableDataListKey('Id');

                $list->setNav($data['siteClass'], 'id');

                $list
                    ->addTopButton(['name' => '新增', 'value' => 'create', 'url' => UrlFunc::jumpUrl('diyfield/create', ['id' => $id]), 'type' => 'url'])
                    ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => UrlFunc::jumpUrl('diyfield/destroy'), 'type' => 'checkbox']);

                $list
                    ->addTableColumn(['name' => 'Id', 'value' => 'Id', 'type' => 'default'])
                    ->addTableColumn(['name' => '名称', 'value' => 'Name', 'type' => 'default'])
                    ->addTableColumn(['name' => '别名', 'value' => 'Title', 'type' => 'default'])
                    ->addTableColumn(['name' => '排序', 'value' => 'Sort', 'type' => 'default'])
                    ->addTableColumn(['name' => '操作', 'type' => 'btn']);

                $list->addListData($data['siteList']);

                $list->page($page);

                $list
                    ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('diyfield/edit'), 'custom' => ['Id', 'BindClass'], 'way' => 'get'])
                    ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('diyfield/destroy'), 'custom' => ['Id'], 'way' => 'post']);

                return $list;
            };

            return $view($data)->display();
        }

        public function createBuilder(array $data = [], $id)
        {
            $form = Builder::forms();

            $view = function (array $data) use ($form, $id) {

                $form
                    ->setSubWay('post')
                    ->setFormUrl(route('diyfield.store'));

                $form
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => route('diyfield.index') . '?id=' . $id])
                    ->addFormItem(['name' => 'BindClass', 'type' => 'select', 'title' => '所属分类', 'value' => $id, 'parameter' => $data['siteClsssList']])
                    ->addFormItem(['name' => 'TypeId', 'type' => 'select', 'title' => '字段类型', 'parameter' => $data['siteTypeList']])
                    ->addFormItem(['name' => 'Name', 'type' => 'text', 'title' => '字段名称', 'help' => '字段名称是自动转成全部大写'])
                    ->addFormItem(['name' => "Title", 'type' => 'text', 'title' => '字段别名'])
                    ->addFormItem(['name' => 'Default', 'type' => 'textarea', 'title' => '默认值'])
                    ->addFormItem(['name' => 'Sort', 'type' => 'text', 'title' => '排序', 'value' => '15']);

                return $form;

            };

            return $view($data)->display();
        }

        public function editBuilder(array $data = [], $id)
        {
            $form = Builder::forms();

            $view = function (array $data) use ($form, $id) {

                $form
                    ->setSubWay('post')
                    ->setFormUrl(UrlFunc::jumpUrl('diyfield/update'));

                $form
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => route('diyfield.index') . '?id=' . $id])
                    ->addFormItem(['name' => 'Id', 'type' => 'hidden', 'value' => $data['siteDetail']->Id])
                    ->addFormItem(['name' => 'BindClass', 'type' => 'select', 'title' => '所属分类', 'value' => $data['siteDetail']->BindClass, 'parameter' => $data['siteClsssList']])
                    ->addFormItem(['name' => 'TypeId', 'type' => 'select', 'title' => '字段类型', 'value' => $data['siteDetail']->TypeId, 'parameter' => $data['siteTypeList']])
                    ->addFormItem(['name' => 'Name', 'type' => 'text', 'title' => '字段名称', 'value' => $data['siteDetail']->Name, 'help' => '字段名称是自动转成全部大写'])
                    ->addFormItem(['name' => "Title", 'type' => 'text', 'title' => '字段别名', 'value' => $data['siteDetail']->Title])
                    ->addFormItem(['name' => 'Default', 'type' => 'textarea', 'title' => '默认值', 'value' => $data['siteDetail']->Default])
                    ->addFormItem(['name' => 'Sort', 'type' => 'text', 'title' => '排序', 'value' => $data['siteDetail']->Sort]);

                return $form;

            };

            return $view($data)->display();
        }
    }