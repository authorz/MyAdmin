<?php
    namespace App\Module\<{{moduleName}}>;

    use Illuminate\Support\Facades\Route;

    class <{{moduleName}}>Route
    {
        use System;

        const MODULE_NAME = '<{{moduleName}}>';

        public static function _init()
        {

            self::func();

            self::config();

            Route::group(
                [
                    'domain' => env('ADMIN_URL'),
                    'middleware' => 'Auth',
                    'prefix' => 'admin'
                ], function () {

                self::_console();

                Route::get('<{{modules}}>/example', self::MODULE_NAME . '\Controller\ExampleController');

            });

        }

        /**
         * <{{moduleName}}> 控制台
         * @return void
         */
        public static function _console()
        {
            Route::get('<{{modules}}>/index', self::MODULE_NAME . '\ConsoleController');
        }
    }