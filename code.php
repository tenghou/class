<?php
session_start();
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���빫���ļ�
require dirname(_FILE_).'/includes/common.inc.php';

//������֤�뺯��
//_code(������λ����$_flag) ��֤��ͼƬ�Ĵ�СΪ��75*25��Ĭ��λ����4λ�����Ҫ6λ�������Ƽ�125,���Ҫ8λ�������Ƽ�175,
//����λ�����ǣ��Ƿ�Ҫ�߿�Ĭ��Ϊ��Ҫ��Ҫ�Ļ� �� true����Ҫ��Ϊfalse
_code();

?>