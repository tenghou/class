<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm_add_admin');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('���¼���ٽ��иò���');
}

//�ж��Ƿ��ύ��
if ($_GET['action'] == 'add') {
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);

	//�ж��Ƿ��ظ�
	_is_repeat("SELECT 
										adm_username 
						   FROM 
										adm_user 
					     WHERE 
										adm_username='{$_clean['name']}'
						   LIMIT 
										1",'�Բ��𣬸��˻����ǹ���Ա');
	
	_query("INSERT INTO adm_user (
															adm_username,
															adm_password
														)
										VALUES (
															'{$_clean['name']}',
															'{$_clean['password']}'
													
													)
					");
	if (_affected_rows() == 1) {
		_close();
		_location('��ϲ�㣬��ӳɹ���','adm_add_admin.php');
	} else {
		_close();
		_location('���ź������ʧ�ܣ�','adm_add_admin.php');
	}
}
//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT adm_id FROM adm_user",5);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											adm_id,adm_username,adm_last_time,adm_last_ip
							  FROM
											adm_user
						ORDER BY
											adm_id
						       LIMIT
											$_pagenum,$_pagesize
		");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��ӹ���Ա</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/adm_header.inc.php';
	?>	

	<div id=main>
		<h2>�����Ϣ</h2>
		<div id=table>
			<table cellspacing="1">
				<tr><th colspan="5">����Ա�б�</th></tr>
				<tr><th width=7%>ID</th><th>�˺�</th><th>����¼ʱ��</th><th>����¼IP</th><th>����</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['id'] = $_rows['adm_id'];
						$_html['name'] = $_rows['adm_username'];
						$_html['time'] = $_rows['adm_last_time'];
						$_html['ip'] = $_rows['adm_last_ip'];
			   	?>
				
				<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['name']?></td><td><?php echo $_html['time']?></td><td><?php if($_html['ip']) echo $_html['ip'];else echo '���޵�¼��¼';?></td><td>����</td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>					
			</table>
			
				<?php 
					//_pageing�������÷�ҳ��1|2��1��ʾ���ַ�ҳ��2��ʾ�ı���ҳ
					_paging(2);
				?>
		</div>
		
		<div id="info">
			<form method="post" name="add" action="?action=add">
				<dl>
					<dt>��ӹ���Ա</dt>
					<dd>�ˡ����ţ�<input type="text" name="name" class="text" /> </dd>
					<dd>�ܡ����룺<input type="password" name="password" class="text note"/> </dd>
					<dd>����ȷ�ϣ�<input type="password" name="notpassword" class="text note"/> </dd>
					<dd><input type="submit" class="submit" value="ȷ�����" /></dd>
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







