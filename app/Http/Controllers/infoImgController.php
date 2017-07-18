<?php

    namespace App\Http\Controllers;

    use App\Builder\Builder;
    use App\Libarary\UrlFunc;
    use App\Model\InfoClass;
    use App\Model\InfoList;
    use App\Model\InfoStyle;
    use Illuminate\Http\Request;

    class InfoImgController extends Controller
    {
        /**
         * @var InfoList
         */
        protected $infoListModel, $infoClassModel, $infoStyleModel;

        /**
         * InfoListController constructor.
         *
         * @param InfoList  $infoList
         * @param InfoClass $infoClass
         * @param InfoStyle $infoStyle
         */
        public function __construct(InfoList $infoList, InfoClass $infoClass, InfoStyle $infoStyle)
        {
            $this->infoListModel = $infoList;

            $this->infoClassModel = $infoClass;

            $this->infoStyleModel = $infoStyle;
        }

        public function index()
        {


            $builder = Builder::tables();

            $builder
                ->addTopButton(['name' => '添加图片信息', 'value' => 'create', 'url' => UrlFunc::jumpUrl('infoimg/create'), 'type' => 'url']);

            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'id', 'type' => 'default'])
                ->addTableColumn(['name' => '标题', 'value' => 'title', 'type' => 'default'])
                ->addTableColumn(['name' => '栏目', 'value' => 'classId', 'type' => 'state', 'extend' => [
                    'param' => $this->infoClassModel->getInfoListClass(3)
                ]])
                ->addTableColumn(['name' => '更新时间', 'value' => 'updated_at', 'type' => 'default'])
                ->addTableColumn(['name' => '发布人', 'value' => 'author', 'type' => 'default'])
                ->addTableColumn(['name' => '点击', 'value' => 'click', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder->page($this->infoListModel->_list(3)->links());

            $builder->addListData($this->infoListModel->_list(3)->toArray()['data']);

            $builder
                ->addRightButton(['class' => 'btn-info', 'name' => '审核', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('infoimg/check'), 'custom' => ['id'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'edit', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('infoimg/edit'), 'custom' => ['id'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => UrlFunc::jumpUrl('infoimg/delete'), 'custom' => ['id'], 'way' => 'post']);


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
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('infoimg')])
                    ->addFormItem(['name' => 'classId', 'type' => 'select', 'title' => '栏目', 'parameter' =>
                        $this->infoClassModel->getInfoListClass(3), 'extra' => 'required'
                    ])
                    ->addFormItem(['name' => 'title', 'type' => 'text', 'title' => '文章标题', 'extra' => 'required'])
                    ->addFormItem(['name' => 'style', 'type' => 'checkbox', 'title' => '属性', 'parameter' =>
                        $this->infoStyleModel->getAll()
                    ])
                    ->addFormItem(['name' => 'source', 'type' => 'text', 'title' => '文章来源', 'extra' => 'required'])
                    ->addFormItem(['name' => 'author', 'type' => 'text', 'title' => '作者', 'extra' => 'required'])
                    ->addFormItem(['name' => 'linkurl', 'type' => 'text', 'title' => '跳转链接'])
                    ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'title' => '关键字'])
                    ->addFormItem(['name' => 'description', 'type' => 'textarea', 'title' => '摘要'])
                    ->addFormItem(['name' => "content", 'type' => 'ueditor', 'title' => '详细内容', 'append' => [
                        'style' => 'height:300px'
                    ], 'extra' => 'required'])
                    ->addFormItem(['name' => 'click', 'type' => 'text', 'title' => '点击次数', 'value' => 0])
                    ->addFormItem(['name' => 'sort', 'type' => 'text', 'title' => '排序', 'value' => 9999])
                    ->addFormItem(['name' => 'check', 'type' => 'radio', 'title' => '审核', 'parameter' => [
                        0 => '是',
                        1 => '否'
                    ]]);

                $builder->display();
            }


        }

        public function edit(Request $request)
        {

            if ($request->isMethod('post')) {

                $data = $request->all();

                unset($data['redirect']);

                $data['style'] = implode(',', $data['style']);

                $output = $this->infoListModel->update($data, $data['id']);

                if ($output) {
                    return response()->json(['message' => '更新成功', 'code' => 200]);
                } else {
                    return response()->json(['message' => '更新失败', 'code' => 0]);
                }

            } else {


                $data = $this->infoListModel->_find($request->input('id'));

                $data['style'] = explode(',', $data['style']);

                $builder = Builder::forms();

                $builder->setFormUrl()
                    ->setSubWay('post');

                $builder
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('infoimg')])
                    ->addFormItem(['name' => 'id', 'type' => 'hidden', 'value' => $request->input('id')])
                    ->addFormItem(['name' => 'classId', 'type' => 'select', 'value' => $data['classId'], 'title' => '栏目', 'parameter' =>
                        $this->infoClassModel->getInfoListClass(3)
                    ])
                    ->addFormItem(['name' => 'title', 'type' => 'text', 'value' => $data['title'], 'title' => '文章标题'])
                    ->addFormItem(['name' => 'style', 'type' => 'checkbox', 'value' => $data['style'], 'title' => '属性', 'parameter' =>
                        $this->infoStyleModel->getAll()
                    ])
                    ->addFormItem(['name' => 'source', 'type' => 'text', 'value' => $data['source'], 'title' => '文章来源'])
                    ->addFormItem(['name' => 'author', 'type' => 'text', 'value' => $data['author'], 'title' => '作者'])
                    ->addFormItem(['name' => 'linkurl', 'type' => 'text', 'value' => $data['linkurl'], 'title' => '跳转链接'])
                    ->addFormItem(['name' => 'keywords', 'type' => 'tags', 'value' => $data['keywords'], 'title' => '关键字'])
                    ->addFormItem(['name' => 'description', 'type' => 'textarea', 'value' => $data['description'], 'title' => '摘要'])
                    ->addFormItem(['name' => "content", 'type' => 'ueditor', 'title' => '详细内容', 'value' => $data['content'], 'append' => [
                        'style' => 'height:300px'
                    ]])
                    ->addFormItem(['name' => 'click', 'type' => 'text', 'value' => $data['click'], 'title' => '点击次数'])
                    ->addFormItem(['name' => 'sort', 'type' => 'text', 'value' => $data['sort'], 'title' => '排序'])
                    ->addFormItem(['name' => 'check', 'type' => 'radio', 'value' => $data['check'], 'title' => '审核', 'parameter' => [
                        0 => '是',
                        1 => '否'
                    ]]);

                $builder->display();
            }
        }

        public function delete(Request $request)
        {
            $id = $request->input('id');

            $output = $this->infoListModel->destroy($id);

            if ($output) {
                return response()->json(['message' => '删除成功', 'code' => 200]);
            } else {
                return response()->json(['message' => '删除失败', 'code' => 0]);
            }
        }

        public function check(Request $request)
        {

            if ($request->isMethod('post')) {
                $output = $this->infoListModel->check($request->input('id'), $request->input('check'));

                if ($output) {
                    return response()->json(['message' => '更新成功', 'code' => 200]);
                } else {
                    return response()->json(['message' => '更新失败', 'code' => 0]);
                }
            } else {
                $data = $this->infoListModel->_find($request->input('id'));

                $builder = Builder::forms();
                $builder
                    ->setFormUrl()
                    ->setSubWay('post');
                $builder
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => UrlFunc::jumpUrl('infoimg')])
                    ->addFormItem(['name' => 'id', 'type' => 'hidden', 'value' => $request->input('id')])
                    ->addFormItem(['name' => 'check', 'type' => 'radio', 'value' => $data['check'], 'title' => '审核', 'parameter' => [
                        0 => '是',
                        1 => '否'
                    ]]);
                $builder->display();
            }


        }

        public function destroy(Request $request)
        {

        }

    }
