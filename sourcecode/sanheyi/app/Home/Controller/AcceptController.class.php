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

class AcceptController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //发起接受资助
    public function sendAccept(){
        $community_id = I('get.id');

        //获取社区信息
        if (!empty($community_id)) {
            $where['community_id'] = $community_id;
            $where['is_open'] = 1;
            $where['use_yn'] = 'Y';
            $result = M('community')->where($where)->find();
            if ($result !== false && $result !== null) {

                //获取当前用户的出局钱包金额
                $where_self['currency_id'] = 5; //
                $where_self['user_id'] = $_SESSION['user']['user_id'];
                $para['where'] = $where_self;
                $result_self = D('user_currency')->getSingle($para);
                if ($result_self !== false && $result_self !== null) {
                    $cjqb = (int)$result_self['num'];
                } else {
                    $cjqb = 0;
                }

                $this->assign('community_id', $community_id);//社区id
                $this->assign('name', $result['name']);//社区名称
                $this->assign('need_SXB', $result['offer_need_sxb']);//该提供资助需要的善心币数量,目前的设置刚好和社区id一样
                $this->assign('cjqb', $cjqb);//目前帐号拥有的善心币数量

                $this->display();
            }
            else{
                exit('不存在的社区');
            }
        } else {
            exit('非法进入');
        }
    }

    public function sendAcceptDo(){

        $data=I('post.');
        //先判断是否有正在进行的接收帮助,如果有,则返回错误,进行中的接收帮助只能有一个(一个社区中)
        $where_check_accept['user_id']=$_SESSION['user']['user_id'];
        $where_check_accept['confirm_status'] =array('NEQ',2);
        $where_check_accept['community_id'] =$data['community_id'];
        $where_check_accept['status'] =1;
        $check_result=M('order_accept')->where($where_check_accept)->find();
        if($check_result!==null && $check_result !==false){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '只能有一个进行中接收资助!'));
        }

        //先获取社区资料,各种参数

        $where['community_id'] = $data['community_id'];
        $where['is_open'] = 1;
        $where['use_yn'] = 'Y';
        $comunity_result = M('community')->where($where)->find();
        if ($comunity_result == false || $comunity_result == null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', '社区信息不正确!'));
        }

        //先判断金额
        if($data['num']< $comunity_result['offer_money_min'] || $data['num']> $comunity_result['offer_money_max']){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0002', '接收资助的金额不在该社区的范围!'));
        }

        if($data['num']%$comunity_result['must_mult']!=0){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '接收资助的金额不符合规范!'));
        }

        //提供的金额不能大于出局钱包现有的金额
        $where_self['currency_id'] = 5; //
        $where_self['user_id'] = $_SESSION['user']['user_id'];
        $para['where'] = $where_self;
        $result_self = D('user_currency')->getSingle($para);
        if ($result_self !== false && $result_self !== null) {
            $cjqb = (int)$result_self['num'];
        } else {
            $cjqb = 0;
        }

        if($cjqb<$data['num']){
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0003', '接收资助的金额不能大于出局钱包的余额!'));
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

        //以上都没问题,那么可以开始存储了

        //生成accept记录
        $data_accept['user_id']=$_SESSION['user']['user_id'];
        $data_accept['community_id']=$data['community_id'];
        $data_accept['total_num']=$data['num'];
        $data_accept['match_remain_num']=$data['num'];
        $data_accept['pay_remain_num']=$data['num'];
        $data_accept['confirm_remain_num']=$data['num'];
        $data_accept['create_time']=time();
        $data_accept['queue_time']=$data_accept['create_time'];
        $add_result= M('order_accept')->add($data_accept);

        if ($add_result) {
            $return_data['url']= U('accept/acceptlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }


    }

    public function acceptlist(){

        $conditionData['status'] = 1;
        $conditionData['user_id'] = $_SESSION['user']['user_id'];

        $model = M('order_accept');
        $total = $model->field('accept_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['user_id']=$_SESSION['user']['user_id'];
        $paras['page']=$Page;

        $list=D('OrderAccept')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

}