<?php


namespace Home\Model;

use Think\Model;

class OrderMatchModel extends Model
{
    //获取单个信息,参数为数组
    public function getSingle($paras)
    {


    }

    //获取列表信息 参数为数组
    public function getList($paras)
    {
        $sql =
            "select A.*,D.name as offer_name ,D.family_name as offer_family_name ,D.user_id as offer_user_id,
                  E.name  as accept_name ,E.family_name as accept_family_name,E.user_id as accept_user_id
from t_order_match A
inner join t_order_offer B on A.offer_id =B.offer_id
inner join t_order_accept C on A.accept_id=C.accept_id
inner join t_user D on B.user_id=D.user_id
inner join t_user E on C.user_id=E.user_id
where  A.status=1";

        if (!empty($paras['offer_id'])) {
            $sql = $sql . " and A.offer_id=" . $paras['offer_id'];
        }

        if (!empty($paras['accept_id'])) {
            $sql = $sql . " and A.accept_id=" . $paras['accept_id'];
        }

        $sql = $sql . " order by A.match_time desc ";

        if (!empty($paras['page'])) {
            $sql = $sql . " limit " . $paras['page']->firstRow . "," . $paras['page']->listRows;

        }

        return $this->query($sql);
    }

    //确认收款:
    public function confirm_money($data)
    {

        //获取该match对应的信息
        $match_result = M('order_match')->where(array('match_id' => $data['match_id']))->find();
        $offer_id = $match_result['offer_id'];
        $accept_id = $match_result['accept_id'];

        //获取该match对应的提供资助信息
        $offer_result = M('order_offer')->where(array('offer_id' => $offer_id))->find();

        //获取该match对应的接收资助信息
        $accept_result = M('order_accept')->where(array('accept_id' => $accept_id))->find();

        //开启事务
        M()->startTrans();

        //先把确认收款信息更新到match表
        $update_match_data['confirm_status'] = 1;
        $update_match_data['confirm_time'] = time();

        $r[] = M('order_match')
            ->where(array('match_id' => $data['match_id']))
            ->save($update_match_data);


        //更新该match对应的offer表信息
        if ($offer_result['confirm_remain_num'] - $match_result['match_num'] == 0) {
            $update_offer_data['confirm_status'] = 2;
        } else {
            $update_offer_data['confirm_status'] = 1;
        }
        //更新剩余金额
        $update_offer_data['confirm_remain_num'] = $offer_result['confirm_remain_num'] - $match_result['match_num'];

        $r[] = M('order_offer')
            ->where(array('offer_id' => $offer_id))
            ->save($update_offer_data);


        //更新该match对应的accept表信息
        if ($accept_result['confirm_remain_num'] - $match_result['match_num'] == 0) {
            $update_accept_data['confirm_status'] = 2;
        } else {
            $update_accept_data['confirm_status'] = 1;
        }

        $update_accept_data['confirm_remain_num'] = $accept_result['confirm_remain_num'] - $match_result['match_num'];
        $r[] = M('order_accept')
            ->where(array('accept_id' => $accept_id))
            ->save($update_accept_data);

        //更新offer人对应的货币数量
        $offer_get_money = $this->calc_offer_user_get($match_result['match_num'], $offer_result['community_id'], $offer_result['user_id'], $offer_id);
        $currency_id = 5; //定义货币类型
        $r[] = M('user_currency')
            ->where(array('user_id' => $offer_result['user_id'], 'currency_id' => $currency_id))
            ->setInc('num', $offer_get_money + $match_result['match_num']);

        //增加offer人对应的货币明细记录

        $detail_data['user_id'] = $offer_result['user_id'];
        $detail_data['currency_id'] = $currency_id;
        $detail_data['detail_type'] = 1;
        $detail_data['detail_num'] = $offer_get_money;
        $detail_data['create_time'] = time();
        $detail_data['handle_type'] = '出局钱包收入';
        $detail_data['remark'] = '出局确认收款';
        $r[] = M('user_currency_detail')->add($detail_data);



        //计算各级返佣金，并插入到各个上级的货币总数 ， 以及增加对应货币的财务明细表
        $level_currency_id = 4; //定义货币类型为管理钱包
        $level_retult = $this->calc_level_get_money($match_result['match_num'], $offer_result['user_id']);

        //总共6代返佣
        for ($x = 1; $x <= 6; $x++) {
            //如果该数组下标不为空
            if (!empty($level_retult['level_' . $x . '_user_id']) &&  $level_retult['level_' . $x . '_money']>0) {

                $r[] = M('user_currency')
                    ->where(array('user_id' => $level_retult['level_' . $x . '_user_id'], 'currency_id' => $level_currency_id))
                    ->setInc('num', $level_retult['level_' . $x . '_money']);

                //增加offer人对应的货币明细记录

                $detail_data_level['user_id'] = $level_retult['level_' . $x . '_user_id'];
                $detail_data_level['currency_id'] = $level_currency_id;
                $detail_data_level['detail_type'] = 1;
                $detail_data_level['detail_num'] = $level_retult['level_' . $x . '_money'];
                $detail_data_level['create_time'] = time();
                $detail_data_level['handle_type'] = '管理钱包收入';
                $detail_data_level['remark'] = '下级确认收款返佣';
                $r[] = M('user_currency_detail')->add($detail_data_level);
            }
        }

        //判读是否对该提供资助的人进行封号处理
        //为1表示要进行封号处理
        if ($data['lock_accept_user'] == 1) {
            $update_user_data['use_yn'] = 'N';
            $r[] = M('user')
                ->where(array('user_id' => $accept_result['user_id']))
                ->save($update_user_data);
        }


        if (!in_array(false, $r)) {
            M()->commit();

            //发送短信
            //$sendsms = new \Common\Util\Sendsms();
            //$sendsms->sand_sms('',$offer_result['user_id'],$content);

            return true;
        } else {
            M()->rollback();
            return false;
        }

    }

    //计算各级返佣金额
    private function  calc_level_get_money($offer_get_money, $user_id)
    {
        $final_result[] = null;
        $result_rebate = M('rebate')->find();

        $where_level['user_id'] = $user_id;

        //level-1
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_1_user_id'] = $result_level['p_id'];
            $final_result['level_1_money'] = $offer_get_money * $result_rebate['level_1_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }
        //level-2
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_2_user_id'] = $result_level['p_id'];
            $final_result['level_2_money'] = $offer_get_money * $result_rebate['level_2_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }

        //level-3
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_3_user_id'] = $result_level['p_id'];
            $final_result['level_3_money'] = $offer_get_money * $result_rebate['level_3_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }

        //level-4
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_4_user_id'] = $result_level['p_id'];
            $final_result['level_4_money'] = $offer_get_money * $result_rebate['level_4_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }

        //level-5
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_5_user_id'] = $result_level['p_id'];
            $final_result['level_5_money'] = $offer_get_money * $result_rebate['level_5_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }

        //level-6
        $result_level = M('user')->where($where_level)->field('p_id')->find();
        if ($result_level !== null && $result_level !== false && $result_level['p_id'] > 0) {
            $final_result['level_6_user_id'] = $result_level['p_id'];
            $final_result['level_6_money'] = $offer_get_money * $result_rebate['level_6_rate'];
            $where_level['user_id'] = $result_level['p_id'];
        } else {
            return $final_result;
        }

        return $final_result;

    }

    //计算提供资助人的收益
    private function  calc_offer_user_get($match_num, $community_id, $offer_user_id, $offer_id)
    {
        $where_com['community_id'] = $community_id;
        $result_com = M('community')->where($where_com)->find();
        $rate_round = $result_com['rate_round'];
        $get_rate_before = $result_com['get_rate_before'];
        $get_rate_after = $result_com['get_rate_after'];
        $calc_rate = 0;
        //0表示所有收益都一样,就用地一个收益率来计算
        if ($rate_round == 0) {
            $calc_rate = $get_rate_before;
        } else {
            //非0的话,必须判断该用户,这是第几轮提供资助
            $where_offer_count['user_id'] = $offer_user_id;
            $where_offer_count['status'] = 1;
            $where_offer_count['offer_id'] = array('ELT', $offer_id);

            $model = M('order_offer');
            $count = $model->field('offer_id')->where($where_offer_count)->count();

            if ($count <= $rate_round) {
                $calc_rate = $get_rate_before;
            } else {
                $calc_rate = $get_rate_after;
            }

        }

        //计算该提供资助该获得的金额
        $get_money = $match_num * $calc_rate;

        return $get_money;
    }

    //开始匹配 ,从提供资助去匹配接收资助
    public function  match_from_offer_to_accept($paras)
    {
        //默认返回
        $result_final['code'] = 1;//失败
        $result_final['info'] = '处理失败';
        //首先再次检测该匹配的状态,如果全部匹配,则返回操作失败
        $where_offer['offer_id'] = $paras['offer_id'];
        $where_offer['status'] = 1;
        $where_offer['match_status'] = array('NEQ', 2);
        $where_offer['pay_status'] = array('NEQ', 2);//这条件最好也加上,不能是完全付款的
        $where_offer['confirm_status'] = array('NEQ', 2);//这条件最好也加上,不能是完全确认的
        $result_offer = M('order_offer')->where($where_offer)->find();
        if ($result_offer == false || $result_offer == null) {
            return $result_final;
        }

        $offer_match_remain_num = $result_offer['match_remain_num']; //该提供资助需要匹配的金额
        $community_id = $result_offer['community_id'];//社区
        $user_id = $result_offer['user_id'];//提供资助的会员 ,后续不能匹配自己的接收资助

        $result_accept = $this->find_accept_record($community_id, $user_id, $offer_match_remain_num); //寻找
        //查找失败
        if ($result_accept == false) {
            $result_final['code'] = 2;//失败
            $result_final['info'] = '未找到合适的接收资助进行匹配';
            return $result_final;
        }

        $handle_flag = true; //处理结果标志
        //循环找到的需要处理的接收资助,进行匹配
        foreach ($result_accept as $k => $val) {
            $accept_id = $val['accept_id'];
            $accept_match_remain_num = $val['match_remain_num']; //该接收资助目前剩余的可匹配金额

            //本次匹配金额
            //$match_num = 0;
            //如果需要匹配的金额大于等于该接受资助能提供的金额
            //那么, 匹配金额 就是接收资助的剩余匹配金额
            //否则,匹配金额就是提供资助的剩余未匹配金额
            if ($offer_match_remain_num >= $accept_match_remain_num) {
                $match_num = $accept_match_remain_num;
            } else {
                $match_num = $offer_match_remain_num;
            }

            //剩余匹配金额
            //计算新的offer表的剩余匹配金额
            $offer_new_match_remain_num=$offer_match_remain_num-$match_num;

            //重新赋值给该offer的最新剩余金额,因为下次循环要用到该值啊
            $offer_match_remain_num =$offer_new_match_remain_num;

            //重新计算匹配状态
            if($offer_new_match_remain_num==0){
                $offer_match_status=2;
            }
            else{
                $offer_match_status=1;
            }

            //计算新的accept表的剩余匹配金额
            $accept_new_match_remain_num=$accept_match_remain_num-$match_num;
            //重新计算匹配状态
            if($accept_new_match_remain_num==0){
                $accept_match_status=2;
            }
            else{
                $accept_match_status=1;
            }

            //开启事务
            M()->startTrans();

            //给match表增加记录
            $data_match['offer_id'] = $paras['offer_id'];
            $data_match['accept_id'] = $accept_id;
            $data_match['match_num'] = $match_num;
            $data_match['match_time'] = time();
            $data_match['max_pay_time'] =$this->calc_max_pay_time($community_id); //计算出最晚付款时间
            $r[] = M('order_match')->add($data_match);

            //更新相应的offer表的字段状态
            $update_offer_where['offer_id']=$paras['offer_id'];
            $update_offer_data['match_remain_num']=$offer_new_match_remain_num;
            $update_offer_data['match_status']=$offer_match_status;
            $r[] = M('order_offer')
                ->where($update_offer_where)
                ->save($update_offer_data);


            //更新相应的accept表的字段状态
            $update_accept_where['accept_id']=$accept_id;
            $update_accept_data['match_remain_num']=$accept_new_match_remain_num;
            $update_accept_data['match_status']=$accept_match_status;
            $r[] = M('order_accept')
                ->where($update_accept_where)
                ->save($update_accept_data);

            if (!in_array(false, $r)) {
                M()->commit();

                //发送短信
                $sendsms = new \Common\Util\Sendsms();
                $content="亲爱的会员，您申请的订单已成功匹配，请登录系统后台查看处理，任何人索要验证码的都不要给他，请勿轻信系统以外的信息。";
                $sendsms->sand_sms('',$user_id,$content);
                $sendsms->sand_sms('',$val['user_id'],$content);

                $handle_flag = true;

            } else {
                M()->rollback();
                $handle_flag = false;
                break; //如果失败了,退出循环
            }

        }


        if ($handle_flag == true) {
            $result_final['code'] = 0;//失败
            $result_final['info'] = '匹配处理成功';
        }
        return $result_final;

    }

    //计算出最后确认收款时间
    private function  calc_max_pay_time($community_id){
        $where['community_id']=$community_id;
        $com_result=M('community')->where($where)->find();
        $max_day=$com_result['pay_day_max'];

        return  strtotime( "+".$max_day ." day");

    }



    //寻找合适匹配的接收资助记录
    private function find_accept_record($community_id, $user_id, $offer_match_remain_num)
    {
        $where_find_accept['community_id'] = $community_id;
        $where_find_accept['user_id'] = array('NEQ', $user_id);
        $where_find_accept['match_status'] = array('NEQ', 2);
        $where_find_accept['confirm_status'] = array('NEQ', 2);//这条件最好也加上,不能是完全确认的
        $orderby = 'queue_time asc';
        //把所有符合条件的都找出来
        $result_accept = M('order_accept')->where($where_find_accept)->order($orderby)->select();
        if ($result_accept == null || $result_accept == false) {
            return false;
        }

        //最终要返回的合适要匹配的accept数组
        $result_final[] = null;

        $accept_num = 0;
        foreach ($result_accept as $k => $val) {
            //如果这些多个接收资助的钱,累加,当累加的金额等于大于该提供资助的钱时,就退出循环,后面的就不需要了
            if ($accept_num < $offer_match_remain_num) {
                //$result_final[$k]['accept_id']=$val['accept_id'];
                $result_final[$k] = $val;
                $accept_num = $accept_num + $val['match_remain_num'];
            } else {
                break;
            }

        }

        return $result_final;//返回数组
    }


    //寻找合适匹配的提供资助记录
    private function find_offer_record($community_id, $user_id, $accept_match_remain_num)
    {
        $where_find_offer['community_id'] = $community_id;
        $where_find_offer['user_id'] = array('NEQ', $user_id);
        $where_find_offer['match_status'] = array('NEQ', 2);
        $where_find_offer['confirm_status'] = array('NEQ', 2);//这条件最好也加上,不能是完全确认的
        $orderby = 'queue_time asc';
        //把所有符合条件的都找出来
        $result_offer = M('order_offer')->where($where_find_offer)->order($orderby)->select();
        if ($result_offer == null || $result_offer == false) {
            return false;
        }

        //最终要返回的合适要匹配的accept数组
        $result_final[] = null;

        $offer_num = 0;
        foreach ($result_offer as $k => $val) {
            //如果这些多个接收资助的钱,累加,当累加的金额等于大于该提供资助的钱时,就退出循环,后面的就不需要了
            if ($offer_num < $accept_match_remain_num) {
                //$result_final[$k]['accept_id']=$val['accept_id'];
                $result_final[$k] = $val;
                $offer_num = $offer_num + $val['match_remain_num'];
            } else {
                break;
            }

        }

        return $result_final;//返回数组
    }



    //开始匹配 ,从接收资助去匹配提供资助
    public function  match_from_accept_to_offer($paras)
    {
        //默认返回
        $result_final['code'] = 1;//失败
        $result_final['info'] = '处理失败';
        //首先再次检测该匹配的状态,如果全部匹配,则返回操作失败
        $where_accept['accept_id'] = $paras['accept_id'];
        $where_accept['status'] = 1;
        $where_accept['match_status'] = array('NEQ', 2);
        $where_accept['confirm_status'] = array('NEQ', 2);//这条件最好也加上,不能是完全确认的
        $result_accept = M('order_accept')->where($where_accept)->find();
        if ($result_accept == false || $result_accept == null) {
            return $result_final;
        }

        $accept_match_remain_num = $result_accept['match_remain_num']; //该接收资助需要匹配的金额
        $community_id = $result_accept['community_id'];//社区
        $user_id = $result_accept['user_id'];//接收资助的会员 ,后续不能匹配自己的提供资助

        $result_offer = $this->find_offer_record($community_id, $user_id, $accept_match_remain_num); //寻找


        //查找失败
        if ($result_offer == false) {
            $result_final['code'] = 2;//失败
            $result_final['info'] = '未找到合适的提供资助进行匹配';
            return $result_final;
        }

        $handle_flag = true; //处理结果标志
        //循环找到的需要处理的接收资助,进行匹配
        foreach ($result_offer as $k => $val) {
            $offer_id = $val['offer_id'];
            $offer_match_remain_num = $val['match_remain_num']; //该提供资助目前剩余的可匹配金额

            //本次匹配金额
            //如果需要匹配的金额大于等于该提供资助能提供的金额
            //那么, 匹配金额 就是提供资助的剩余匹配金额
            //否则,匹配金额就是接收资助的剩余未匹配金额
            if ( $accept_match_remain_num >=$offer_match_remain_num ) {
                $match_num = $offer_match_remain_num;
            } else {
                $match_num = $accept_match_remain_num;
            }

            //剩余匹配金额

            //计算新的accept表的剩余匹配金额
            $accept_new_match_remain_num=$accept_match_remain_num-$match_num;

            //重新赋值给该offer的最新剩余金额,因为下次循环要用到该值啊
            $accept_match_remain_num =$accept_new_match_remain_num;

            //重新计算匹配状态
            if($accept_new_match_remain_num==0){
                $accept_match_status=2;
            }
            else{
                $accept_match_status=1;
            }

            //计算新的offer表的剩余匹配金额
            $offer_new_match_remain_num=$offer_match_remain_num-$match_num;

            //重新计算匹配状态
            if($offer_new_match_remain_num==0){
                $offer_match_status=2;
            }
            else{
                $offer_match_status=1;
            }


            //开启事务
            M()->startTrans();

            //给match表增加记录
            $data_match['offer_id'] = $offer_id;
            $data_match['accept_id'] = $paras['accept_id'];
            $data_match['match_num'] = $match_num;
            $data_match['match_time'] = time();
            $data_match['max_pay_time'] =$this->calc_max_pay_time($community_id); //计算出最晚付款时间
            $r[] = M('order_match')->add($data_match);


            //更新相应的accept表的字段状态
            $update_accept_where['accept_id']=$paras['accept_id'];
            $update_accept_data['match_remain_num']=$accept_new_match_remain_num;
            $update_accept_data['match_status']=$accept_match_status;
            $r[] = M('order_accept')
                ->where($update_accept_where)
                ->save($update_accept_data);

            //更新相应的offer表的字段状态
            $update_offer_where['offer_id']=$offer_id;
            $update_offer_data['match_remain_num']=$offer_new_match_remain_num;
            $update_offer_data['match_status']=$offer_match_status;
            $r[] = M('order_offer')
                ->where($update_offer_where)
                ->save($update_offer_data);

            if (!in_array(false, $r)) {
                M()->commit();

                //发送短信
                $sendsms = new \Common\Util\Sendsms();
                $content="亲爱的会员，您申请的订单已成功匹配，请登录系统后台查看处理，任何人索要验证码的都不要给他，请勿轻信系统以外的信息。";
                $sendsms->sand_sms('',$user_id,$content);
                $sendsms->sand_sms('',$val['user_id'],$content);

                $handle_flag = true;

            } else {
                M()->rollback();
                $handle_flag = false;
                break; //如果失败了,退出循环
            }

        }


        if ($handle_flag == true) {
            $result_final['code'] = 0;//失败
            $result_final['info'] = '匹配处理成功';
        }
        return $result_final;

    }


}

?>