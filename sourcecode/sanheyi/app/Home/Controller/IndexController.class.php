<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //未登陆之后的首页
    public function index(){
        $this->display();
    }



}