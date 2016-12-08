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
if ($_GET['action'] == 'stu_modify') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	//$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['birth'] = _check_empty($_POST['birth'],'��������');
	$_clean['college'] = _check_empty($_POST['college'],'ѧԺ');
	$_clean['major'] = _check_empty($_POST['major'],'רҵ');
	$_clean['grade'] = _check_empty($_POST['grade'],'�꼶');
	//	$_clean['number'] = _check_empty($_POST['number'],'ѧ��');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'��ϵ�绰');
	//	print_r($_clean);

	//�����û�
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query("UPDATE stu_user SET
													
													stu_email='{$_clean['email']}',
													stu_id='{$_clean['id']}',
													stu_sex='{$_clean['sex']}',
													stu_birth='{$_clean['birth']}',
													stu_college='{$_clean['college']}',
													stu_major='{$_clean['major']}',
													stu_grade='{$_clean['grade']}',
													stu_phoneNumber='{$_clean['phoneNumber']}'
								WHERE
													stu_number='{$_COOKIE['stu_number']}'
			");
	//�ж��Ƿ��޸ĳɹ�
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			_location('��ϲ�㣬�޸ĳɹ���','stu_modify.php');
		} else {
			_close();
			_session_destroy();
			_location('���ź���û�����κ��޸ģ�','stu_modify.php');
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
				                                        stu_name,stu_number,stu_sex,stu_id,stu_birth,stu_college,stu_major,stu_grade,stu_phoneNumber,stu_email 
				                             FROM 
				                                        stu_user 
				                           WHERE 
				                                        stu_number='{$_COOKIE['stu_number']}'");
		if ($_rows) {
			$_html= array();
			$_html['name'] = $_rows['stu_name'];
			$_html['number'] = $_rows['stu_number'];
			$_html['sex'] = $_rows['stu_sex'];
			$_html['id'] = $_rows['stu_id'];
			$_html['birth'] = $_rows['stu_birth'];
			$_html['college'] = $_rows['stu_college'];
			$_html['major'] = $_rows['stu_major'];
			$_html['grade'] = $_rows['stu_grade'];
			$_html['phoneNumber'] = $_rows['stu_phoneNumber'];
			$_html['email'] = $_rows['stu_email'];
			$_html = _html($_html);
			
			//�Ա�ѡ��
			 if ($_html['sex'] == '��') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" checked="checked" /> �� </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" /> Ů</label>';
			} elseif ($_html['sex'] == 'Ů') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" />��</label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" checked="checked" /> Ů</label>';
			}else {
			_alert_back('���û�������');
			} 
		}
	?>

	<div id=main>
		<div id="info">
				<h2>�޸�����</h2>
				<form method="post" name="stu_modify" action="?action=stu_modify">
					<dl>
						<dt>��������д��������</dt>
						<dd>�ա�������<?php  echo $_html['name']  ?></dd>
						<dd>ѧ�����ţ�<?php  echo $_html['number']  ?></dd>
						<dd>�ԡ�����<?php echo $_html['sex_html']?></dd>
						<dd>���֤�ţ�<input type="text"  class="text"  name="id" value="<?php echo $_html['id']?>"  /> (*����)</dd>
						<dd>�������ڣ�<input type="text"  class="text"  name="birth" value="<?php echo $_html['birth']?>"  /> (*����)</dd>
						<dd>ѧ����Ժ��<input type="text"  class="text"  name="college" value="<?php echo $_html['college']?>" /> (*����)</dd>
						<dd>ר����ҵ��<input type="text"  class="text"  name="major" value="<?php echo $_html['major']?>"  /> (*����)</dd>
						<dd>�ꡡ������<input type="text"  class="text"  name="grade" value="<?php echo $_html['grade']?>" /> (*����)</dd>
						<dd>��ϵ�绰��<input type="text" class="text"  name="phoneNumber"  value="<?php echo $_html['phoneNumber']?>" /> (*����)</dd>
						<dd>�������䣺<input type="text" class="text"  name="email" value="<?php echo $_html['email']?>"  /></dd>				
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







