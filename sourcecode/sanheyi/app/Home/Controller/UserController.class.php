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
    private $index = 0;


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
        $where_check['user_id'] = $_SESSION['user']['user_id'];
        $oldpwd = I('post.oldpwd');
        $where_check['pwd'] = md5($oldpwd);
        $result_check = M('user')->where($where_check)->find();
        //找不到
        if ($result_check == null || $result_check == false) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '旧密码错误,请重试!'));
        }

        $data['pwd'] = md5(I('post.pwd'));
        $data['high_pwd'] = md5(I('post.high_pwd'));
        $where['user_id'] = $_SESSION['user']['user_id'];
        $result = M('user')->where($where)->save($data);

        if ($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('user/changepwd');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '保存失败，请重试!'));
        }

    }


    //个人信息
    public function personinfo()
    {
        //可能是查看下级会员的个人信息,如果是本人信息就从session取
        $current_user = I('get.user_id');
        if (empty($current_user)) {
            $current_user = $_SESSION['user']['user_id'];
        }

        $where['user_id'] = $current_user;
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

    //个人信息
    public function relpersoninfo()
    {
        //可能是查看下级会员的个人信息,如果是本人信息就从session取
        $current_user = I('get.user_id');
        if (empty($current_user)) {
            $current_user = $_SESSION['user']['user_id'];
        }

        $where['user_id'] = $current_user;
        $para['where'] = $where;
        $result_self = D('user')->getSingle($para);

        $show_data['name'] = $result_self['name'];
        $show_data['family_name'] = $result_self['family_name'];
        $show_data['create_time'] = date('Y-m-d H:i:s', $result_self['create_time']);
        $show_data['bank'] = $result_self['bank'];
        $show_data['bank_no'] = $result_self['bank_no'];
        $show_data['mobile'] = $result_self['mobile'];
        $show_data['city'] = $result_self['city'];


        if ($result_self['group'] == 0) {
            $show_data['group'] = '普通会员';
        } else {
            $show_data['group'] = '特困会员';
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


        $this->assign('show_data', $show_data);
        $this->display();
    }





//帐号信息
    public function accountinfo()
    {
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['use_yn'] = 'Y';
        $paras['where'] = $where;
        $show_data = D('user')->getSingle($paras);
        if ($show_data != false && $show_data !== null) {
            if ($show_data['confirm_status'] == 0) {
                $show_data['confirm_status_name'] = '未审核';
            } else if ($show_data['confirm_status'] == 1) {
                $show_data['confirm_status_name'] = '等待审核';
            } else if ($show_data['confirm_status'] == 2) {
                $show_data['confirm_status_name'] = '已审核';
            } else if ($show_data['confirm_status'] == 3) {
                $show_data['confirm_status_name'] = '审核失败';
            }
        }

        $this->assign('show_data', $show_data);

        $this->display();
    }

    public function accountinfoDo()
    {
        $data = I('post.');
        $where['user_id'] = $_SESSION['user']['user_id'];
        $data['confirm_status'] = 1;
        $result = M('user')->where($where)->save($data);

        if ($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('user/accountinfo');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '保存失败，请重试!'));
        }

    }

    //验证信息
    public function identityinfo()
    {
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['use_yn'] = 'Y';
        $paras['where'] = $where;
        $show_data = D('user')->getSingle($paras);
        if ($show_data != false && $show_data !== null) {
            if ($show_data['confirm_status'] == 0) {
                $show_data['confirm_status_name'] = '未审核';
            } else if ($show_data['confirm_status'] == 1) {
                $show_data['confirm_status_name'] = '等待审核';
            } else if ($show_data['confirm_status'] == 2) {
                $show_data['confirm_status_name'] = '已审核';
            } else if ($show_data['confirm_status'] == 3) {
                $show_data['confirm_status_name'] = '审核失败';
            }
        }

        $this->assign('show_data', $show_data);

        $this->display();
    }

    public function identityinfoDo()
    {
        $data = I('post.');
        $data['confirm_status'] = 1;
        $where['user_id'] = $_SESSION['user']['user_id'];
        $result = M('user')->where($where)->save($data);

        if ($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('user/identityinfo');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '保存失败，请重试!'));
        }

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
        $p_id = $_SESSION['user']['user_id'];
        $p_name = $_SESSION['user']['name'];
        $this->assign('p_id', $p_id);
        $this->assign('p_name', $p_name);
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
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url'] = U('user/reg');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '保存失败，请重试!'));
        }
    }

    //发送手机验证码
    public function ajxSendPhoneCode()
    {

    }


    //获取下级
    public function ajxgetlevel_down()
    {

    }

    //获取所有下级-激活会员菜单页
    public function level_down_all()
    {
        $model = M('user');

        //获取各个状态的会员数量
        $conditionData_act['use_yn'] = 'Y';
        $conditionData_act['p_id'] = $_SESSION['user']['user_id'];
        $conditionData_act['act_status'] = 1; //已激活
        $total_act = $model->field('user_id')->where($conditionData_act)->count();

        $conditionData_noact['use_yn'] = 'Y';
        $conditionData_noact['p_id'] = $_SESSION['user']['user_id'];
        $conditionData_noact['act_status'] = 0; //未激活
        $total_noact = $model->field('user_id')->where($conditionData_noact)->count();


        //获取分页列表
        $conditionData['use_yn'] = 'Y';
        $conditionData['p_id'] = $_SESSION['user']['user_id'];


        $total = $model->field('user_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);
        $list = $model
            ->where($conditionData)
            ->order("user_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        //$show = $Page->showAjax("mainarea");
        $show = $Page->show();

        $this->assign('total_act', $total_act);//总数量
        $this->assign('total_noact', $total_noact);//总数量
        $this->assign('total', $total);//总数量
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }

    //激活会员
    public function ajxact_user()
    {
        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $act_user = $post['act_user']; //要激活的会员id

        //获取当前会员的善种子
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['currency_id'] = 1; //善种子
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result == false || $result == null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '你的善种子数量不足,请购买!'));
        }
        $num = (int)$result['num'];
        if ($num <= 0) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '你的善种子数量不足,请购买!'));
        }

        //定义激活会员需要的种子数
        $act_nedd_money = 1;

        //开启事务
        M()->startTrans();

        //扣除善种子总数
        $r[] = M('user_currency')
            ->where(array('user_id' => $_SESSION['user']['user_id'], 'currency_id' => 1))
            ->setDec('num', $act_nedd_money);

        //增加扣除善种子的明细
        $detail_data['user_id'] = $_SESSION['user']['user_id'];
        $detail_data['currency_id'] = 1;
        $detail_data['detail_type'] = 2;
        $detail_data['detail_num'] = $act_nedd_money * -1;
        $detail_data['create_time'] = time();
        $detail_data['handle_type'] = '支出善种子';
        $detail_data['remark'] = '激活会员';
        $r[] = M('user_currency_detail')->add($detail_data);

        //激活会员
        $where_act['user_id'] = $act_user;
        $data_act['act_status'] = 1;
        $data_act['act_time'] = time();
        $data_act['act_user'] = $_SESSION['user']['user_id'];
        $r[] = M('user')->where($where_act)->save($data_act);

        if (!in_array(false, $r)) {
            M()->commit();
            $this->make_user_currency_default($act_user);//激活之后生成该会员的默认货币记录
            $return_data['url'] = U('user/level_down_all');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '处理成功', $return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '激活失败,请重试!'));
        }

    }

//生成该会员的默认货币记录
    private function  make_user_currency_default($act_user)
    {
        //生成5种货币
        for ($currency_id = 1; $currency_id <= 5; $currency_id++) {
            $insert_to_data['user_id'] = $act_user;
            $insert_to_data['currency_id'] = $currency_id;
            M('user_currency')->add($insert_to_data);
        }
    }


    //查看下级会员信息
    public function level_down_info()
    {

        $this->getlevel($_SESSION['user']['user_id']);
        $temp = json_encode($this->ar_tree);

        $this->assign('tree', $temp);
        $this->display();
    }

    private function  getlevel($user_id)
    {
        $where['user_id'] = $user_id;
        $where['use_yn'] = 'Y';
        $paras['where'] = $where;
        $result = D('user')->getSingle($paras);

        $temp['id'] = $result['user_id'];
        if ($user_id == $_SESSION['user']['user_id']) {
            $temp['pId'] = 0;
        } else {
            $temp['pId'] = $result['p_id'];
        }

        $temp['name'] = $result['name'] . ' ' . date('Y-m-d H:i:s', $result['create_time']);
        $this->ar_tree[$this->index] = $temp;
        $this->index += 1;


        if ($this->check_has_children($user_id)) {
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