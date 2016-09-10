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



}