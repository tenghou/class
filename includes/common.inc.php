<?php

//��ֹ�������
  if(!defined('IN_AC')){
       exit('Access Defined!');
    }

    
//����һ���Զ�ת��״̬�ĳ���
define('GPC',get_magic_quotes_gpc());

//�����ַ���
header('Content-Type:text/html;chartset=gbk2312');

//ת��Ӳ·��
define('ROOT_PATH',substr(dirname(__FILE__), 0,-8));

//�ܾ�PHP�Ͱ汾
if(PHP_VERSION<'4.1.0'){
    exit('Your php version is too low!');
}


//���뺯����
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';


//���ݿ�����
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','***');
define('DB_NAME','***');


//��ʼ�����ݿ�
_connect(); //����MYSQL���ݿ�
_select_db();   //ѡ��ָ�������ݿ�
_set_names();   //�����ַ���


// //�������ݿ�����
// $_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('����������ʧ��');

// //ѡ��һ�����ݿ�
// mysql_select_db(DB_NAME) or die('ָ�������ݿⲻ����');

// //ѡ���ַ���
// mysql_query('SET NAMES UTF8') or die('�ַ�������');


?>