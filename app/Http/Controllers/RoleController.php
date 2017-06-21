<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\RolePermissions;
use Illuminate\Http\Request;

use App\Builder;
use App\Model\Node;

class RoleController extends Controller
{
    public function index(Role $role)
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

        $builder->addListData($role::all()->toArray());

        $builder
            ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => '/admin/role/update', 'custom' => ['ID'], 'way' => 'get'])
            ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => '/admin/node/enable', 'custom' => ['Id'], 'way' => 'post'])
            ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => '/admin/node/disable', 'custom' => ['Id'], 'way' => 'post'])
            ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => '/admin/node/delete', 'custom' => ['Id'], 'way' => 'post']);

        $builder->display();
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $role = new Role();

            $role->Title = $request->input('Title');
            $role->Description = $request->input('Description');
            $role->Pid = $request->input('Pid') ?? 0;

            if ($role->save()) {
                return response()->json(['message' => '添加成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '添加失败', 'code' => 0]);
            }

        } else {
            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => '/admin/role'])
                ->addFormItem(['name' => 'Title', 'title' => '角色名称', 'type' => 'text'])
                ->addFormItem(['name' => 'Description', 'title' => '角色描述', 'type' => 'textarea']);

            $builder->display();
        }

    }

    public function update(Node $node, Request $request, Role $role, RolePermissions $rolePermissions)
    {
        if ($request->isMethod('post')) {

            $roleUpdate = Role::find($request->input('Id'));
            $roleUpdate->Title = $request->input('Title');
            $roleUpdate->Description = $request->input('Description');


            $result = $rolePermissions->bindPermissions($request->input('nodeId'), $request->input('Id'));

            if ($result) {
                return response()->json(['message' => '更新成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '更新失败', 'code' => 0]);
            }

        } else {
            $roleData = $role->getThisRole($request->input('ID'));

            $tree = [];

            $allNode = $node->getAllNode();

            $permissions = $rolePermissions->getPermissions($request->input('ID'));

            foreach ($allNode as $key => $value) {
                $tree[$value['Id']] = $value['title_show'];
            }


            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => '/admin/role'])
                ->addFormItem(['name' => 'Id', 'type' => 'hidden', 'value' => $roleData['ID']])
                ->addFormItem(['name' => 'Title', 'title' => '角色名称', 'type' => 'text', 'value' => $roleData['Title']])
                ->addFormItem(['name' => 'Description', 'title' => '角色描述', 'type' => 'textarea', 'value' => $roleData['Description']])
                ->addFormItem(['name' => 'nodeId', 'title' => '权限', 'type' => 'checkbox', 'parameter' => $tree, 'value' => $permissions]);


            $builder->display();
        }
    }
}
