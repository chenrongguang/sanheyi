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

class CurrencyController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //充值
    public function  recharge(){
        $this->display();
    }

    public function  rechargeDo(){
        $data=I('post.');

        //开启事务
        M()->startTrans();

        //先给充值记录表加记录
        $data_recharge['create_user']=$_SESSION['admin']['id'];
        $data_recharge['create_time']=time();
        $data_recharge['user_id']=$data['user_id'];
        $data_recharge['num']=$data['num'];
        $data_recharge['currency_id']=$data['currency_id'];
        $r[] = M('recharge')->add($data_recharge);

        //给会员的总货币数量更新
        $where_user_currency['user_id']=$data['user_id'];
        $where_user_currency['currency_id']=$data['currency_id'];
        $r[] = M('user_currency')
            ->where($where_user_currency)
            ->setInc('num', $data['num']);

        //给会员的货币明细表添加记录
        $detail_data['user_id']= $data['user_id'];
        $detail_data['currency_id']=$data['currency_id'];
        $detail_data['detail_type']=1;
        $detail_data['detail_num']= $data['num'];
        $detail_data['create_time']=time();
        $detail_data['handle_type']='管理员充值';
        $detail_data['remark']='管理员充值';
        $r[] = M('user_currency_detail')->add($detail_data);

        if (!in_array(false, $r)) {
            M()->commit();
            $return_data['url']= U('currency/rechargelist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));

        } else {
            M()->rollback();
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0003','处理失败,请重试!'));
        }

    }

    //充值记录
    public function  rechargelist(){

        $model = M('recharge');
        $total = $model->field('id')->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['page']=$Page;

        $list=D('Home/Currency')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

}