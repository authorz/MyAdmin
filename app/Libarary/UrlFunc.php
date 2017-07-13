<?php
    namespace App\Libarary;

    use Illuminate\Http\Request;

    class UrlFunc
    {

        public function __construct()
        {

        }

        /**
         * @param string $url
         * @param array  $param
         *
         * @summary 生成URL
         * @return string
         */
        public static function jumpUrl(string $url, array $param = []) : string
        {
            $url = function () use ($url) : string {

                $moduleUrl  = '';

                $requestUrl = $_SERVER['REQUEST_URI'];

                $param      = explode('/', $requestUrl);

                unset($param[0]);

                foreach ($param as $key => $value) {

                    if ($key < 3) {
                        $moduleUrl .= ('/' . $value);
                    }

                    continue;
                }

                return $moduleUrl . '/' . $url;

            };


            if (count($param) == 0) {
                return $url();
            } else {
                $parameter = '';

                foreach ($param as $key => $value) {
                    $parameter .= ($key . '=' . $value . '&');
                }

                $parameter = rtrim($parameter,'&');

                return $url() . '?' . $parameter;
            }

        }
    }