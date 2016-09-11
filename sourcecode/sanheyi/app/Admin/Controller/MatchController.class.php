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

class MatchController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    public function matchlist()
    {

        $model = M('order_match');
        $total = $model->field('match_id')->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['page'] = $Page;

        $list = D('Home/OrderMatch')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

}