<?php
namespace App\Builder;

class Config
{
    public $config;

    public $tableConfig;

    public function __construct($config = NULL)
    {
        if (isset($config)) {
            $this->config = $config;
        } else {
            $this->defaultConfig();
        }
    }

    protected function defaultConfig()
    {

        $this->config = [
            'js' => [
                '/asstes/js/vendor/modernizr-3.3.1.min.js',
                '/asstes/js/vendor/jquery-2.2.4.min.js',
                '/asstes/js/plugins.js',
                '/asstes/js/app.js',
                '/asstes/js/pages/formsComponents.js',
                '/asstes/js/plugins/ckeditor/ckeditor.js',
                '/asstes/js/vendor/bootstrap.min.js',
                '/asstes/js/pages/uiTables.js',
                '/plugin/toast/src/jquery.toast.js',
                // ueditor
                '/plugin/ueditor/ueditor.config.js',
                '/plugin/ueditor/ueditor.all.min.js',
                '/plugin/ueditor/lang/zh-cn/zh-cn.js',
                // file input

                '/plugin/fileinput/js/plugins/canvas-to-blob.min.js',
                '/plugin/fileinput/js/plugins/sortable.min.js',
                '/plugin/fileinput/js/plugins/purify.min.js',
                '/plugin/fileinput/js/fileinput.min.js',
                '/plugin/fileinput/themes/explorer/theme.js',
                '/plugin/fileinput/js/locales/zh.js',

            ],
            'css' => [
                'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
                '/asstes/css/plugins.css',
                '/asstes/css/main.css',
                '/asstes/css/themes.css',
                '/plugin/toast/src/jquery.toast.css',
                '/plugin/fileinput/css/fileinput.css',
                '/plugin/fileinput/themes/explorer/theme.css',
            ]
        ];

        $this->tableConfig = [
            'js' => [

            ],
            'css' => [

            ]
        ];
    }
}