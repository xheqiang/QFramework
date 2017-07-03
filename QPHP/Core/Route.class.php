<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午5:19
 */
class Route
{
    private $_controller;
    private $_action;
    private $_params;

    /**
     * Route constructor.
     */
    public function __construct()
    {
        $this->_controller = "index";
        $this->_action = "index";
        $this->_params = array();

        $this->route();
    }

    /**
     * 路由解析方法
     *
     * 取得参数数组
     * @return array
     */
    public function route()
    {
        $url = isset($_GET['_url']) ? $_GET['_url'] : $_SERVER["REQUEST_URI"]; //兼容默认入口文件和用户自定义入口文件
        $url = substr($url,0); //去除参数中第一个"/"

        if ($url) {
            // 使用"/"分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);
            $urlArray = array_values($urlArray); //重置数组键值


            //检查第一个参数是否包含.php,如果包含直接去除
            if(!empty(strstr($urlArray[0], '.php'))){
                array_shift($urlArray); //删除数组中第一个元素(入口文件)，返回数组
            }

            // 获取控制器名
            $this->_controller = $urlArray ? $urlArray[0] : 'index';

            // 获取动作名
            array_shift($urlArray); //删除数组中第一个元素(控制器)，返回数组
            $this->_action = $urlArray ? $urlArray[0] : 'index';

            // 获取URL参数
            array_shift($urlArray);
            $this->_params = self::paseParams($urlArray);
        }
    }

    /**
     * 获取参数名称
     *
     * @return array
     */
    public static function paseParams($urlArray)
    {
        $paramArray = array();
        $num = count($urlArray);
        if($num > 0){
            if($num % 2 == 0) {
                //将参数进行处理
                for ($i = 0; $i < $num; $i += 2) {
                    $paramArray[$urlArray[$i]] = $urlArray[$i + 1];
                }
            }
        }
        return $paramArray;
    }

    /**
     * 获取控制器名称
     *
     * @return string
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * 获取动作名称
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * 获取参数名称
     *
     * @return string
     */
    public function getParams()
    {
        return $this->_params;
    }

}