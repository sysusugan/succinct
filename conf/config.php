<?php
/**
 * 配置信息
 * @author: sugan
 * @date: 13-8-22
 */

return array(
    'DB' => array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'port' => '3306',
    ),

    //默认控制器
    'default_ctl' => 'HelloWorld',
//    'default_ctl' => 'MsgBoard',

    //系统的根路径（index.php入口文件的路径）
    'base_url' => 'http://localhost/succinct',
);