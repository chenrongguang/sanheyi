<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>会员注册</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:left; margin-left:50px; margin-top:20px;}
        .er li{width:700px; color:red; font-weight:bold;}
        .red{color:red;}
        .san{float:left; margin-left:0; width:700px;}
        .san li{float:left; width:300px; height:40px; line-height:40px; text-align:center; margin-top:10px;}
        .lv{color:green;}
        .beizhu{margin-left:50px; margin-top:10px; float:left;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2; padding-left:4px;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/huiyuanzhuce.js"></script>

</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图-->
    <div class="head"></div>
    <ul class="nav">
    <li>
        <dl class="caidan">
            <dt><h2><a href="<?php echo U('public/main');?>">首页</a></h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2>个人中心</h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
            <dd><a href="<?php echo U('user/accountinfo');?>">账户信息</a></dd>
            <dd><a href="<?php echo U('user/identityinfo');?>">身份验证</a></dd>
            <dd><a href="<?php echo U('user/changepwd');?>">修改密码</a></dd>
            <dd><a href="<?php echo U('user/reg');?>">会员注册</a></dd>
            <dd><a href="<?php echo U('user/pidlink');?>">推荐链接</a></dd>
            <dd><a href="<?php echo U('user/personinfo');?>">个人信息</a></dd>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2>布施中心</h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
            <dd><a href="<?php echo U('user/level_down_info');?>">因缘图</a></dd>
            <dd><a href="<?php echo U('user/level_down_all');?>">激活会员</a></dd>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2>财务管理</h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
            <dd><a href="<?php echo U('Uc/detail');?>">账户明细</a></dd>
            <dd><a href="<?php echo U('Uc/out_detail');?>">支出记录</a></dd>
            <dd><a href="<?php echo U('Uc/in_detail');?>">收入记录</a></dd>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2>交易中心</h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
            <dd><a href="<?php echo U('community/community_list');?>">功德社区</a></dd>
            <dd><a href="<?php echo U('community/community_select_offer');?>">提供资助</a></dd>
            <dd><a href="<?php echo U('offer/offerlist');?>">提供资助列表</a></dd>
            <dd><a href="<?php echo U('community/community_select_accept');?>">接受资助</a></dd>
            <dd><a href="<?php echo U('accept/acceptlist');?>">接受资助列表</a></dd>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2>系统公告</h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
            <dd><a href="<?php echo U('message/mess_sys_list');?>">公告通知</a></dd>
            <dd><a href="<?php echo U('message/mess_check_list');?>">审核通知</a></dd>
        </dl>
    </li>
    <li>
        <dl class="caidan">
            <dt><h2><a href="<?php echo U('login/logoutDo');?>">退出系统</a></h2><div class="tubiao"><img src="/Public/images/3.png" /></div></dt>
        </dl>
    </li>
</ul>
    <div class="you">
        <ul class="yi">
            <li><a href="<?php echo U('public/main');?>">主页</a>＞</li>
            <li><a href="">会员注册</a></li>
        </ul>
        <br />
        <ul class="er">
            <li>年龄区间16-70岁之间</li>
        </ul>
        <form method="post" action="<?php echo U('user/regDo');?>" name="form" id="form">
            <ul class="san">
                <li style="text-align:right;">登录帐号：</li>
                <li><input class="kuang" type="text"  id="name" name="name" placeholder="6-16位之间，注册后不能修改" /></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">登录密码：</li>
                <li><input class="kuang" type="password"   id="pwd" name="pwd" placeholder="登录密码，6-16位之间" /></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">确认密码：</li>
                <li><input class="kuang" type="password"  id="re_pwd" name="re_pwd" placeholder="确认密码和登录密码一致" /></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">姓名：</li>
                <li><input class="kuang" type="text" id="family_name" name="family_name"  placeholder="身份证上的姓名"  /></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">手机号码：</li>
                <li><input class="kuang" type="text" id="mobile" name="mobile" placeholder="手机号码"  /></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">推荐人帐号：</li>
                <li><input class="kuang" type="text" readonly  id="p_name" name="p_name" value="<?php echo ($p_name); ?>" placeholder="推荐人的登录帐号"  /></li>
                <input type="hidden" name="p_id" id="p_id" value="<?php echo ($p_id); ?>" />
            </ul>
            <ul class="san">
                <li style="text-align:right;"></li>
                <li><input id="btn_sub"  type="button" value="提交注册" onclick="sub(1)" /></li>
            </ul>
        </form>
    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
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
            data : JSON.stringify({name:name}),
            async : false,
            success : function(data){
                //该名字可以用
                if(data.result=='SUCCESS'){
                    //location.href= data.return_data.url;
                }else{
                    //该名字不可以用,已经有人注册了
                    $(this).val('');
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