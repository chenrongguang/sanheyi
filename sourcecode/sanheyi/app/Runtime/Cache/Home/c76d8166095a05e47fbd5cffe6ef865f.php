<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>接受资助</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{margin-left:50px; float:left;}
        .er li{width:500px; height:30px; line-height:30px; border-bottom:1px solid #c2c2c2;}
        .nei1{width:30%; height:30px; line-height:30px; float:left; text-align:center;}
        .nei2{width:70%; height:30px; line-height:30px; float:left;}
        .xin{color:red; margin-left:5px;}
        .tishi{color:red; margin-left:10px;}
        .inp{float:left;}
        .jian{width:20px; height:20px; float:left; margin-top:5px; margin-right:5px; cursor:pointer;}
        .inp2{width:30px; text-align:center; float:left; margin-top:3px;}
        .jia{width:20px; height:20px; float:left; margin-top:5px; margin-left:5px; cursor:pointer;}
        .tijiao{margin:0 auto; display:block;}
        .di{color:red;}
        .er li a{margin-right:30px;}
        .san{float:left; width:500px; margin-left:50px; margin-top:20px;}
        .san span{color:red;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/jieshouzizhu.js"></script>

</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
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
            <dd><a href="<?php echo U('offer/sendoffer');?>">提供资助</a></dd>
            <dd><a href="<?php echo U('offer/offerlist');?>">提供资助列表</a></dd>
            <dd><a href="<?php echo U('accept/sendaccept');?>">接受资助</a></dd>
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
            <li><a href="shouye.html">主页</a>＞</li>
            <li>请填写接受资助金额</li>
        </ul>
        <br />
        <ul class="er">
            <form method="post">
                <li>
                    <div class="nei1">剩余出局钱包：</div>
                    <div class="nei2">0</div>
                </li>
                <li>
                    <div class="nei1">出局金额：</div>
                    <div class="nei2"><input type="text" class="inp1" /><span class="xin">*</span><span class="tishi">必须是100的整倍数</span></div>
                </li>
                <li>
                    <div class="nei1">二级密码：</div>
                    <div class="nei2"><input type="text" class="inp1" /><span class="xin">*</span><span class="tishi">密码错误</span></div>
                </li>
                <li><input type="submit" class="tijiao" value="接受资助" /></li>
            </form>
        </ul>
        <dl class="san">
            <dt>提示：</dt>
            <dd>1）只能提交<span>一次</span>接受资助</dd>
            <dd>2）<span>请勿把小康区的接受资助拆分小金额提交，系统会延时处理；</span></dd>
            <dd>3）金额单位是元；</dd>
        </dl>
    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>
</body>
</html>