<?php
    namespace App\Libarary\Crumb;

    use App\Libarary\Inter\CrumbInterface;
    use Illuminate\Http\Request;

    class CrumbBasic implements CrumbInterface
    {
        /**
         * @const array
         */
        const noAuthUrl = [
            '/'
        ];

        /**
         * @var Request
         */
        protected $request;

        /**
         * @var Model
         */
        private $model;

        /**
         * @var array
         */
        public $pathArr;

        /**
         * @var string
         */
        public $moduleName;

        /**
         * @var integer
         */
        public $funcPid;

        /**
         * @var array
         */
        public $funcTree;


        /**
         * CrumbBasic constructor.
         *
         * @param Request $request
         * @param Model   $model
         */
        public function __construct(
            Request $request,
            Model $model
        )
        {
            $this->request = $request;
            $this->model = $model;
        }

        /**
         * @desc 忽略的路径
         * @return bool
         */
        public function noAuth()
        {
            return in_array($this->request->path(), self::noAuthUrl);
        }

        /**
         * @desc 初始化方法
         * @return bool
         */
        public function init()
        {
            if ($this->noAuth()) {
                return false;
            }

            if (!$this->getModuleId()) {
                return false;
            }

            if (!$this->getFuncForPid()) {
                return false;
            }


            return $this->index();
        }

        /**
         * @desc 面包屑链接组
         * @return array
         */
        public function index()
        {
            return array_merge([
                [
                    'url' => '/admin/' . $this->moduleName . '/index',
                    'name' => '系统'
                ],
                [
                    'url' => '/admin/' . $this->moduleName . '/index',
                    'name' => '控制台'
                ]
            ], $this->funcTree);
        }

        /**
         * @desc 获取模块id
         * @return bool|mixed
         */
        public function getModuleId()
        {
            $this->cuttingPath($this->request->path());

            if ($this->pathArr == NULL) {
                return false;
            }

            $this->moduleName = array_slice($this->pathArr, 1, 1)[0];

            $moduleId = $this->model->getModuleId($this->moduleName);

            if ($moduleId) {
                return $moduleId;
            } else {
                return false;
            }

        }

        /**
         * @desc 功能列表生成
         * @return bool
         */
        public function getFuncForPid()
        {
            $this->cuttingPath($this->request->path());

            unset($this->pathArr[0], $this->pathArr[1]);

            $this->pathArr = implode('/', $this->pathArr);

            $funcPid = $this->model->getFuncPid($this->pathArr);


            if (!$funcPid) {
                return false;
            }

            $funcTree = $this->model->getTreeNodeCrumb($funcPid);


            foreach ($funcTree as $key => $value) {
                $this->funcTree[] = ['url' => 'javascript:;', 'name' => $value->NodeName];
            }


            $anFunc = $this->model->getFuncData($this->pathArr);

            $this->funcTree[] = ['url' => 'javascript:;', 'name' => $anFunc->NodeName];

            return true;

        }


        /**
         * @param string $path
         *
         * @desc 切割路径,获取节点地址
         * @return array
         */
        private function cuttingPath(string $path)
        {
            $this->pathArr = explode('/', $path);

            if (count($this->pathArr) < 3) {

                unset($this->pathArr);
                $this->pathArr = NULL;

                return false;
            }

            return $this->pathArr;
        }

    }