<?php

//��ֹ�������
if (!defined('IN_AC')) {
	exit('Access Defined!');
}


/**
 * _connect() ����MYSQL���ݿ�
 * @access public
 * @return void
 */

function _connect() {
	//global ��ʾȫ�ֱ�������˼����ͼ�ǽ��˱����ں����ⲿҲ�ܷ���
	global $_conn;
	if (!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD)) {
		exit('���ݿ�����ʧ��');
	}
}

/**
 * _select_dbѡ��һ�����ݿ�
 * @return void
 */

function _select_db() {
	if (!mysql_select_db(DB_NAME)) {
		exit('�Ҳ���ָ�������ݿ�');
	}
}

/**
 * 
 */

function _set_names() {
	if (!mysql_query('SET NAMES gb2312')) {
		exit('�ַ�������');
	}
}

/**
 * 
 * @param $_sql
 */

function _query($_sql) {
	if (!$_result = mysql_query($_sql)) {
		exit('SQLִ��ʧ��'.mysql_error());
	}
	return $_result;
}

/**
 * _fetch_arrayֻ�ܻ�ȡָ�����ݼ�һ��������
 * @param $_sql
 */

 function _fetch_array($_sql) {
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
} 


/**
 * _fetch_array_list���Է���ָ�����ݼ�����������
 * @param $_result
 */

function _fetch_array_list($_result) {
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}

function _num_rows($_result) {
	return mysql_num_rows($_result);
}


/**
 * _affected_rows��ʾӰ�쵽�ļ�¼��
 */

function _affected_rows() {
	return mysql_affected_rows();
}

/**
 * _free_result���ٽ����
 * @param $_result
 */

function _free_result($_result) {
	mysql_free_result($_result);
}


/**
 * 
 * @param $_sql
 * @param $_info
 */

function _is_repeat($_sql,$_info) {
	if (_fetch_array($_sql)) {
		_alert_back($_info);
	}
}


function _close() {
	if (!mysql_close()) {
		exit('�ر��쳣');
	}
}




?>