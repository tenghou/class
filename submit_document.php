<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','submit_document');
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
$id=$_GET['id'];
//�жϵ�ַ����id�Ƿ����
if(isset($_GET['id'])){
	if(!($_GET['id']==1||$_GET['id']==2||$_GET['id']==3||$_GET['id']==4||$_GET['id']==5)){
		_alert_back('�����ڴ�ҳ�棡');
	}
}else{
	_alert_back('�Ƿ�������');
}
//��ȡ��Ŀ����
if(!!isset($_GET['id'])){
	if($_GET['id']==1){
		$title='��Ŀ�����ĵ�';
	}elseif($_GET['id']==2){
		$title='�з��ĵ�';
	}elseif($_GET['id']==3){
		$title='�û��ĵ�';
	}elseif($_GET['id']==4){
		$title='���ڱ���';
	}elseif($_GET['id']==5){
		$title='���ⱨ��';
	}
}else{
	_alert_back('�Ƿ�������');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name,
													stu_college
			                         FROM 
			                                        stu_user 
			                       WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html['college'] = $_rows['stu_college'];

		$_html = _html($_html);
	}

if ($_GET['action'] == 'submit') {
/* 	$type=$_POST['type']; */
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['url'] = _check_empty($_POST['url'],'��Ŀ�����ĵ�');
	
	//����һ���������ж����ݿ����Ƿ���ڸ�ѧ��������
	$_rows1 = _fetch_array("SELECT 
			                                        doc_id
			                         FROM 
			                                        document 
			                       WHERE 
			                                        doc_stuNum='{$_COOKIE['stu_number']}'");
	if($_GET['id']==1){
		if(!$_rows1){
			//����һ��������
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_man_time,
																			doc_man_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//���������ݣ������
			_query("UPDATE document SET
																doc_man_time=NOW(),
																doc_man_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==2){
		if(!$_rows1){
			//����һ��������
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_dev_time,
																			doc_dev_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//���������ݣ������
			_query("UPDATE document SET
																doc_dev_time=NOW(),
																doc_dev_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==3){
		if(!$_rows1){
			//����һ��������
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_use_time,
																			doc_use_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//���������ݣ������
			_query("UPDATE document SET
																doc_use_time=NOW(),
																doc_use_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==4){
		if(!$_rows1){
			//����һ��������
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_des_time,
																			doc_des_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//���������ݣ������
			_query("UPDATE document SET
																doc_des_time=NOW(),
																doc_des_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==5){
		if(!$_rows1){
			//����һ��������
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_cod_time,
																			doc_cod_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//���������ݣ������
			_query("UPDATE document SET
																doc_cod_time=NOW(),
																doc_cod_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}
			
			
			//�ж��Ƿ�ɹ��������ݿ�
			if (_affected_rows() ==1) {
				_close();
				_session_destroy();
				echo "<script type='text/javascript'>alert('��ϲ�㣬�ύ�ɹ���');location.href='stu_project_other.php';</script>";
				/* _location('��ϲ�㣬�����ɹ���','submit_pro.php'); */
				
			} else {
				_close();
				_session_destroy();
				echo "<script type='text/javascript'>alert('���ź����ύʧ�ܣ�');location.href='submit_document.php?id=".$id.";</script>";
			} 

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_document.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-�ύ��Ŀ����</title>
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
															stu_college
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
		
				$_html = _html($_html);
			}
	?>
	
	<div id=main class=submi_pro>
		<h2>�ύ��Ŀ����</h2>
		<form method="post" action="?id=<?php echo $_GET['id']?>&action=submit">
		<dl>
			<dd>��Ŀ�ӳ���<?php echo $_html['name']?></dd>
			<dd>����ѧԺ��<?php echo $_html['college']?></dd>
			<dd><?php echo $title?>��<input type="text" name="url" id="url" readonly="readonly" class="text" /> <a href="javascript:;" title="<?php echo $_GET['id']?>"  id="up">�ϴ�</a></dd>
			<dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="�ύ����" /><input type="button" class="submit location" value="����"onclick="location='stu_project_other.php'"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







