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
		$this->renderView('index',$data);
       // die(json_encode($ret));
	   /*
		$a=new MsgList_Widget('mylist');
		$this->addWidget($a);
		$this->renderView('header',$data);
		$this->renderView('body',$data);
		$this->renderView('footer',$data);
		*/



    }

    public function add() {
        $config = $this->getConfig('DB');
        $this->mod = new MsgBoard_Model($config);

        $data = array(
            'content' => $_REQUEST['content'],
            'reply_to' => (int)$_REQUEST['reply_to'],
            'is_reply' => isset($_REQUEST['reply_to']) ? 1 : 0,
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


        $msgId = $_REQUEST['id'];
        $data = array(
            'content' => $_REQUEST['content'],
            'reply_to' => (int)$_REQUEST['reply_to'],
            'is_reply' => isset($_REQUEST['reply_to']) ? 1 : 0,
            //'rt' => date('Y-m-d H:i:s', time()),
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
        $msgId = $_REQUEST['id'];

        $ret = array('status' => true);
        if (!$this->mod->delMsg($msgId)) {
            $ret['msg'] = $this->mod->error();
            
        }
		die(json_encode($ret));
    }


}