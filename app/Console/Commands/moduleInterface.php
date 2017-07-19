<?php
    namespace App\Console\Commands;

    interface moduleInterface
    {
        public function createDir();

        public function createConfigDir();

        public function createControllerDir();

        public function createFuncDir();

        public function createLibararyDir();

        public function createModelDir();
    }