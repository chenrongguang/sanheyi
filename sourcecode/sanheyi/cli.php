<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false，此处使用了apache的SetEnv指令（或nginx的fastcgi_param）设置的DEBUG_MODEL，只要此值不为空，则进行debug模式。
define('APP_DEBUG', true);

// 定义应用模式
//define('MODE_NAME', 'Api');

// 绑定模块
define('BIND_MODULE','Cli');

// 定义应用目录
//define('APP_PATH', __DIR__ . '/../app/');
//由于是命令行模式，所以必须得有DIR，部分的话找不到文件哦
define('APP_PATH', __DIR__.'./app/');

// 引入ThinkPHP入口文件
require __DIR__.'./ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
