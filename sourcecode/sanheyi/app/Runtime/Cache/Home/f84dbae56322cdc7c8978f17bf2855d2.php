<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>功德社区</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:left; margin-left:50px; margin-top:20px;}
        .er li{width:700px; color:#09F;}
        .red{color:red;}
        .blue{color:#4f7ca9;}
        .gre{color:#66cd00;}
        .san{float:left; margin-left:50px; width:800px;}
        .mt{margin-top:20px;}
        .bt{border-top:1px solid red;}
        .san li{float:left; height:100px; border-bottom:1px solid red;}
        .sanyi{width:30%; border-left:1px solid red; line-height:50px; text-align:center; font-size:30px; font-weight:bold;}
        .saner{width:69%; border-left:1px solid red; border-right:1px solid red;}
        .saner p{margin-left:10px;}
        .lv{color:green;}
        .beizhu{margin-left:50px; margin-top:10px; float:left; width:800px; height:40px; line-height:40px; text-align:center;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/gongdeshequ.js"></script>
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
            <dd><a href="<?php echo U('offer/offlist');?>">提供资助列表</a></dd>
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
            <li class="blue">社区一览</li>
        </ul>
        <br />
        <ul class="san mt">
            <li class="sanyi bt">特困<br />社区</li>
            <li class="saner bt"><p>在贫穷社区的基础上，筛选出一批特困会员（详情请咨询善心汇扶贫济困微信客服：shanxinhui9090）,布施金额1000-3000元，每轮收益率50%.排队打款和收款时间会酌情提前。</p> </li>
        </ul>
        <ul class="san">
            <li class="sanyi">贫困<br />社区</li>
            <li class="saner"><p>布施金额1000—3000元 ，每轮收益率30%.排队布施时间1—10天，打款成功后，进入感恩受助队列，1—7天匹配收款（周末休息暂停匹配时间计入排队时间，国家法定节假日时间不计入排队时间）。 </p></li>
        </ul>
        <ul class="san">
            <li class="sanyi">小康<br />社区</li>
            <li class="saner"><p>布施金额1万—3万元，前五轮收益率为20%，从第六轮开始收益率降为15%. 排队布施时间3—15天，打款成功后，进入感恩受助队列，3—9天匹配收款（周末休息暂停匹配时间计入排队时间，国家法定节假日时间不计入排队时间）。</p></li>
        </ul>
        <ul class="san">
            <li class="sanyi">富人<br />社区</li>
            <li class="saner"><p>布施金额5万—30万元，每轮收益率10%.排队布施时间3—15天，打款成功后，进入感恩受助队列，30天内匹配收款。 </p></li>
        </ul>
        <ul class="san">
            <li class="sanyi">德善<br />社区</li>
            <li class="saner"><p>布施金额50万—1000万元，每轮收益率0—5%，安排专属客服直接服务，签约之后打款，打款成功后，进入感恩受助队列，回款时间15—60天。</p></li>
        </ul>
        <ul class="san">
            <li class="sanyi">大德<br />社区</li>
            <li class="saner"><p></p></li>
        </ul>
    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>
</body>
</html>