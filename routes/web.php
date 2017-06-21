<?php

Route::group(['domain' => 'site.myadmin.com'], function () {
    Route::get('/', function () {
        return '1111';
    });
});