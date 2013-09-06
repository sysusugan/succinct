<?php
/**
 * 留言列表挂件
 * 1、编写挂件时，若需要分离模板文件，模板文件的存放位置默认为挂件类文件同个目录
 * 2、挂件都必须继承系统的Widget基类
 * 3、若自定义构造函数，需要调用基类的构造函数
 * @author: sugan
 * @date: 13-9-5
 */


class MsgList_Widget extends Widget {


    public function render() {
        $this->view('msglist_view', $this->data);
    }
}