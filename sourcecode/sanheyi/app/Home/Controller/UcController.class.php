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

class UcController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //财务明细
    public function detail()
    {
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['currency_id'] = 1; //善种子
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['szz_num'] = (int)$result['num'];
        } else {
            $show_data['szz_num'] = 0;
        }


        $where['currency_id'] = 2; //善心币
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['sxb_num'] = (int)$result['num'];
        } else {
            $show_data['sxb_num'] = 0;
        }

        $where['currency_id'] = 3; //善金币
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['sjb_num'] = (int)$result['num'];
        } else {
            $show_data['sjb_num'] = 0;
        }

        $where['currency_id'] = 4; //管理钱包
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['glqb_num'] = $result['num'];
        } else {
            $show_data['glqb_num'] = 0;
        }

        $where['currency_id'] = 5; //出局钱包
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['cjqb_num'] = $result['num'];
        } else {
            $show_data['cjqb_num'] = 0;
        }

        $this->assign('show_data', $show_data);
        $this->display();
    }

    //转善种子
    public function sendSZZ()
    {
        $this->display();
    }

    public function sendSZZDo()
    {
        $data = I('post.');
        $send_num = $data['send_num'];

        //定义币种
        $currency_id=1;

        //先判断自己的善种子数量,是否够的
        //获取当前会员的善种子
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['currency_id'] = $currency_id; //善种子
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result == false || $result == null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '你的善种子数量不足,请购买!'));
        }
        $num = (int)$result['num'];
        if ($num <= 0) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '你的善种子数量不足,请购买!'));
        }
        if ($num < $send_num) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '你的善种子数量不足,请购买!'));
        }

        //判断二级密码是否正确
        $high_pwd = $data['high_pwd'];
        $where_user['user_id'] = $_SESSION['user']['user_id'];
        $where_user['use_yn'] = 'Y';
        $paras['where'] = $where_user;
        $user_data = D('user')->getSingle($paras);
        if (md5($high_pwd) != $user_data['high_pwd']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0004', '你输入的二级密码不正确'));
        }


        //开启事务
        M()->startTrans();

        //减少本人的善种子数量
        $r[] = M('user_currency')
            ->where(array('user_id' => $_SESSION['user']['user_id'],'currency_id'=>$currency_id))
            ->setDec('num', $send_num);

        //记录本人的减少明细
        $detail_data['user_id']= $_SESSION['user']['user_id'];
        $detail_data['currency_id']=$currency_id;
        $detail_data['detail_type']=2;
        $detail_data['detail_num']=$send_num*-1;
        $detail_data['rel_user_id']=$data['to_user_id']; //接收关系方id
        $detail_data['rel_user']=$data['name'];//接收关系方名字
        $detail_data['create_time']=time();
        $detail_data['handle_type']='支出善种子';
        $detail_data['remark']=$data['remark'];
        $r[] = M('user_currency_detail')->add($detail_data);

        //增加接收人的善种子数量
        $r[] = M('user_currency')
            ->where(array('user_id' => $data['to_user_id'],'currency_id'=>$currency_id))
            ->setInc('num', $send_num);

        //增加接收人的增加明细
        $detail_data_to['user_id']= $data['to_user_id'] ;
        $detail_data_to['currency_id']=$currency_id;
        $detail_data_to['detail_type']=1;
        $detail_data_to['detail_num']=$send_num;
        $detail_data_to['rel_user_id']=$_SESSION['user']['user_id']; //发送方关系方id
        $detail_data_to['rel_user']=$_SESSION['user']['name'];//发送方名字
        $detail_data_to['create_time']=time();
        $detail_data_to['handle_type']='收入善种子';
        $detail_data_to['remark']=$data['remark'];
        $r[] = M('user_currency_detail')->add($detail_data_to);

        if (!in_array(false, $r)) {
            M()->commit();
            $return_data['url']= U('uc/sendSZZ');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }

    }

    //转善心币
    public function sendSXB()
    {
        $this->display();
    }

    public function sendSXBDo()
    {

        $data = I('post.');
        $send_num = $data['send_num'];

        //定义币种
        $currency_id=2;

        //先判断自己的善心币数量,是否够的
        //获取当前会员的善心币
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['currency_id'] = $currency_id; //善种子
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result == false || $result == null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '你的善心币数量不足,请购买!'));
        }
        $num = (int)$result['num'];
        if ($num <= 0) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '你的善心币数量不足,请购买!'));
        }
        if ($num < $send_num) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '你的善心币数量不足,请购买!'));
        }

        //判断二级密码是否正确
        $high_pwd = $data['high_pwd'];
        $where_user['user_id'] = $_SESSION['user']['user_id'];
        $where_user['use_yn'] = 'Y';
        $paras['where'] = $where_user;
        $user_data = D('user')->getSingle($paras);
        if (md5($high_pwd) != $user_data['high_pwd']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0004', '你输入的二级密码不正确'));
        }


        //开启事务
        M()->startTrans();

        //减少本人的善数量
        $r[] = M('user_currency')
            ->where(array('user_id' => $_SESSION['user']['user_id'],'currency_id'=>$currency_id))
            ->setDec('num', $send_num);

        //记录本人的减少明细
        $detail_data['user_id']= $_SESSION['user']['user_id'];
        $detail_data['currency_id']=$currency_id;
        $detail_data['detail_type']=2;
        $detail_data['detail_num']=$send_num*-1;
        $detail_data['rel_user_id']=$data['to_user_id']; //接收关系方id
        $detail_data['rel_user']=$data['name'];//接收关系方名字
        $detail_data['create_time']=time();
        $detail_data['handle_type']='支出善心币';
        $detail_data['remark']=$data['remark'];
        $r[] = M('user_currency_detail')->add($detail_data);

        //增加接收人的数量
        $r[] = M('user_currency')
            ->where(array('user_id' => $data['to_user_id'],'currency_id'=>$currency_id))
            ->setInc('num', $send_num);

        //增加接收人的增加明细
        $detail_data_to['user_id']= $data['to_user_id'] ;
        $detail_data_to['currency_id']=$currency_id;
        $detail_data_to['detail_type']=1;
        $detail_data_to['detail_num']=$send_num;
        $detail_data_to['rel_user_id']=$_SESSION['user']['user_id']; //发送方关系方id
        $detail_data_to['rel_user']=$_SESSION['user']['name'];//发送方名字
        $detail_data_to['create_time']=time();
        $detail_data_to['handle_type']='收入善心币';
        $detail_data_to['remark']=$data['remark'];
        $r[] = M('user_currency_detail')->add($detail_data_to);

        if (!in_array(false, $r)) {
            M()->commit();
            $return_data['url']= U('uc/sendSXB');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }


    }

    //管理钱包，即奖金
    public function manager_money()
    {
        $this->display();
    }

    //收入明细
    public function in_detail()
    {
        $conditionData['detail_type'] = 1;
        $conditionData['user_id'] = $_SESSION['user']['user_id'];

        $model = M('user_currency_detail');
        $total = $model->field('detail_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['detail_type'] = 1;
        $paras['user_id'] = $_SESSION['user']['user_id'];
        $paras['page'] = $Page;

        $list = D('UserCurrencyDetail')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }

    //支出明细
    public function out_detail()
    {
        $conditionData['detail_type'] = 2;
        $conditionData['user_id'] = $_SESSION['user']['user_id'];

        $model = M('user_currency_detail');
        $total = $model->field('detail_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['detail_type'] = 2;
        $paras['user_id'] = $_SESSION['user']['user_id'];
        $paras['page'] = $Page;

        $list = D('UserCurrencyDetail')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

    //动态获取该用户当前该货币的数量
    public function ajxgettypecurrency()
    {

    }
}