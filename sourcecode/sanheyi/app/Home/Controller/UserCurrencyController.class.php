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

class UserCurrencyController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //财务明细
    public  function detail(){
        $this->display();
    }

    //转善种子
    public  function sendSZZ(){
        $this->display();
    }

    public  function sendSZZDo(){

    }

    //转善心币
    public  function sendSXB(){
        $this->display();
    }

    public  function sendSXBDo(){

    }

    //管理钱包，即奖金
    public  function manager_money(){
        $this->display();
    }

    //收入明细
    public  function in_detail(){
        $this->display();
    }

    //支出明细
    public  function out_detail(){
        $this->display();
    }

    //动态获取该用户当前该货币的数量
    public  function ajxgettypecurrency(){

    }
}