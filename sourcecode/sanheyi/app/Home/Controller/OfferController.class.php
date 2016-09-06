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

class OfferController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //发起提供资助
    public function sendOffer(){
        $this->display();
    }

    public function sendOfferDo(){


    }

    public function offerlist(){
        $this->display();
    }


    //取消提供
    public function canceloffer(){


    }

    public function cancelofferDo(){


    }
}