<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_info');
//���빫���ļ�
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('���¼���ٽ��иò���');
}
//��ȡ����
	$_rows = _fetch_array("SELECT
			                                        tea_name,tea_sex,tea_idNumber,tea_age,tea_college,tea_field,tea_post,tea_title,tea_phoneNumber,tea_email 
			                             FROM 
			                                        tea_user 
			                           WHERE 
			                                        tea_name='{$_GET['name']}'");

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
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-ָ����ʦ��Ϣ</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		include ROOT_PATH.'includes/adm_header.inc.php';
	?>	

	<div id=main>
		<h2>ָ����ʦ��Ϣ</h2>
		<dl>
					<dd>�ա�����������<?php echo $_html['name'] ?></dd>
					<dd>�ԡ������𣺡�<?php echo $_html['sex']?></dd>
					<dd>�� �� ֤ �ţ���<?php echo $_html['idNumber']?></dd>
					<dd>�ꡡ�����䣺��<?php echo $_html['age'];?></dd>
					<dd>ѧԺ��λ����<?php echo $_html['college'];?></dd>
					<dd>�� �� �� �򣺡�<?php echo $_html['field'];?></dd>
					<dd>ְ�������񣺡�<?php echo $_html['post'];?></dd>
					<dd>ְ�������ƣ���<?php echo $_html['title'];?></dd>
					<dd>�� ϵ �� ������<?php echo $_html['phoneNumber'];?></dd>
					<dd>�� �� �� �䣺��<?php echo $_html['email'];?></dd>				
					<dd><input type="button" class="back" value="����"onclick="history.back()"/></dd>
		</dl>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







