<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>找回密码</title>
    <style type="text/css">
        @media screen and (max-width:1920px){
            .beijing{width:100%; margin:0 auto; position:relative;}
            .denglu{width:500px; height:600px; position:absolute;}
            .dl{position:absolute; top:3%; left:60%;}
            a{color:blue;}
            .tishi{color:red; float:right; line-height:50px; width:500px; height:50px; text-align:right;}
            .username{width:500px; height:50px; line-height:50px; float:left;}
            .two{width:500px; height:50px; margin-top:10px; float:left;}
            .inp{width:230px; height:30px; margin-top:10px; border:1px solid #c2c2c2; padding-left:5px;}
            .qian{width:100px; height:50px; line-height:50px; float:left; text-align:right;}
            .zhong,.hou{color:red;}
            .xuan{margin-left:100px;}
            .tijiao{width:80px; height:40px; line-height:40px; border:none; color:#fff; background:#ffa32f; margin-left:100px;
                border-radius:5px; -webkit-border-radius:5px;; -moz-border-radius:5px;; -ms-border-radius:5px;;-o-border-radius:5px;;}
        }
        @media screen and (max-width:1520px){
        }
    </style>
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/zhaohui.js"></script>
</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
    <div class="dl">已经有了账号？<br />请直接<a href="<?php echo U('login/login');?>">登录</a></div>
    <div class="denglu">
        <h1>找回密码</h1>
        <div class="tishi"></div>
        <form method="post">
            <div class="username">
                <div class="qian">注册手机：</div>
                <input class="inp" type="text" placeholder="11位手机号码" />
                <span class="zhong">*</span>
                <span class="hou"><input type="button" value="获取验证码" /></span>
            </div>
            <div class="two">
                <div class="qian">手机验证码：</div>
                <input class="inp" type="password" placeholder="手机接收到的6位验证码" />
                <span class="zhong">*</span>
            </div>
            <div class="two">
                <div class="qian">图形验证码：</div>
                <input class="inp" type="password" placeholder="右边的图形验证码" />
                <span class="zhong">*</span>
                <span class="hou">此处放验证码</span>
            </div>
            <div class="two">
                <input class="tijiao" type="submit" value="找回密码" />
            </div>
        </form>
    </div>
</div>
</body>
</html>