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

class UcController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
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

}