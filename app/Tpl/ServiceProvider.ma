<?php
    namespace App\Module\<{{moduleName}}>;

    use App\Libarary\ModuleProviderInterface as ModuleInter;
    use Illuminate\Support\ServiceProvider;

    class <{{moduleName}}>ServiceProvider extends ServiceProvider implements ModuleInter
    {
        public function boot()
        {
            $this->init();
        }

        /**
         * @desc 初始化
         */
        public function init()
        {
            $this->registerMigrations();

            $this->registerViews();

            $this->registerTranslations();

            $this->registerRoutes();
        }

        /**
         * @desc 注册模块 migration
         */
        public function registerMigrations()
        {
            $this->loadMigrationsFrom(__DIR__ . '/Config/Database/migrations');
        }

        /**
         * @desc 注册模板目录
         */
        public function registerViews()
        {
            $this->loadViewsFrom(__DIR__ . '/View', '<{{moduleName}}>');
        }

        /**
         * @desc 注册多语言目录
         */
        public function registerTranslations()
        {
            $this->loadTranslationsFrom(__DIR__ . '/Config/Lang', '<{{moduleName}}>');
        }

        /**
         * @desc 注册路由目录
         */
        public function registerRoutes()
        {
            $this->loadRoutesFrom(__DIR__ . '/Route.php');
        }
    }