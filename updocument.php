<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','updocument');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name 
			                             FROM 
			                                        stu_user 
			                           WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html = _html($_html);
	}
	

if($_GET['action'] == 'up'){
	/* //�����ϴ��ļ�������
	$_files = array('application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	
	//�ж������Ƿ����������һ��
	if (is_array($_files)) {
		if (!in_array($_FILES['userfile']['type'],$_files)) {
			_alert_back('�ϴ��ļ�������doc��docx��');
		}
	} */
	//�ж��ļ���������
	if ($_FILES['userfile']['error'] > 0) {
		switch ($_FILES['userfile']['error']) {
			case 1: _alert_back('�ϴ��ļ�����Լ��ֵ1');
				break;
			case 2: _alert_back('�ϴ��ļ�����Լ��ֵ2');
				break;
			case 3: _alert_back('�����ļ����ϴ�');
				break;
			case 4: _alert_back('û���κ��ļ����ϴ���');
				break;
		}
		exit;
	}
	
	//�ж����ô�С
	if ($_FILES['userfile']['size'] > 50000000) {
		_alert_back('�ϴ����ļ����ó���50M');
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
			$title='��Ŀ��Ʊ���';
		}elseif($_GET['id']==5){
			$title='ϵͳ�з�����';
		}
	}else{
		_alert_back('�Ƿ�������');
	}
	//��ȡ�ļ�����չ��
	$_n = explode('.', $_FILES['userfile']['name']);
	$_name = 'document/'.$title.'-'.$_html['name'].'.'.$_n[1];
	//�ƶ��ļ�
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		if	(!move_uploaded_file($_FILES['userfile']['tmp_name'],$_name)) {
			_alert_back('�ƶ�ʧ��');
		} else {
			//_alert_close('�ϴ��ɹ���');
			echo "<script>alert('�ϴ��ɹ���');window.opener.document.getElementById('url').value='$_name';window.close();</script>";
		}
	} else {
		_alert_back('�ϴ�����ʱ�ļ������ڣ�');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />

<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��������</title>
</head>
<body>
	
	<div id="upword" style="padding:20px;">
		<form enctype="multipart/form-data" action="?id=<?php echo $_GET['id']?>&action=up" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000" />
			ѡ����Ŀ�걨��: <input type="file" name="userfile" />
			<input type="submit"   value="�ϴ�" />
		</form>
	</div>
	

</body>

</html>







