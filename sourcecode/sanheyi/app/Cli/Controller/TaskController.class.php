<?php
namespace Cli\Controller;

use Think\Controller;

class TaskController extends Controller
{
    protected $model;

    //检查过期未确认收款，自动收款，并且对接收资助人进行封号处理
    //其实这样不合理，假如提供资助的人，提供了假的打款证明，而接收资助人实际每收到钱
    //或者收到的钱的金额不对 ，这个时候，接收资助的人，没法处理阿。。。难道就必须确认，否则就被封号了
    public function  task_expire_confirm()
    {
        $this->model = M('order_match');

        $where['status'] = 1;//可用
        $where['pay_status'] = 1;//已付款
        $where['confirm_status'] = 0;//未确认付款
        $where['max_confirm_time'] = array('LT',time());//最大确认时间已经超过现在时间了

        $result = $this->model->where($where)->select();
        if ($result == false || $result == null) {
            exit('任务结束-没有需要处理的任务');
        }

        //循环处理
        foreach($result as $k=>$val){

            $data['match_id']=$val['match_id'];
            $data['lock_accept_user']=1; //是否对该接收帮助人进行锁定帐号的处理,0表示不处理

            $result_handle= D('Home/OrderMatch')->confirm_money($data);
        }

        exit('任务结束');
    }


    //检查超过时间未打款的纪录,
    //目前的处理方式是:1取消该匹配记录,2.将提供方封号,3.给接收资助方的accept表的各字段状态重新计算
    public function  task_expire_pay()
    {
        $this->model = M('order_match');

        $where['status'] = 1;//可用
        $where['pay_status'] = 0;//未付款
        $where['confirm_status'] = 0;//未确认付款
        $where['max_pay_time'] = array('LT',time());//最大付款时间已经超过现在时间了

        $result = $this->model->where($where)->select();
        if ($result == false || $result == null) {
            exit('任务结束-没有需要处理的任务');
        }

        //循环处理
        foreach($result as $k=>$val){

            $match_id=$val['match_id'];
            $offer_id=$val['offer_id'];//提供方
            $accept_id=$val['accept_id'];//接收方
            $match_num=$val['match_num']; //该匹配的金额

            M()->startTrans();

            //1取消该匹配记录
            $update_match_data['status'] = 0;
            $r[] = M('order_match')
                ->where(array('match_id' =>$match_id))
                ->save($update_match_data);

            //2.将提供方封号
            $offer_result= M('order_offer')->where(array('offer_id' =>$offer_id))->find();
            $update_user_data['use_yn'] = 'N';
            $r[] = M('user')
                ->where(array('user_id' => $offer_result['user_id']))
                ->save($update_user_data);

            //3.给接收资助方的accept表的各字段状态重新计算
            $accept_result= M('order_accept')->where(array('accept_id' =>$accept_id))->find();
            //计算出新的未匹配金额
            $new_accept_match_remain_num=$accept_result['match_remain_num'] + $match_num;

            //如果该未匹配金额和要接收的总金额相等,则,状态为未匹配
            //如果最新的剩余金额小于提供的总金额,则为部分匹配的状态
            if($new_accept_match_remain_num == $accept_result['total_num']){
                $new_match_status=0;
            }
            else if($new_accept_match_remain_num < $accept_result['total_num']){
                $new_match_status=1;
            }

            $accept_update_data['match_remain_num']=$new_accept_match_remain_num;
            $accept_update_data['match_status']=$new_match_status;

            $r[] = M('order_accept')
                ->where(array('accept_id' => $accept_id))
                ->save($accept_update_data);

            if (!in_array(false, $r)) {
                M()->commit();
            } else {
                M()->rollback();
                \Think\Log::write('自动检查处理超时未付款的匹配失败:'.$match_id);
                continue; //处理失败的话,继续下一个
            }


        }

        exit('任务结束');
    }



}