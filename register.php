<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
/* define('SCRIPT','register'); */
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<link rel="stylesheet" type="text/css" href="style/register.css" />
<link rel="stylesheet" type="text/css" href="style/header.inc.css" /> 
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-ע��</title>

</head>

<?php
//�ж��Ƿ��ύ��
if ($_GET['action'] == 'register') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
 	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php'; 
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['number'] = _check_empty($_POST['number'],'ѧ��');
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['birth'] = _check_empty($_POST['birth'],'��������');
	$_clean['college'] = _check_empty($_POST['college'],'ѧԺ');
	$_clean['major'] = _check_empty($_POST['major'],'רҵ');
	$_clean['grade'] = _check_empty($_POST['grade'],'�꼶');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'��ϵ�绰');
	//	print_r($_clean);
	//������֮ǰ��Ҫ�ж��û����Ƿ��ظ�
	_is_repeat(
		"SELECT stu_number FROM stu_user WHERE stu_number='{$_clean['number']}' LIMIT 1",
		'�Բ��𣬸�ѧ���ѱ�ע��'
			);

	//�����û�
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query(
							"INSERT INTO stu_user (
																	stu_number,
																	stu_name,
																	stu_password,
																	stu_email,
																	stu_id,
																	stu_sex,
																	stu_birth,
																	stu_college,
																	stu_major,
																	stu_grade,
																	stu_phoneNumber
															 )
												VALUES (
																	'{$_clean['number']}',
																	'{$_clean['name']}',
																	'{$_clean['password']}',
																	'{$_clean['email']}',
																	'{$_clean['id']}',
																	'{$_clean['sex']}',
																	'{$_clean['birth']}',
																	'{$_clean['college']}',
																	'{$_clean['major']}',
																	'{$_clean['grade']}',
																	'{$_clean['phoneNumber']}'
															)"
				);
	if (_affected_rows() == 1) {
			_close();
			_location('��ϲ�㣬ע��ɹ���','index.php');
		} else {
			_close();
			_location('���ź���ע��ʧ�ܣ�','register.php');
		}
	}

?>

<body>

<div id="header">
    <h1><a href=### >�Ƽ���Ŀ����ƽ̨</a></h1>
 </div>
 
<div id=main>
	<div id="info">
			<h2>ע��</h2>
			<form method="post" name="register" action="?action=register">
				<dl>
					<dt>��������дһ������</dt>
					<dd>�ա�������<input type="text" name="name" class="text" /> (*����)</dd>
					<dd>ѧ�����ţ�<input type="text" name="number" class="text" /> (*����)</dd>
					<dd>�ԡ�����<label><input type="radio" name="sex" value="��" checked="checked" />��</label> <label><input type="radio" name="sex" value="Ů" />Ů</label></dd>
					<dd>�ܡ����룺<input type="password" name="password" class="text note"/> (*����)</dd>
					<dd>����ȷ�ϣ�<input type="password" name="notpassword" class="text note"/> (*����)</dd>
					<dd>���֤�ţ�<input type="text" name="id" class="text" /> (*����)</dd>
					<dd>�������ڣ�<input type="text" name="birth" class="text" /> (*����)</dd>
					<dd>ѧ����Ժ��<input type="text" name="college" class="text" /> (*����)</dd>
					<dd>ר����ҵ��<input type="text" name="major" class="text" /> (*����)</dd>
					<dd>�ꡡ������<input type="text" name="grade" class="text" /> (*����)</dd>
					<dd>��ϵ�绰��<input type="text" name="phoneNumber" class="text" /> (*����)</dd>
					<dd>�������䣺<input type="text" name="email" class="text" /></dd>				
	                <dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
					<dd><input type="submit" class="submit" value="ȷ��" /><input type="button" class="submit location" value="����"onclick="location='login.php'"/></dd>
				</dl>
			</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







