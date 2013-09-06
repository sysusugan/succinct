<?php
/**
 * 留言板控制器
 * @author: sugan
 * @date: 13-8-22
 */

class MsgBoard_Controler extends Controler {
    private $mod;

    public function index() {
        $config = $this->getConfig('DB');
        $this->mod = new MsgBoard_Model($config);

        $data['list'] = $this->mod->getMsg();

        $ret = array('status' => true, 'data' => array());
        if ($err = $this->mod->error()) {
            $ret ['msg'] = $err;
            die(json_encode($ret));
        }

        $ret['data'] = $data;

        $list = new MsgList_Widget('mylist');
        $list->setData($data);
        $this->addWidget($list);

        $this->view('msgboard/header');
        $this->view('msgboard/index');
        $this->view('msgboard/footer');

    }

    public function add() {
        $config = $this->getConfig('DB');
        $this->mod = new MsgBoard_Model($config);

        $data = array(
            'content' => $this->R('content'),
            'reply_to' => (int)$this->R('reply_to'),
            'is_reply' => $this->R('reply_to', 'intval') ? 1 : 0,
            'rt' => date('Y-m-d H:i:s', time()),
            'ut' => date('Y-m-d H:i:s', time()),
        );

        $ret = array('status' => true);
        $re = $this->mod->addMsg($data);
        if (!$re) {
            $ret['msg'] = $this->mod->error();
        }

        $ret['id'] = $re;
        die(json_encode($ret));
    }

    public function edit() {
        $config = $this->getConfig('DB');
        $this->mod = new MsgBoard_Model($config);


        $msgId = $this->R('id');
        $data = array(
            'content' => $this->R('content'),
            'reply_to' => $this->R('reply_to', 'intval'),
            'is_reply' => $this->R('reply_to') ? 1 : 0,
            'ut' => date('Y-m-d H:i:s', time()),
        );

        $ret = array('status' => true);
        if (!$this->mod->updateMsg($data, "id='{$msgId}'")) {
            $ret['msg'] = $this->mod->error();

        }
        die(json_encode($ret));
    }

    public function del() {
        $config = $this->getConfig('DB');
        $this->mod = new MsgBoard_Model($config);
        $msgId = $this->R('id');

        $ret = array('status' => true);
        if (!$this->mod->delMsg($msgId)) {
            $ret['msg'] = $this->mod->error();

        }
        die(json_encode($ret));
    }


}