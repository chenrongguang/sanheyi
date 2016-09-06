<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>个人登录</title>
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
    <script src="/Public/js/home/zhuce.js"></script>
</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
    <div class="dl">已经有了账号？<br />请直接<a href="<?php echo U('Login/login');?>">登录</a></div>
    <div class="denglu">
        <h1>会员注册</h1>
        <div class="tishi">年龄区间16-70岁之间</div>
        <form method="post"  method="post"  action="<?php echo U('Login/regDo');?>" name="form" id="form">
            <div class="username">
                <div class="qian">登录账号：</div>
                <input class="inp" type="text" placeholder="6-16位之间，注册后不能更改" id="name" name="name" />
                <span class="zhong">*</span>
                <span class="hou">空账号不可注册</span>
            </div>
            <div class="two">
                <div class="qian">登录密码：</div>
                <input class="inp" type="password" placeholder="登录密码，6-16位之间" id="pwd" name="pwd" />
                <span class="zhong">*</span>
                <span class="hou">密码不规范</span>
            </div>
            <div class="two">
                <div class="qian">确认密码：</div>
                <input class="inp" type="password" placeholder="确认密码和登录密码一致" id="repwd" name="repwd" />
                <span class="zhong">*</span>
                <span class="hou">密码不一致</span>
            </div>
            <div class="two">
                <div class="qian">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</div>
                <input class="inp" type="text" placeholder="身份证上的姓名"  id="family_name" name="family_name" />
                <span class="zhong">*</span>
                <span class="hou">姓名不能为空</span>
            </div>
            <div class="two">
                <div class="qian">手机号码：</div>
                <input class="inp" type="text" placeholder="手机号码"  id="mobile" name="mobile" />
                <span class="zhong">*</span>
                <span class="hou">手机号码不正确</span>
            </div>
            <div class="two">
                <div class="qian">推荐人账号：</div>
                <input class="inp" type="text" placeholder="推荐人的登录账号"  id="p_name" name="p_name" value="<?php echo ($p_name); ?>" />
                <input class="inp" type="hidden"   id="p_id" name="p_id" value="<?php echo ($p_id); ?>" />
                <span class="zhong">*</span>
                <span class="hou">无此推荐人</span>
            </div>
            <div class="two">
                <input class="xuan" type="checkbox" />
                <a href="">我已阅读并同意相关用户协议和条款</a>
            </div>
            <div class="two">
                <input class="tijiao" type="button" value="提交注册" onclick="sub()" />
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    //检查名字是否可用
    $('#name').bind('blur', function(){
        var name =$(this).val();
        var path = "<?php echo U('login/ajaxCheckName');?>";
        $.ajax({
            type : "post",
            url : path,
            data : JSON.stringify({name:encodeURIComponent(name)}),
            async : false,
            success : function(data){
                //return_handle(data);
                 if(data.result=='SUCCESS'){
                    //location.href= data.return_data.url;
                 }else{
                    alert(data.msg);
                 }

            }
        });

    });

    //检查推荐人是否正确存在
    $('#p_name').bind('blur', function(){
        var p_name =$(this).val();
        var path = "<?php echo U('login/ajaxCheckPid');?>";
        $.ajax({
            type : "post",
            url : path,
            data : JSON.stringify({p_name:encodeURIComponent(p_name)}),
            async : false,
            success : function(data){
                //return_handle(data);
                if(data.result=='SUCCESS'){
                    //location.href= data.return_data.url;
                    $('#p_id').val(data.return_data.p_id);

                }else{
                    alert(data.msg);
                }

            }
        });

    });

    function validate_handle(){
        //todo
        return true;

    }

</script>
</body>
</html>