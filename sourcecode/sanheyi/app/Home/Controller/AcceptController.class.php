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
        $this->display();
    }

    public function sendAcceptDo(){


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