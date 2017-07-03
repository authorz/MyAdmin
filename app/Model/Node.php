<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Mockery\CountValidator\Exception;

    class Node extends Model
    {
        protected $table = 'node';

        public $primaryKey = 'Id';

        public $timestamps = false;

        private $formatTree;

        /**
         * 获取所有节点
         * @author CrazyCodes
         */
        public function getAllNode($type)
        {
            if ($type == -1) {
                $allNode = self::get()->toArray();
            } else {
                if (empty($_GET['Module'])) {
                    $_GET['Module'] = 1;
                }
                $allNode = self::where('Module', $_GET['Module'])->get()->toArray();
            }

            $this->toFormatTree($allNode, $title = 'NodeName', $pk = 'Id', $pid = 'Pid');

            return $this->formatTree;
        }

        /**
         * 用于builder select控件展示
         * @author CrazyCodes
         */
        public function selectNode()
        {
            $data = [];

            $nodeData = $this->getAllNode();

            $data[0] = '一级节点';

            foreach ($nodeData as $key => $value) {
                $data[$value['Id']] = $value['title_show'];
            }

            return $data;
        }

        /**
         * 删除节点
         * @author CrazyCodes
         */
        public function deleteNode($nodeId)
        {
            $state = self::where('Id', $nodeId)->delete();

            return $state;
        }

        /**
         * 禁用节点
         * @author CrazyCodes
         */
        public function disableNode($nodeId)
        {
            $state = self::where('Id', $nodeId)->update(['State' => 1]);

            return $state;
        }

        /**
         * 启用节点
         * @author CrazyCodes
         */
        public function enableNode($nodeId)
        {
            $state = self::where('Id', $nodeId)->update(['State' => 0]);

            return $state;
        }

        /**
         * 获取单个节点内容
         * @author CrazyCodes
         */
        public function getNode($nodeId)
        {
            $result = self::where('Id', $nodeId)->first()->toArray();

            if (!$result) {
                throw new Exception('节点不存在');
            }

            return $result;
        }


        public function updateNode($nodeId)
        {

        }

        /**
         * 查找最上级节点ID,用于打开一级节点菜单 class = open
         * @author CrazyCodes
         */
        public function getParentNode($id = 0, $title = 'Id')
        {
            global $parentId;

            $data = self::where($title, $id)->first();

            if ($data->Pid) {
                $this->getParentNode($data->Pid);
            } else {
                $parentId = $data->Id;
            }

            return $parentId;
        }

        /**
         * 获取面包屑列表
         * @author CrazyCodes
         */
        public function getTreeNodeCrumb($id = 0, $title = 'Id')
        {
            global $tree;

            $data = self::where($title, $id)->first();

            if ($data->Pid) {
                $this->getTreeNodeCrumb($data->Pid);
                $tree[] = $data;
            } else {
                $tree[] = $data;
            }

            return $tree;
        }

        /**
         * 将格式数组转换为基于标题的树（实际还是列表，只是通过在相应字段加前缀实现类似树状结构）
         *
         * @param array   $list
         * @param integer $level 进行递归时传递用的参数
         */
        private function _toFormatTree($list, $level = 0, $title = 'NodeName')
        {
            foreach ($list as $key => $val) {
                $title_prefix = str_repeat("&nbsp;", $level * 4);
                $title_prefix .= "┝ ";
                $val['level'] = $level;
                $val['title_prefix'] = $level == 0 ? '' : $title_prefix;
                $val['title_show'] = $level == 0 ? $val[$title] : $title_prefix . $val[$title];
                if (!array_key_exists('_child', $val)) {
                    array_push($this->formatTree, $val);
                } else {
                    $child = $val['_child'];
                    unset($val['_child']);
                    array_push($this->formatTree, $val);
                    $this->_toFormatTree($child, $level + 1, $title); //进行下一层递归
                }
            }
            return;
        }

        /**
         * 将格式数组转换为树
         *
         * @param array   $list
         * @param integer $level 进行递归时传递用的参数
         */
        public function toFormatTree($list, $title = 'title', $pk = 'id', $pid = 'pid', $root = 0, $strict = true)
        {

            $list = $this->list_to_tree($list, $pk, $pid, '_child', $root, $strict);

            $this->formatTree = array();
            $this->_toFormatTree($list, 0, $title);

            return $this->formatTree;
        }

        /**
         * 将数据集转换成Tree（真正的Tree结构）
         *
         * @param array  $list   要转换的数据集
         * @param string $pk     ID标记字段
         * @param string $pid    parent标记字段
         * @param string $child  子代key名称
         * @param string $root   返回的根节点ID
         * @param string $strict 默认严格模式
         *
         * @return array
         */
        public function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $strict = true)
        {

            // 创建Tree
            $tree = array();
            if (is_array($list)) {
                // 创建基于主键的数组引用
                $refer = array();
                foreach ($list as $key => $data) {
                    $refer[$data[$pk]] =& $list[$key];
                }

                foreach ($list as $key => $data) {
                    // 判断是否存在parent
                    $parent_id = $data[$pid];

                    if ($parent_id === null || $root == $parent_id) {
                        $tree[] =& $list[$key];
                    } else {
                        if (isset($refer[$parent_id])) {
                            $parent =& $refer[$parent_id];
                            $parent[$child][] =& $list[$key];
                        } else {
                            if ($strict === false) {
                                $tree[] =& $list[$key];
                            }
                        }
                    }
                }

            }
            return $tree;
        }

        /**
         * 将list_to_tree的树还原成列表
         *
         * @param    array  $tree  原来的树
         * @param    string $child 孩子节点的键
         * @param    string $order 排序显示的键，一般是主键 升序排列
         * @param    array  $list  过渡用的中间数组，
         *
         * @return array 返回排过序的列表数组
         */
        public function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
        {
            if (is_array($tree)) {
                foreach ($tree as $key => $value) {
                    $reffer = $value;
                    if (isset($reffer[$child])) {
                        unset($reffer[$child]);
                        $this->tree_to_list($value[$child], $child, $order, $list);
                    }
                    $list[] = $reffer;
                }
                $list = $this->list_sort_by($list, $order, $sortby = 'asc');
            }
            return $list;
        }

        /**
         * 对查询结果集进行排序
         * @access public
         *
         * @param array  $list   查询结果
         * @param string $field  排序的字段名
         * @param array  $sortby 排序类型 asc正向排序 desc逆向排序 nat自然排序
         *
         * @return array
         */
        public function list_sort_by($list, $field, $sortby = 'asc')
        {
            if (is_array($list)) {
                $refer = $resultSet = array();
                foreach ($list as $i => $data)
                    $refer[$i] = &$data[$field];
                switch ($sortby) {
                    case 'asc': // 正向排序
                        asort($refer);
                        break;
                    case 'desc':// 逆向排序
                        arsort($refer);
                        break;
                    case 'nat': // 自然排序
                        natcasesort($refer);
                        break;
                }
                foreach ($refer as $key => $val)
                    $resultSet[] = &$list[$key];
                return $resultSet;
            }
            return false;
        }

        /**
         * 在数据列表中搜索
         * @access public
         *
         * @param array $list      数据列表
         * @param mixed $condition 查询条件
         *                         支持 array('name'=>$value) 或者 name=$value
         *
         * @return array
         */
        function list_search($list, $condition)
        {
            if (is_string($condition))
                parse_str($condition, $condition);
            //返回的结果集合
            $resultSet = array();
            foreach ($list as $key => $data) {
                $find = false;
                foreach ($condition as $field => $value) {
                    if (isset($data[$field])) {
                        if (0 === strpos($value, '/')) {
                            $find = preg_match($value, $data[$field]);
                        } elseif ($data[$field] == $value) {
                            $find = true;
                        }
                    }
                }
                if ($find) {
                    $resultSet[] = &$list[$key];
                }
            }
            return $resultSet;
        }

    }
