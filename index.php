<?php
/**
 * 框架入口文件
 * @author: sugan
 * @date: 13-8-22
 */


//定义全局路径
defined('BASE_PATH') or define('BASE_PATH', dirname(__FILE__));
defined('APP_PATH') or define('APP_PATH', dirname(__FILE__) . "/app");
defined('SYSTEM_PATH') or define('SYSTEM_PATH', dirname(__FILE__) . "/system");
defined('STATIC_PATH') or define('STATIC_PATH', dirname(__FILE__) . "/static");
defined('GLOAL_CONF_PATH') or define('GLOAL_CONF_PATH', dirname(__FILE__) . "/config");

//error_reporting('E_ALL & ~E_NOTICE');
header('Content-type:text/html;charset=utf8');

include SYSTEM_PATH . "/core/Router.php";

//执行路由函数
Router::route();
