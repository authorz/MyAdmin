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
         * Create a new command instance.
         *
         * @return void
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
            $name = $this->ask('请输入');

            $this->moduleLib->createDir($this->argument('moduleName'));
        }
    }
