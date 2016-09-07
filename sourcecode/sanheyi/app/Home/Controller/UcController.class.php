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

class UcController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //财务明细
    public function detail()
    {
        $where['user_id'] = $_SESSION['user']['user_id'];
        $where['currency_id'] = 1; //善种子
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['szz_num'] = (int)$result['num'];
        } else {
            $show_data['szz_num'] = 0;
        }


        $where['currency_id'] = 2; //善心币
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['sxb_num'] = (int)$result['num'];
        } else {
            $show_data['sxb_num'] = 0;
        }

        $where['currency_id'] = 3; //善金币
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['sjb_num'] = (int)$result['num'];
        } else {
            $show_data['sjb_num'] = 0;
        }

        $where['currency_id'] = 4; //管理钱包
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['glqb_num'] = $result['num'];
        } else {
            $show_data['glqb_num'] = 0;
        }

        $where['currency_id'] = 5; //出局钱包
        $para['where'] = $where;
        $result = D('user_currency')->getSingle($para);
        if ($result !== false && $result !== null) {
            $show_data['cjqb_num'] = $result['num'];
        } else {
            $show_data['cjqb_num'] = 0;
        }

        $this->assign('show_data', $show_data);
        $this->display();
    }

    //转善种子
    public function sendSZZ()
    {
        $this->display();
    }

    public function sendSZZDo()
    {

    }

    //转善心币
    public function sendSXB()
    {
        $this->display();
    }

    public function sendSXBDo()
    {

    }

    //管理钱包，即奖金
    public function manager_money()
    {
        $this->display();
    }

    //收入明细
    public function in_detail()
    {
        $conditionData['detail_type'] = 1;
        $conditionData['user_id'] = $_SESSION['user']['user_id'];

        $model = M('user_currency_detail');
        $total = $model->field('detail_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);

        $paras['detail_type']=1;
        $paras['user_id']=$_SESSION['user']['user_id'];
        $paras['page']=$Page;

        $list=D('UserCurrencyDetail')->getList($paras);

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

        $paras['detail_type']=2;
        $paras['user_id']=$_SESSION['user']['user_id'];
        $paras['page']=$Page;

        $list=D('UserCurrencyDetail')->getList($paras);

        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

    //动态获取该用户当前该货币的数量
    public function ajxgettypecurrency()
    {

    }
}