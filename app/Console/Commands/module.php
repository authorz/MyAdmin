<?php

    namespace App\Console\Commands;

    use App\Libarary\CreateModule;
    use Illuminate\Console\Command;


    class module extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'create:module {moduleName}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Create Module For MyAdmin';

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
         * Create a new command instance.
         *
         * @return void
         *
         */
        public function __construct(CreateModule $createModule)
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
            $this->askIntroduction();
            $this->askAuthor();
            $this->askVersion();


            $result = $this->moduleLib->createDir($this->argument('moduleName'));

            $result == true ? $this->line('Y(^_^)Y create successly') : $this->line('create error');

            $result = $this->moduleLib->touchConfigJson($this->argument('moduleName'), [
                'name' => $this->argument('moduleName'),
                'title' => $this->introduction,
                'author' => $this->author,
                'version' => $this->version,
                'description' => '',
                'icon' => ''
            ]);

            $result == true ? $this->line('Y(^_^)Y create config successly') : $this->line('create error');

            \App\Model\Module::create([
                'name' => $this->argument('moduleName'),
                'title' => $this->introduction,
                'author' => $this->author,
                'version' => $this->version,
                'description' => '',
                'icon' => ''
            ]);

        }


    }
