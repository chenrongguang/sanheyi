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
            ->setInc('num', $offer_get_money);

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
        $level_currency_id=4; //定义货币类型为管理钱包
        $level_retult = $this->calc_level_get_money($offer_get_money, $offer_result['user_id']);

        //总共6代返佣
        for ($x = 1; $x <= 6; $x++) {
            //如果该数组下标不为空
            if(!empty($level_retult['level_'.$x.'_user_id'])){

                $r[] = M('user_currency')
                    ->where(array('user_id' => $level_retult['level_'.$x.'_user_id'], 'currency_id' => $level_currency_id))
                    ->setInc('num', $level_retult['level_'.$x.'_money']);

                //增加offer人对应的货币明细记录

                $detail_data_level['user_id'] = $level_retult['level_'.$x.'_user_id'];
                $detail_data_level['currency_id'] =  $level_currency_id;
                $detail_data_level['detail_type'] = 1;
                $detail_data_level['detail_num'] = $level_retult['level_'.$x.'_money'];
                $detail_data_level['create_time'] = time();
                $detail_data_level['handle_type'] = '管理钱包收入';
                $detail_data_level['remark'] = '下级确认收款返佣';
                $r[] = M('user_currency_detail')->add($detail_data_level);
            }
        }

        //判读是否对该提供资助的人进行封号处理
        //为1表示要进行封号处理
        if( $data['lock_accept_user']==1){
            $update_user_data['use_yn']='N';
            $r[] = M('user')
                ->where(array('user_id' =>  $accept_result['user_id']))
                ->save($update_user_data);
        }


        if (!in_array(false, $r)) {
            M()->commit();
            return true;
        } else {
            M()->rollback();
            return false;
        }

    }

    //计算各级返佣金额
    private function  calc_level_get_money($offer_get_money, $user_id)
    {
        $final_result[]=null;
        $result_rebate=M('rebate')->find();

        $where_level['user_id']=$user_id;

        //level-1
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_1_user_id']=$result_level['p_id'];
            $final_result['level_1_money']=$offer_get_money * $result_rebate['level_1_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
            return $final_result;
        }
        //level-2
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_2_user_id']=$result_level['p_id'];
            $final_result['level_2_money']=$offer_get_money * $result_rebate['level_2_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
            return $final_result;
        }

        //level-3
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_3_user_id']=$result_level['p_id'];
            $final_result['level_3_money']=$offer_get_money * $result_rebate['level_3_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
            return $final_result;
        }

        //level-4
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_4_user_id']=$result_level['p_id'];
            $final_result['level_4_money']=$offer_get_money * $result_rebate['level_4_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
            return $final_result;
        }

        //level-5
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_5_user_id']=$result_level['p_id'];
            $final_result['level_5_money']=$offer_get_money * $result_rebate['level_5_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
            return $final_result;
        }

        //level-6
        $result_level= M('user')->where($where_level)->field('p_id')->find();
        if($result_level!==null && $result_level !==false && $result_level['p_id']>0){
            $final_result['level_6_user_id']=$result_level['p_id'];
            $final_result['level_6_money']=$offer_get_money * $result_rebate['level_6_rate'] ;
            $where_level['user_id']=$result_level['p_id'];
        }
        else{
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

}

?>