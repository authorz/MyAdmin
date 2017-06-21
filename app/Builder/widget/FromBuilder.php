<?php
namespace App\Builder\widget;

use App\Builder\core\From;

/**
 *
 * @describe From 构建器
 *
 * @see class FromBuilder()
 * @author CrazyCodes <625566775@qq.com>
 * @copyright MyBuilder 2017/4/10
 * @version MyBuilder v1.0 Beta
 * @internal
 *      CrazyCodes <625566775@qq.com>
 *
 */
class FromBuilder extends From
{

    protected static $receive;

    protected static $url;

    protected static $way;

    protected static $isAjax = TRUE;

    protected static $validation = FALSE;

    protected static $uploadConfig;

    protected static $nav;

    protected static $navPrefix;

    protected static $blockData;


    /**
     *
     * @describe 生成form表单
     *
     * @access public
     * @see addFormItem()
     */
    public function addFormItem($output)
    {
        self::$receive[] = $output;

        return $this;
    }


    /**
     *
     * @describe 设置提交的地址
     *
     * @access public
     * @see setFormUrl()
     */
    public function setFormUrl($url = '')
    {
        self::$url = $url;

        return $this;
    }

    /**
     *
     * @describe 设置提交方式 post get
     *
     * @access public
     * @see setSubWay()
     */
    public function setSubWay($way)
    {

        self::$way = $way;

        return $this;

    }

    /**
     *
     * @describe 是否开启ajax
     *
     * @access public
     * @see isAjax()
     */
    public function closeAjax()
    {
        self::$isAjax = FALSE;
    }

    /**
     *
     * @describe 是否开启验证
     *
     * @access public
     * @see openValidation()
     */
    public function openValidation()
    {
        self::$validation = TRUE;
    }

    public function upload($uploadConfig)
    {
        self::$uploadConfig = $uploadConfig;
    }

    public function setNav($nav, $navPrefix)
    {
        self::$nav = $nav;
        self::$navPrefix = $navPrefix;
    }

    public function block($data)
    {
        self::$blockData = $data;
    }


    /**
     *
     * @describe 渲染模板
     *
     * @access public
     * @see display()
     */
    public function display()
    {
        echo view('builder/form', [
            'url' => self::$url,
            'way' => self::$way,
            'isAjax' => self::$isAjax,
            'receive' => self::$receive,
            'uploadConfig' => self::$uploadConfig,
            'nav' => self::$nav,
            'navPrefix' => self::$navPrefix,
            'block' => self::$blockData
        ]);
    }
}