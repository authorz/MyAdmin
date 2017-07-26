<?php
    namespace App\Libarary\Inter;

    interface CrumbInterface
    {
        public function noAuth();

        public function index();

        public function init();

        public function getModuleId();

        public function getFuncForPid();
    }