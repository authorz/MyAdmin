<?php
namespace App\Builder\synergia;
/**
 *
 * @describe Title 相关公共方法
 *
 * @see trait Title()
 * @author CrazyCodes <625566775@qq.com>
 * @copyright MyBuilder 2017/5/11
 * @version MyBuilder v1.0 Beta
 * @internal
 *      CrazyCodes <625566775@qq.com>
 *
 */
trait Title
{
    protected static $topTitle;

    protected static $breadCrumbs;

    protected static $title;

    /**
     *
     * @describe 设置顶部标题
     *
     * @access public
     * @see setTopTitle()
     */
    public function setTopTitle($topTitle)
    {
        if (isset($topTitle)) {
            self::$topTitle = htmlspecialchars($topTitle);
        } else {
            self::$topTitle = "默认标题";
        }

        return $this;
    }

    /**
     *
     * @describe 设置面包渣导航
     *
     * @access public
     * @see setBreadCrumbs()
     */
    public function setBreadCrumbs($breadCrumbs)
    {
        if (empty($breadCrumbs)) {
            self::$breadCrumbs = ['默认标签组1', '默认标签组2', '默认标签组3'];

            return $this;
        }

        if (is_array($breadCrumbs)) {
            self::$breadCrumbs = $breadCrumbs;
        } else {
            $stringBread = explode(',', $breadCrumbs);

            if (count($stringBread) == 1) {
                self::$breadCrumbs[] = $breadCrumbs;
            } else {
                self::$breadCrumbs = $stringBread;
            }
        }

        return $this;
    }

    /**
     *
     * @describe 设置标题
     *
     * @access public
     * @see setTitle()
     */
    public function setTitle($title)
    {
        if (isset($title)) {
            self::$title = htmlspecialchars($title);
        } else {
            self::$title = "默认标题";
        }

        return $this;
    }
}