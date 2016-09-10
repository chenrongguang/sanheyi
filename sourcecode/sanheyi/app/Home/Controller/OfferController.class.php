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

class OfferController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //发起提供资助
    public function sendOffer()
    {
        $community_id = I('get.id');

        //获取社区信息
        if (!empty($community_id)) {
            $where['community_id'] = $community_id;
            $where['is_open'] = 1;
            $where['use_yn'] = 'Y';
            $result = M('community')->where($where)->find();
            if ($result !== false && $result !== null) {

                //获取当前用户的善心币数量
                $where_self['currency_id'] = 2; //善心币
                $para['where'] = $where_self;
                $result_self = D('user_currency')->getSingle($para);
                if ($result_self !== false && $result_self !== null) {
                    $my_SXB = (int)$result_self['num'];
                } else {
                    $my_SXB = 0;
                }

                $this->assign('community_id', $community_id);//社区id
                $this->assign('name', $result['name']);//社区名称
                $this->assign('need_SXB', $result['offer_need_sxb']);//该提供资助需要的善心币数量,目前的设置刚好和社区id一样
                $this->assign('my_SXB', $my_SXB);//目前帐号拥有的善心币数量

                $this->display();
            }
            else{
                exit('不存在的社区');
            }
        } else {
            exit('非法进入');
        }
    }

    public function sendOfferDo()
    {
       //先获取社区资料,各种参数
        $data=I('post.');
        $where['community_id'] = $data['community_id'];
        $where['is_open'] = 1;
        $where['use_yn'] = 'Y';
        $comunity_result = M('community')->where($where)->find();
        if ($comunity_result == false || $comunity_result == null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '社区信息不正确!'));
        }

        //先判断金额
        if($data['num']< $comunity_result['offer_money_min'] || $data['num']> $comunity_result['offer_money_max']){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '提供资助的金额不在该社区的范围!'));
        }

        if($data['num']%$comunity_result['must_mult']!=0){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '提供资助的金额不符合规范!'));
        }

        //再判断密码
        $high_pwd = $data['high_pwd'];
        $where_user['user_id'] = $_SESSION['user']['user_id'];
        $where_user['use_yn'] = 'Y';
        $paras['where'] = $where_user;
        $user_data = D('user')->getSingle($paras);
        if (md5($high_pwd) != $user_data['high_pwd']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0004', '你输入的二级密码不正确'));
        }

        //先判断自己的善心币数量,是否够的
        //获取当前会员的善心币
        $currency_id=2;
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
        if ($num < $data['need_SXB']) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '你的善心币数量不足,请购买!'));
        }

        //以上都没问题,那么可以开始存储了

        //开启事务
        M()->startTrans();

        //生成offer记录
        $data_offer['user_id']=$_SESSION['user']['user_id'];
        $data_offer['community_id']=$data['community_id'];
        $data_offer['num']=$data['num'];
        $data_offer['match_remain_num']=$data['num'];
        $data_offer['pay_remain_num']=$data['num'];
        $data_offer['confirm_remain_num']=$data['num'];

        $data_offer['create_time']=time();

        $data_offer['queue_time']=$data_offer['create_time'];
       // $data_offer['min_match_time']=$data['community_id']; //匹配最早时间和最晚时间,暂时先不存
       // $data_offer['max_match_time']=$data['community_id'];
        $r[] = M('order_offer')->add($data_offer);


        //更新用户的货币数量
        $r[] = M('user_currency')
            ->where(array('user_id' => $_SESSION['user']['user_id'],'currency_id'=>$currency_id))
            ->setDec('num', $data['need_SXB']);

        //增加记录货币明细
        $detail_data['user_id']= $_SESSION['user']['user_id'];
        $detail_data['currency_id']=$currency_id;
        $detail_data['detail_type']=2;
        $detail_data['detail_num']= $data['need_SXB']*-1;
        $detail_data['create_time']=time();
        $detail_data['handle_type']='支出善心币';
        $detail_data['remark']='提供资助';
        $r[] = M('user_currency_detail')->add($detail_data);

        if (!in_array(false, $r)) {
            M()->commit();
            $return_data['url']= U('offer/offerlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }

    }

    public function offerlist()
    {

        $confirm_status = I('get.confirm_status');

        if (empty($confirm_status)) {
            $conditionData['confirm_status'] = array('NEQ', 2);
        } else {
            $conditionData['confirm_status'] = array('EQ', $confirm_status);
        }

        $conditionData['status'] = 1;
        $conditionData['user_id'] = $_SESSION['user']['user_id'];

        $model = M('order_offer');
        $total = $model->field('offer_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        if (empty($confirm_status)) {
            $paras['confirm_status'] = -1;
        } else {
            $paras['confirm_status'] = $confirm_status;
        }

        $paras['user_id'] = $_SESSION['user']['user_id'];
        $paras['page'] = $Page;

        $list = D('OrderOffer')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }


    //取消提供
    public function canceloffer()
    {


    }

    public function cancelofferDo()
    {


    }
}