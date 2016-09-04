<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 基类
 */

namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller  {

    public function _initialize()
    {
        $this->login_check();
        $this->init_data();
    }

    //登录判断
    public function login_check(){

        if (empty($_SESSION['admin']['id'])) {
            //$this->display('Login:login');
            //redirect('/home/login/login');
            redirect(U('login/login'));
        }

    }
    //初始化必要的数据
    public function init_data(){

    }

}