<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>提供资助</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:left; margin-left:50px; margin-top:20px; border:2px solid red; width:655px;}
        .er li{float:left; height:200px;}
        .eryi{width:70%; background:#c2c2c2;}
        .erer{width:30%; line-height:100px; text-align:center; font-size:40px; font-weight:bold;}
        .red{color:red;}
        .blue{color:#4f7ca9;}
        .gre{color:#66cd00;}
        .san{float:left; margin-left:50px; margin-top:20px; width:800px;}
        .mt{margin-top:20px;}
        .bt{border-top:1px solid red;}
        .san li{float:left; width:300px; height:200px; line-height:100px; text-align:center; background:#c9cacb; font-size:40px; font-weight:bold; border:2px solid red; margin-right:50px;}
        .san li a,.er li a{display:block; width:100%; height:100%;}
        .lv{color:green;}
        .beizhu{margin-left:50px; margin-top:10px; float:left; width:800px; height:40px; line-height:40px; text-align:center;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/tigongzizhu.js"></script>
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
            <dd><a href="<?php echo U('usercurrency/detail');?>">账户明细</a></dd>
            <dd><a href="<?php echo U('usercurrency/out_detail');?>">支出记录</a></dd>
            <dd><a href="<?php echo U('usercurrency/in_detail');?>">收入记录</a></dd>
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
            <li class="blue">请选择提供资助的地区：<span class="red">现已开放"贫穷社区"、"小康社区"和"富人社区"，<br />其他后期陆续开放，敬请关注。</span></li>
        </ul>
        <br />
        <ul class="san">
            <li><a href="zizhu.html">贫困<br />社区</a></li>
            <li><a href="zizhu.html">小康<br />社区</a></li>
        </ul>
        <ul class="san">
            <li><a href="zizhu.html">富人<br />社区</a></li>
            <li><a href="zizhu.html">德善<br />社区</a></li>
        </ul>
        <ul class="er">
            <li class="eryi"></li>
            <li class="erer"><a href="zizhu.html">大德<br />社区</a></li>
        </ul>
    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>
</body>
</html>