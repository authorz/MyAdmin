<?php
    namespace App\Module\Business;

    use Illuminate\Support\Facades\Storage;


    trait System
    {
        /**
         * 加载自定义函数
         *
         * @return void
         */
        public static function func()
        {
            $fileTree = Storage::disk('module')->files(self::MODULE_NAME . '/Func');

            foreach ($fileTree as $value) {

                $funcDir = __DIR__ . ltrim($value, self::MODULE_NAME);

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
            $configTree = Storage::disk('module')->files(self::MODULE_NAME . '/Config');

            foreach ($configTree as $value) {

                $configDir = __DIR__ . ltrim($value, self::MODULE_NAME);

                require_once $configDir;
            }
        }


    }