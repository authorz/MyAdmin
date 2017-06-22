<?php
    Route::group(['domain' => env('ADMIN_URL')], function () {
        # 登录页面
        Route::get('/', 'LoginController@index')->name('login');

        Route::group(['namespace' => 'Auth'], function () {
            # 退出
            Route::get('/logout', 'LogoutController');
            # 验证登录
            Route::post('/auth/login', 'LoginController@validation');
        });

        # 未通过Auth 权限认证
        Route::get('/auth/error', 'Error\NoAuthController');

        # 后台管理
        Route::group(['middleware' => 'Auth', 'prefix' => 'admin'], function () {

            # 首页
            Route::get('index', 'IndexController')->name('index');

            # 修改邮箱
            Route::post('modifyEmail', 'Action\UserController@modifyEmail');

            # 获取邮箱
            Route::get('getEmail', 'Action\UserController@getEmail');

            # 修改密码
            Route::post('modifyPass', 'Action\UserController@modifyPass');

            # 登录日志
            Route::get('loginlog', 'LoginLogController@index');

            # 节点管理
            Route::get('node', 'NodeController@index')->name('node');
            Route::any('node/add', 'NodeController@add')->name('node.add');
            Route::any('node/update', 'NodeController@update')->name('node.update');
            Route::post('node/delete', 'NodeController@delete')->name('node.delete');
            Route::post('node/enable', 'NodeController@enable')->name('node.enable');
            Route::post('node/disable', 'NodeController@disable')->name('node.disable');

            #用户管理
            Route::get('user', 'UserController@index');
            Route::any('user/add', 'UserController@add');
            Route::any('user/bind', 'UserController@bind');
            Route::post('user/isadd', 'UserController@isAdd');
            Route::any('user/update', 'UserController@update');
            Route::post('user/delete', 'UserController@delete');
            Route::post('user/enable', 'UserController@enable');
            Route::post('user/disable', 'UserController@disable');

            #网站信息配置
            Route::get('website', 'WebSiteController@index');
            Route::post('website/store', 'WebSiteController@store');

            #角色管理
            Route::get('role', 'RoleController@index');
            Route::any('role/add', 'RoleController@add');
            Route::any('role/update', 'RoleController@update');

            #数据库管理
            Route::any('dblist', 'DbListController@index');
            Route::post('dblist/backup', 'DbList\BackupController');
            Route::post('dblist/del', 'DbList\DelBackUpController');
            Route::post('dblist/repair', 'DbList\TableWieldController@repair');
            Route::post('dblist/optimize', 'DbList\TableWieldController@optimize');
            Route::get('dblist/download', 'DbList\DownloadController');

            #栏目内容
            Route::get('infoclass/edit', 'InfoClassController@edit');
            Route::post('infoclass/update', 'InfoClassController@update');
            Route::post('infoclass/destroy', 'InfoClassController@destroy');
            Route::post('infoclass/enable', 'InfoClass\StateController@enable');
            Route::post('infoclass/disable', 'InfoClass\StateController@disable');
            Route::resource('infoclass', 'InfoClassController');

            #栏目分类
            Route::resource('maintype', 'MainTypeController');

            #单页信息
            Route::resource('info', 'InfoController');

            #自定义字段
            Route::get('diyfield/edit', 'DiyFieldController@edit');
            Route::post('diyfield/update', 'DiyFieldController@update');
            Route::post('diyfield/destroy', 'DiyFieldController@destroy');
            Route::resource('diyfield', 'DiyFieldController');
        });


    });
