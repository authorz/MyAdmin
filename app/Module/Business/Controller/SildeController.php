<?php
    /**
     * Created by PhpStorm.
     * User: crazy
     * Date: 2017/7/3
     * Time: 18:31
     */
    namespace App\Module\Business\Controller;

    use App\Http\Controllers\Controller;

    use App\Builder;
    use App\Libarary\UrlFunc;
    use Qiniu\Auth;
    use Qiniu\Storage\UploadManager;
    use Symfony\Component\HttpFoundation\Request;

    class SildeController extends Controller
    {
        public function index()
        {
            $builder = Builder\Builder::tables();


            $builder->setTableDataListKey('ID');

            $builder
                ->addTopButton(['name' => '新增', 'value' => 'add', 'url' => UrlFunc::jumpUrl('silde/add'), 'type' => 'url'])
                ->addTopButton(['name' => '启用', 'value' => 'enable', 'url' => '/admin/node/enable', 'type' => 'checkbox'])
                ->addTopButton(['name' => '禁用', 'value' => 'disable', 'url' => '/admin/node/disable', 'type' => 'checkbox'])
                ->addTopButton(['name' => '删除', 'value' => 'delete', 'url' => '/admin/node/delete', 'type' => 'checkbox']);


            $builder
                ->addTableColumn(['name' => 'Id', 'value' => 'ID', 'type' => 'default'])
                ->addTableColumn(['name' => '角色名称', 'value' => 'Title', 'type' => 'default'])
                ->addTableColumn(['name' => '角色描述', 'value' => 'Description', 'type' => 'default'])
                ->addTableColumn(['name' => '操作', 'type' => 'btn']);

            $builder->addListData([]);

            $builder
                ->addRightButton(['class' => 'btn-success', 'name' => '编辑', 'value' => 'update', 'type' => FALSE, 'url' => '/admin/system/role/update', 'custom' => ['ID'], 'way' => 'get'])
                ->addRightButton(['class' => 'btn-info', 'name' => '启用', 'value' => 'enable', 'type' => TRUE, 'url' => '/admin/node/enable', 'custom' => ['Id'], 'way' => 'post'])
                ->addRightButton(['class' => 'btn-danger', 'name' => '禁用', 'value' => 'disable', 'type' => TRUE, 'url' => '/admin/node/disable', 'custom' => ['Id'], 'way' => 'post'])
                ->addRightButton(['class' => 'btn-primary', 'name' => '删除', 'value' => 'delete', 'type' => TRUE, 'url' => '/admin/node/delete', 'custom' => ['Id'], 'way' => 'post']);

            $builder->display();
        }

        public function add()
        {
            $form = Builder\Builder::forms();

            $view = function (array $data) use ($form) {

                $form
                    ->setSubWay('post')
                    ->upload(['upload_url' => UrlFunc::jumpUrl('silde/upload')])
                    ->setFormUrl(UrlFunc::jumpUrl('silde/create'));

                $form
                    ->addFormItem(['name' => 'redirect', 'type' => 'hidden', 'value' => ''])
                    ->addFormItem(['name' => 'name', 'type' => 'text', 'title' => '图片标题'])
                    ->addFormItem(['name' => "img", 'type' => 'upload', 'title' => '封面图']);

                return $form;

            };

            $view([])->display();
        }

        public function create(Request $request)
        {
            dd($request->input());
        }

        public function upload()
        {
            $accessKey = '3hc8F6ipBY-nYcU1YZTP0ZxCeRfanYRWoqY16B0e';
            $secretKey = 'xT73ny3MiY3HPlzMs0Nm_5ba2g_h1zG4aZU97_3R';
            // 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
            // 要上传的空间
            $bucket = 'myadmin';
            // 生成上传 Token
            $token = $auth->uploadToken($bucket);

            // 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new UploadManager();

            $key = 'group_cover_' . date('Ymdhis') . rand(1, 10000) . '.png';

            $path = $_FILES['img']['tmp_name'];

            $fp = fopen($path, "r");

            $file = fread($fp, $_FILES['img']['size']);

            list($ret, $err) = $uploadMgr->put($token, $key, $file);;

            echo json_encode(['key' => $ret['key']]);
        }
    }