<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 登录登出
 */

namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller  {

    public  function  login(){
        $this->display();
    }
    //登录操作
    public  function  loginDo(){

        $model = M('user');
        $pwd = md5(I("post.password"));
        $username = I("post.username");

        $map['name']=$username;
        $map['pwd']=$pwd;
        $map['use_yn']='Y';

        $result= $model->where($map)->find();
        //登录成功，设置session
        if($result!=false && $result !=null){
            $_SESSION['user']['user_id']=$result['user_id'];
            $_SESSION['user']['name']=$result['name'];
            //$return_data['url']= '/home/index/';
            $return_data['url']= U('public/main');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        //登录不成功
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0001','用户名和密码不匹配，请重试!'));
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

    public  function findpwd(){
        $this->display();
    }
    public  function findpwdDo(){

    }

    public  function reg(){
        $this->assign('p_id',I('get.p_id'));
        $this->assign('p_name',I('get.p_name'));
        $this->display();
    }


    public  function regDo(){

        $data = I("post.");
        $data['create_time'] = time();
        $data['pwd'] =  md5(I("post.pwd"));
        $data['high_pwd'] =  md5(I("post.pwd"));//默认密码和登陆密码一样
        $result = M('user')->add($data);
        if($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url']= U('login/login');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','保存失败，请重试!'));
        }

    }
    //检测名字是否重复
    public  function ajaxCheckName(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $name=$post['name'];
        $where['name']=$name;
        //$where['name']=I("post.name");
        $reult= M('user')->where($where)->find();
        //找到了
        if($reult!==false && $reult!==null){
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0001','该用户名已经存在!'));

        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功'));
        }

    }

    //检测推荐人是否存在
    public  function ajaxCheckPid(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $name=$post['p_name'];
        $where['name']=$name;
       // $where['name']=I("post.p_name");
        $reult= M('user')->where($where)->find();
        //找到
        if($reult!==false && $reult!==null){
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['p_id']=$reult[user_id];
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0001','该推荐人不存在!'));
        }
    }

}