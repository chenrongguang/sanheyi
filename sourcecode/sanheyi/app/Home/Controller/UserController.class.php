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

class UserController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }




    public  function changepwd(){
        $this->display();
    }

    public  function changepwdDo(){
        $this->display();
    }



    //个人信息
    public  function personinfo(){
        $this->display();
    }



//帐号信息
    public  function accountinfo(){
        $this->display();
    }

    public  function accountinfoDo(){
        $this->display();
    }

    //验证信息
    public  function identityinfo(){
        $this->display();
    }

    public  function identityinfoDo(){
        $this->display();
    }


    //推荐链接页面
    public  function pidlink(){
        $this->display();
    }

    //注册
    public  function reg(){
        $this->display();
    }


    public  function regDo(){
        $this->display();
    }

    //发送手机验证码
    public  function ajxSendPhoneCode(){

    }


    //布施中心
    public  function relationcenter(){
        $this->display();
    }

    //获取下级
    public  function ajxgetlevel_down(){

    }

    //获取所有下级-激活会员菜单页
    public  function level_down_all(){
       $this->display();
    }

    //激活会员
    public  function ajxact_user(){

    }

    //查看下级会员信息
    public  function level_down_info(){
        $this->display();
    }

}