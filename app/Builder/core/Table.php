<?php
namespace App\Builder\core;

use App\Builder\synergia\BuilderInterface;
use App\Builder\synergia\Title;

class Table implements BuilderInterface
{
    use Title;

    protected static $config;

    /**
     *
     * @describe 构造
     *
     * @access public
     * @see __construct()
     */
    public function __construct($config)
    {
        self::$config = $config;
    }

    /**
     *
     * @describe 格式化url
     *
     * @access public
     * @see spliceUrl()
     */
    public function spliceUrl($param, $data)
    {
        if (empty($param['url'])) {
            return;
        }

        if (empty($param['param'])) {
            return;
        }

        $spliceUrl = '';

        foreach ($param['param'] as $key => $value) {
            if (isset($data[$value])) {
                $spliceUrl .= $key . '=' . $data[$value] . '&';
            } else {
                $spliceUrl .= $key . "=未找到这个值({$value})&";
            }
        }

        $spliceUrl = '?' . rtrim($spliceUrl, '&');

        return $spliceUrl;
    }

    /**
     *
     * @describe 设置状态
     *
     * @access public
     * @see setState()
     */
    public function setState($param, $data)
    {
        return $param['param'][$data];
    }

    /**
     *
     * @describe 分页下一页url拼接
     *
     * @access public
     * @see nextPage()
     */
    public function nextPage()
    {
        $nextPage = $_GET['page'] >= static::$limit ? static::$limit : (isset($_GET['page']) ? $_GET['page'] + 1 : 2);

        $goPage = '?page=' . $nextPage . $this->queryString();

        return $goPage;
    }

    /**
     *
     * @describe 分页上一页url拼接
     *
     * @access public
     * @see prevPage()
     */
    public function prevPage()
    {
        $prevPage = $_GET['page'] <= 1 ? 1 : $_GET['page'] - 1;

        $goPage = '?page=' . $prevPage . $this->queryString();

        return $goPage;
    }

    /**
     *
     * @describe 拼接参数
     *
     * @access public
     * @see queryString()
     */
    public function queryString()
    {
        $paramData = $_GET;

        if (count($paramData) > 1) {
            unset($paramData['page']);

            $param = http_build_query($paramData);

            return "&" . $param;
        } else {
            return;
        }
    }
}