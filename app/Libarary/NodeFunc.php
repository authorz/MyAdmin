<?php
    namespace App\Libarary;

    use Illuminate\Http\Request;

    class NodeFunc
    {
        /**
         * NodeFunc constructor.
         */
        public function __construct()
        {

        }

        /**
         * @param $path
         *
         * @return array|string
         */
        public static function url(string $path)
        {
            $param = explode('/', $path);

            unset($param[0], $param[1]);

            $url = implode('/', array_merge($param));

            return $url;
        }

        /**
         * @param int $moduleId
         *
         * @return int
         */
        public static function moduleId(int $moduleId = 0) : int
        {
            return $moduleId;
        }

        /**
         * @param string $path
         *
         * @return string
         */
        public static function moduleName(string $path) : string
        {
            #preg_match_all('/[\/*.]+/', $path, $match);

            $url = explode('/', $path);

            $path = array_slice($url, 1, 1);

            return $path[0];
        }

        /**
         * @param        $list
         * @param string $pk
         * @param string $pid
         * @param string $child
         * @param int    $root
         *
         * @return array
         */
        public static function node($list, $pk = 'Id', $pid = 'Pid', $child = "children", $root = 0) : array
        {
            $tree = [];

            foreach ($list as $key => $value) {

                if ($value[$pid] == $root) {

                    unset($list[$key]);

                    if (!empty($list)) {

                        $child = self::node($list, $pk, $pid, $child, $value[$pk]);

                        if (!empty($child)) {
                            $value['children'] = $child;
                        }
                    }

                    $tree[] = $value;

                }

            }
            return $tree;

        }
    }