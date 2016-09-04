<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 通知工具类
 */namespace Common\Util;

class  Notify  {

    /*
     * 获取发送者
     */
    public  static  function getSender($type){
        $class  =   'Common\\Util\\'.ucwords(strtolower($type));
        return  new $class();
   }
}
