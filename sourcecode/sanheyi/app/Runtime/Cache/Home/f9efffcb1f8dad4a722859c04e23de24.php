<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>个人登录</title>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        @media screen and (max-width:1920px){
            .beijing{width:100%; margin:0 auto; position:relative;}
            .denglu{width:500px; height:300px; position:absolute; border:1px solid #c2c2c2;
                border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px; -ms-border-radius:10px;-o-border-radius:10px;}
            .username{width:400px; height:40px; line-height:40px; margin:0 auto; margin-top:50px;;}
            .password{width:400px; height:40px; line-height:40px; margin:0 auto; margin-top:15px;}
            .yanzheng{width:400px; height:40px; margin:0 auto; margin-top:15px;}
            .tijiao{width:400px; height:40px; margin:0 auto; margin-top:15px;}
            .tubiao{width:40px; height:40px; float:left;}
            .tubiao img{width:50%; height:50%; margin-top:11px;}
            .shuru{width:88%; height:100%; padding-left:6px; float:right; border:1px solid #c2c2c2;
                border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px;}
            .yan{width:20%; margin-left:10%; margin-top:2%; float:left;}
            .shuzi{width:30%; margin-top:2%; float:left;}
            .tj{margin-left:10%; float:left; cursor:pointer; background-image: linear-gradient(to bottom, #5bc0de 0px, #2aabd2 100%);background-repeat: repeat-x; border-color: #28a4c9;
                box-sizing: border-box;font-size: 14px;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap; color:#fff;
                border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px; border:none;}
            .lianjie{float:right;}
            .lianjie li{float:left; margin-right:10px; margin-top:3%;}
            .lianjie li a{color:#808080;}
            .lianjie li a:hover{color:#000;}
        }
        @media screen and (max-width:1520px){
        }
    </style>
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/geren.js"></script>
</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
    <div class="denglu">
        <form method="post" action="<?php echo U('login/loginDo');?>" name="form" id="form">
            <div class="username">
                <div class="tubiao"><img src="/Public/images/1.png" /></div>
                <input class="shuru" type="text" name="username" placeholder="用户名" />
            </div>
            <div class="password">
                <div class="tubiao"><img src="/Public/images/2.png" /></div>
                <input class="shuru" type="password" name="password" placeholder="密码" />
            </div>
            <div class="yanzheng" style="display: none">
                <input class="yan" type="text" />
                <div class="shuzi">此处放验证码</div>
            </div>
            <div class="tijiao">
                <input class="tj" type="button" value="登录" onclick="sub()" />
                <ul class="lianjie">
                    <li><a href="<?php echo U('Login/reg');?>">快速注册</a></li>
                    <li><a href="<?php echo U('Login/findpwd');?>">找回密码</a></li>
                </ul>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function validate_handle(){
        //todo
        return true;

    }

</script>

</body>
</html>