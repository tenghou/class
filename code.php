<?php
session_start();
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//引入公共文件
require dirname(_FILE_).'/includes/common.inc.php';

//运行验证码函数
//_code(长，宽，位数，$_flag) 验证码图片的大小为：75*25，默认位数是4位，如果要6位，长度推荐125,如果要8位，长度推荐175,
//第四位参数是：是否要边框，默认为不要，要的话 填 true，不要则为false
_code();

?>