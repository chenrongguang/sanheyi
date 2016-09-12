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

class AcceptController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //批量匹配
    public function  run_match_mult_Do(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $accept_ids = $post['accept_ids'];

        $arr = explode(',', $accept_ids);

        foreach ($arr as $k => $val) {
            $accept_id = $val;
            $paras['accept_id'] = $accept_id;

            //返回的是数组 ,里边包括code和info,code为0表示成功,为1表示失败
            D('Home/OrderMatch')->match_from_accept_to_offer($paras); //不管返回了成功还是失败,都要继续进行

        }

        //都返回处理成功
        $return_data['url'] = U('accept/acceptlist', array('community_id' => $post['community_id'], 'match' => $post['match']));
        $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '批量匹配成功', $return_data));

    }

    //单个匹配
    public function  run_match_single_Do(){
        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $accept_id = $post['accept_id'];
        $paras['accept_id'] = $accept_id;

        //返回的是数组 ,里边包括code和info,code为0表示成功,为1表示失败
        $result = D('Home/OrderMatch')->match_from_accept_to_offer($paras);
        if ($result['code'] == 0) {
            $return_data['url'] = U('accept/acceptlist', array('community_id' => $post['community_id'], 'match' => $post['match']));
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS', '0', '匹配成功', $return_data));
        } else {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL', '0001', $result['info']));
        }
    }


    public function acceptlist(){

        //接收参数
        $match = I('get.match');
        $community_id = I('get.community_id');
        if(empty($match)){
            $match=-1;
        }
        if(empty($community_id)){
            $community_id=-1;
        }

        //不为-1,则要加入查询条件
        if ($match==1) {
            //如果传入参数为1,表示未匹配,这时,对应的数据库是完全未匹配和部分未匹配
            $conditionData['match_status'] = array('ELT',1); //小于等于1
        } else if ($match==2) {
            $conditionData['match_status'] = $match; //表示完全匹配
        }

        //不为-1,就表示不是全部
        if ($community_id !=-1) {
            $conditionData['community_id'] =$community_id;
        }

        $conditionData['status'] = 1;

        $model = M('order_accept');
        $total = $model->field('accept_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);


        //不为-1,则要加入查询条件
        if ($match!=-1) {
            $paras['match_status'] = $match; //表示完全匹配
        }

        //不为-1,就表示不是全部
        if ($community_id !=-1) {
            $paras['community_id'] =$community_id;
        }

        $paras['page'] = $Page;

        $list = D('Home/OrderAccept')->getList_for_admin($paras);

        $show = $Page->show();

        $this->assign('match', $match);
        $this->assign('community_id', $community_id);
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }

    //提供资助的排队
    public function ajaxaccept_to_que(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $accept_id=$post['accept_id'];
        $type=$post['type']; //排队类型,1表示要排在最前面,2表示要排在最后面

        //首先获取该提供资助所在的社区
        $result_accept=M('order_accept')->where(array('accept_id'=>$accept_id))->field('community_id')->find();

        if($result_accept==false || $result_accept==null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','操作失败，请重试!'));
        }
        $comunity_id=$result_accept['community_id'];


        $model = M('order_accept');
        $conditionData['use_yn'] = 'Y';
        $conditionData['community_id'] = $comunity_id; //必须带上社区条件,因为是在该社区排队,不是针对所有的社区哦
        $conditionData['match_status'] = array('NEQ',2);//不是完全匹配的
        if($type==1){
            $orderby =' queue_time asc';
        }
        else if($type==2){
            $orderby =' queue_time desc';
        }

        $result = $model->where($conditionData)->order($orderby)->field('queue_time')->find();
        if($result==false || $result==null) {
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','处理失败，请重试!'));
        }

        //随便加减个数吧
        if($type==1){
            $new_queue_time  =$result['queue_time']-5;
        }
        else if($type==2){
            $new_queue_time  =$result['queue_time']+5;
        }

        $update_data['queue_time']=$new_queue_time;
        $update_where['accept_id']=$accept_id;
        $result_update=M('order_accept')->where($update_where)->save($update_data);
        if($result_update){
            //这里特殊的url,,因为前台必须拼参数了,所以不用u方法了
            //还原前台的查询条件
            $return_data['url']= U('accept/acceptlist',array('community_id'=>$post['community_id'],'match'=>$post['match']));
            //$return_data['url']= '/admin/offer/offerlist';
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','调整排队失败，请重试!'));
        }


    }


}