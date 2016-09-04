<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 网站公告 ，必须是富文本
 */

namespace Admin\Controller;
use Think\Controller;

class MessageController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    public  function  add(){
       $this->display();
    }
    public  function  messlist(){

        if ($_GET['keywords']) {
            $keywords = $_GET['keywords'];
            $conditionData['title'] = array('like', '%' . $keywords . '%');
        }

        $conditionData['use_yn'] = 'Y';

        $model = M('message');
        $total = $model->field('id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);
        $list = $model->field('id,title,content,create_time,use_yn')
            ->where($conditionData)
            ->order("id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        //$show = $Page->showAjax("mainarea");
        $show = $Page->show();

        $this->assign('keywords', $keywords);
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }
    public function edit(){
        $id=$_GET['messid'];
        if(empty($id)){
            //todo
        }

        $model = M('message');
        $conditionData['use_yn'] = 'Y';
        $conditionData['id'] = $id;
        $result= $model->where($conditionData)->find();
        if ($result!=false && $result !=null){
            $this->assign('result', $result);
        }
        else{
            //todo
        }

        $this->display();
    }

    public  function  addDo(){
        $model = M('message');

        $data['title'] = I("post.title");
        $data['img_url'] = I("post.upload_img");
        $data['create_time'] = strtotime(date("Y-m-d H:i:s",time()));

        $result = $model->add($data);
        if($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $return_data['url']= U('message/messlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','保存失败，请重试!'));
        }
    }

    public  function  editDO(){

        $model = M('message');

        $conditionData['id'] = I("post.mess_id");
        $data['title'] = I("post.title");
        $data['img_url'] = I("post.upload_img");

        $result = $model->where($conditionData)->save($data);
        if($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            //$return_data['url']= '/home/message/messlist';
            $return_data['url']= U('message/messlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','保存失败，请重试!'));
        }
    }

    public function delDo(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $id=$post['messid'];

        if(empty($id)){
            //todo
        }
        $model = M('message');
        $conditionData['id'] = $id;
        $data['use_yn'] = 'N';
        $result = $model->where($conditionData)->save($data);
        if($result) {
            //$return_data['url']= '/home/message/messlist';
            $return_data['url']= U('message/messlist');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','处理失败，请重试!'));
        }
    }

    //富文本编辑器
    public  function richtext(){
        $this->display();
    }

    //富文本编辑器保存
    public  function richtextDo(){
        $this->display();
    }


}