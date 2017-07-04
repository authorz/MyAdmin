<?php

    Route::group(['domain' => env('ADMIN_URL')], function () {
        // 需要验证写这里
        Route::group(['middleware' => 'Auth', 'prefix' => 'admin/{moduleName}'], function () {

            Route::get('silde', 'Business\SildeController@index');

        });
        // 不需要验证写这里

    });

