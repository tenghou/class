<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','tea_mark_detail');
//����session����֤ ��֤��
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�жϵ�ַ����id�Ƿ����
if(!isset($_GET['id'])){
	_alert_back('�Ƿ�������');
}

$id=$_GET['id'];
$_rows = _fetch_array("SELECT
													pro_id,pro_name,pro_applicant,pro_college,pro_sort,pro_point,pro_mark
									  FROM
													project
									WHERE
													pro_id='{$_GET['id']}'
							");
							
if ($_rows) {					
	$_html = array();
	$_html['pro_id'] = $_rows['pro_id'];
	$_html['pro_name'] = $_rows['pro_name'];
	$_html['pro_applicant'] = $_rows['pro_applicant'];
	$_html['pro_college'] = $_rows['pro_college'];
	$_html['pro_sort'] = $_rows['pro_sort'];
	$_html['pro_point'] = $_rows['pro_point'];
	$_html['pro_mark'] = $_rows['pro_mark'];
	$_html = _html($_html);
}

if($_GET['action']=='submit'){
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['point'] = _check_empty($_POST['point'],'��Ŀ����');
	$_clean['mark'] = _check_mark($_POST['mark'],300);
	
	_query("UPDATE project SET
														
														pro_point='{$_clean['point']}',
														pro_mark='{$_clean['mark']}'
									WHERE
														pro_id='{$_GET['id']}'
				");

		//�ж��Ƿ��޸ĳɹ�
			if (_affected_rows() == 1) {
				_close();
				_session_destroy();
				_location('��ϲ�㣬�����ɹ���','tea_mark.php');
			} else {
				_close();
				_session_destroy();
				_alert_back('���ź�������ʧ�ܣ�','tea_mark_detail.php?id='.$id);
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
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
	?>	
	
	<div id=main>
		<h2>��Ŀ����</h2>
		
		<div id=table>
		<form method="post" action="?id=<?php echo$_html['pro_id']?>&action=submit">
			<table cellspacing="1">
				<tr><th>��Ŀ����</th><th>�걨��</th><th>ѧԺ</th><th>��Ŀ����</th></tr>
				<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td></tr>
			</table>
			
			
			<dl>
				<dd>��Ŀ������<input type="text"  class="text" name="point" value="<?php echo $_html['pro_point']?>"/></dd>
				<dd>��Ŀ������<textarea name="mark" ><?php echo $_html['pro_mark']?></textarea></dd>
				<dd>�� ֤ �룺<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" /> <input type="submit" class="submit" value="ȷ��" /><input type="button" class="back" value="����"onclick="location='tea_mark.php'"/></dd>
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







