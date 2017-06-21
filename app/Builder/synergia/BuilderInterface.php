<?php
namespace App\Builder\synergia;
/**
 *
 * @describe Builder Interface
 *
 * @see interface Builder()
 * @author CrazyCodes <625566775@qq.com>
 * @copyright MyBuilder 2017/5/11
 * @version MyBuilder v1.0 Beta
 * @internal
 *      CrazyCodes <625566775@qq.com>
 *
 */
interface BuilderInterface
{
    /**
     *
     * @describe 设置面包渣导航
     *
     * @access public
     * @see setBreadCrumbs()
     * @param $breadCrumbs array or string
     */
    public function setBreadCrumbs($breadCrumbs);

    /**
     *
     * @describe 设置顶部标题
     *
     * @access public
     * @see setTopTitle()
     * @param $topTitle string
     */
    public function setTopTitle($topTitle);

    /**
     *
     * @describe 设置标题
     *
     * @access public
     * @see setTitle()
     * @param $title string
     */
    public function setTitle($title);

    /**
     *
     * @describe 模版渲染
     *
     * @access public
     * @see display()
     */
//    public function display();
}