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

class OfferController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //批量匹配
    public function  run_match_mult_Do(){

    }


    //单个匹配
    public function  run_match_single_Do(){

    }

    //排队到最前面
    public function ajx_que_firstDo(){

    }

    //排队到最后面
    public function ajx_que_lastDo(){

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