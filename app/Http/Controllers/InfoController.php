<?php

    namespace App\Http\Controllers;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;
    use App\Model\Info;
    use App\Model\InfoClass;
    use Illuminate\Http\Request;

    class InfoController extends Controller
    {
        public function index()
        {
            $builder = Builder::tables();

            $builder
                ->addTopButton(['name' => '新增', 'value' => 'create', 'url' => UrlFunc::jumpUrl('infoclass/create'), 'type' => 'url']);


            $builder->addListData(InfoClass::getInfo()->toArray()['data']);
            $builder->page(InfoClass::getInfo()->links());

            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'Id', 'type' => 'default'])
                ->addTableColumn(['name' => '单页名称', 'value' => 'Title', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder
                ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('info/edit'), 'custom' => ['Id'], 'way' => 'get']);

            $builder->display();
        }

        public function edit(Request $request)
        {

            if ($request->isMethod('post')) {

                $output = Info::editInfo(
                    $request->input('id'),
                    $request->input('content')
                );

                if ($output) {
                    return response()->json(['message' => '添加成功', 'code' => 200]);
                } else {
                    return response()->json(['message' => '添加失败', 'code' => 0]);
                }


            } else {

                $builder = Builder::forms();

                $builder->setFormUrl()
                    ->setSubWay('post');

                $builder
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('info')])
                    ->addFormItem(['name' => 'id', 'type' => 'hidden', 'value' => $request->input('Id')])
                    ->addFormItem(['name' => "content", 'type' => 'ueditor', 'title' => '内容', 'value' => Info::getInfo($request->input('Id'))->content, 'append' => [
                        'style' => 'height:300px'
                    ]]);

                $builder->display();
            }

        }

    }
