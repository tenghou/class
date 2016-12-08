<?php

session_start();

//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

_unsetcookies();
?>