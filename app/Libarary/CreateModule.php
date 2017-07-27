<?php
    namespace App\Libarary;

    use App\Console\Commands\moduleInterface;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class CreateModule
     * @package App\Libarary
     */
    class CreateModule implements moduleInterface
    {

        public $moduleName;

        public $config;

        /**
         * @summary 创建模块目录
         */
        public function createDir()
        {
            $moduleExists = Storage::disk('module')->exists($this->moduleName);

            if ($moduleExists) {
                die('╯﹏╰ ' . $this->moduleName . ' module already exists');
            } else {
                $result = Storage::disk('module')->makeDirectory($this->moduleName);
                return $result;
            }
        }

        /**
         * @description 创建一个demo文件
         * @return $this
         */
        public function createExampleFile()
        {
            $exampleTpl = preg_replace('/<{{moduleName}}>/', $this->moduleName, Storage::disk('tpl')->get('ExampleController.ma'));

            Storage::disk('module')->put($this->moduleName . '/' . 'Controller/ExampleController.php', $exampleTpl);
        }

        /**
         * @description 生成核心模块文件
         * @return $this
         */
        public function touchModuleFile()
        {
            $routeTpl = preg_replace('/<{{moduleName}}>/', $this->moduleName, Storage::disk('tpl')->get('Route.ma'));
            $routeTpl = preg_replace('/<{{modules}}>/', strtolower($this->moduleName), $routeTpl);

            Storage::disk('module')->put($this->moduleName . '/' . $this->moduleName . 'Route.php', $routeTpl);

            $consoleTpl = preg_replace('/<{{moduleName}}>/', $this->moduleName, Storage::disk('tpl')->get('ConsoleController.ma'));

            Storage::disk('module')->put($this->moduleName . '/' . 'ConsoleController.php', $consoleTpl);

            $systemTpl = preg_replace('/<{{moduleName}}>/', $this->moduleName, Storage::disk('tpl')->get('System.ma'));

            Storage::disk('module')->put($this->moduleName . '/' . 'System.php', $systemTpl);

            $providerTpl = preg_replace('/<{{moduleName}}>/', $this->moduleName, Storage::disk('tpl')->get('ServiceProvider.ma'));

            Storage::disk('module')->put($this->moduleName . '/' . $this->moduleName . 'ServiceProvider.php', $providerTpl);


        }

        /**
         * @description 创建模块配置文件目录
         * @return $this
         */
        public function createConfigDir()
        {
            Storage::disk('module')->makeDirectory($this->moduleName . '/Config');
            Storage::disk('module')->put($this->moduleName . '/config.json', json_encode($this->config));

            return $this;
        }

        /**
         * @description 创建模块控制器目录
         * @return $this
         */
        public function createControllerDir()
        {
            Storage::disk('module')->makeDirectory($this->moduleName . '/Controller');

            return $this;
        }

        /**
         * @description 创建模块自定义函数目录
         * @return $this
         */
        public function createFuncDir()
        {
            Storage::disk('module')->makeDirectory($this->moduleName . '/Func');

            return $this;
        }

        /**
         * @description 创建模块自定义类目录
         * @return $this
         */
        public function createLibararyDir()
        {
            Storage::disk('module')->makeDirectory($this->moduleName . '/Libarary');

            return $this;
        }

        /**
         * @description 创建模块自定义模型目录
         * @return $this
         */
        public function createModelDir()
        {
            Storage::disk('module')->makeDirectory($this->moduleName . '/Model');

            return $this;
        }

    }