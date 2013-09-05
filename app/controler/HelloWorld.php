<?php
/**
 * 留言板控制器
 * @author: sugan
 * @date: 13-8-22
 */

class HelloWorld_Controler extends Controler {

    public function index() {
        $msg = 'hello world! head  1';
        $msg2 = 'hello world! body 2';
        $this->renderView('helloworld/head', array('msg1' => $msg));
        $this->renderView('helloworld/body', array('msg2' => $msg2));

    }


}