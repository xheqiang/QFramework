<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午3:40
 */
//....增加目录时，直接加入即可，在下面spl中增加对应的方法
define('CORE', "core");     //定义框架核心库目录名称
define('CONTROLLER', "Controller");     //定义项目Controller目录名称
define('MODEL', "Model");     //定义项目Model目录名称
define('CONFIG', "Config");     //定义项目Config目录名称

define('DIR_SEPARATOR', DIRECTORY_SEPARATOR);   //取系统分割符，兼容win&&linux
define('FRAME_INDEX_PATH', __DIR__);


/**
 * 方法2：spl方法加载框架
 */
class Qphp {
    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL){
            self::$loader = new self ();
        }

        return self::$loader;
    }

    public function __construct()
    {
        $this->config();    //TODO:: 暂时没有找到别的好的方法,之后优化 require 无法通过spl实现
        spl_autoload_register ( array ($this, 'core' ) );
        spl_autoload_register ( array ($this, 'controller' ) );
        spl_autoload_register ( array ($this, 'model' ) );
    }

    public function core($class)
    {
        set_include_path ( get_include_path () . PATH_SEPARATOR . FRAME_INDEX_PATH . DIR_SEPARATOR . CORE . DIR_SEPARATOR );
        spl_autoload_extensions ( '.class.php' );
        spl_autoload ( $class );
    }

    public function controller($class)
    {
        set_include_path ( get_include_path () . PATH_SEPARATOR . APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . CONTROLLER . DIR_SEPARATOR );
        spl_autoload_extensions ( 'Controller.php' );
        spl_autoload ( $class );
    }

    public function model($class)
    {
        set_include_path ( get_include_path () . PATH_SEPARATOR . APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . MODEL . DIR_SEPARATOR );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }

    public function config()
    {
        $configPath = APP_PATH. DIR_SEPARATOR . APP_NAME . DIR_SEPARATOR . CONFIG . DIR_SEPARATOR;
        $dp = dir($configPath);
        while($file = $dp->read()){
            if($file !="." && $file !="..") {
                if (is_file($configPath . $file)) { //当前为文件
                    if(substr($file, -4) == ".php"){
                        $configFile = $configPath . $file;
                        $config = include_once("$configFile");
                        foreach($config as $key => $val){
                            define($key, $val);
                        }
                    }
                }
            }
        }
    }
}

Qphp::init();


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