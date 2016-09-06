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

class CommunityController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    //社区列表
    public  function  community_list(){
        $this->display();
    }

    //社区选择界面=提供资助用
    public  function  community_select_offer(){
        $this->display();
    }

    //社区选择界面=接受资助用
    public  function  community_select_accept(){
        $this->display();
    }

}