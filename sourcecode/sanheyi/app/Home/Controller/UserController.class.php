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

class UserController extends BaseController
{

    private $before_li = '<li>';
    private $end_li = '</li>';
    private $before_spen_haschildren = '<span class="folder">';
    private $content_father = '';
    private $before_spen_nochildren = '<span class="file">';
    private $content_child = '';
    private $end_span = '</span>';
    private $before_ul = '<ul>';
    private $end_ul = '</ul>';
    private $tree = '';
    private $child_tree = '';
    private $currenty_id = '';
    private $ar_tree;
    private $index=0;


    public function _initialize()
    {
        parent::_initialize();
    }


    public function changepwd()
    {
        $this->display();
    }

    public function changepwdDo()
    {
        $this->display();
    }


    //个人信息
    public function personinfo()
    {
        $where['user_id'] = $_SESSION['user']['user_id'];
        $para['where'] = $where;
        $result_self = D('user')->getSingle($para);
        $p_id = $result_self['p_id'];
        $where['user_id'] = $p_id;
        $para['where'] = $where;
        $result_p = D('user')->getSingle($para);

        $show_data['name'] = $result_self['name'];
        $show_data['family_name'] = $result_self['family_name'];
        $show_data['create_time'] = date('Y-m-d H:i:s', $result_self['create_time']);
        $show_data['last_ip'] = $result_self['last_ip'];

        if ($result_self['group'] == 0) {
            $show_data['group'] = '普通会员';
        } else {
            $show_data['group'] = '特困会员';
        }


        if ($result_self['act_status'] == 0) {
            $show_data['act_status'] = '未激活';
        } else {
            $show_data['act_status'] = '已激活';
        }

        if ($result_self['confirm_status'] == 0) {
            $show_data['confirm_status'] = '未审核';
        } else if ($result_self['confirm_status'] == 1) {
            $show_data['confirm_status'] = '等待审核';
        } else if ($result_self['confirm_status'] == 2) {
            $show_data['confirm_status'] = '已审核';
        } else if ($result_self['confirm_status'] == 3) {
            $show_data['confirm_status'] = '审核失败';
        }

        $show_data['p_name'] = $result_p['name'];
        $show_data['p_family_name'] = $result_p['family_name'];
        $show_data['p_mobile'] = $result_p['mobile'];

        $this->assign('show_data', $show_data);
        $this->display();
    }


//帐号信息
    public function accountinfo()
    {
        $this->display();
    }

    public function accountinfoDo()
    {
        $this->display();
    }

    //验证信息
    public function identityinfo()
    {
        $this->display();
    }

    public function identityinfoDo()
    {
        $this->display();
    }


    //推荐链接页面
    public function pidlink()
    {
        $this->assign('link', U('login/reg', array('p_name' => $_SESSION['user']['name'], 'p_id' => $_SESSION['user']['user_id']), false, true));
        $this->display();
    }

    //注册
    public function reg()
    {
        $this->display();
    }


    public function regDo()
    {
        $this->display();
    }

    //发送手机验证码
    public function ajxSendPhoneCode()
    {

    }


    //布施中心
    public function relationcenter()
    {
        $this->display();
    }

    //获取下级
    public function ajxgetlevel_down()
    {

    }

    //获取所有下级-激活会员菜单页
    public function level_down_all()
    {

        $this->display();
    }

    //激活会员
    public function ajxact_user()
    {

    }

    //查看下级会员信息
    public function level_down_info()
    {

        $this->getlevel($_SESSION['user']['user_id']);
        $temp=json_encode($this->ar_tree);

        $this->assign('tree', $temp);
        $this->display();
    }

    private function  getlevel( $user_id){
        $where['user_id'] = $user_id;
        $where['use_yn'] = 'Y';
        $paras['where'] = $where;
        $result = D('user')->getSingle($paras);

        $temp['id']=$result['user_id'];
        if($user_id==$_SESSION['user']['user_id']){
            $temp['pId']=0;
        }
        else{
            $temp['pId']=$result['p_id'];
        }

        $temp['name']=$result['name']. ' ' . date('Y-m-d H:i:s', $result['create_time']);
        $this->ar_tree[$this->index]=$temp;
        $this->index+=1;


        if($this->check_has_children($user_id)){
            $where1['p_id'] = $result['user_id'];
            $where1['use_yn'] = 'Y';
            $result1 = M('user')->where($where1)->order('create_time asc')->select();
            foreach ($result1 as $k => $v) {
                $this->child_tree .= $this->getlevel($v['user_id']);
            }
        }
    }


       //判断该会员是否有下级孩子
    private function  check_has_children($p_id)
    {
        $where['p_id'] = $p_id;
        $where['use_yn'] = 'Y';
        $result = M('user')->where($where)->find();
        //有返回1,没有返回0
        if ($result !== false && $result !== null) {
            return 1;
        } else {
            return 0;
        }

    }

}