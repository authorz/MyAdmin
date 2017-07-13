<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/6/3
     * Time: 16:39
     */
    namespace App\Http\Controllers\DbList;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;


    trait Builders
    {
        private function navs() : array
        {
            return [
                ['name' => '数据库操作', 'url' => '?id=1', 'value' => '1'],
                ['name' => '备份列表', 'url' => '?id=2', 'value' => '2'],
                ['name' => '执行SQL语句', 'url' => '?id=3', 'value' => '3']
            ];
        }

        public function indexBuilder($data)
        {

            $list = Builder::tables();

            $view = function (array $data) use ($list) {

                $list->setTableDataListKey('tableName');

                $list->setNav($this->navs(), 'id');

                $list
                    ->addTopButton(['name' => '备份', 'value' => 'backup', 'url' => UrlFunc::jumpUrl('dblist/backup'), 'type' => 'checkbox'])
                    ->addTopButton(['name' => '修复', 'value' => 'repair', 'url' => UrlFunc::jumpUrl('dblist/repair'), 'type' => 'checkbox'])
                    ->addTopButton(['name' => '优化', 'value' => 'optimize', 'url' => UrlFunc::jumpUrl('dblist/optimize'), 'type' => 'checkbox']);


                $list
                    ->addTableColumn(['name' => '表名', 'value' => 'tableName', 'type' => 'default'])
                    ->addTableColumn(['name' => '记录数', 'value' => 'tableCount', 'type' => 'default'])
                    ->addTableColumn(['name' => '数据大小', 'value' => 'tableSize', 'type' => 'default'])
                    ->addTableColumn(['name' => '操作', 'type' => 'btn']);

                $list->addListData($data);

                $list
                    ->addRightButton(['class' => 'btn-success', 'name' => '备份', 'value' => 'backup', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('dblist/backup'), 'custom' => ['tableName'], 'way' => 'post'])
                    #->addRightButton(['class' => 'btn-info', 'name' => '结构', 'value' => 'update', 'type' => FALSE, 'url' => '/admin/node/update', 'custom' => ['Id'], 'way' => 'get'])
                    ->addRightButton(['class' => 'btn-danger', 'name' => '修复', 'value' => 'repair', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('dblist/repair'), 'custom' => ['tableName'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-danger', 'name' => '优化', 'value' => 'optimize', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('dblist/optimize'), 'custom' => ['tableName'], 'way' => 'post']);

                return $list;

            };

            return $view($data)->display();
        }


        public function queryBuilder($data)
        {
            $form = Builder::forms();

            $view = function (array $data) use ($form) {

                $form->setNav($this->navs(), 'id');

                $form->setSubWay('post')->setFormUrl()->closeAjax();

                $form
                    ->addFormItem(['name' => 'sqlContent', 'title' => 'SQL', 'type' => 'textarea', 'value' => $data['sql'], 'help' => '请输入完整SQL语句,只能使用select语句']);

                $form->block($data['result']);

                return $form;
            };

            return $view($data)->display();
        }

        public function backupBuilder($data)
        {
            $list = Builder::tables();

            $view = function (array $data) use ($list) {

                $list->setTableDataListKey('filename');

                $list->setNav($this->navs(), 'id');

                $list
                    ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => UrlFunc::jumpUrl('dblist/del'), 'type' => 'checkbox']);

                $list
                    ->addTableColumn(['name' => '文件', 'value' => 'filename', 'type' => 'default'])
                    ->addTableColumn(['name' => '数据大小 (约等于)', 'value' => 'filesize', 'type' => 'default'])
                    ->addTableColumn(['name' => '操作', 'type' => 'btn']);

                $list->addListData($data);

                $list
                    ->addRightButton(['class' => 'btn-success', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('dblist/del'), 'custom' => ['filename'], 'way' => 'post'])
                    ->addRightButton(['class' => 'btn-info', 'name' => '下载', 'value' => 'enable', 'type' => false, 'url' => UrlFunc::jumpUrl('dblist/download'), 'custom' => ['name'], 'way' => 'post']);
                return $list;

            };

            return $view($data)->display();
        }
    }