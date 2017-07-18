<?php
    namespace App\Module\Business;

    use Illuminate\Support\Facades\Route;

    class BusinessRoute
    {
        const MODULE_NAME = 'Business';

        public static function _init()
        {

            Route::group(
                [
                    'domain' => env('ADMIN_URL'),
                    'middleware' => 'Auth',
                    'prefix' => 'admin'
                ], function () {

                self::_console();

                Route::get('business/silde', self::MODULE_NAME . '\Controller\SildeController@index');
                Route::get('business/silde/add', self::MODULE_NAME . '\Controller\SildeController@add');
                Route::post('business/silde/upload', self::MODULE_NAME . '\Controller\SildeController@upload');
                Route::post('business/silde/create', self::MODULE_NAME . '\Controller\SildeController@create');

                Route::get('business/user', self::MODULE_NAME . '\Controller\UserController@index');
                Route::get('business/file', self::MODULE_NAME . '\Controller\FileController@index');
            });

        }

        /**
         * Business 控制台
         * @return void
         */
        public static function _console()
        {
            Route::get('business/index', self::MODULE_NAME . '\ConsoleController');
        }
    }