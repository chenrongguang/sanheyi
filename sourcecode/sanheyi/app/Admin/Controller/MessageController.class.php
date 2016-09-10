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


    //系统公告
    public  function  mess_list(){

        $conditionData['use_yn'] = 'Y';
        $conditionData['type'] = 0;

        $model = M('message');
        $total = $model->field('message_id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);
        $list = $model->field('message_id,title,content,create_time,use_yn')
            ->where($conditionData)
            ->order("message_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        //$show = $Page->showAjax("mainarea");
        $show = $Page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();
    }

    //查看某个公告的内容
    public  function  message_content(){
        $message_id=I('get.message_id');
        $where['message_id']=$message_id;
        $where['use_yn']='Y';
        $content='';

        $result=M('message')->where($where)->find();

        if($result!=false && $result!==null){
            $content=$result['content'];
        }
        $this->assign('content',$content);

        $this->display();
    }

    //系统公告
    public  function  mess_add(){

        $id=$_GET['message_id'];
        if(!empty($id)){
            //todo 表示是编辑
            $model = M('message');
            $conditionData['use_yn'] = 'Y';
            $conditionData['message_id'] = $id;
            $result= $model->where($conditionData)->find();
            if ($result!=false && $result !=null){
                $this->assign('show_data', $result);
            }
        }

        $this->display();

    }

    public  function  addDo(){

        $model = M('message');

        $post_data['message_id'] = I("post.message_id");
        //新增
        if(empty($post_data['message_id'])){
            $data['title'] = I("post.title");
            $data['content'] = I("post.content");
            $data['create_user'] = $_SESSION['admin']['id'];
            $data['create_time'] = strtotime(date("Y-m-d H:i:s",time()));
            $result = $model->add($data);
        }
        else{
            //编辑
            $data['title'] = I("post.title");
            $data['content'] = I("post.content");
            $where['message_id']= $post_data['message_id'];
            $result = $model->where($where)->save($data);

        }

        if($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $return_data['url']= U('message/mess_list');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','处理失败，请重试!'));
        }
    }


    public function ajaxmessdel(){

        $content = file_get_contents('php://input');
        $post = json_decode($content, true);
        $id=$post['messid'];

        if(empty($id)){
            //todo
        }
        $model = M('message');
        $conditionData['message_id'] = $id;
        $data['use_yn'] = 'N';
        $result = $model->where($conditionData)->save($data);
        if($result) {
            //$return_data['url']= '/home/message/messlist';
            $return_data['url']= U('message/mess_list');
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0002','删除失败，请重试!'));
        }
    }

}