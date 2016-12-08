<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm_add_adjudicator');
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
	$_clean['sex'] = $_POST['sex'];
	$_clean['password'] = _check_password('123456','123456',6);
	$_clean['email'] = _check_email($_POST['email']);
	//	print_r($_clean);
	//���������ʦ֮ǰ��������������������ݿ������д���ʦ�������ݿ���û��
	//�����ж����ݿ����Ƿ��д���ʦ
	if(_fetch_array("SELECT tea_name from tea_user where tea_name ='{$_clean['name']}' limit 1")){
		//���У��жϸ���ʦ�Ƿ�Ϊ������ʦ
		_is_repeat("SELECT 
										tea_name 
						   FROM 
										tea_user 
					     WHERE 
										tea_name ='{$_clean['name']}' AND tea_adj='1'
						   LIMIT 
										1",'�Բ��𣬸��˻�����������ʦ');
		//������ʦ����������ʦ������������ʦ״̬��tea_adj����Ϊ1
		_query("UPDATE tea_user SET
															tea_adj='1'
											WHERE
															tea_name ='{$_clean['name']}'
				");
		}else{
			//�����ݿ���û�д���ʦ��������������ʦ����Ϣ
			_query("INSERT INTO tea_user (
															tea_name,
															tea_sex,
															tea_password,
															tea_email,
															tea_adj
														)
										VALUES (
															'{$_clean['name']}',
															'{$_clean['sex']}',
															'{$_clean['password']}',
															'{$_clean['email']}',
															'1'
													
													)
					");
			}
		if (_affected_rows() == 1) {
			_close();
			_location('��ϲ�㣬��ӳɹ���','adm_add_adjudicator.php');
		} else {
			_close();
			_location('���ź������ʧ�ܣ�','adm_add_adjudicator.php');
		} 
}

//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT tea_id FROM tea_user WHERE tea_adj='1'  ",5);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											tea_id,tea_name,tea_email,tea_last_time
							  FROM
											tea_user
							WHERE 
											tea_adj='1'
						ORDER BY
											tea_id
						       LIMIT
											$_pagenum,$_pagesize
		");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��������</title>
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
					<tr><th colspan="5">������ʦ�б�</th></tr>
					<tr><th width=7%>ID</th><th>����</th><th>����</th><th>����¼ʱ��</th><th width=8%>����</th></tr>
					<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['id'] = $_rows['tea_id'];
							$_html['name'] = $_rows['tea_name'];
							$_html['email'] = $_rows['tea_email'];
							$_html['time'] = $_rows['tea_last_time'];
				   	?>
					
					<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['name']?></td><td><?php if($_html['email']) echo $_html['email']; else echo '����';?></td><td><?php echo $_html['time']?></td><td>�鿴</td></tr>
					
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
						<dt>���������ʦ������Ĭ��Ϊ123456��</dt>
						<dd>�ա�������<input type="text" name="name" class="text" /> (*����)</dd>
						<dd>�ԡ�����<label><input type="radio" name="sex" value="��" checked="checked" />��</label> <label><input type="radio" name="sex" value="Ů" />Ů</label></dd>
						<dd>�������䣺<input type="text" name="email" class="text" /></dd>
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







