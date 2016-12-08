<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','submit_pro');
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�жϵ�ַ����sort�Ƿ����
if(isset($_GET['sort'])){
	if(!($_GET['sort']==1||$_GET['sort']==2||$_GET['sort']==3||$_GET['sort']==4)){
		_alert_back('�����ڴ�ҳ�棡');
	}
}else{
	_alert_back('�Ƿ�������');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name,
													stu_college,
													stu_major,
		                                            stu_grade,
													stu_number,
													stu_phoneNumber,
													stu_email
			                         FROM 
			                                        stu_user 
			                       WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html['college'] = $_rows['stu_college'];
		$_html['major'] = $_rows['stu_major'];
		$_html['grade'] = $_rows['stu_grade'];
		$_html['stuNumber'] = $_rows['stu_number'];
		$_html['stuphoneNumber'] = $_rows['stu_phoneNumber'];
		$_html['stuemail'] = $_rows['stu_email'];
		$_html = _html($_html);
	}

	//��ȡ��Ŀ����
	if (isset($_GET['sort'])) {
		if($_GET['sort']==1){
			$_sort = '��ҵʵ����Ŀ';
		}elseif($_GET['sort']==2){
			$_sort = '��ҵѵ����Ŀ';
		}elseif($_GET['sort']==3){
			$_sort = '����ѵ����Ŀ';
		}elseif($_GET['sort']==4){
			$_sort = '����ѵ����Ŀ';
		}
	}else{
		_alert_back('�Ƿ�����');
	}
	$_year = date(Y);

if ($_GET['action'] == 'submit') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['name'] = _check_empty($_POST['name'],'��Ŀ����');
	$_clean['teacher'] = _check_empty($_POST['teacher'],'ָ����ʦ');
	$_clean['url'] = _check_empty($_POST['url'],'�걨��');
	$_clean['sex'] = $_POST['sex'];
	$_clean['password'] = _check_password('123456','123456',6);
	
	//�ж����ݿ����Ƿ��и���ʦ��Ϣ
	if(!_fetch_array("SELECT tea_name from tea_user where tea_name ='{$_clean['teacher']}' limit 1")){
	//��ָ����ʦ��ӵ���ʦ���У��Ա���ʦ��¼��Ĭ������Ϊ123456
	_query("INSERT INTO tea_user (
															tea_name,
															tea_sex,
															tea_password
														)
										VALUES (
															'{$_clean['teacher']}',
															'{$_clean['sex']}',
															'{$_clean['password']}'
													)
					");
	}
	
	//��˫�����ֱ�ӷű����ǿ��Եģ�����$_username,����������飬�ͱ������{} ������ {$_clean['username']}
	_query(
							"INSERT INTO project (
																	pro_stuNumber,
																	pro_name,
																	pro_applicant,
																	pro_sort,
																	pro_url,
																	pro_teacher,
																	pro_stuemail,
																	pro_college,
																	pro_major,
																	pro_grade,
																	pro_stuphoneNumber,
																	pro_year
															 )
												VALUES (
																	'{$_html['stuNumber']}',
																	'{$_clean['name']}',
																	'{$_html['name']}',
																	'$_sort',
																	'{$_clean['url']}',
																	'{$_clean['teacher']}',
																	'{$_html['stuemail']}',
																	'{$_html['college']}',
																	'{$_html['major']}',
																	'{$_html['grade']}',
																	'{$_html['stuphoneNumber']}',
																	'$_year'
															)"
				);
		//�ж��Ƿ�ɹ��������ݿ�
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('��ϲ�㣬�����ɹ���');location.href='submit_pro.php?sort=$_GET[sort]';</script>";
			/* _location('��ϲ�㣬�����ɹ���','submit_pro.php'); */
			
		} else {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('���ź�������ʧ�ܣ�');location.href='submit_pro.php?sort=$_GET[sort]';</script>";
		} 
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_pro.js"></script>
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
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';

		$_rows = _fetch_array("SELECT 
					                                        stu_name,
															stu_college,
															stu_major,
				                                            stu_grade,
															stu_number,
															stu_phoneNumber,
															stu_email
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
				$_html['major'] = $_rows['stu_major'];
				$_html['grade'] = $_rows['stu_grade'];
				$_html['stuNumber'] = $_rows['stu_number'];
				$_html['stuphoneNumber'] = $_rows['stu_phoneNumber'];
				$_html['stuemail'] = $_rows['stu_email'];
				$_html = _html($_html);
			}
		
	?>
	
	<div id=main class=submi_pro>
		<h2>�ϴ���Ŀ�걨��</h2>
		<form method="post" action="?sort=<?php echo $_GET[sort]?>&action=submit">
		<dl>
			<dd><input type="hidden" name="major" value="<?php echo $_html['major']?>" /></dd>
			<dd><input type="hidden" name="grade" value="<?php echo $_html['grade']?>" /></dd>
			<dd><input type="hidden" name="stuNumber" value="<?php echo $_html['stuNumber']?>" /></dd>
			<dd><input type="hidden" name="stuphoneNumber" value="<?php echo $_html['stuphoneNumber']?>" /></dd>
			<dd><input type="hidden" name="stuemail" value="<?php echo $_html['stuemail']?>" /></dd>
			<dd>��Ŀ�ӳ���<?php echo $_html['name']?></dd>
			<dd>����ѧԺ��<?php echo $_html['college']?></dd>
			<dd>��Ŀ���ƣ�<input type="text" name="name" class="text" /></dd>
			<dd>ָ����ʦ��<input type="text" name="teacher" class="text" /></dd>
			<dd>��ʦ�Ա�<label><input type="radio" name="sex" value="��" checked="checked" />��</label> <label><input type="radio" name="sex" value="Ů" />Ů</label></dd>
			<dd>�� �� �飺<input type="text" name="url" id="url" readonly="readonly" class="text" /> <a href="javascript:;" title="<?php echo $_GET['sort']?>" id="up">�ϴ�</a></dd>
			<dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="�ύ����" /><input type="button" class="submit location" value="����"onclick="history.back()"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







