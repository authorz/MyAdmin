<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2017/6/3
 * Time: 16:39
 */
namespace App\Http\Controllers\LoginLog;

use App\Builder\Builder;


trait Builders
{
    public function indexBuilder(array $data, $page)
    {
        $list = Builder::tables();

        $view = function (array $data, $page) use ($list) {

            $list->setTableDataListKey('Id');

            $list
                ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => '', 'type' => 'checkbox']);


            $list
                ->addTableColumn(['name' => 'Id', 'value' => 'Id', 'type' => 'default'])
                ->addTableColumn(['name' => '用户', 'value' => 'Name', 'type' => 'default'])
                ->addTableColumn(['name' => 'ip', 'value' => 'Ip', 'type' => 'default'])
                ->addTableColumn(['name' => '登录时间', 'value' => 'LoginTime', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $list->addListData($data);

            $list->page($page);

            $list
                ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => '', 'custom' => ['Id'], 'way' => 'post']);

            return $list;
        };

        return $view($data,$page)->display();

    }
}