<?php

//防止恶意调用
if (!defined('IN_AC')) {
    exit('Access Defined!');
}

if (!function_exists('_alert_back')) {
    exit('_alert_back()函数不存在，请检查!');
}

if (!function_exists('_mysql_string')) {
    exit('_mysql_string()函数不存在，请检查!');
}

/**
 * _setcookies生成登录cookies
 * @param unknown_type $_number
 */
/* function _setcookies($_number) {
    //浏览器进程
    setcookie('number',$_number);
}
 */

/**
 * _check_number表示检测并过滤登录学号
 * @access public
 * @param string $_string 受污染的登录学号
 * @return string  过滤后的登录学号
 */
function _check_number($_string) {
    //去掉两边的空格
    $_string = trim($_string);

    //用户名不能为空
    if (mb_strlen($_string,'utf-8') ==0) {
        _alert_back('登录学号不得为空');
    }

    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \　]/';
    if (preg_match($_char_pattern,$_string)) {
        _alert_back('登录学号不得包含非法字符');
    }

    //将用户名转义输入
    return _mysql_string($_string);
}

/**
 * _check_password验证密码
 * @access public
 * @param string $_first_pass
 * @param int $_min_num
 * @return string $_first_pass 返回一个加密后的密码
 */

function _check_login_password($_string,$_min_num) {
	//判断密码
	if (strlen($_string) < $_min_num) {
		_alert_back('密码不得小于'.$_min_num.'位！');
	}

	//将密码返回
	return sha1($_string);
}

?>