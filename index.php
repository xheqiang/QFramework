<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午3:40
 */

// 定义框架的路径相对于当前目录
define('M_PATH', './MPHP');
//定义项目名称和路径
define('APP_PATH', __DIR__);
define('APP_NAME', 'App');
// 加载框架入口文件
require(M_PATH."/Mphp.php");
//实例化一个项目
$app = new App();
$app->run();

