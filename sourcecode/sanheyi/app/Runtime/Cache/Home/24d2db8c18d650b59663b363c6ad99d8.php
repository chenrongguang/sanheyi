<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>注册会员后台</title>
    <style type="text/css">
        h2{font-weight:normal;}
        .yi{width:900px; height:100px; float:left; margin-top:30px; margin-left:50px; border-bottom:1px solid #c2c2c2;}
        .yi1{float:left; margin-top:10px; margin-left:30px;}
        .yi1 li{width:250px; height:30px; line-height:30px; text-align:left; float:left;}
        .er{float:left; margin-top:50px; margin-left:200px;}
        .er li{width:170px; height:130px; float:left; margin-right:50px; position:relative; z-index:0;}
        .ertu{width:170px; height:130px; float:left; position:relative; z-index:1;}
        .erxiao{width:170px; height:30px; line-height:30px; text-align:center; position:absolute; z-index:2; left:0; bottom:0; background:#c9cacb;}
        .san{float:left; margin-top:30px; margin-left:130px;}
        .san li{float:left; width:150px; height:35px; line-height:35px; text-align:center; color:#fff; background:#333333; border-right:1px solid #c2c2c2;}
        .si{float:left; margin-left:130px;}
        .si li{float:left; width:149px; height:35px; line-height:35px; text-align:center; border-right:1px solid #c2c2c2; border-bottom:1px solid #c2c2c2;border:1px solid #c2c2c2;}
        /*新加的ul*/
       	.xinjia{float:left; margin-left:130px;}
        .xinjia li{float:left; width:104px; height:35px; line-height:35px; text-align:center; border-right:1px solid #c2c2c2; border-bottom:1px solid #c2c2c2;border:1px solid #c2c2c2;}
        /*新加的ul2*/
       	.xinjia2{float:left; margin-left:130px;}
        .xinjia2 li{float:left; width:141px;height:35px; line-height:35px; text-align:center; border-right:1px solid #c2c2c2; border-bottom:1px solid #c2c2c2;border:1px solid #c2c2c2;}
        .ba>li:first-child{width:50px}
        .ba>li:nth-child(2){width:143px}
        .ba>li:nth-child(3){width:143px}
        .ba>li:nth-child(4){width:190px}
        .ba>li:nth-child(5){width:143px}
        .ba>li:nth-child(6){width:80px}
        .wu{float:left; margin-top:30px; margin-left:130px;}
        .wu li{float:left; width:105px; height:35px; line-height:35px; text-align:center; color:#fff; background:#333333; border-right:1px solid #c2c2c2;}
        .liu{float:left; margin-left:130px;}
        .liu li{float:left; width:107px; height:35px; line-height:35px; text-align:center; border-right:1px solid #c2c2c2; border-bottom:1px solid #c2c2c2;}
        .qi{float:left; margin-top:30px; margin-left:130px;}
        .qi li{float:left; width:143px; height:35px; line-height:35px; text-align:center; color:#fff; background:#333333; border-right:1px solid #c2c2c2;}
        .ba{float:left; margin-left:130px;}
        .ba li{float:left; width:140px; height:35px; line-height:35px; text-align:center; border-right:1px solid #c2c2c2; border-bottom:1px solid #c2c2c2;}
        .pipei{color:red;}
        .gonggao{margin-left:90px; margin-top:20px; width:700px; float:left;}
        .neirong{float:left; margin-top:5px; margin-left:120px;}
        .neirong li{float:left; text-align:left; width:180px; height:30px; line-height:30px;}
        .gengduo{width:200px; height:30px; line-height:30px; text-align:right; float:right;}
        .foot{width:1200px; height:200px; float:left; margin:0 auto; text-align:center;}
        .beian{margin-top:80px;}
        .beianIcon{width:20px;height:20px;display:inline-block;background:url('/Public/images/beianIcon.png');}
        @media screen and (max-width:1520px){
        }
    </style>

    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/shouye.js"></script>

</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
    <style>
.beianIcon{width:20px;height:20px;display:inline-block;background:url('/Public/images/beianIcon.png');}
 
</style>
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
            <dd><a href="<?php echo U('user/level_down_all');?>">下级会员</a></dd>
			<dd><a href="<?php echo U('user/activation');?>">会员激活</a></dd>
            
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
        <div class="yi">
            <ul class="yi1">
                <li><?php echo ($person_info['name']); ?></li>
                <li><?php echo ($person_info['family_name']); ?></li>
                <li><?php echo ($person_info['group']); ?></li>
            </ul>
            <ul class="yi1">
                <li><?php echo ($person_info['act_status']); ?></li>
                <li><?php echo ($person_info['confirm_status']); ?></li>
                <li><?php echo ($person_info['create_time']); ?></li>
            </ul>
        </div>
        <ul class="er">
            <li>
                <a href="<?php echo U('community/community_select_offer');?>">
                <div class="ertu"><img src="/Public/images/icon-event.png" /></div>
                <div class="erxiao"><h3>布施积德</h3></div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('community/community_select_accept');?>">
                <div class="ertu"><img src="/Public/images/icon-cart.png" /></div>
                <div class="erxiao"><h3>感恩受助</h3></div>
                </a>
            </li>
            <li>
                <div class="ertu"><img src="/Public/images/icon-help.png" /></div>
                <div class="erxiao"><h3>审核反馈</h3></div>
            </li>
        </ul>
        <ul class="san">
            <li style="border-left:1px solid #c2c2c2;">善种子</li>
            <li>善心币</li>
            <li>善金币</li>
            <li>管理钱包</li>
            <li>出局钱包</li>
        </ul>
        <ul class="si">
            <li><a href="<?php echo U('Uc/sendSZZ');?>"><?php echo ($user_currency['szz_num']); ?></a></li>
            <li><a href="<?php echo U('Uc/sendSXB');?>"><?php echo ($user_currency['sxb_num']); ?></a></li>
            <li><?php echo ($user_currency['sjb_num']); ?></li>
            <li><a href="<?php echo U('Uc/manager_money');?>"><?php echo ($user_currency['glqb_num']); ?></a></li>
            <li><a href="<?php echo U('community/community_select_accept');?>"><?php echo ($user_currency['cjqb_num']); ?></a></li>
        </ul>

        <ul class="wu">
            <li style="border-left:1px solid #c2c2c2;">ID</li>
            <li>类型</li>
            <li>社区</li>
            <li>金额</li>
            <li>提交时间</li>
            <li>详细信息</li>
            <li style="width:120px;">匹配信息</li>
        </ul>
        <!--后加的边框-->
         <ul class="xinjia">
            <li><a href="">1111</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li style="width:120px;"><a href=""></a></li>
        </ul>
        <?php if(is_array($offer_list)): $i = 0; $__LIST__ = $offer_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="liu">
                <li><?php echo ($vo["offer_id"]); ?></li>
                <li>提供资助</li>
                <li><?php echo ($vo["cname"]); ?></li>
                <li><?php echo ($vo["num"]); ?></li>
                <li><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></li>
                <li><?php if(($vo["confirm_status"]) == "0"): ?><font color="red">未完成</font><?php endif; if(($vo["confirm_status"]) == "1"): ?>部分完成<?php endif; if(($vo["confirm_status"]) == "2"): ?>全部完成<?php endif; ?></li>
                <li style="width:120px;"><?php if(($vo["match_status"]) == "0"): ?><font color="red">未匹配</font><?php endif; ?>><?php if(($vo["match_status"]) == "1"): ?>部分匹配<input type="button" value="查看" onclick="show_match_offer('<?php echo ($vo["offer_id"]); ?>')"><?php endif; if(($vo["match_status"]) == "2"): ?>全部匹配<input type="button" value="查看" onclick="show_match_offer('<?php echo ($vo["offer_id"]); ?>')"><?php endif; ?></li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
        <ul class="qi">
            <li style="border-left:1px solid #c2c2c2; width:50px;">ID</li>
            <li>类型</li>
            <li>金额</li>
            <li style="width:190px">提交时间</li>
            <li>详细信息</li>
            <li style="width:80px;">操作</li>
        </ul>
         <!--后加的边框2-->
         <ul class="xinjia2">
            <li style="width: 50px;"><a href="">222</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li  style="width: 190px;"><a href=""></a></li>
            <li><a href=""></a></li>
            <li style="width: 80px;"><a href=""></a></li>
            
        </ul>
        <?php if(is_array($accept_list)): $i = 0; $__LIST__ = $accept_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="ba">
                <li><?php echo ($vo["accept_id"]); ?></li>
                <li>接受资助</li>
                <li><?php echo ($vo["total_num"]); ?></li>
                <li><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></li>
                <!--
                <li><?php if(($vo["match_status"]) == "0"): ?>等待匹配<?php endif; if(($vo["match_status"]) == "1"): ?>部分匹配<?php endif; if(($vo["match_status"]) == "2"): ?>全部匹配<?php endif; ?></li>
                -->
                <li><?php if(($vo["confirm_status"]) == "0"): ?><font color="red">未完成</font><?php endif; if(($vo["confirm_status"]) == "1"): ?>部分完成<?php endif; if(($vo["confirm_status"]) == "2"): ?>全部完成<?php endif; ?></li>
                <li><input type="button" value="查看" onclick="show_match_accept('<?php echo ($vo["accept_id"]); ?>')"></li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="gonggao">系统公告</div>
        <?php if(is_array($message_list)): $i = 0; $__LIST__ = $message_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="neirong">
                <li style="width:80px;"><?php echo ($vo["message_id"]); ?></li>
                <li style="width:350px;"><a target="_blank" href="<?php echo U('message/message_content',array('message_id'=>$vo['message_id']));?>"><?php echo ($vo["title"]); ?></a></li>
                <li style="width:130px;">系统公告</li>
                <li><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="gengduo"><a href="<?php echo U('message/mess_sys_list');?>">更多</a></div>

        </div>
    <div class="foot">
    <div class="beian">善心汇&nbsp;&nbsp;&nbsp;&nbsp;版权所有&nbsp;&nbsp;&nbsp;&nbsp;<b class="beianIcon"></b>&nbsp;&nbsp;粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>

<script type="text/javascript">

    function show_match_offer(offer_id){
        alert(offer_id);
    }

    function  show_match_accept(accept_id){
        alert(offer_id);
    }

</script>

</body>
</html>