<?php

//��ֹ�������
if (!defined('IN_AC')) {
    exit('Access Defined!');
}

if (!function_exists('_alert_back')) {
    exit('_alert_back()���������ڣ�����!');
}

if (!function_exists('_mysql_string')) {
    exit('_mysql_string()���������ڣ�����!');
}

/**
 * _setcookies���ɵ�¼cookies
 * @param unknown_type $_number
 */
/* function _setcookies($_number) {
    //���������
    setcookie('number',$_number);
}
 */

/**
 * _check_number��ʾ��Ⲣ���˵�¼ѧ��
 * @access public
 * @param string $_string ����Ⱦ�ĵ�¼ѧ��
 * @return string  ���˺�ĵ�¼ѧ��
 */
function _check_number($_string) {
    //ȥ�����ߵĿո�
    $_string = trim($_string);

    //�û�������Ϊ��
    if (mb_strlen($_string,'utf-8') ==0) {
        _alert_back('��¼ѧ�Ų���Ϊ��');
    }

    //���������ַ�
    $_char_pattern = '/[<>\'\"\ \��]/';
    if (preg_match($_char_pattern,$_string)) {
        _alert_back('��¼ѧ�Ų��ð����Ƿ��ַ�');
    }

    //���û���ת������
    return _mysql_string($_string);
}

/**
 * _check_password��֤����
 * @access public
 * @param string $_first_pass
 * @param int $_min_num
 * @return string $_first_pass ����һ�����ܺ������
 */

function _check_login_password($_string,$_min_num) {
	//�ж�����
	if (strlen($_string) < $_min_num) {
		_alert_back('���벻��С��'.$_min_num.'λ��');
	}

	//�����뷵��
	return sha1($_string);
}

?>