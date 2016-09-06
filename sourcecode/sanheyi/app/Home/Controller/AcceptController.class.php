<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 共通区域
 */

namespace Home\Controller;
use Think\Controller;

class AcceptController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //发起接受资助
    public function sendAccept(){
        $this->display();
    }

    public function sendAcceptDo(){


    }

    public function acceptlist(){
        $this->display();
    }

}