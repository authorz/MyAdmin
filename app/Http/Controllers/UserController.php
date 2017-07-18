<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2017/5/25
 * Time: 23:00
 */

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Libarary\UrlFunc;
use App\Model\Role;
use App\Model\User;
use App\Model\UserRole;
use Illuminate\Http\Request;
use App\Builder;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 管理员列表
    public function index(User $user)
    {


        $users = $user::paginate(10);

        #$userData = $user::all()->toArray();

        $builder = Builder\Builder::tables();


        $builder->setTableDataListKey('ID');

        $builder
            ->addTopButton(['name' => '新增', 'value' => 'add', 'url' => UrlFunc::jumpUrl('user/add'), 'type' => 'url'])
            ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => UrlFunc::jumpUrl('user/enable'), 'type' => 'checkbox'])
            ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => UrlFunc::jumpUrl('user/disable'), 'type' => 'checkbox'])
            ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => UrlFunc::jumpUrl('user/delete'), 'type' => 'checkbox']);


        $builder
            ->addTableColumn(['name' => 'Id', 'value' => 'ID', 'type' => 'default'])
            ->addTableColumn(['name' => '用户名', 'value' => 'Name', 'type' => 'default'])
            ->addTableColumn(['name' => '邮箱', 'value' => 'Email', 'type' => 'default'])
            ->addTableColumn(['name' => '登录时间', 'value' => 'LoginTime', 'type' => 'default'])
            ->addTableColumn(['name' => '状态', 'value' => 'State', 'type' => 'default'])
            ->addTableColumn(['name' => '操作', 'type' => 'btn']);

        $builder->addListData($users->toArray()['data']);

        $builder
            ->addRightButton(['class' => 'btn-danger', 'name' => '绑定角色', 'value' => 'bind', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('user/bind'), 'custom' => ['ID'], 'way' => 'get'])
            ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('user/update'), 'custom' => ['ID'], 'way' => 'get'])
            ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('user/enable'), 'custom' => ['ID'], 'way' => 'post'])
            ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('user/disable'), 'custom' => ['ID'], 'way' => 'post'])
            ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('user/delete'), 'custom' => ['ID'], 'way' => 'post']);

        $builder->page($users->links());

        $builder->display();

    }

    public function bind(Request $request, UserRole $userRole, Role $role)
    {

        if ($request->isMethod('post')) {
            if ($request->input('ID') == 1) {
                return response()->json(['message' => '超级管理员无法修改角色', 'code' => 0]);
            }

            $result = $userRole->bindRole($request->input('ID'), $request->input('roleId'));

            if ($result) {
                return response()->json(['message' => '绑定成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '绑定失败', 'code' => 0]);
            }

        } else {
            $roleId = $userRole->getBindRole($request->input('ID'));

            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem([
                    'name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('user')
                ])
                ->addFormItem([
                    'name' => 'roleId', 'title' => '绑定角色', 'type' => 'select', 'value' => $roleId, 'parameter' => $role->getRole()
                ]);

            $builder->display();
        }

    }

    // 添加管理员
    public function add()
    {
        $builder = Builder\Builder::forms();

        $builder->setSubWay('post')->setFormUrl(UrlFunc::jumpUrl('user/isadd'));

        $builder
            ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('user')])
            ->addFormItem(['name' => 'Name', 'title' => '用户名', 'type' => 'text'])
            ->addFormItem(['name' => 'Email', 'title' => '邮箱', 'type' => 'text'])
            ->addFormItem(['name' => 'PassWord', 'title' => '登录密码', 'type' => 'password'])
            ->addFormItem(['name' => 'State', 'title' => '状态', 'type' => 'radio', 'value' => 0, 'parameter' => [
                '0' => '启用',
                '1' => '禁用'
            ]]);


        $builder->display();

    }

    // 添加管理员行为
    public function isAdd(UserPost $request)
    {
        $node = new User();

        $node->Name = $request->input('Name');
        $node->Email = $request->input('Email') ?? '';
        $node->PassWord = Hash::make($request->input('PassWord'));
        $node->State = $request->input('State');
        $node->LoginTime = date('Y-m-d H:i:s', time());

        if ($node->save()) {
            return response()->json(['message' => '添加成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '添加失败', 'code' => 0]);
        }
    }

    // 编辑管理员
    public function update(User $userModel, Request $request)
    {
        if ($request->isMethod('post')) {
            $node = User::find($request->input('ID'));

            $node->Name = $request->input('Name');
            $node->Email = $request->input('Email') ?? '';
            if ($request->input('PassWord')) {
                $node->PassWord = Hash::make($request->input('PassWord'));
            }

            $node->State = $request->input('State');
            $node->LoginTime = date('Y-m-d H:i:s', time());

            if ($node->save()) {
                return response()->json(['message' => '更新成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '更新失败', 'code' => 0]);
            }

        } else {
            $userData = $userModel->getUser($request->input('ID'));

            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => '/admin/user'])
                ->addFormItem(['name' => 'ID', 'type' => 'hidden', 'value' => $userData['ID']])
                ->addFormItem(['name' => 'Name', 'title' => '用户名', 'type' => 'text', 'value' => $userData['Name']])
                ->addFormItem(['name' => 'Email', 'title' => '邮箱', 'type' => 'text', 'value' => $userData['Email']])
                ->addFormItem(['name' => 'PassWord', 'title' => '登录密码', 'type' => 'password'])
                ->addFormItem(['name' => 'State', 'title' => '状态', 'type' => 'radio', 'value' => $userData['State'], 'parameter' => [
                    '0' => '启用',
                    '1' => '禁用'
                ]]);


            $builder->display();
        }
    }

    // 禁用管理员
    public function disable(User $userModel, Request $request)
    {
        $Id = $request->input('ID');

        $Id = explode(',', $Id);


        foreach ($Id as $value) {
            $result = $userModel->disableUser($value);
        }

        if ($result) {
            return response()->json(['message' => '禁用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '禁用失败', 'code' => 0]);
        }

    }

    // 启用管理员
    public function enable(User $userModel, Request $request)
    {
        $Id = $request->input('ID');

        $Id = explode(',', $Id);


        foreach ($Id as $value) {
            $result = $userModel->enableUser($value);
        }

        if ($result) {
            return response()->json(['message' => '启用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '启用失败', 'code' => 0]);
        }
    }

    // 删除管理员
    public function delete(User $userModel, Request $request)
    {
        $Id = $request->input('ID');

        $Id = explode(',', $Id);

        foreach ($Id as $value) {

            if ($value != 1) {
                $result = $userModel->deleteUser($value);
            } else {
                return response()->json(['message' => 'admin用户无法删除', 'code' => 0]);
            }
        }

        if ($result) {
            return response()->json(['message' => '删除成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '删除失败', 'code' => 0]);
        }


    }
}