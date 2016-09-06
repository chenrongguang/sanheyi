<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>提供资助列表</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:right; margin-left:50px; margin-top:20px;}
        .er li{ margin-right:20px; color:#09F; float:left;}
        .ip1{ cursor:pointer; background-image: linear-gradient(to bottom, #5bc0de 0px, #2aabd2 100%);background-repeat: repeat-x; border-color: #28a4c9;
            box-sizing: border-box;font-size: 14px;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap; color:#fff;
            border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px; border:none;}
        .ip2{ cursor:pointer; background-image: linear-gradient(to bottom, #d9534f 0px, #c12e2a 100%);background-repeat: repeat-x;border-color: #b92c28;
            box-sizing: border-box;font-size: 14px;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap; color:#fff;
            border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px; border:none;}
        .red{color:red;}
        .blue{color:#4f7ca9;}
        .gre{color:#66cd00;}
        .san{float:left; margin-left:50px; width:800px;}
        .san li{float:left; width:100px; height:30px; line-height:30px; margin-top:10px; text-align:center;}
        .lv{color:green;}
        .beizhu{margin-left:100px; margin-top:10px; float:left;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/tigongzizhuliebiao.js"></script>

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
            <li class="blue">提供资助列表</li>
        </ul>
        <br />
        <ul class="er">
            <li><input class="ip1" type="button" value="查看未完成" /></li>
            <li><input class="ip2" type="button" value="查看已完成" /></li>
        </ul>
        <ul class="san">
            <li>ID</li>
            <li>类型</li>
            <li>社区</li>
            <li>金额</li>
            <li>提交时间</li>
            <li>付款信息</li>
            <li>匹配信息</li>
            <li>操作</li>
        </ul>
        <ul class="san">
            <li>123456</li>
            <li>接受资助</li>
            <li>贫穷社区</li>
            <li>2000</li>
            <li>2016-5-20</li>
            <li>已付款</li>
            <li>已匹配</li>
            <li>已完成</li>
        </ul>
        <div class="beizhu">注：此页面默认只显示未匹配或未完成的挂单，要查看已完成的挂单，请点击右上角的【查看已完成】按钮。</div>
    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>
</body>
</html>