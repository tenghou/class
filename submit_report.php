<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','submit_report');
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}



if ($_GET['action'] == 'submit') {
/* 	$type=$_POST['type']; */

	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['name'] = $_POST['name'];
	$_clean['pro_repurl'] = _check_empty($_POST['rep_url'],'��Ŀ�ܱ�');

	//����project���е���Ŀ�ܱ�����ʱ��
	_query("UPDATE project SET
														pro_reptime=NOW()
									WHERE
														pro_stuNumber='{$_COOKIE['stu_number']}' AND pro_id='{$_GET['id']}'
										LIMIT
														1
			");
	
	//����report��Ŀ�ܱ����е���Ϣ
	_query(
							"INSERT INTO report (
																	name,
																	stuNumber,
																	url,
																	time
															 )
												VALUES (
																	'{$_clean['name']}',
																	'{$_COOKIE['stu_number']}',
																	'{$_clean['pro_repurl']}',
																	NOW()
															)"
				);
		//�ж��Ƿ�ɹ��������ݿ�
		if (_affected_rows() ==1) {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('��ϲ�㣬�ύ�ɹ���');location.href='stu_current_project.php';</script>";
			/* _location('��ϲ�㣬�����ɹ���','submit_pro.php'); */
			
		} else {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('���ź����ύʧ�ܣ�');location.href='submit_report.php';</script>";
		} 
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_report.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-�ύ��Ŀ����</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
		$_rows = _fetch_array("SELECT 
					                                        stu_name,
															stu_college
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
		
				$_html = _html($_html);
			}
	?>
	
	<div id=main class=submi_pro>
		<h2>�ύ��Ŀ����</h2>
		<form method="post" action="?id=<?php echo $_GET['id']?>&action=submit">
		<dl>
			<dd><input type="hidden" name="name" value="<?php echo $_html['name']?>" /></dd>
			<dd>��Ŀ�ӳ���<?php echo $_html['name']?></dd>
			<dd>����ѧԺ��<?php echo $_html['college']?></dd>
			<dd>��Ŀ�ܱ���<input type="text" name="rep_url" id="url" readonly="readonly" class="text" /> <a href="javascript:;"  id="up">�ϴ�</a></dd>
			<dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="�ύ����" /><input type="button" class="submit location" value="����"onclick="location='stu_current_project.php'"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







