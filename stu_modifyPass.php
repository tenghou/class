<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_modify');

session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�ж��Ƿ��ύ��
if ($_GET['action'] == 'stu_modifyPass') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);

	//	print_r($_clean);

	//�����û�  
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query("UPDATE stu_user SET
																	stu_password='{$_clean['password']}'
																	
											WHERE
											                        stu_number='{$_COOKIE['number']}'					
				");
	//�ж��Ƿ��޸ĳɹ�
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			_location('��ϲ�㣬�޸ĳɹ���','stu_modifyPass.php');
		} else {
			_close();
			_session_destroy();
			_location('���ź����޸�ʧ�ܣ�','stu_modifyPass.php');
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��������</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
		//��ȡ����
			$_rows = _fetch_array("SELECT 
																	stu_number,stu_name
														FROM 
																	stu_user 
													 WHERE 
																	stu_number='{$_COOKIE['stu_number']}' 
														 LIMIT 
																	1
												");
				 if ($_rows) {
					$_html= array();
					$_html['name'] = $_rows['stu_name'];
					$_html['number'] = $_rows['stu_number'];
					$_html = _html($_html);
				} 
	?>

	<div id=main>
		<div id="info">
				<h2>�޸�����</h2>
				<form method="post" name="stu_modifyPass" action="?action=stu_modifyPass">
					<dl>
						<dt>��������д��������</dt>
						<dd>�ա�������<?php  echo $_html['name']  ?></dd>
						<dd>ѧ�����ţ�<?php  echo $_html['number']  ?></dd>
						<dd>�ܡ����룺<input type="password" name="password" class="text note"/></dd>
						<dd>����ȷ�ϣ�<input type="password" name="notpassword" class="text note"/></dd>
		                <dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
						<dd><input type="submit" class="submit" value="ȷ��" /></dd>
					</dl>
				</form>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>