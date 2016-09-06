<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="keywords" content="java培训 , .net培训 , php培训" />
    <meta name="description" content="IT培训的龙头老大，口碑最好的XX培训" />
    <title>登录向导</title>

    <style type="text/css">
        @media screen and (max-width:1920px){
            .beijing{width:100%; margin:0 auto; position:relative;}
            .denglu{width:30%; background:#fff; position:absolute; border:1px solid #c2c2c2;
                border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px; -ms-border-radius:10px;-o-border-radius:10px;}
            .geren{ position:absolute; left:30%; top:40%; cursor:pointer; background-image: linear-gradient(to bottom, #5bc0de 0px, #2aabd2 100%);background-repeat: repeat-x; border-color: #28a4c9;
                box-sizing: border-box;font-size: 14px;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap; color:#fff;
                border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px; border:none;}
            .qiye{ position:absolute; right:30%; top:40%; cursor:pointer; background-image: linear-gradient(to bottom, #d9534f 0px, #c12e2a 100%);background-repeat: repeat-x;border-color: #b92c28;
                box-sizing: border-box;font-size: 14px;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap; color:#fff;
                border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px;-o-border-radius:5px; border:none;}
            .geren:hover{background-color:#2aabd2;}
        }
        @media screen and (max-width:1520px){
            .geren{left:25%;}
            .qiye{right:25%;}
        }
    </style>

    <link href="/Public/css/home.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-3.0.0.min.js"></script>
    <script src="/Public/js/home/denglu.js"></script>

</head>

<body>
<div class="beijing"><!--此处可以用行间样式加背景图，背景图长宽比例最好是跟屏幕大小一致-->
    <div class="denglu">
        <input class="geren" type="button" onclick="javascript:location.href='/home/login/login'"; value="个人登录" />
        <input class="qiye" type="button" onclick="javascript:location.href='';" value="企业登录" />
    </div>
</div>
</body>
</html>