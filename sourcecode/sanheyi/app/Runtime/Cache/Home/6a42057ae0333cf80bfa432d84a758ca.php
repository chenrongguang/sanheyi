<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>身份验证</title>
    <style type="text/css">.yi{margin-left:50px; float:left;}
    .yi li{float:left;}
    .er{float:left; margin-left:50px; margin-top:20px;}
    .er li{width:700px; color:#09F;}
    .red{color:red;}
    .san{float:left; margin-left:50px; width:700px;}
    .san li{float:left; height:200px; line-height:200px; margin-top:10px; color:#999;}
    .lv{color:green;}
    .beizhu{margin-left:50px; margin-top:10px; float:left;}
    .kuang{width:100%; height:100%; border:1px solid #c2c2c2;}
    </style>
    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/jquery.form.min.js"></script>
    <script src="/Public/js/home/shenfenyanzheng.js"></script>

    <script src="/Public/js/jquery.uploadify.min.js"></script>
    <script src="/Public/js/uploadify.swf"></script>

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
            <dd><a href="<?php echo U('user/level_down_all');?>">下级会员</a></dd>
            
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
            <li><a href="">资料修改：【审核状态：<span class="red"><?php echo ($show_data['confirm_status_name']); ?></span>】</a></li>
        </ul>
        <br />
        <ul class="er">
            <li>审核通过之后，不能修改资料信息。如需修改，请向服务中心申请。</li>
        </ul>
        <form method="post" action="<?php echo U('user/identityinfoDo');?>" name="form" id="form">
                <ul class="san">
                    <li class="wen">身份证正面：</li>
                    <li class="tu"><img id="cardp" name="cardp"  src="<?php echo ($show_data['card_p_url']); ?>" style="width:200px;height: 100px;"/></li>
                    <li><input type="file" name="image_file_p" id="image_file_p" /> </li>
                    <input  type="hidden" id="card_p_url" name="card_p_url" value ="<?php echo ($show_data['card_p_url']); ?>"/>
                </ul>
                <ul class="san">
                    <li class="wen">身份证反面：</li>
                    <li class="tu"><img id="cardo" name="cardo"  src="<?php echo ($show_data['card_o_url']); ?>" style="width:200px;height: 100px;"/></li>
                    <li><input type="file" name="image_file_o" id="image_file_o" /> </li>
                    <input  type="hidden" id="card_o_url" name="card_o_url" value ="<?php echo ($show_data['card_o_url']); ?>"/>
                </ul>
                <ul class="san">
                    <li class="wen">手持身份证：</li>
                    <li class="tu"><img id="cardh" name="cardh"  src="<?php echo ($show_data['card_h_url']); ?>" style="width:200px;height: 100px;"/></li>
                    <li><input type="file" name="image_file_h" id="image_file_h" /> </li>
                    <input  type="hidden" id="card_h_url" name="card_h_url" value ="<?php echo ($show_data['card_h_url']); ?>"/>
                </ul>
                <ul>
                    <li><input  id="btn_sub"  type="button" value="保存" onclick="sub(1)" /></li>
                </ul>
        </form>
    </div>
    <div class="foot">
    <div class="beian">善心汇     版权所有     粤ICP备15076181号<br />2016V1.0版本</div>
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
            $('#image_file_p').css('display','none');
            $('#image_file_o').css('display','none');
            $('#image_file_h').css('display','none');
            $('#btn_sub').css('display','none');
        }
        else {
            init_img_file_p();
            init_img_file_o();
            init_img_file_h();
        }

    });

    function init_img_file_p(){
        $("#image_file_p").uploadify({
            'swf': "/Public/js/uploadify.swf",
            'formData': {SESSION_ID:"<?php echo session_id();?>"},
            'uploader': "<?php echo U('public/uploadimg');?>",
            'buttonText': "上传图片",
            'buttonClass':"buttons",
            'width':'110px',
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'fileSizeLimit':"2MB",//正式限制
            'onInit': function () {
                //$(".uploadify-queue").hide();
            },
            'onUploadSuccess': function (file, data, response) {
                var jsonData = eval('(' + data + ')');
                //alert(jsonData['message']);
                //如果上传成功
                if(jsonData['error']==0){
                    //显示预览的图片，并且负责给隐藏域，点保存的时候传递到后台
                    //alert(jsonData['url']);
                    $('#card_p_url').val(jsonData['url']);
                    $('#cardp').attr('src',jsonData['url']);
                }
            },
            'onUploadError':function (file, errorCode, errorMsg, errorString) {
            }
        });
    }

    function init_img_file_o(){
        $("#image_file_o").uploadify({
            'swf': "/Public/js/uploadify.swf",
            'formData': {SESSION_ID:"<?php echo session_id();?>"},
            'uploader': "<?php echo U('public/uploadimg');?>",
            'buttonText': "上传图片",
            'buttonClass':"buttons",
            'width':'110px',
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'fileSizeLimit':"2MB",//正式限制
            'onInit': function () {
                //$(".uploadify-queue").hide();
            },
            'onUploadSuccess': function (file, data, response) {
                var jsonData = eval('(' + data + ')');
                //alert(jsonData['message']);
                //如果上传成功
                if(jsonData['error']==0){
                    //显示预览的图片，并且负责给隐藏域，点保存的时候传递到后台
                    //alert(jsonData['url']);
                    $('#card_o_url').val(jsonData['url']);
                    $('#cardo').attr('src',jsonData['url']);
                }
            },
            'onUploadError':function (file, errorCode, errorMsg, errorString) {
            }
        });

    }

    function init_img_file_h(){
        $("#image_file_h").uploadify({
            'swf': "/Public/js/uploadify.swf",
            'formData': {SESSION_ID:"<?php echo session_id();?>"},
            'uploader': "<?php echo U('public/uploadimg');?>",
            'buttonText': "上传图片",
            'buttonClass':"buttons",
            'width':'110px',
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'fileSizeLimit':"2MB",//正式限制
            'onInit': function () {
                //$(".uploadify-queue").hide();
            },
            'onUploadSuccess': function (file, data, response) {
                var jsonData = eval('(' + data + ')');
                //alert(jsonData['message']);
                //如果上传成功
                if(jsonData['error']==0){
                    //显示预览的图片，并且负责给隐藏域，点保存的时候传递到后台
                    //alert(jsonData['url']);
                    $('#card_h_url').val(jsonData['url']);
                    $('#cardh').attr('src',jsonData['url']);
                }
            },
            'onUploadError':function (file, errorCode, errorMsg, errorString) {
            }
        });

    }


</script>

</body>
</html>