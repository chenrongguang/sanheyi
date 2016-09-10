<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 登录登出
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller  {

    public  function  login(){
        $this->display();
    }
    //登录操作
    public  function  loginDo(){

        $model = M('admin');
        $pwd = md5(I("post.password"));
        $username = I("post.username");

        $map['name']=$username;
        $map['pwd']=$pwd;
        $map['use_yn']='Y';

        $result= $model->where($map)->find();
        //登录成功，设置session
        if($result!=false && $result !=null){
            $_SESSION['admin']['id']=$result['id'];
            $_SESSION['admin']['name']=$result['name'];
            //$return_data['url']= '/home/index/';
            $return_data['url']= U('public/main');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        //登录不成功
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0001','用户名和密码不匹配'));
        }


    }
    //登出操作
    public  function logoutDo(){
        unset($_SESSION['user']);
        //$this->display('login');
        //redirect('/home/login/login');
        redirect(U('login/login'));
    }

    /**
     * 显示验证码
     */
    public function showVerify(){
        $config =	array(
            'fontSize'  =>  10,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  35,               // 验证码图片高度
            'imageW'    =>  80,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $Verify =     new Verify($config);
        $Verify->entry();
    }

}