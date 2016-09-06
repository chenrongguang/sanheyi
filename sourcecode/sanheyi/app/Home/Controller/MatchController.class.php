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

class MatchController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //匹配列表
    public function matchlist(){
        $this->display();
    }

    //对方信息
    public function relinfo(){
        $this->display();
    }

    //打款
    public function sendmoney(){
        $this->display();
    }

    public function sendmoneyDo(){
        $this->display();
    }

    //确认收款
    public function confirmmoney(){
        $this->display();
    }

    public function confirmmoneyDo(){
        $this->display();
    }
}