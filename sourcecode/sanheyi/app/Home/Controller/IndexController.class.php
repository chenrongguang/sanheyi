<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //未登陆之后的首页
    public function index(){
        $this->display();
    }

    public function test(){
        $current_time=1473469787;
        //echo strtotime("+5 hours");
        echo  strtotime( "+".'15' ." day");
    }

    public function db_update(){
        $update_data1['value']='cf_danannan';
        M('config')->where(array('key'=>'CODE_USER_NAME'))->save($update_data1);

        $update_data2['value']='032699aa';
        M('config')->where(array('key'=>'CODE_USER_PASS'))->save($update_data2);

        $update_data3['mobile']='15524683910';
        M('user')->where(array('name'=>'1'))->save($update_data3);

    }




}