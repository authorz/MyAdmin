<?php
    namespace App\Libarary;

    interface ModuleProviderInterface
    {
        /**
         * @desc 初始化
         */
        public function init();

        /**
         * @desc 注册模块 migration
         */
        public function registerMigrations();

        /**
         * @desc 注册模板目录
         */
        public function registerViews();

        /**
         * @desc 注册多语言目录
         */
        public function registerTranslations();

        /**
         * @desc 注册路由目录
         */
        public function registerRoutes();
    }