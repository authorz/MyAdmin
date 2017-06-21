<?php
    namespace App\Libarary;

    use Illuminate\Support\Facades\Storage;

    /**
     * Class CreateModule
     * @package App\Libarary
     */
    class CreateModule
    {
        public function _init()
        {

        }

        public function createDir($moduleName)
        {
            $moduleExists = Storage::disk('module')->exists($moduleName);

            if ($moduleExists) {
                die('╯﹏╰ ' . $moduleName . ' module already exists');
            } else {
                Storage::disk('module')->makeDirectory($moduleName);
                die('Y(^_^)Y create successly');
            }
        }
    }