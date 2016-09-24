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

class MatchController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //提供资助的匹配列表
    public function offer_matchlist()
    {
        $offer_id = I('get.offer_id');
        if (empty($offer_id)) {
            exit('系统错误');
        }
        $paras['offer_id'] = $offer_id;
        $list = D('OrderMatch')->getList($paras);

        $this->assign('list', $list);
        $this->display();
    }

    //接收帮助的匹配列表
    public function accept_matchlist()
    {
        $accept_id = I('get.accept_id');
        if (empty($accept_id)) {
            exit('系统错误');
        }
        $paras['accept_id'] = $accept_id;
        $list = D('OrderMatch')->getList($paras);

        $this->assign('list', $list);
        $this->display();
    }


    //打款
    public function sendmoney()
    {
        $match_id = I('get.match_id');
        if (empty($match_id)) {
            exit('系统错误');
        }

        $match_where['match_id'] = $match_id;
        $match_where['status'] = 1;
        $show_data = M('order_match')->where($match_where)->find();
        if ($show_data != false && $show_data != null) {
            if ($show_data['pay_status'] == 0) {
                $show_data['pay_status_name'] = '未付款';
            } else {
                $show_data['pay_status_name'] = '已付款';
            }


        }
        $this->assign('show_data', $show_data);
        $this->display();
    }

    public function sendmoneyDo()
    {
        $data = I('post.');

        //获取该match对应的信息
        $match_result=M('order_match')->where(array('match_id' => $data['match_id']))->find();
        $offer_id= $match_result['offer_id'];
        $accept_id= $match_result['accept_id'];

        //获取该match对应的提供资助信息
        $offer_result=M('order_offer')->where(array('offer_id' =>$offer_id))->find();

        //获取该match对应的接收资助信息
        $accept_result=M('order_accept')->where(array('accept_id' =>$accept_id))->find();

        //开启事务
        M()->startTrans();

        //先把付款图片和状态,时间等,更新到match表
        //并且计算出最后确认收款时间,可以用于前台的倒计时
        $update_match_data['pay_status']=1;
        $update_match_data['pay_time']=time();
        $update_match_data['pay_pic_url']=$data['pay_pic_url'];
        //根据当前时间 和该匹配所属的社区,计算出最后确认收款的时间
        $update_match_data['max_confirm_time']=$this->calc_max_confirm_time($offer_result['community_id']);

        $r[] = M('order_match')
            ->where(array('match_id' => $data['match_id']))
            ->save($update_match_data);

        //处理该match对应的offer表里的记录的状态
        //如果剩余金额刚好就是匹配金额,那么该提供资助,的付款状态变为全部完成
        if($offer_result['pay_remain_num']-$match_result['match_num'] ==0){
            $update_offer_data['pay_status']=2;
        }
        else{
            $update_offer_data['pay_status']=1;
        }
        //更新剩余金额
        $update_offer_data['pay_remain_num']=$offer_result['pay_remain_num']-$match_result['match_num'];

        $r[] = M('order_offer')
            ->where(array('offer_id' => $offer_id))
            ->save($update_offer_data);

        //处理该match对应的accept表里的付款剩余量更新
        $update_accept_data['pay_remain_num']=$accept_result['pay_remain_num']-$match_result['match_num'];
        $r[] = M('order_accept')
            ->where(array('accept_id' => $accept_id))
            ->save($update_accept_data);


        if (!in_array(false, $r)) {
            M()->commit();

            //发送短信
            $sendsms = new \Common\Util\Sendsms();
            $sendsms->sand_sms('',$accept_result['user_id'],'尊敬的会员,你的匹配已经打款,请登陆系统查看!');

            $return_data['url']= U('offer/offerlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }

    }

    //确认收款
    public function confirmmoney()
    {
        $match_id = I('get.match_id');
        if (empty($match_id)) {
            exit('系统错误');
        }

        $match_where['match_id'] = $match_id;
        $match_where['status'] = 1;
        $show_data = M('order_match')->where($match_where)->find();
        if ($show_data != false && $show_data != null) {
            if ($show_data['confirm_status'] == 0) {
                $show_data['confirm_status_name'] = '未确认收款';
            } else {
                $show_data['confirm_status_name'] = '已确认收款';
            }


        }
        $this->assign('show_data', $show_data);
        $this->display();
    }

    public function confirmmoneyDo()
    {

        $data = I('post.');
        $data['lock_accept_user']=0; //是否对该接收帮助人进行锁定帐号的处理,0表示不处理

        $result= D('OrderMatch')->confirm_money($data);

        if ($result) {
            $return_data['url']= U('accept/acceptlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }

    }

    //计算出最后确认收款时间
    private function  calc_max_confirm_time($community_id){
        $where['community_id']=$community_id;
        $com_result=M('community')->where($where)->find();
        $max_day=$com_result['confirm_day_max'];

        return  strtotime( "+".$max_day ." day");

    }

}