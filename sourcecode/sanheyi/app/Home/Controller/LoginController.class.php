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

class LoginController extends Controller
{

    public function  login()
    {
        $this->display();
    }

    //登录操作
    public function  loginDo()
    {

        $model = M('user');
        $pwd = md5(I("post.password"));
        $username = I("post.username");


        $verify = new Verify();
        if(!$verify->check($_POST['captcha'])){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '验证码输入错误'));
        }


        $map['name'] = $username;
        $map['pwd'] = $pwd;
        $map['use_yn'] = 'Y';
        $map['act_status'] = 1;//激活状态的人才可以登录

        $result = $model->where($map)->find();
        //登录成功，设置session
        if ($result != false && $result != null) {
            $_SESSION['user']['user_id'] = $result['user_id'];
            $_SESSION['user']['name'] = $result['name'];
            //$return_data['url']= '/home/index/';
            $return_data['url'] = U('public/main');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } //登录不成功
        else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '用户名和密码不匹配,或者未激活，请重试!'));
        }


    }

    //登出操作
    public function logoutDo()
    {
        unset($_SESSION['user']);
        //$this->display('login');
        //redirect('/home/login/login');
        redirect(U('login/login'));
    }

    /**
     * 显示验证码
     */
    public function showVerify()
    {
        $config = array(
            'fontSize' => 10,              // 验证码字体大小(px)
            'useCurve' => true,            // 是否画混淆曲线
            'useNoise' => true,            // 是否添加杂点
            'imageH' => 35,               // 验证码图片高度
            'imageW' => 80,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
        );
        $Verify = new Verify($config);
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }

    public function findpwd()
    {
        $this->display();
    }

    public function findpwdDo()
    {
        $data = I('post.');
        if ($data['mobile'] != $_SESSION['find_pwd_mobile']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '手机号不匹配'));
        }
        if ($data['code'] != $_SESSION['code']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '验证码错误'));
        }

        $where['mobile'] = $data['mobile'];
        $update_data['pwd'] = md5($data['mobile']);
        $update_data['high_pwd'] = md5($data['mobile']);
        $result = M('user')->where($where)->save($update_data);//更新密码
        if ($result) {
            $return_data['url'] = U('login/login');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '密码重置,请立刻登陆修改', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '找回密码失败，请重试!'));
        }

    }

    public function reg()
    {
        $this->assign('p_id', I('get.p_id'));
        $this->assign('p_name', I('get.p_name'));
        $this->display();
    }


    public function regDo()
    {

        $data = I("post.");
        $data['create_time'] = time();
        $data['pwd'] = md5(I("post.pwd"));
        $data['high_pwd'] = md5(I("post.pwd"));//默认密码和登陆密码一样
        $result = M('user')->add($data);
        if ($result) {

            $sendsms = new \Common\Util\Sendsms();
            $sendsms->sand_sms($data['mobile'],'','尊敬的会员,恭喜你注册成功!');
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('login/login');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '注册成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '保存失败，请重试!'));
        }

    }

    //检测手机号是否是有效的手机号,会员找回密码用
    public function ajaxCheckmobile_ok()
    {

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $mobile = $post['mobile'];
        $where['mobile'] = $mobile;
        //$where['name']=I("post.name");
        $reult = M('user')->where($where)->find();
        //找到了
        if ($reult !== false && $reult !== null) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功'));

        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '该手机号不存在!'));
        }

    }


    //发送手机验证码
    public function ajxsendphonecode()
    {

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $mobile = $post['mobile'];

        $phone = $mobile;
        if (empty($phone)) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '参数错误!'));
        }
        if (!preg_match("/^1[34578]{1}\d{9}$/", $phone)) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '手机号码不正确!'));
        }

        $where['mobile'] = $mobile;
        //$where['name']=I("post.name");
        $reult = M('user')->where($where)->find();
        //找到了
        if ($reult == false || $reult == null) {
            //$return_data['url']= '/home/message/messlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '该手机号不存在!'));
        }

        $result_config_code_name = M('config')->where(array('key' => 'CODE_NAME'))->field('value')->find();
        $result_config_code_user_name = M('config')->where(array('key' => 'CODE_USER_NAME'))->field('value')->find();
        $result_config_code_user_pass = M('config')->where(array('key' => 'CODE_USER_PASS'))->field('value')->find();

        $r = sandPhone($phone, $result_config_code_name['value'], $result_config_code_user_name['value'], $result_config_code_user_pass['value']);
        //$r = sandPhone($phone,$this->config['CODE_NAME'],$this->config['CODE_USER_NAME'],$this->config['CODE_USER_PASS']);
        if ($r != "短信发送成功") {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', $r));
        } else {
            $_SESSION['find_pwd_mobile'] = $phone; //存到session中,在点击找回密码时需要使用
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '验证码发送成功'));
        }

    }


    //检测名字是否重复
    public function ajaxCheckName()
    {

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $name = $post['name'];
        $where['name'] = $name;
        //$where['name']=I("post.name");
        $reult = M('user')->where($where)->find();
        //找到了
        if ($reult !== false && $reult !== null) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '该用户名已经存在!'));

        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功'));
        }

    }

    //检测手机号是否重复
    public function ajaxCheckmobile()
    {

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $mobile = $post['mobile'];
        $where['mobile'] = $mobile;
        //$where['name']=I("post.name");
        $reult = M('user')->where($where)->find();
        //找到了
        if ($reult !== false && $reult !== null) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '该手机号已经存在!'));

        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功'));
        }

    }


    //检测该人是否存在,名字定的有点问题,新这样吧
    public function ajaxCheckPid()
    {

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $name = $post['p_name'];
        $where['name'] = $name;
        $where['act_status'] = 1;//必须是激活的才可用
        // $where['name']=I("post.p_name");
        $reult = M('user')->where($where)->find();
        //找到
        if ($reult !== false && $reult !== null) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['p_id'] = $reult['user_id'];
            $return_data['family_name'] = $reult['family_name'];
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));

        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '该用户不存在!'));
        }
    }

}