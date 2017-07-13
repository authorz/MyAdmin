<?php

    namespace App\Http\Controllers;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;
    use App\Model\InfoClass;
    use App\Model\InfoList;
    use Illuminate\Http\Request;

    class InfoListController extends Controller
    {

        protected $infoListModel, $infoClassModel;

        public function __construct(InfoList $infoList, InfoClass $infoClass)
        {
            $this->infoListModel = $infoList;

            $this->infoClassModel = $infoClass;
        }

        public function index()
        {


            $builder = Builder::tables();

            $builder
                ->addTopButton(['name' => '添加列表信息', 'value' => 'create', 'url' => UrlFunc::jumpUrl('infolist/create'), 'type' => 'url']);


            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'id', 'type' => 'default'])
                ->addTableColumn(['name' => '标题', 'value' => 'title', 'type' => 'default'])
                ->addTableColumn(['name' => '栏目', 'value' => 'classId', 'type' => 'state', 'extend' => [
                    'param' => $this->infoClassModel->getInfoListClass()
                ]])
                ->addTableColumn(['name' => '更新时间', 'value' => 'updated_at', 'type' => 'default'])
                ->addTableColumn(['name' => '发布人', 'value' => 'author', 'type' => 'default'])
                ->addTableColumn(['name' => '点击', 'value' => 'click', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder->page($this->infoListModel->_list()->links());

            $builder->addListData($this->infoListModel->_list()->toArray()['data']);

            $builder
                ->addRightButton(['class' => 'btn-info', 'name' => '审核', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('infolist/check'), 'custom' => ['id'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'edit', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('infolist/edit'), 'custom' => ['id'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('infolist/delete'), 'custom' => ['id'], 'way' => 'get']);


            $builder->display();
        }

        public function create(Request $request)
        {
            if ($request->isMethod('post')) {

                $data = $request->all();

                unset($data['redirect']);

                $data['style'] = implode(',', $data['style']);

                $output = $this->infoListModel->add($data);

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
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('infolist')])
                    ->addFormItem(['name' => 'classId', 'type' => 'select', 'title' => '栏目', 'parameter' =>
                        $this->infoClassModel->getInfoListClass()
                    ])
                    ->addFormItem(['name' => 'title', 'type' => 'text', 'title' => '文章标题'])
                    ->addFormItem(['name' => 'style', 'type' => 'checkbox', 'title' => '属性', 'parameter' => [
                        0 => '头条',
                        1 => '推荐',
                        2 => '幻灯',
                        3 => '特贱'
                    ]])
                    ->addFormItem(['name' => 'source', 'type' => 'text', 'title' => '文章来源'])
                    ->addFormItem(['name' => 'author', 'type' => 'text', 'title' => '作者'])
                    ->addFormItem(['name' => 'linkurl', 'type' => 'text', 'title' => '跳转链接'])
                    ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'title' => '关键字'])
                    ->addFormItem(['name' => 'description', 'type' => 'textarea', 'title' => '摘要'])
                    ->addFormItem(['name' => "content", 'type' => 'ueditor', 'title' => '详细内容', 'append' => [
                        'style' => 'height:300px'
                    ]])
                    ->addFormItem(['name' => 'click', 'type' => 'text', 'title' => '点击次数'])
                    ->addFormItem(['name' => 'sort', 'type' => 'text', 'title' => '排序'])
                    ->addFormItem(['name' => 'check', 'type' => 'radio', 'title' => '审核', 'parameter' => [
                        0 => '是',
                        1 => '否'
                    ]]);

                $builder->display();
            }


        }

        public function edit(Request $request)
        {

            $data = $this->infoListModel->_find($request->input('id'));

            $builder = Builder::forms();

            $builder->setFormUrl()
                ->setSubWay('post');

            $builder
                ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('infolist')])
                ->addFormItem(['name' => 'classId', 'type' => 'select', 'value' => $data['classId'], 'title' => '栏目', 'parameter' =>
                    $this->infoClassModel->getInfoListClass()
                ])
                ->addFormItem(['name' => 'title', 'type' => 'text', 'value' => $data['title'], 'title' => '文章标题'])
                ->addFormItem(['name' => 'style', 'type' => 'checkbox', 'value' => $data['style'], 'title' => '属性', 'parameter' => [
                    0 => '头条',
                    1 => '推荐',
                    2 => '幻灯',
                    3 => '特贱'
                ]])
                ->addFormItem(['name' => 'source', 'type' => 'text', 'value' => $data['source'], 'title' => '文章来源'])
                ->addFormItem(['name' => 'author', 'type' => 'text', 'title' => '作者'])
                ->addFormItem(['name' => 'linkurl', 'type' => 'text', 'title' => '跳转链接'])
                ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'title' => '关键字'])
                ->addFormItem(['name' => 'description', 'type' => 'textarea', 'title' => '摘要'])
                ->addFormItem(['name' => "content", 'type' => 'ueditor', 'title' => '详细内容', 'append' => [
                    'style' => 'height:300px'
                ]])
                ->addFormItem(['name' => 'click', 'type' => 'text', 'title' => '点击次数'])
                ->addFormItem(['name' => 'sort', 'type' => 'text', 'title' => '排序'])
                ->addFormItem(['name' => 'check', 'type' => 'radio', 'title' => '审核', 'parameter' => [
                    0 => '是',
                    1 => '否'
                ]]);

            $builder->display();
        }

    }
