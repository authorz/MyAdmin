<?php
    namespace App\Libarary;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Storage;
    use KHerGe\JSON\JSON;

    /**
     * Class CreateModule
     * @package App\Libarary
     */
    class CreateModule
    {
        public function _init()
        {

        }

        /**
         * @param $moduleName
         *
         * @summary 创建模块目录
         */
        public function createDir($moduleName)
        {
            $moduleExists = Storage::disk('module')->exists($moduleName);

            if ($moduleExists) {
                die('╯﹏╰ ' . $moduleName . ' module already exists');
            } else {
                $result = Storage::disk('module')->makeDirectory($moduleName);
                return $result;
            }
        }

        /**
         * @param $moduleName
         *
         * @summary 创建配置文件
         * @return mixed
         */
        public function touchConfigJson($moduleName, $config)
        {
            $json = new JSON();

            $result = Storage::disk('module')->put($moduleName . '/config.json', $json->encode($config));

            $this->touchRouteFile($moduleName);

            return $result;
        }

        public function touchRouteFile($moduleName)
        {
            Storage::disk('module')->put($moduleName . '/' . $moduleName . 'Route.php',"<?php
    namespace App\\Module\\{$moduleName};

    use Illuminate\\Support\\Facades\\Route;

    class {$moduleName}Route
    {
        public static function _init()
        {

        }
    }
            ");
        }

    }