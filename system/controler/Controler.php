<?php
/**
 * 控制器基类
 * @author: sugan
 * @date: 13-8-22
 */

include SYSTEM_PATH . "/core/ViewRender.php";

abstract class Controler extends ViewRender {

    protected $config;

    public function __construct() {
        $this->viewPath = APP_VIEW_PATH;
    }

    public function setConfig($config) {
        $this->config = $config;
    }

    public function getConfig($key) {
        return $this->config[$key];
    }

    public function R($key, $func = '') {
        $val = isset($_REQUEST[$key]) ? $_REQUEST[$key] : NULL;

        if (!empty($val)) {
            if (!get_magic_quotes_gpc()) $val = addslashes($val);

            if (!empty($func))
                $val = $func(htmlspecialchars($val));

        }
        return $val;
    }

}