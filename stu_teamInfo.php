<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_team');

session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�ж��Ƿ��ύ��
if ($_GET['action'] == 'submit') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	$_clean = array();
	$_clean['name'] = _check_empty($_POST['name'],'�Ŷ�����');
	$_clean['numberofstu'] = _check_empty($_POST['numberofstu'],'�Ŷ�����');
	//	print_r($_clean);

	//�����û�
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query("UPDATE project SET
													pro_teamName='{$_clean['name']}',
													pro_numberofstu='{$_clean['numberofstu']}'
								WHERE
													pro_stuNumber='{$_COOKIE['stu_number']}'
			");
	//�ж��Ƿ��޸ĳɹ�
		if (_affected_rows() >= 1) {
			_close();
			_session_destroy();
			_location('��ϲ�㣬�����ɹ���','stu_teamInfo.php');
		} else {
			_close();
			_session_destroy();
			_location('���ź�������ʧ�ܣ�','stu_teamInfo.php');
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
		
		//��ȡ���ݶӳ���Ϣ
		$_rows = _fetch_array("SELECT 
				                                        pro_applicant,pro_teamName,pro_numberofstu
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_COOKIE['stu_number']}'");
		if ($_rows) {
			$_html= array();
			$_html['pro_applicant'] = $_rows['pro_applicant'];
			$_html['numberofstu'] = $_rows['pro_numberofstu'];
			$_html['pro_teamName'] = $_rows['pro_teamName'];
			$_html = _html($_html);
		}
	?>

	<div id=main>
		<div id="info">
				<h2>�Ŷ���Ϣ</h2>
				<form method="post" name="register" action="?action=submit">
				<dl>
					<dt>��������дһ������</dt>
					<dd>�ӳ�������<?php  echo $_html['pro_applicant']  ?></dd>
					<dd>�Ŷ����ƣ�<input type="text" name="name" class="text"  value="<?php echo $_html['pro_teamName']?>" /> (*����)</dd>
					<dd>�Ŷ�������<input type="text" name="numberofstu" class="count"  value="<?php echo $_html['numberofstu']?>" /> (*����)</dd>
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







