# MyAdmin
MyAdmin是一款基于Laravel 5.4开发的后台管理系统，系统采用模块式开发、安装，并内置MyBuilder构建器，让开发人员能把更多时间放在业务方面。进一步提升了开发质量和时间。

* 移植 - MyAdmin 支持其他后台管理系统的完美移植到本系统上。
* 安装 - 依赖Laravel内置功能，安装简易
* 模块 - 模块化开发，可随时卸载安装，代码解耦合
* 构建 - MyAdmin内置了强大的构建器，几行代码既完成一个管理业务
* 版本 - MyAdmin向下兼容至PHP7.0，低于PHP7.0无法使用

# 安装

### 数据库
复制一份 .env.example 并重命名为 .env
```shell
mv ./.env.example .env
```
数据库配置文件 /.env

```
DB_CONNECTION=mysql  //数据库引擎
DB_HOST=127.0.0.1    //数据库地址
DB_PORT=3306         //数据库端口
DB_DATABASE=myadmin  //库名称
DB_USERNAME=root     //用户名（生产环境中避免使用root用户）
DB_PASSWORD=root  //密码
```

数据库详细配置见：https://docs.golaravel.com/docs/5.4/database/#configuration

### 组件安装
默认项目 vendor 不存在，请使用composer安装
```shell
composer install
```


### 目录
MyAdmin 基本保留Laravel原始目录结构

目录结构详细见：https://docs.golaravel.com/docs/5.4/structure/
# 模块
### 创建模块
使用命令 artisan 创建：
```shell
php artisan make:module <moduleName>
```
命令执行后回在YourApp\app\Module\目录下创建一个与 <moduleName>名称相同的目录
### 模块目录
```shell
|-- Config                    模块配置文件存放目录
|-- Controller                控制器模块
|-- Func                      自定义函数目录
|-- Libarary                  自定义类目录
|-- Model                     模型目录
|-- config.json               模块配置文件
|-- ConsoleController.php     模块首页控制器
|-- System.php                模块核心文件
|-- <ModuleName>Route.php     模块目录
```
### 命令详解
```shell
php artisan make:module <moduleName>

<moduleName>   必填参数 [模块名称]
--build        重新构建项目、修复错误
--install      安装模块
--zip          打包一个模块
--uninstall    卸载一个模块
--check        检查模块
```

```shell
php artisan moduleList  查看所有模块
```
### 加载
在文件 routes\module.php 添加模块依赖

```shell
App\Module\<moduleName>\<moduleName>Route::_init();
```

### 其他
* 模块显示 - 登录后顶部菜单内将会出现安装的模块
* 模块功能 - 在系统->网站管理->节点管理中添加功能
* 角色权限 - 使用的传统RBAC模式，需要在角色管理->编辑 操作


# MyBuilder PHP 构建器
使用手册：https://www.kancloud.cn/crazy/mybuilder/319170

### 在MyAdmin内使用
```php
<?php
    namespace App\Module\TestA\Controller;

    use App\Http\Controllers\Controller;

    use App\Builder;

    class ExampleController extends Controller
    {
        public function __invoke()
        {
            $builder = Builder\Builder::tables();

            $builder->display();
        }
    }
```


# 关于

CrazyCodes : 一位屌丝程序员的开源路

邮箱 : 919342864@qq.com

博客 : http://blog.fastrun.cn