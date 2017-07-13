<?php
    namespace App\Module\Business;

    use App\Module\Business\BusinessRoute as Business;
    use Illuminate\Support\Facades\Storage;


    class System
    {
        const moduleName = "Business";

        /**
         * 初始化方法
         *
         * @return void
         */
        public static function _init()
        {
            self::route();

            self::func();

            self::config();
        }

        /**
         * 获取模块路由
         *
         * @return void
         */
        public static function route()
        {
            Business::_init();
        }

        /**
         * 加载自定义函数
         *
         * @return void
         */
        public static function func()
        {
            $fileTree = Storage::disk('module')->files(self::moduleName . '/Func');

            foreach ($fileTree as $value) {

                $funcDir = __DIR__ . ltrim($value, self::moduleName);

                require_once $funcDir;
            }
        }

        /**
         * 加载所有配置文件
         *
         * @return void
         */
        public static function config()
        {
            $configTree = Storage::disk('module')->files(self::moduleName . '/Config');

            foreach ($configTree as $value) {

                $configDir = __DIR__ . ltrim($value, self::moduleName);

                require_once $configDir;
            }
        }


    }