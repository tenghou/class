<?php

//防止恶意调用
  if(!defined('IN_AC')){
       exit('Access Defined!');
    }

    
//创建一个自动转义状态的常量
define('GPC',get_magic_quotes_gpc());

//设置字符集
header('Content-Type:text/html;chartset=gbk2312');

//转换硬路径
define('ROOT_PATH',substr(dirname(__FILE__), 0,-8));

//拒绝PHP低版本
if(PHP_VERSION<'4.1.0'){
    exit('Your php version is too low!');
}


//引入函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';


//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','***');
define('DB_NAME','***');


//初始化数据库
_connect(); //连接MYSQL数据库
_select_db();   //选择指定的数据库
_set_names();   //设置字符集


// //创建数据库连接
// $_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('数据里连接失败');

// //选择一款数据库
// mysql_select_db(DB_NAME) or die('指定的数据库不存在');

// //选择字符集
// mysql_query('SET NAMES UTF8') or die('字符集错误');


?>