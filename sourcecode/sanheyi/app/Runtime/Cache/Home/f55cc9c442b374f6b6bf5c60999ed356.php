<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>激活会员</title>
    <style type="text/css">
        .yi{margin-left:50px; float:left;}
        .yi li{float:left;}
        .er{float:left; margin-left:50px; margin-top:20px;}
        .er li{width:700px; color:#09F;}
        .red{color:red;}
        .blue{color:#4f7ca9;}
        .gre{color:#66cd00;}
        .san{float:left; margin-left:50px; width:700px;}
        .san li{float:left; width:100px; height:30px; line-height:30px; margin-top:10px; text-align:center;}
        .lv{color:green;}
        .beizhu{margin-left:50px; margin-top:10px; float:left;}
        .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/jihuohuiyuan.js"></script>

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
            <li class="blue">下级会员：(总数：<?php echo ($total); ?>个 <span class="gre">激活</span>：<?php echo ($total_act); ?>个 <span class="red">未激活</span>：<?php echo ($total_noact); ?>个)</li>
        </ul>
        <br />
        <ul class="san">
            <li>登录账号</li>
            <li>姓名</li>
            <li>电话</li>
            <li>状态</li>
            <li style="width:200px;">注册时间</li>
            <li>操作</li>
        </ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="san">
                <li><?php echo ($vo["name"]); ?></li>
                <li><?php echo ($vo["family_name"]); ?></li>
                <li><?php echo ($vo["mobile"]); ?></li>
                <li><?php if(($vo["act_status"]) == "0"): ?>未激活<?php endif; if(($vo["act_status"]) == "1"): ?>已激活<?php endif; ?></li>
                <li><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></li>
                <li><?php if(($vo["act_status"]) == "0"): ?><input type="button" value="激活" onclick="act_user('<?php echo ($vo["user_id"]); ?>');"><?php endif; ?><input type="button" value="查看" onclick="show_user('<?php echo ($vo["user_id"]); ?>');"></li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php if(empty($list)): ?><tr>
                <td colspan="6">目前没有相关信息</td>
            </tr><?php endif; ?>
        <?php if(!empty($list)): ?><div class="beizhu"><?php echo ($page); ?></div><?php endif; ?>

    </div>
    <div class="foot">
    <div class="beian">善心汇  版权所有  粤ICP备15076181号<br />2016V1.0版本</div>
</div>
</div>
<script type="text/javascript">

    function  act_user(user_id){

        var path = "<?php echo U('user/ajxact_user');?>";

        $.ajax({
            type : "post",
            url : path,
            data : JSON.stringify({act_user:user_id}),
            async : false,
            success : function(data){
                //该名字可以用
                if(data.result=='SUCCESS'){
                    alert(data.msg);
                    location.href= data.return_data.url;
                }else{
                    //该名字不可以用,已经有人注册了
                    alert(data.msg);
                }

            }
        });

    }

    function  show_user(user_id){
        //alert(user_id);
        //var url=eval("<?php echo U('user/personinfo',array('user_id'=>" + user_id + "));?>");
        location.href='/home/user/personinfo/user_id/'+ user_id ;
    }

</script>
</body>
</html>