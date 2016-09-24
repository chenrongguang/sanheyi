<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 发送短信
 */namespace Common\Util;

class Sendsms  {

    public  function sand_sms($phone,$user_id,$content){
        //如果手机号为空,则根据用户去获取手机号
        if(empty($phone)){
            $result_user=M('user')->where(array('user_id'=>$user_id))->field('mobile')->find();
            if($result_user==false || $result_user==null ){
                return false;
            }
            $phone=$result_user['mobile'];
        }

        $result_config_code_name = M('config')->where(array('key' => 'CODE_NAME'))->field('value')->find();
        $result_config_code_user_name = M('config')->where(array('key' => 'CODE_USER_NAME'))->field('value')->find();
        $result_config_code_user_pass = M('config')->where(array('key' => 'CODE_USER_PASS'))->field('value')->find();
        $r = $this->sand($phone, $result_config_code_name['value'], $result_config_code_user_name['value'], $result_config_code_user_pass['value'],$content);
        if ($r != "短信发送成功") {
            return false;
        } else {
           return true;
        }
    }

    /** 短信认证
     * @param $phone 电话号码
     * @param $name  发送标题
     * @param $user  短息接口用户名
     * @param $pass  短信接口密码
     * @param $pass  短信内容
     * @return mixed 错误信息
     */
   private function sand($phone,$name,$user,$pass,$content){
        $statusStr = array(
            "0" => "短信发送成功",
            "-1" => "参数不全",
            "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
            "30" => "密码错误",
            "40" => "账号不存在",
            "41" => "余额不足",
            "42" => "帐户已过期",
            "43" => "IP地址限制",
            "50" => "内容含有敏感词",
            "100"=>'您操作太频繁，请稍后再试'
        );
        $smsapi = "http://api.smsbao.com/";
        $user = $user; //短信平台帐号
        $pass = md5($pass); //短信平台密码

        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
//     dump($user);dump($pass);dump($phone);dump($content);die;
        return $statusStr[$result];
    }

}
