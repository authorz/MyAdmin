<?php
    namespace App\Module\TestC;

    use Illuminate\Support\Facades\Route;

    class TestCRoute
    {
        use System;

        const MODULE_NAME = 'TestC';

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

                Route::get('testc/example', self::MODULE_NAME . '\Controller\ExampleController');

            });

        }

        /**
         * TestC 控制台
         * @return void
         */
        public static function _console()
        {
            Route::get('testc/index', self::MODULE_NAME . '\ConsoleController');
        }
    }