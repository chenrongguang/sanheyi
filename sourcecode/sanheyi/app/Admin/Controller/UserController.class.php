<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 共通区域
 */

namespace Admin\Controller;

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
    private $index = 0;


    public function _initialize()
    {
        parent::_initialize();
    }


    //获取所有下级-激活会员菜单页
    public function userlist()
    {
        $model = M('user');

        $total = $model->field('user_id')->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);
        $list = $model
            ->order("user_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        //$show = $Page->showAjax("mainarea");
        $show = $Page->show();
        $this->assign('total', $total);//总数量
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }



    //个人信息
    public function userinfo()
    {
        //可能是查看下级会员的个人信息,如果是本人信息就从session取
        $current_user = I('get.user_id');
        $handle_type = I('get.handle_type');

        $where['user_id'] = $current_user;
        $para['where'] = $where;
        $result_self = D('Home/user')->getSingle($para);
        $show_data=$result_self;

        $show_data['handle_type']=$handle_type;

        $p_id = $result_self['p_id'];
        $where['user_id'] = $p_id;
        $para['where'] = $where;
        $result_p = D('Home/user')->getSingle($para);

        $show_data['create_time'] = date('Y-m-d H:i:s', $result_self['create_time']);

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


    public function userinfoDo()
    {
        $data = I('post.');
        $handle_type=$data['handle_type'];
        //修改
        if($handle_type==1){
            $where['user_id'] = $data['user_id'];
            $update_data=$data;
            $result = M('user')->where($where)->save($update_data);
        }
        //审核
        else if ($handle_type==2){

            $where['user_id'] = $data['user_id'];
            $confirm_data['confirm_status'] = 2;
            $confirm_data['confirm_time'] = time();
            $confirm_data['confirm_user'] =$_SESSION['admin']['id'];
            $result = M('user')->where($where)->save($confirm_data);

            //给会员发送审核通知

            $data['title'] = "审核通知";
            $data['type'] = 1; //1表示审核通知
            $data['to_user_id'] =  $data['user_id']; //给审核的会员
            $data['content'] = "你的资料已经审核通过";
            $data['create_user'] = $_SESSION['admin']['id'];
            $data['create_time'] = strtotime(date("Y-m-d H:i:s",time()));
            $result_add = M('message')->add($data);

        }

        if ($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('user/userlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '处理失败，请重试!'));
        }

    }

}