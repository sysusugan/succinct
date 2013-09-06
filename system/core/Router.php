<?php
/**
 * 路由类
 * @author: sugan
 * @date: 13-8-22
 */
defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', APP_PATH . '/view');
include SYSTEM_PATH . '/core/DB.php';
include SYSTEM_PATH . '/helpers/url_helper.php';


class Router {

    /**自加载函数
     * @param $class
     * @throws ErrorException
     */
    public static function autoload($class) {
        $dir = APP_PATH;
        $filename = $class;
        //加载Controler
        if (false !== strpos(strtolower($class), 'controler')) {
            $dir = SYSTEM_PATH . '/controler';
            if (false !== strpos(strtolower($class), '_')) {
                $dir = APP_PATH . '/controler';
                $filename = current(explode('_', $class));
            }

        } //加载Model
        elseif (false !== strpos(strtolower($class), 'model')) {
            $dir = SYSTEM_PATH . '/model';
            if (false !== strpos(strtolower($class), '_')) {
                $dir = APP_PATH . '/model';
                $filename = current(explode('_', $class));
            }
        } //加载Model
        elseif (false !== strpos(strtolower($class), 'widget')) {
            $dir = SYSTEM_PATH . '/core';
            if (false !== strpos(strtolower($class), '_')) {
                $filename = current(explode('_', $class));
                $dir = APP_PATH . '/widgets/' . $filename;
            }
        }

        if (file_exists("{$dir}/{$filename}.php"))
            include  "{$dir}/{$filename}.php";
        else
            throw new ErrorException("file {$dir}/{$filename}.php not found! ");
    }


    /**
     * 路由函数
     */
    public static function route() {

        $config = include BASE_PATH . '/conf/config.php';

        $ctl = !empty($_GET['_c']) ? $_GET['_c'] : $config['default_ctl'];
        $act = !empty($_GET['_a']) ? $_GET['_a'] : 'index';

        $class = ucfirst($ctl) . '_Controler';
        if (class_exists($class)) {
            $controler = new $class;
            if (in_array(strtolower($act), array_map('strtolower', get_class_methods($class)))) {

                $controler->setConfig($config);
                $controler->$act();
                $controler->display();

            } else {
                self::show404(' $ctl/$act not found!');
            }

        } else {
            self::show404($class . ' 404!');
        }

    }

    public static function show404($msg = '') {
        die($msg);
    }
}


spl_autoload_register('Router::autoload');
