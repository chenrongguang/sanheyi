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
        $where['user_id']=$_SESSION['user']['user_id'];
        $para['where']=$where;
        $result_self= D('user')->getSingle($para);
        $p_id= $result_self['p_id'];
        $where['user_id']=$p_id;
        $para['where']=$where;
        $result_p=D('user')->getSingle($para);

        $show_data['name']=$result_self['name'];
        $show_data['family_name']=$result_self['family_name'];
        $show_data['create_time']=date('Y-m-d H:i:s', $result_self['create_time']);
        $show_data['last_ip']=$result_self['last_ip'];

        if($result_self['group']==0){
            $show_data['group']='普通会员';
        }
        else{
            $show_data['group']='特困会员';
        }


        if($result_self['act_status']==0){
            $show_data['act_status']='未激活';
        }
        else{
            $show_data['act_status']='已激活';
        }

        if($result_self['confirm_status']==0){
            $show_data['confirm_status']='未审核';
        }
        else if($result_self['confirm_status']==1){
            $show_data['confirm_status']='等待审核';
        }
        else if($result_self['confirm_status']==2){
            $show_data['confirm_status']='已审核';
        }
        else if($result_self['confirm_status']==3){
            $show_data['confirm_status']='审核失败';
        }

        $show_data['p_name']=$result_p['name'];
        $show_data['p_family_name']=$result_p['family_name'];
        $show_data['p_mobile']=$result_p['mobile'];

        $this ->assign('show_data',$show_data);
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
        $this->assign('link',U('login/reg',array('p_name'=>$_SESSION['user']['name'],'p_id'=>$_SESSION['user']['user_id']),false,true));
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