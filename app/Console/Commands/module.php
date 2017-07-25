<?php

    namespace App\Console\Commands;

    use App\Libarary\CreateModule;
    use App\Libarary\Module\ListCommend;
    use App\Libarary\Module\UnInstallCommend;
    use Illuminate\Console\Command;


    class module extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'make:module {moduleName} {--build} {--install} {--zip} {--uninstall} {--check}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Create a new Module For MyAdmin';

        /**
         * 依赖注入模块创建类
         *
         * @var stdClass
         */
        protected $moduleLib;

        /**
         * 模块简介
         *
         * @var string
         */
        protected $introduction;

        /**
         * 模块作者
         *
         * @var string
         */
        protected $author;

        /**
         * 模块版本号
         *
         * @var string
         */
        protected $version;

        /**
         * module constructor.
         *
         * @param CreateModule $createModule
         */
        public function __construct(
            CreateModule $createModule
        )
        {
            $this->moduleLib = $createModule;

            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            $this->_options();

            $isThisModule = $this->confirm('Is creating module is `' . $this->argument('moduleName') . '` ?  y/n');

            isset($isThisModule) ? $this->askAll() : $this->line('bye!');
        }

        /**
         * @summary 提示输入简介
         */
        protected function askIntroduction()
        {
            $this->introduction = $this->ask('Please enter the module introduction');

        }

        /**
         * @summary 提示输入作者
         */
        protected function askAuthor()
        {
            $this->author = $this->ask('Please enter the module author');
        }

        /**
         * @summary 提示输入版本号
         */
        protected function askVersion()
        {
            $this->version = $this->ask('Please enter the module version');
        }


        /**
         * @summary 提示入口
         */
        private function askAll()
        {
            /**
             * 获取模块创建信息
             */
            $this->askIntroduction();
            $this->askAuthor();
            $this->askVersion();

            /**
             * 初始化模块类
             */
            $this->moduleLib->moduleName = $this->argument('moduleName');
            $this->moduleLib->config = [
                'name' => &$this->moduleLib->moduleName,
                'title' => $this->introduction,
                'author' => $this->author,
                'version' => $this->version,
                'description' => '',
                'icon' => ''
            ];

            /**
             * 创建模块需要的目录
             */
            $this->moduleLib->createDir();
            $this->moduleLib->createConfigDir();
            $this->moduleLib->createControllerDir();
            $this->moduleLib->createFuncDir();
            $this->moduleLib->createLibararyDir();
            $this->moduleLib->createModelDir();

            /**
             * 创建核心配置文件
             */
            $this->moduleLib->touchModuleFile();

            /**
             * 创建一个demo文件
             */
            $this->moduleLib->createExampleFile();

            /**
             * 模块信息添加到数据库
             */
            \App\Model\Module::create([
                'name' => &$this->moduleLib->moduleName,
                'title' => $this->introduction,
                'author' => $this->author,
                'version' => $this->version,
                'description' => '',
                'icon' => ''
            ]);

            $this->line('Y(^_^)Y create successly');

        }

        public function _options()
        {
            // 检查模块是否正常运行
            $check = $this->option('check');
            // 重新构建模块,修复错误
            $build = $this->option('build');
            // 安装模块
            $install = $this->option('install');
            // 卸载模块 - 自动打包
            $uninstall = $this->option('uninstall');
            // 打包模块
            $zip = $this->option('zip');

            if ($install && $uninstall) {
                $this->line('Install and uninstall cannot be used at the same time');
            }

            if ($uninstall) {
                UnInstallCommend::getModuleDataToDb($this->argument('moduleName'));
            }


        }

    }
