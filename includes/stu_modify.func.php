<?php




//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);

if (!function_exists('_alert_back')) {
	exit('_alert_back()函数不存在，请检查!');
}

if (!function_exists('_mysql_string')) {
	exit('_mysql_string()函数不存在，请检查!');
}


/**
 * _check_name表示检测并过滤用户名
 * @access public
 * @param string $_string 受污染的用户名
 * @param int $_min_num  最小位数
 * @param int $_max_num 最大位数
 * @return string  过滤后的用户名
 */
function _check_name($_string,$_min_num,$_max_num) {
	//去掉两边的空格
	$_string = trim($_string);

	//长度小于1位或者大于10位
	if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num) {
		_alert_back('姓名或账号长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位');
	}

	//限制敏感字符
	$_char_pattern = '/[<>\'\"\ \　]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('用户名不得包含敏感字符');
	}


	//将用户名转义输入
	return _mysql_string($_string);
}

function _check_mark($_string,$_max_num) {
	//去掉两边的空格
	$_string = trim($_string);

	//长度大于
	if (mb_strlen($_string,'utf-8') > $_max_num) {
		_alert_back('项目点评不得大于'.$_max_num.'位');
	}

	//将用户名转义输入
	return _mysql_string($_string);
}

/**
 * _check_email() 检查邮箱是否合法
 * @access public
 * @param string $_string 提交的邮箱地址
 * @return string $_string 验证后的邮箱
 */

function _check_email($_string) {
	//参考bnbbs@163.com
	//[a-zA-Z0-9_] => \w
	//[\w\-\.] 16.3.
	//\.[\w+] .com.com.com.net.cn
	//如果听起来比较麻烦，就直接套用
	if (empty($_string)) {
		return null;
	} else {
		if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)) {
			_alert_back('邮件格式不正确！');
		}
	}

	return _mysql_string($_string);
}


/**
 * _check_id表示检测并过滤身份证号码
 * @access public
 * @return string  过滤后的身份证号码
 */
function _check_id($_string) {
	//去掉两边的空格
	$_string = trim($_string);

	//长度小于1位或者大于10位
	if (mb_strlen($_string,'utf-8') !=18) {
		_alert_back('身份证号码错误！');
	}

	//限制敏感字符
	$_char_pattern = '/[<>\'\"\ \　]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('身份证号码不得包含敏感字符');
	}


	//将身份证号码转义输入
	return _mysql_string($_string);
}

/**
 * _check_empty表示检测并过滤输入是否为空
 * @access public
 * @return string  过滤后的输入
 */
function _check_empty($_string,$_value) {
	//去掉两边的空格
	$_string = trim($_string);

	//长度不能为0
	if (empty($_string)) {
		_alert_back($_value.'不能为空！');
	}

	//限制敏感字符
	$_char_pattern = '/[<>\'\"]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('输入内容不得包含敏感字符');
	}


	//将输入内容转义输入
	return _mysql_string($_string);
}


function _check_competition($_string,$_value) {
	//长度不能为0
	if (empty($_string)) {
		_alert_back($_value.'不能为空！');
	}
	//将输入内容转义输入
	return _mysql_string($_string);
}

/**
 * _check_sex  性别
 * @access public
 * @param string $_string
 * @return string
 */

function _check_sex($_string) {
	return _mysql_string($_string);
}

/**
 * _check_password验证密码
 * @access public
 * @param string $_first_pass
 * @param string $_end_pass
 * @param int $_min_num
 * @return string $_first_pass 返回一个加密后的密码
 */

function _check_password($_first_pass,$_end_pass,$_min_num) {
	//判断密码
	if (strlen($_first_pass) < $_min_num) {
		_alert_back('密码不得小于'.$_min_num.'位！');
	}
	
	//密码和密码确认必须一致
	if ($_first_pass != $_end_pass) {
		_alert_back('密码和确认密码不一致！');
	}
	
	//将密码返回
	return sha1($_first_pass);
}





?>