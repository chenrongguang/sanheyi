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

class PublicController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    private function  get_personinfo()
    {

        $where['user_id'] = $_SESSION['user']['user_id'];
        $para['where'] = $where;
        $result_self = D('user')->getSingle($para);

        $show_data['name'] = $result_self['name'];
        $show_data['family_name'] = $result_self['family_name'];
        $show_data['create_time'] = date('Y-m-d H:i:s', $result_self['create_time']);
        $show_data['last_ip'] = $result_self['last_ip'];

        if ($result_self['group'] == 0) {
            $show_data['group'] = '普通会员';
        } else {
            $show_data['group'] = '特困会员';
        }

        if ($result_self['act_status'] == 0) {
            $show_data['act_status'] = '未激活';
        } else {
            $show_data['act_status'] = '已激活';
        }

        if ($result_self['confirm_status'] == 0) {
            $show_data['confirm_status'] = '未审核';
        } else if ($result_self['confirm_status'] == 1) {
            $show_data['confirm_status'] = '等待审核';
        } else if ($result_self['confirm_status'] == 2) {
            $show_data['confirm_status'] = '已审核';
        } else if ($result_self['confirm_status'] == 3) {
            $show_data['confirm_status'] = '审核失败';
        }

        return $show_data;

    }

    private function  get_usercurrency()
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

        return $show_data;

    }

    private function  get_offer()
    {

        $Page = new \Common\Util\Pagebar(5, 5);
        $Page->firstRow = 0;
        $Page->listRows = 1;

        $paras['user_id'] = $_SESSION['user']['user_id'];
        $paras['page'] = $Page;

        $list = D('OrderOffer')->getList($paras);
        return $list;

    }

    private function  get_accept()
    {

        $Page = new \Common\Util\Pagebar(5, 5);
        $Page->firstRow = 0;
        $Page->listRows = 1;

        $paras['user_id'] = $_SESSION['user']['user_id'];
        $paras['page'] = $Page;

        $list = D('OrderAccept')->getList($paras);

        return $list;

    }


    private function get_message(){

        $conditionData['use_yn'] = 'Y';
        $conditionData['type'] =0;
        $model = M('message');
        $list = $model->field('message_id,title,content,create_time,use_yn')
            ->where($conditionData)
            ->order("message_id desc")
            ->limit(0 . ',' . 2)
            ->select();

        return  $list;

    }

    //登陆之后的首页
    public function main()
    {


        //以下获取个人信息:
        $person_info = $this->get_personinfo();

        //以下获取财务信息
        $user_currency = $this->get_usercurrency();

        //以下获取提供帮助
        $offer_list = $this->get_offer();

        //以下获取接收帮助
        $accept_list = $this->get_accept();

        //以下通知
        $message_list = $this->get_message();

        $this->assign('person_info', $person_info); //个人信息
        $this->assign('user_currency', $user_currency);//财务信息
        $this->assign('offer_list', $offer_list);//提供帮助列表,目前就取第一条
        $this->assign('accept_list', $accept_list);//提供帮助列表,目前就取第一条
        $this->assign('message_list', $message_list);//系统公告列表,目前就取前两条

       $this->display();
    }


    public function  footer()
    {
        $this->display();
    }

    public function  header()
    {
        $this->display();
    }

    public function menu()
    {
        $this->display();
    }

    //上传图片
    public function  uploadimg()
    {

        $upload = new \Think\Upload();
        $upType = C('UPLOADIFY_TYPE'); //允许上传的文件类型及大小定义等
        $upload->maxSize = $upType[$this->type]['size'];
        $upload->exts = $upType[$this->type]['exts'];
        $upload->rootPath = C('UPLOAD_SERVER_PATH');
        $upload->savePath = date('Y/m/d/');
        $upload->autoSub = false;

        $info = $upload->upload();

        if (!$info) {
            $mag = array('error' => true, 'message' => $upload->getError(), 'info' => null);//或 'message' =>$upload->getErrorMsg()
        } else {
            $info['Filedata']['view_url'] = C('UPLOAD_SERVER_URL') . $info['Filedata']['savepath'] . $info['Filedata']['savename']; //预览url
            $info['Filedata']['view_path'] = $info['Filedata']['view_url']; //预览路径

            $mag = array('error' => false, 'message' => '上传成功', 'url' => $info['Filedata']['view_url']);

            $mag['error'] = 0;
        }

        $this->ajaxReturn($mag);
    }

}