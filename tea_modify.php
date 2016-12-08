<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_modify');

session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�ж��Ƿ��ύ��
if ($_GET['action'] == 'tea_modify') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['idNumber'] = _check_id($_POST['idNumber']);
	$_clean['age'] = _check_empty($_POST['age'],'����');
	$_clean['college'] = _check_empty($_POST['college'],'ѧԺ��λ');
	$_clean['field'] = _check_empty($_POST['field'],'�о�����');
	$_clean['post'] = _check_empty($_POST['post'],'ְ��');
	$_clean['title'] = _check_empty($_POST['title'],'ְ��');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'��ϵ�绰');
	$_clean['email'] = _check_email($_POST['email']);
	//	print_r($_clean);

	//�����û�
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query("UPDATE tea_user SET
													tea_sex='{$_clean['sex']}',
													tea_idNumber='{$_clean['idNumber']}',
													tea_age='{$_clean['age']}',
													tea_college='{$_clean['college']}',
													tea_field='{$_clean['field']}',
													tea_post='{$_clean['post']}',
													tea_title='{$_clean['title']}',
													tea_phoneNumber='{$_clean['phoneNumber']}',
													tea_email='{$_clean['email']}'
								WHERE
													tea_name='{$_COOKIE['tea_name']}'
			");
	//�ж��Ƿ��޸ĳɹ�
			if (_affected_rows() == 1) {
				_close();
				_session_destroy();
				_location('��ϲ�㣬�޸ĳɹ���','tea_modify.php');
			} else {
				_close();
				_session_destroy();
				_location('���ź���û�����κ��޸ģ�','tea_modify.php');
			}
}
//�Ƿ�������¼
if (isset($_COOKIE['tea_name'])) {
	//��ȡ����
	$_rows = _fetch_array("SELECT
			                                        tea_name,tea_sex,tea_idNumber,tea_age,tea_college,tea_field,tea_post,tea_title,tea_phoneNumber,tea_email 
			                             FROM 
			                                        tea_user 
			                           WHERE 
			                                        tea_name='{$_COOKIE['tea_name']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['tea_name'];
		$_html['sex'] = $_rows['tea_sex'];
		$_html['idNumber'] = $_rows['tea_idNumber'];
		$_html['age'] = $_rows['tea_age'];
		$_html['college'] = $_rows['tea_college'];
		$_html['field'] = $_rows['tea_field'];
		$_html['post'] = $_rows['tea_post'];
		$_html['title'] = $_rows['tea_title'];
		$_html['phoneNumber'] = $_rows['tea_phoneNumber'];
		$_html['email'] = $_rows['tea_email'];
		$_html = _html($_html);
		
		//�Ա�ѡ��
		if ($_html['sex'] == '��') {
			$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" checked="checked" /> �� </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" /> Ů</label>';
		} elseif ($_html['sex'] == 'Ů') {
			$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" /> �� </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" checked="checked" /> Ů</label>';
		}/* else {
		_alert_back('���û�������');
		} */
	}
} else {
	_alert_back('�Ƿ���¼');
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
		require ROOT_PATH.'includes/tea_header.inc.php';
	?>	

	<div id=main>
		<div id="info">
				<h2>�޸�����</h2>
				<form method="post" name="tea_modify" action="?action=tea_modify">
					<dl>
						<dt>��������д��������</dt>
						<dd>�ա���������<?php echo $_html['name'] ?></dd>
						<dd>�ԡ�������<?php echo $_html['sex_html']?></dd>
						<dd>�� �� ֤ �ţ�<input type="text" name="idNumber" class="text" value="<?php echo $_html['idNumber'];?>"/> (*����)</dd>
						<dd>�ꡡ�����䣺<input type="text" name="age" class="text" value="<?php echo $_html['age'];?>"/> (*����)</dd>
						<dd>ѧԺ��λ��<input type="text" name="college" class="text" value="<?php echo $_html['college'];?>"/> (*����)</dd>
						<dd>�� �� �� ��<input type="text" name="field" class="text" value="<?php echo $_html['field'];?>"/> (*����)</dd>
						<dd>ְ��������<input type="text" name="post" class="text" value="<?php echo $_html['post'];?>"/> (*����)</dd>
						<dd>ְ�������ƣ�<input type="text" name="title" class="text" value="<?php echo $_html['title'];?>"/> (*����)</dd>
						<dd>�� ϵ �� ����<input type="text" name="phoneNumber" class="text" value="<?php echo $_html['phoneNumber'];?>"/> (*����)</dd>
						<dd>�� �� �� �䣺<input type="text" name="email" class="text" value="<?php echo $_html['email'];?>"/></dd>				
		                <dd>�顡֤���룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
						<dd><input type="submit" class="submit tea_submit" value="ȷ��" /></dd>
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







