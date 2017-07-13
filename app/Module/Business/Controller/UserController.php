<?php
    namespace App\Module\Business\Controller;

    use App\Http\Controllers\Controller;
    use App\Builder;
    use App\Libarary\UrlFunc;
    use App\Module\Business\Model\FileModel;
    use App\Module\Business\Model\UserModel;

    /**
     * Class UserController
     * @package App\Module\Business\Controller
     */
    class UserController extends Controller
    {

        /**
         * @var UserModel
         */
        protected $userModel, $fileModel;

        /**
         * UserController constructor.
         *
         * @param UserModel $userModel
         * @param FileModel $fileModel
         */
        public function __construct(
            UserModel $userModel,
            FileModel $fileModel
        )
        {
            $this->userModel = $userModel;
            $this->fileModel = $fileModel;
        }

        /**
         * 用户列表
         * @throws \Exception
         */
        public function index()
        {

            $builder = Builder\Builder::tables();


            $builder
                ->setTableDataListKey('id')
                ->addListData($this->userModel->userList());

            $builder
                ->addTopButton(
                    ['name' => '启用', 'value' => 'enable', 'url' => UrlFunc::jumpUrl('user/enable'), 'type' => 'checkbox']
                )
                ->addTopButton(
                    ['name' => '禁用', 'value' => 'disable', 'url' => UrlFunc::jumpUrl('user/disable'), 'type' => 'checkbox']
                );

            $builder
                ->addTableColumn(
                    ['name' => 'Id', 'value' => 'id', 'type' => 'default']
                )
                ->addTableColumn(
                    ['name' => '第三方Id', 'value' => 'username', 'type' => 'default']
                )
                ->addTableColumn(
                    ['name' => '昵称', 'value' => 'nickname', 'type' => 'default']
                )
                ->addTableColumn(
                    ['name' => '邮箱', 'value' => 'email', 'type' => 'default']
                )
                ->addTableColumn(
                    ['name' => '操作', 'type' => 'btn']
                );

            $builder
                ->addRightButton(
                    ['class' => 'btn-success', 'name' => '查看', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('user/show'), 'custom' => ['id'], 'way' => 'get']
                );

            $builder->display();
        }


        /**
         *　显示用户详细资料
         */
        public function show()
        {

        }
    }