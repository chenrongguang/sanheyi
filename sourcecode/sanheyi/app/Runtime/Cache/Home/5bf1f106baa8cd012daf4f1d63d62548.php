<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>详细信息</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:left; margin-left:50px; margin-top:20px;}
        .er li{width:700px; color:#09F;}
        .red{color:red;}
        .san{float:left; margin-left:0; width:700px;}
        .san li{float:left; width:300px; height:40px; line-height:40px; text-align:center; margin-top:10px; color:#999;}
        .lv{color:green;}
        .beizhu{margin-left:50px; margin-top:10px; float:left;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/zhanghuxinxi.js"></script>

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
            <li><a>资料修改：【审核状态：<span class="red"><?php echo ($show_data['confirm_status_name']); ?></span>】</a></li>
        </ul>
        <br />
        <ul class="er">
            <li>审核通过之后，不能修改资料信息。如需修改，请向服务中心申请。</li>
        </ul>
        <form method="post" action="<?php echo U('user/accountinfoDo');?>" name="form" id="form">
            <ul class="san">
                <li style="text-align:right;">手机号码：</li>
                <li><input type="text" name="mobile" id="mobile" value="<?php echo ($show_data['mobile']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">收货地址：</li>
                <li><input type="text" name="address" id="address" value="<?php echo ($show_data['address']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">电子邮箱：</li>
                <li><input type="text" name="email" id="email" value="<?php echo ($show_data['email']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">居住城市：</li>
                <li><input type="text" name="city" id="city" value="<?php echo ($show_data['city']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">支付宝账号：</li>
                <li><input type="text" name="alipay_no" id="alipay_no" value="<?php echo ($show_data['alipay_no']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">微信账号：</li>
                <li><input type="text" name="weixin_no" id="weixin_no" value="<?php echo ($show_data['weixin_no']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">开户银行：</li>
                <li><input type="text" name="bank" id="bank" value="<?php echo ($show_data['bank']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">银行帐号：</li>
                <li><input type="text" name="bank_no" id="bank_no" value="<?php echo ($show_data['bank_no']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">身份证姓名：</li>
                <li><input type="text" name="family_name" id="family_name" value="<?php echo ($show_data['family_name']); ?>"></li>
            </ul>
            <ul class="san">
                <li style="text-align:right;">身份证号码：</li>
                <li><input type="text" name="card_no" id="card_no" value="<?php echo ($show_data['card_no']); ?>"></li>
            </ul>
            <ul>
               <li><input  id="btn_sub"  type="button" value="提交保存" onclick="sub(1)" /></li>
            </ul>
        </form>
    </div>

    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>

<script type="text/javascript">
    function validate_handle(){
        //todo
        return true;

    }

    $(document).ready(function(){
        //状态为2，不让修改
        var st="<?php echo ($show_data['confirm_status']); ?>";
        if(st==2){
            $(':text').attr('readonly','readonly');
            $('#btn_sub').css('display','none');
        }

    });

</script>

</body>
</html>