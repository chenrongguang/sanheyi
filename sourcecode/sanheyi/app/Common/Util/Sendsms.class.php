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
       // $r = $this->sand($phone, $result_config_code_name['value'], $result_config_code_user_name['value'], $result_config_code_user_pass['value'],$content);
        $r = $this->sand_huiyi($phone, $result_config_code_name['value'], $result_config_code_user_name['value'], $result_config_code_user_pass['value'],$content);
        if ($r != "短信发送成功") {
            return false;
        } else {
           return true;
        }
    }

    /**
     * @param $phone
     * @param $name
     * @param $user
     * @param $pass
     * @param $content
     * 慧亿短信
     */
    public function sand_huiyi($phone,$name,$user,$pass,$content){

        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
        $mobile = $phone;
        $mobile_code = $this->random(4,1);

        $post_data = "account=".$user."&password=".$pass."&mobile=".$mobile."&content=".rawurlencode($content);
//查看密码请登录用户中心->验证码、通知短信->帐户及签名设置->APIKEY
        $gets =  $this->xml_to_array($this->Post($post_data, $target));
        if($gets['SubmitResult']['code']==2){
            // $_SESSION['mobile'] = $mobile;
            // $_SESSION['mobile_code'] = $mobile_code;
            //session(array('name'=>'code','expire'=>600));
            //session('code',$mobile_code);  //设置session
            //session('time',time());
            //\Think\Log::write("conteent:".$content ." phone:". $phone ." msg:". $gets['SubmitResult']['msg']);
            return "短信发送成功";
        }
        else{
            return "短信发送失败:".$gets['SubmitResult']['msg'];
            \Think\Log::write("conteent:".$content ." phone:". $phone ." msg:". $gets['SubmitResult']['msg']);
        }

    }


  private  function Post($curlPost,$url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
    private  function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }
    private  function random($length = 6 , $numeric = 0) {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
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
