<?php 

//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','login');
//����session����֤ ��֤��
session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

//�ж��Ƿ��ύ��
if ($_GET['action'] == 'login') {
	//Ϊ�˷�ֹ�����¼
	_check_code($_POST['code'], $_SESSION['code']);

	//������֤�ļ�
	include ROOT_PATH.'includes/index.func.php';

	//��������
	$_clean = array();
	$_clean['number'] = _check_number($_POST['number']);
	$_clean['password'] = _check_login_password($_POST['password'], 6);
	$_clean['identity'] = $_POST['identity'];
	if($_clean['identity']=='ѧ��'){
		//���ݿ���֤
		if (!!$_rows = _fetch_array("SELECT 
																stu_number,stu_password 
													FROM 
																stu_user 
												  WHERE 
																stu_number='{$_clean['number']}' AND stu_password='{$_clean['password']}' 
													LIMIT 
																1
				")) {
			//��¼�ɹ��󣬼�¼��¼��Ϣ
			_query("UPDATE stu_user SET
														stu_last_time=NOW(),
														stu_last_ip='{$_SERVER["REMOTE_ADDR"]}',
														stu_login_count=stu_login_count+1
											WHERE
														stu_number='{$_rows['stu_number']}'
			");
			
			_close();
			_session_destroy();
			setcookie('stu_number',$_rows['stu_number']);
			_location(null,'stu_user.php');
		} else {
			_close();
			_session_destroy();
			_location('�û��������벻��ȷ��','login.php');
		 }
	 }
	 elseif($_clean['identity']=='��ʦ'){
	 	//���ݿ���֤
	 	if (!!$_rows = _fetch_array("SELECT tea_name,tea_password FROM tea_user WHERE tea_name='{$_clean['number']}' AND tea_password='{$_clean['password']}' LIMIT 1")) {
	 		//��¼�ɹ��󣬼�¼��¼��Ϣ
	 		_query("UPDATE tea_user SET
													 		tea_last_time=NOW(),
													 		tea_last_ip='{$_SERVER["REMOTE_ADDR"]}',
													 		tea_login_count=tea_login_count+1
										 	  WHERE
										 					tea_name='{$_rows['tea_name']}'
	 		");
	 			 		
	 		_close();
	 		_session_destroy();
	 		setcookie('tea_name',$_rows['tea_name']);
	 		_location(null,'tea_user.php');
	 	} else {
	 		_close();
	 		_session_destroy();
	 		_location('�û��������벻��ȷ��','login.php');
	 	}
	 }
	 else {
	 //���ݿ���֤
	 	if (!!$_rows = _fetch_array("SELECT adm_username,adm_password FROM adm_user WHERE adm_username='{$_clean['number']}' AND adm_password='{$_clean['password']}' LIMIT 1")) {
	 		//��¼�ɹ��󣬼�¼��¼��Ϣ
	 		_query("UPDATE adm_user SET
													 		adm_last_time=NOW(),
													 		adm_last_ip='{$_SERVER["REMOTE_ADDR"]}',
													 		adm_login_count=adm_login_count+1
										 	  WHERE
										 					adm_username='{$_rows['adm_username']}'
					");
	 		
	 		_close();
	 		_session_destroy();
	 		setcookie('adm_username',$_rows['adm_username']);
	 		_location(null,'adm_user.php');
	 	} else {
	 		_close();
	 		_session_destroy();
	 		_location('�û��������벻��ȷ��','login.php');
	 	}
	 }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��¼</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div id="header">
    <h1><a href=### >�Ƽ���Ŀ����ƽ̨</a></h1>
 </div>
<div id=index_uni>
	 <div id=login>
	     <h2>���������ĵ�¼��Ϣ<a href="index.php">������Ϣ</a></h2>
	     <form method="post" name="login" action="?action=login">
	          <dl>
	              <dd>�û�����<input type="text" name="number" class="text"/></dd>
	              <dd>�ܡ��룺<input type="password" name="password" class="text note"/></dd>
	              <dd>���ݣ�<label><input type="radio" name="identity" value="ѧ��" checked="checked" />ѧ�� </label><label><input type="radio" name="identity" value="��ʦ" />��ʦ </label><label><input type="radio" name="identity" value="����Ա" />����Ա</label></dd>
	              <dd>��֤�룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
	              <dd><input type="submit" class="submit" value="��¼"/><input type="button" class="submit location" value="ע��"onclick="location='register.php'"/></dd>
	              
	          </dl>
	     </form>
	</div>
</div>
</body>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</html>
