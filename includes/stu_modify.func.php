<?php




//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);

if (!function_exists('_alert_back')) {
	exit('_alert_back()���������ڣ�����!');
}

if (!function_exists('_mysql_string')) {
	exit('_mysql_string()���������ڣ�����!');
}


/**
 * _check_name��ʾ��Ⲣ�����û���
 * @access public
 * @param string $_string ����Ⱦ���û���
 * @param int $_min_num  ��Сλ��
 * @param int $_max_num ���λ��
 * @return string  ���˺���û���
 */
function _check_name($_string,$_min_num,$_max_num) {
	//ȥ�����ߵĿո�
	$_string = trim($_string);

	//����С��1λ���ߴ���10λ
	if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num) {
		_alert_back('�������˺ų��Ȳ���С��'.$_min_num.'λ���ߴ���'.$_max_num.'λ');
	}

	//���������ַ�
	$_char_pattern = '/[<>\'\"\ \��]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('�û������ð��������ַ�');
	}


	//���û���ת������
	return _mysql_string($_string);
}

function _check_mark($_string,$_max_num) {
	//ȥ�����ߵĿո�
	$_string = trim($_string);

	//���ȴ���
	if (mb_strlen($_string,'utf-8') > $_max_num) {
		_alert_back('��Ŀ�������ô���'.$_max_num.'λ');
	}

	//���û���ת������
	return _mysql_string($_string);
}

/**
 * _check_email() ��������Ƿ�Ϸ�
 * @access public
 * @param string $_string �ύ�������ַ
 * @return string $_string ��֤�������
 */

function _check_email($_string) {
	//�ο�bnbbs@163.com
	//[a-zA-Z0-9_] => \w
	//[\w\-\.] 16.3.
	//\.[\w+] .com.com.com.net.cn
	//����������Ƚ��鷳����ֱ������
	if (empty($_string)) {
		return null;
	} else {
		if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)) {
			_alert_back('�ʼ���ʽ����ȷ��');
		}
	}

	return _mysql_string($_string);
}


/**
 * _check_id��ʾ��Ⲣ�������֤����
 * @access public
 * @return string  ���˺�����֤����
 */
function _check_id($_string) {
	//ȥ�����ߵĿո�
	$_string = trim($_string);

	//����С��1λ���ߴ���10λ
	if (mb_strlen($_string,'utf-8') !=18) {
		_alert_back('���֤�������');
	}

	//���������ַ�
	$_char_pattern = '/[<>\'\"\ \��]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('���֤���벻�ð��������ַ�');
	}


	//�����֤����ת������
	return _mysql_string($_string);
}

/**
 * _check_empty��ʾ��Ⲣ���������Ƿ�Ϊ��
 * @access public
 * @return string  ���˺������
 */
function _check_empty($_string,$_value) {
	//ȥ�����ߵĿո�
	$_string = trim($_string);

	//���Ȳ���Ϊ0
	if (empty($_string)) {
		_alert_back($_value.'����Ϊ�գ�');
	}

	//���������ַ�
	$_char_pattern = '/[<>\'\"]/';
	if (preg_match($_char_pattern,$_string)) {
		_alert_back('�������ݲ��ð��������ַ�');
	}


	//����������ת������
	return _mysql_string($_string);
}


function _check_competition($_string,$_value) {
	//���Ȳ���Ϊ0
	if (empty($_string)) {
		_alert_back($_value.'����Ϊ�գ�');
	}
	//����������ת������
	return _mysql_string($_string);
}

/**
 * _check_sex  �Ա�
 * @access public
 * @param string $_string
 * @return string
 */

function _check_sex($_string) {
	return _mysql_string($_string);
}

/**
 * _check_password��֤����
 * @access public
 * @param string $_first_pass
 * @param string $_end_pass
 * @param int $_min_num
 * @return string $_first_pass ����һ�����ܺ������
 */

function _check_password($_first_pass,$_end_pass,$_min_num) {
	//�ж�����
	if (strlen($_first_pass) < $_min_num) {
		_alert_back('���벻��С��'.$_min_num.'λ��');
	}
	
	//���������ȷ�ϱ���һ��
	if ($_first_pass != $_end_pass) {
		_alert_back('�����ȷ�����벻һ�£�');
	}
	
	//�����뷵��
	return sha1($_first_pass);
}





?>