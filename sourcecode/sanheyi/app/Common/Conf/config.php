<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL' => 2,
    'URL_HTML_SUFFIX' => 'html',
    'TMPL_L_DELIM' => '{', // 模板引擎普通标签开始标记
    'TMPL_R_DELIM' => '}', // 模板引擎普通标签结束标记
    //db配置
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'sanheyi',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 't_',
    'DB_FIELDS_CACHE' => true,
    'DB_CHARSET' => 'utf8',

    //'URL_CASE_INSENSITIVE' => true,
    'UPLOAD_SERVER_PATH' => 'Uploads/', //存储上传文件的路径，对于本地上传，需要为绝对路径，对于云存储，是相对路径,网站的根目录，后面要带/
    //'UPLOAD_SERVER_URL' => 'http://cos.myqcloud.com/11000457/H5Plus/', //cos访问url（除上传指定的目录和文件外的部分）
    'UPLOAD_SERVER_URL' => 'http://local.sanheyi.com/Uploads/', //如果是本地上传的话，需要配置这个网站的路径，后面带上根目录/upload/哦

);