<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午5:06
 */

class App
{
    private static $_controller;
    private static $_action;
    private static $_params;
    private static $_route;


    public function __construct()
    {
        self::$_route = new Route();
        $this->init();
    }

    /**
     * 取得路由传参,并对应用程序进行设置
     *
     * 此方法中会设置程序的Controller、Action、Para
     */
    public function init()
    {
        $route = self::$_route;

        $routeController = $route->getController();
        $routeAction = $route->getAction();
        $routeParams = $route->getParams();

        $controllerFullName = $routeController . "Controller";

        $controllerFullName = ucfirst($controllerFullName); //转化路由中控制器首字母大写
        try{
            if(!class_exists($controllerFullName)) {
                throw new Exception($controllerFullName . "  controller does not exist, please create this controller.");
            }
            self::$_controller = $routeController;

            $actionFullName = $routeAction . "Action";
            if(!method_exists($controllerFullName, $actionFullName))
            {
                throw new Exception($actionFullName . " action does not exist, please create this action.");
            }
            self::$_action = $routeAction;

            self::$_params = $routeParams;

        } catch(Exception $e)
        {
            echo $e->getMessage();
            exit;
        }
    }

    public function run()
    {
        //实例化控制器
        $controllerName = ucfirst(self::$_controller);
        $controller = $controllerName."Controller";
        $action = self::$_action."Action";
        $actionName = self::$_action;
        $param = self::$_params;

        $dispatch = new $controller($controllerName, $actionName);
        //init中已经判断控制器和动作存在，这里调用并传入url参数
        $dispatch->$action($param);
        //call_user_func_array(array($dispatch, $action), $param);
    }

    public static function getController()
    {
        $controllerName = ucfirst(self::$_controller);
        $controller = $controllerName."Controller";
        return $controller;
    }

    public static function getControllerName()
    {
        $controllerName = ucfirst(self::$_controller);
        return $controllerName;
    }

    public static function getAction()
    {
        $action = self::$_action."Action";
        return $action;
    }

    public static function getActionName()
    {
        $actionName = self::$_action;
        return $actionName;
    }
}