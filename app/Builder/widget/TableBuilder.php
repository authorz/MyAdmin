<?php
namespace App\Builder\widget;

use App\Builder\core\Table;
use Illuminate\Http\Request;

/**
 *
 * @describe Table 构建器
 *
 * @see class TableBuilder()
 * @author CrazyCodes <625566775@qq.com>
 * @copyright MyBuilder 2017/5/11
 * @version MyBuilder v1.0 Beta
 * @extends Table
 * @internal
 *      CrazyCodes <625566775@qq.com>
 *
 */
class TableBuilder extends Table
{

    # 搜索默认开启
    protected static $isSearch = FALSE;

    # 数据标示
    protected static $column = [];

    # 数据集
    protected static $listData;

    # 顶部按钮
    protected static $topBtn = [];

    # 右边按钮
    protected static $rightBtn = [];

    # 默认标示
    protected static $listKey = 'id';

    # 数据页数
    protected static $limit = 0;

    # 搜索表单
    protected static $fromData = [];

    protected static $page;

    protected static $nav;

    protected static $navPrefix;

    public function page($page)
    {
        self::$page = $page;

        return $this;
    }

    /**
     *
     * @describe 设置列表内容
     *
     * @access public
     * @see isSearch()
     * param $listData 数组列
     */
    public function addListData($listData)
    {
        if (is_array($listData)) {
            self::$listData = $listData;
        } else {
            throw new \Exception('please use an array type');
        }

        return $this;
    }

    /**
     *
     * @describe 添加列表分类
     *
     * @access public
     * @see addTableColumn()
     * param $name 列表名称
     *       $value 列表字段
     *       $type 列表类型
     *          default 默认样式
     *          date 转换日期
     *          url 链接格式
     *          btn 按钮操作
     *       $extend 扩展
     */
    public function addTableColumn($columnData)
    {
        if (is_array($columnData)) {
            self::$column[] = $columnData;
        } else {
            throw new \Exception('please use an array type');
        }

        return $this;
    }

    /**
     *
     * @describe 添加顶部按钮
     *
     * @access public
     * @see addTopButton()
     * param $name 按钮名称
     *       $value 按钮标示
     *       $url 链接地址
     *       $type url 直接跳转链接
     *             checkbox 点击将checkbox值传入
     */
    public function addTopButton($topBtnData)
    {
        if (is_array($topBtnData)) {
            self::$topBtn[] = $topBtnData;
        } else {
            throw new \Exception('please use an array type');
        }

        return $this;
    }

    /**
     *
     * @describe 添加右边操作菜单
     *
     * @access public
     * @see addRightButton()
     * param $name 按钮名称
     *       $value 按钮标示
     *       $url 链接地址
     *       $type true: ajax 访问
     *             false : 直接跳转
     *       $custom 参数
     *       $way 方式 GET OR POST
     */
    public function addRightButton($rightBtn)
    {
        if (is_array($rightBtn)) {
            self::$rightBtn[] = $rightBtn;
        } else {
            throw new \Exception('please use an array type');
        }

        return $this;
    }

    /**
     *
     * @describe 设置默认标示
     *
     * @access public
     * @see setTableDataListKey()
     *
     */
    public function setTableDataListKey($key)
    {
        self::$listKey = $key;

        return $this;
    }

    /**
     *
     * @describe 开启搜索
     *
     * @access public
     * @see isSearch()
     * @搜索默认关闭
     */
    public function openSearch()
    {
        self::$isSearch = TRUE;

        return $this;
    }

    /**
     *
     * @describe 设置数据页数
     *
     * @access public
     * @see setLimit()
     */
    public function setLimit($limit)
    {
        self::$limit = $limit;

        return $this;
    }

    /**
     *
     * @describe 生成form表单
     *
     * @access public
     * @see addFormItem()
     */
    public function addFormItem($output)
    {
        self::$fromData[] = $output;

        return $this;
    }

    public function setNav($nav, $navPrefix)
    {
        self::$nav = $nav;
        self::$navPrefix = $navPrefix;
    }

    /**
     *
     * @describe 模版渲染
     *
     * @access public
     * @see display()
     */
    public function display()
    {
        echo view('builder/table', [
            'topTitle' => self::$topTitle,
            'breadCrumbs' => self::$breadCrumbs,
            'topBtn' => self::$topBtn,
            'isSearch' => self::$isSearch,
            'column' => self::$column,
            'listData' => self::$listData,
            'listKey' => self::$listKey,
            'rightBtn' => self::$rightBtn,
            'isSearch' => self::$isSearch,
            'fromData' => self::$fromData,
            'nav' => self::$nav,
            'navPrefix' => self::$navPrefix,
            'page' => self::$page
        ]);
        #include BUILDER_DIR . '/view/TableView.php';
    }

}