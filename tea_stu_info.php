<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_info');
//���빫���ļ�
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('���¼���ٽ��иò���');
}
//��ȡ����
$_rows = _fetch_array("SELECT 
		                                        stu_name,stu_number,stu_sex,stu_id,stu_birth,stu_college,stu_major,stu_grade,stu_phoneNumber,stu_email 
		                             FROM 
		                                        stu_user 
		                           WHERE 
		                                        stu_number='{$_GET['stu_number']}'");
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��ҵѵ����Ŀ</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
		
//��ȡ�Ŷ�����
		$_rows1 = _fetch_array("SELECT 
				                                        pro_teamName
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_html['number']}'");
		if ($_rows1) {
			$_html1= array();
			$_html1['pro_teamName'] = $_rows1['pro_teamName'];
			$_html1 = _html($_html1);
		}
		
	?>	

	<div id=main>
		<h2>ѧ����Ϣ</h2>
		
		<dl>
					<dd>�Ŷ����ƣ���<a href="tea_stuTeam.php?stu_number=<?php echo $_html['number']?>"><?php  echo $_html1['pro_teamName']  ?></a></dd>
					<dd>�ӡ���������<?php  echo $_html['name']  ?></dd>
					<dd>ѧ�����ţ���<?php  echo $_html['number']  ?></dd>
					<dd>�ԡ����𣺡�<?php echo $_html['sex']?></dd>
					<dd>���֤�ţ���<?php echo $_html['id']?></dd>
					<dd>�������ڣ���<?php echo $_html['birth']?></dd>
					<dd>ѧ����Ժ����<?php echo $_html['college']?></dd>
					<dd>ר����ҵ����<?php echo $_html['major']?></dd>
					<dd>�ꡡ��������<?php echo $_html['grade']?></dd>
					<dd>��ϵ�绰����<?php echo $_html['phoneNumber']?></dd>
					<dd>�������䣺��<?php echo $_html['email']?></dd>		
					<dd><input type="button" class="back" value="����"onclick="history.back()"/></dd>
					
				</dl>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







