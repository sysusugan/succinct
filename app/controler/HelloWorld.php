<?php
/**
 * 留言板控制器
 * @author: sugan
 * @date: 13-8-22
 */

class HelloWorld_Controler extends Controler {

    public function index() {
        $msgList = new MsgList_Widget('mylist');
        $this->addWidget($msgList);
        $this->renderView('helloworld/body',array('msg2'=>1111));
    }


}