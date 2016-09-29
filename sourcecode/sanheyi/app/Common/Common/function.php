<?php
/**
 * Created by PhpStorm.
 * User: "姜鹏"
 * Date: 16-3-8
 * Time: 下午4:57
 */
/**
 * 格式化信息类型
 * @param $type 参数(信息类型的参数）
 * @return string 返回值 把数字类型的参数 转换成汉字类型
 *
 */
function message_format_type($type){
    switch($type){
        case 1:$name="";break;
    }
    return $name;
}


/**
 * 验证邮箱
 * @param $email
 * @return bool
 */
function checkEmail($email){
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if(preg_match($pattern, $email)){
        return true;
    }else{
        return false;
    }
}
/**
 * 验证手机号支持以下号段
 *      移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
电信：133、153、180、181、189 、177(4G)；
卫星通信：1349
虚拟运营商：170
 * @param $mobile
 * @return bool
 */
function checkMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/**
 * 截取字符串
 * @param $str
 * @param int $start
 * @param $length
 * @param string $charset
 * @param bool $suffix
 * @return string
 */

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
        $slice= mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        $slice= iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $fix='';
    if(strlen($slice) < strlen($str)){
        $fix='';
    }
    return $suffix ? $slice.$fix : $slice;
}


/**
 * 验证密码长度在6-20个字符之间
 * @param $pwd
 * @return bool
 */
function checkPwd($pwd){
    $pattern="/^[\\w-\\.]{6,20}$/";
    if(preg_match($pattern, $pwd)){
        return true;
    }else{
        return false;
    }
}


/**
 *  发送邮箱
 * @param String $emailHost 您的企业邮局域名
 * @param String $emailUserName 邮局用户名(请填写完整的email地址)
 * @param String $emailPassWord 邮局密码
 * @param String $formName 邮件发送者名称
 * @param String $email  收件人邮箱，收件人姓名
 * @param String $title	发送标题
 * @param String $body	发送内容
 * @return boolean
 */
function setPostEmail($emailHost,$emailUserName,$emailPassWord,$formName,$email,$title,$body) {
    // 以下内容为发送邮件
    require_once(APP_PATH.'/Common/Common/class.phpmailer.php');//下载的文件必须放在该文件所在目录
    $mail=new PHPMailer();//建立邮件发送类
    $mail->IsSMTP();//使用SMTP方式发送 设置设置邮件的字符编码，若不指定，则为'UTF-8
    $mail->Host=$emailHost;//'smtp.qq.com';//您的企业邮局域名
    $mail->SMTPAuth=true;//启用SMTP验证功能   设置用户名和密码。
    $mail->Username=$emailUserName;//'mail@koumang.com'//邮局用户名(请填写完整的email地址)
//    $mail->Username='admin@shikeh.com';//邮局用户名(请填写完整的email地址)
//    $mail->Password='WWW15988999998com';//邮局密码
    $mail->Password=$emailPassWord;//'xiaowei7758258'//邮局密码
    $mail->From=$emailUserName;//'mail@koumang.com'//邮件发送者email地址
    $mail->FromName=$formName;//邮件发送者名称
    $mail->AddAddress($email);// 收件人邮箱，收件人姓名
    //$mail->AddBCC('chnsos@126.com',$_SESSION['clean']['name']);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
    $mail->Subject="=?UTF-8?B?".base64_encode($title)."?=";
    $mail->Body=$body; //邮件内容
    $mail->AltBody = "这是一封HTML格式的电子邮件。"; //附加信息，可以省略
    $mail->Send();
    return $mail->ErrorInfo;
}

/**
 * 人民币格式化
 * @param $num
 * @return array|bool|string
 */
function num_format($num){
    if(!is_numeric($num)){
        return false;
    }
    $rvalue='';
    $num = explode('.',$num);//把整数和小数分开
    $rl = !isset($num['1']) ? '' : $num['1'];//小数部分的值
    $j = strlen($num[0]) % 3;//整数有多少位
    $sl = substr($num[0], 0, $j);//前面不满三位的数取出来
    $sr = substr($num[0], $j);//后面的满三位的数取出来
    $i = 0;
    while($i <= strlen($sr)){
        $rvalue = $rvalue.','.substr($sr, $i, 3);//三位三位取出再合并，按逗号隔开
        $i = $i + 3;
    }
    $rvalue = $sl.$rvalue;
    $rvalue = substr($rvalue,0,strlen($rvalue)-1);//去掉最后一个逗号
    $rvalue = explode(',',$rvalue);//分解成数组
    if($rvalue[0]==0){
        array_shift($rvalue);//如果第一个元素为0，删除第一个元素
    }
    $rv = $rvalue[0];//前面不满三位的数
    for($i = 1; $i < count($rvalue); $i++){
        $rv = $rv.','.$rvalue[$i];
    }
    if(!empty($rl)){
        $rvalue = $rv.'.'.$rl;//小数不为空，整数和小数合并
    }else{
        $rvalue = $rv;//小数为空，只有整数
    }
    return $rvalue;
}

/** 短信认证
 * @param $phone 电话号码
 * @param $name  发送标题
 * @param $user  短息接口用户名
 * @param $pass  短信接口密码
 * @return mixed 错误信息
 */
function sandPhone($phone,$name,$user,$pass){
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
    $time=session('time');
    if (time()-$time<60&&!empty($time)){
        return $statusStr['100'];
    }
    $code=rand(1000, 9999);
    session(array('name'=>'code','expire'=>600));
    session('code',$code);  //设置session
    session('time',time());
    $content="【".$name."】您的验证码为".$code."，请不要泄漏给他人。";//要发送的短信内容
    $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
    $result =file_get_contents($sendurl) ;
//     dump($user);dump($pass);dump($phone);dump($content);die;
    return $statusStr[$result];
}


function sandPhone_huiyi($phone,$name,$user,$pass){

    $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
    $mobile = $phone;
    $mobile_code = random(4,1);

   // $post_data = "account=".$user."&password=".$pass."&mobile=".$mobile."&content=".rawurlencode("您的验证码是".$mobile_code.",正在进行善心汇验证,10分钟内有效。");
    $post_data = "account=".$user."&password=".$pass."&mobile=".$mobile."&content=".rawurlencode("您的验证码是".$mobile_code."，正在进行善心汇验证，10分钟内有效。");


//查看密码请登录用户中心->验证码、通知短信->帐户及签名设置->APIKEY
    $gets =  xml_to_array(Post($post_data, $target));
    if($gets['SubmitResult']['code']==2){
       // $_SESSION['mobile'] = $mobile;
       // $_SESSION['mobile_code'] = $mobile_code;
        session(array('name'=>'code','expire'=>600));
        session('code',$mobile_code);  //设置session
        session('time',time());
        return "短信发送成功";
    }
    else{
        return "短信发送失败:".$gets['SubmitResult']['msg'];
    }

}

function Post($curlPost,$url){
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
function xml_to_array($xml){
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
function random($length = 6 , $numeric = 0) {
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





/**
 * 验证手机
 * @param $code
 * @return bool
 */
function checkPhoneCode($code){
    if (session('code')!=$code){
        return  false;
    }else {
        return true;
    }
}

/**
 * 随机数字英文字符
 * @param $param 长度
 * @return string 随机数
 */
function getRandom($param){
    $str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for($i=0;$i<$param;$i++)
    {
        $key .= $str{mt_rand(0,32)};    //生成php随机数
    }
    return $key;
}

/**
 * 检测sql
 * @param unknown $sql_str 语句
 * @return unknown 
 */
function inject_check($sql_str) {
	$check= eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
	if($check){
		return true;
	}else{
		return false;
	}
}

