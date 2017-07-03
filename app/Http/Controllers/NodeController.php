<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2017/5/25
 * Time: 23:00
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Node\Builders;
use Illuminate\Http\Request;
use App\Model\Node;
use App\Builder;


class NodeController extends Controller
{
    use Builders;

    protected $nodeModel;

    public function __construct()
    {
        $this->nodeModel = new Node();
    }

    // 节点列表
    public function index()
    {
        return $this->indexBuilder($this->nodeModel->getAllNode());
    }

    // 编辑节点
    public function update(Node $nodeModel, Request $request)
    {
        if ($request->isMethod('post')) {
            $node = Node::find($request->input('Id'));

            $node->NodeName = $request->input('NodeName');
            $node->Pid = $request->input('Pid');
            $node->Icon = $request->input('Icon') ?? '';
            $node->Href = $request->input('Href') ?? '';
            $node->Sort = $request->input('Sort');
            $node->State = $request->input('State');

            if ($node->save()) {
                return response()->json(['message' => '更新成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '更新失败', 'code' => 0]);
            }

        } else {

            $result = $nodeModel->getNode($request->input('Id'));

            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => '/admin/system/node'])
                ->addFormItem(['name' => 'Id', 'type' => 'hidden', 'value' => $result['Id']])
                ->addFormItem(['name' => 'Pid', 'value' => $result['Pid'], 'title' => '上级节点', 'type' => 'select', 'parameter' => $nodeModel->selectNode()])
                ->addFormItem(['name' => 'NodeName', 'value' => $result['NodeName'], 'title' => '节点名称', 'type' => 'text'])
                ->addFormItem(['name' => 'Icon', 'value' => $result['Icon'], 'title' => '节点图标', 'type' => 'text'])
                ->addFormItem(['name' => 'Href', 'value' => $result['Href'], 'title' => '节点地址', 'type' => 'text'])
                ->addFormItem(['name' => 'Sort', 'value' => $result['Sort'], 'title' => '排序', 'type' => 'text',])
                ->addFormItem(['name' => 'State', 'value' => $result['State'], 'title' => '状态', 'type' => 'radio', 'parameter' => [
                    '0' => '启用',
                    '1' => '禁用'
                ]]);

            $builder->display();
        }
    }

    // 添加节点
    public function add(Node $nodeModel, Request $request)
    {
        if ($request->isMethod('post')) {
            $node = new Node();

            $node->NodeName = $request->input('NodeName');
            $node->Pid = $request->input('Pid');
            $node->Icon = $request->input('Icon','');
            $node->Href = $request->input('Href','');
            $node->Sort = $request->input('Sort');
            $node->State = $request->input('State');
            $node->Module = $request->input('Module');

            if ($node->save()) {
                return response()->json(['message' => '添加成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '添加失败', 'code' => 0]);
            }

        } else {
            $builder = Builder\Builder::forms();

            $builder->setSubWay('post')->setFormUrl();

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => '/admin/node'])
                ->addFormItem(['name' => 'Module', 'type' => 'hidden', 'value' => $_GET['Id']])
                ->addFormItem(['name' => 'Pid', 'title' => '上级节点', 'type' => 'select', 'parameter' => $nodeModel->selectNode()])
                ->addFormItem(['name' => 'NodeName', 'title' => '节点名称', 'type' => 'text'])
                ->addFormItem(['name' => 'Icon', 'title' => '节点图标', 'type' => 'text'])
                ->addFormItem(['name' => 'Href', 'title' => '节点地址', 'type' => 'text'])
                ->addFormItem(['name' => 'Sort', 'title' => '排序', 'type' => 'text', 'value' => 0])
                ->addFormItem(['name' => 'State', 'title' => '排序', 'type' => 'radio', 'value' => 0, 'parameter' => [
                    '0' => '启用',
                    '1' => '禁用'
                ]]);


            $builder->display();
        }
    }

    // 禁用节点
    public function disable(Node $nodeModel, Request $request)
    {
        $Id = $request->input('Id');

        $Id = explode(',', $Id);


        foreach ($Id as $value) {
            $result = $nodeModel->disableNode($value);
        }

        if ($result) {
            return response()->json(['message' => '禁用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '禁用失败', 'code' => 0]);
        }

    }

    // 启用节点
    public function enable(Node $nodeModel, Request $request)
    {
        $Id = $request->input('Id');

        $Id = explode(',', $Id);


        foreach ($Id as $value) {
            $result = $nodeModel->enableNode($value);
        }

        if ($result) {
            return response()->json(['message' => '启用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '启用失败', 'code' => 0]);
        }
    }

    // 删除节点
    public function delete(Node $nodeModel, Request $request)
    {
        $Id = $request->input('Id');

        $Id = explode(',', $Id);

        foreach ($Id as $value) {
            $result = $nodeModel->deleteNode($value);
        }

        if ($result) {
            return response()->json(['message' => '删除成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '删除失败', 'code' => 0]);
        }


    }
}