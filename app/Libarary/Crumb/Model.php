<?php
    namespace App\Libarary\Crumb;

    use Illuminate\Support\Facades\DB;

    /**
     * Class Model
     * @desc    后台面包屑功能核心模型
     * @package App\Libarary\Crumb
     */
    class Model extends \Illuminate\Database\Eloquent\Model
    {
        /**
         * @param $moduleName
         *
         * @desc 获取模块ID
         * @return mixed
         */
        public function getModuleId($moduleName)
        {
            return DB::table('module')
                ->select('Id')
                ->where('ModuleName', '=', $moduleName)
                ->first()
                ->Id;
        }

        /**
         * @param $funcUrl
         *
         * @desc　通过节点地址获取父Id
         * @return mixed
         */
        public function getFuncPid($funcUrl)
        {
            return DB::table('node')
                ->select('Pid')
                ->where('Href', '=', $funcUrl)
                ->first()
                ->Pid;
        }

        /**
         * @param $funcUrl
         *
         * @desc 通过节点地址获取当前节点信息
         * @return mixed
         */
        public function getFuncData($funcUrl)
        {
            return DB::table('node')
                ->select('NodeName', 'Href')
                ->where('Href', '=', $funcUrl)
                ->first();
        }


        /**
         * @param int    $id
         * @param string $title
         *
         * @desc　通过父节点递归查找所有的父级
         * @return array
         */
        public function getTreeNodeCrumb($id = 0, $title = 'Id')
        {
            global $tree;

            $data = DB::table('node')
                ->where($title, '=', $id)
                ->first();

            if ($data->Pid) {
                $this->getTreeNodeCrumb($data->Pid);
                $tree[] = $data;
            } else {
                $tree[] = $data;
            }

            return $tree;
        }
    }