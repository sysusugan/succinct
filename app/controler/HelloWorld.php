<?php
/**
 * 留言板控制器
 * @author: sugan
 * @date: 13-8-22
 */

class HelloWorld_Controler extends Controler {

    public function index() {

        $this->view('helloworld/head', array('msg' => "这是helloword页面! "));
        $this->view('helloworld/body', array('msg' => "这是helloword页面! "));
    }

}