<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/17
 * Time: 上午11:53
 */

/**
 * 视图基类
 */
class View
{
    protected $viewDir = "View";
    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /**
     * 控制器变量分配
     *
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * 输出数据到视图方法
     *
     * @param null $dir
     * @param null $file
     */
    public function display($templet = null)
    {
        extract($this->variables);  //将数组键名作为变量名，使用数组键值作为变量值，便于在视图中使用
        $viewDir = $this->viewDir;
        $viewBasePath = APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . $viewDir . DIR_SEPARATOR;
        $viewDir = $this->_controller . DIR_SEPARATOR;
        $viewName = $this->_action . ".phtml";

        $defaultTemplate = $viewBasePath . $viewDir . $viewName; //默认模板
        $transmitTemplate = $viewBasePath . $templet;

        $templetFile = !empty($templet) ? $transmitTemplate : $defaultTemplate;

        if (file_exists($templetFile)) {
            include_once ($templetFile);
        }else{
            echo "<h3>Warning:Please check whether the view file exists</h3>";
        }
    }
}