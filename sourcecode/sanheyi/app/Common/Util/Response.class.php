<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 统一返回
 */namespace Common\Util;

class Response  {

    /*
     * 统一输出
     */
    public  static  function get_response($flag ='SUCCESS',$code='0',$msg='',$data=[]){

        //如果消息为空，则根据code去获取
       if(empty($msg)){
           $msg= getmsgbycode($code);
       }

        $return = [
            'result' => $flag,
            'code' => $code,
            'msg' => $msg
        ];
        if (!empty($data) && is_array($data)) {
            $return['return_data'] = $data;
        }
        return $return;
   }

    private function getmsgbycode($code){
        //todo

        return '处理成功';

    }
}
