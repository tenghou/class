<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_project_other');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

//����ͷ�ļ�
/* include ROOT_PATH.'includes/header.inc.php'; */

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}

//��ȡ��Ŀ�ĵ���Ϣ
$_result = _fetch_array("SELECT
														doc_id,
														doc_stuName,
														doc_stuNum,
														doc_manage,doc_man_time,doc_man_url,
														doc_development,doc_dev_time,doc_dev_url,
		                                                doc_user,doc_use_time,doc_use_url,
														doc_design,doc_des_time,doc_des_url,
														doc_code,doc_cod_time,doc_cod_url
										  FROM
														document
					                    WHERE
					                                    doc_stuNum = '{$_COOKIE['stu_number']}'
	                   	");
if ($_result) {
	$_html= array();
	$_html['doc_stuName'] = $_result['doc_stuName'];
	$_html['doc_stuNum'] = $_result['doc_stuNum'];
	$_html['doc_man_time'] = $_result['doc_man_time'];
	$_html['doc_man_url'] = _url($_result['doc_man_url']);
	$_html['doc_dev_time'] = $_result['doc_dev_time'];
	$_html['doc_dev_url'] = _url($_result['doc_dev_url']);
	$_html['doc_use_time'] = $_result['doc_use_time'];
	$_html['doc_use_url'] = _url($_result['doc_use_url']);
	$_html['doc_des_time'] = $_result['doc_des_time'];
	$_html['doc_des_url'] = _url($_result['doc_des_url']);
	$_html['doc_cod_time'] = $_result['doc_cod_time'];
	$_html['doc_cod_url'] = _url($_result['doc_cod_url']);
	$_html = _html($_html);
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��Ŀ�ĵ��б�</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
	?>
	
	<div id=main>
		<h2>��Ŀ�ĵ��б�</h2>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th>��Ŀ�鳤</th><th>��Ŀ�����ĵ�</th><th>����ʱ��</th><th>����</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_man_url'];}else echo'###'?>" ><?php if($_html['doc_man_url'])echo '��Ŀ�����ĵ�'; else echo '��δ�ύ';?></a></td><td><?php echo _title1($_html['doc_man_time'],10)?></td><td><a href="submit_document.php?id=1">�ύ�ĵ�</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>��Ŀ�鳤</th><th>�з��ĵ�</th><th>����ʱ��</th><th>����</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_dev_url'];}else echo'###'?>" ><?php if($_html['doc_dev_url'])echo '�з��ĵ�'; else echo '��δ�ύ';?></a></td><td><?php echo _title1($_html['doc_dev_time'],10)?></td><td><a href="submit_document.php?id=2">�ύ�ĵ�</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>��Ŀ�鳤</th><th>�û��ĵ�</th><th>����ʱ��</th><th>����</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_use_url'];}else echo'###'?>" ><?php if($_html['doc_use_url'])echo '�û��ĵ�'; else echo '��δ�ύ';?></a></td><td><?php echo _title1($_html['doc_use_time'],10)?></td><td><a href="submit_document.php?id=3">�ύ�ĵ�</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>��Ŀ�鳤</th><th>���ڱ���</th><th>����ʱ��</th><th>����</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_des_url'];}else echo'###'?>" ><?php if($_html['doc_des_url'])echo '��Ŀ��Ʊ���'; else echo '��δ�ύ';?></a></td><td><?php echo _title1($_html['doc_des_time'],10)?></td><td><a href="submit_document.php?id=4">�ύ�ĵ�</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>��Ŀ�鳤</th><th>���ⱨ��</th><th>����ʱ��</th><th>����</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_cod_url'];}else echo'###'?>" ><?php if($_html['doc_cod_url'])echo 'ϵͳ�з�����'; else echo '��δ�ύ';?></a></td><td><?php echo _title1($_html['doc_cod_time'],10)?></td><td><a href="submit_document.php?id=5">�ύ�ĵ�</a></td></tr>
			</table>
		</div>
		
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







