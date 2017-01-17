<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午3:40
 */
define('DIR_SEPARATOR', DIRECTORY_SEPARATOR);   //取系统分割符，兼容win&&linux
define('FRAME_INDEX_PATH', __DIR__);


/**
 * 方法2：spl方法加载框架
 */
class Mphp {
    public static $loader;

    public static function init() {
        if (self::$loader == NULL)
            self::$loader = new self ();

        return self::$loader;
    }

    public function __construct() {
        spl_autoload_register ( array ($this, 'core' ) );
        spl_autoload_register ( array ($this, 'controller' ) );
        spl_autoload_register ( array ($this, 'model' ) );
        self::config();    //TODO 引入配置文件，暂时通过该方法实现，之后优化
    }

    public function core($class) {
        set_include_path ( get_include_path () . PATH_SEPARATOR . FRAME_INDEX_PATH . DIR_SEPARATOR . 'Core' . DIR_SEPARATOR );
        spl_autoload_extensions ( '.class.php' );
        spl_autoload ( $class );
    }

    public function controller($class) {
        set_include_path ( get_include_path () . PATH_SEPARATOR . APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . 'Controller' . DIR_SEPARATOR );
        spl_autoload_extensions ( 'Controller.php' );
        spl_autoload ( $class );
    }

    public function model($class) {
        set_include_path ( get_include_path () . PATH_SEPARATOR . APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . 'Model' . DIR_SEPARATOR );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }

    public function config() {
        $config = APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . 'Config' . DIR_SEPARATOR . "config.php";
        require $config;
    }

}

Mphp::init();


/**
 * 方法1：__autoload 实现类的自动加载
 * @param $class
 * @return int
 */
/*function __autoload($class)
{
    $classPath = FRAME_INDEX_PATH . DIR_SEPARATOR ."Core" . DIR_SEPARATOR . $class . ".class.php";
    if(file_exists($classPath))
    {
        include_once ($classPath);
        return 0;
    }

    $controllerPath = APP_PATH. DIR_SEPARATOR .APP_NAME. DIR_SEPARATOR . "Controller" . DIR_SEPARATOR . $class . ".php";
    if(file_exists($controllerPath))
    {
        include_once ($controllerPath);
        return 0;
    }

    $modelsPath = APP_PATH. DIR_SEPARATOR .APP_NAME. DIR_SEPARATOR ."Model" . DIR_SEPARATOR . $class . ".php";
    if(file_exists($modelsPath))
    {
        include_once ($modelsPath);
        return 0;
    }
}*/