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

class PublicController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    public  function  footer(){
       $this->display();
    }
    public  function  header(){
        $this->display();
    }
    public  function menu(){
        $this->display();
    }

    //上传图片
    public  function  uploadimg(){

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

            $mag = array('error' => false, 'message' => '上传成功',  'url' => $info['Filedata']['view_url']);

            $mag['error'] = 0;
        }

        $this->ajaxReturn($mag);
    }

}