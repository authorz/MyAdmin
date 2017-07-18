<?php
    namespace App\Module\Business\Controller;

    use App\Http\Controllers\Controller;
    use App\Builder;
    use App\Module\Business\Model\FileModel;
    use App\Libarary\UrlFunc;

    /**
     * Class FileController
     * @package App\Module\Business\Controller
     */
    class FileController extends Controller
    {
        /**
         * @var FileModel
         */
        protected $fileModel;

        /**
         * FileController constructor.
         *
         * @param FileModel $fileModel
         */
        public function __construct(
            FileModel $fileModel
        )
        {
            $this->fileModel = $fileModel;
        }

        /**
         * @throws \Exception
         */
        public function index()
        {

            $builder = Builder\Builder::tables();

            $builder
                ->setTableDataListKey('id')
                ->page($this->fileModel->fileList()->links())
                ->addListData(json_decode($this->fileModel->fileList()->toJson(), true)['data']);

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
                    ['name' => '作品地址', 'value' => 'filename', 'type' => 'default']
                );

            $builder
                ->addRightButton(
                    ['class' => 'btn-success', 'name' => '查看', 'value' => 'update', 'type' => FALSE, 'url' => UrlFunc::jumpUrl('file/show'), 'custom' => ['id'], 'way' => 'get']
                );

            $builder->display();
        }
    }