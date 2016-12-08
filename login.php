<?php 

//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','login');
//开启session，验证 验证码
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//判断是否提交了
if ($_GET['action'] == 'login') {
	//为了防止恶意登录
	_check_code($_POST['code'], $_SESSION['code']);

	//引入验证文件
	include ROOT_PATH.'includes/index.func.php';

	//接受数据
	$_clean = array();
	$_clean['number'] = _check_number($_POST['number']);
	$_clean['password'] = _check_login_password($_POST['password'], 6);
	$_clean['identity'] = $_POST['identity'];
	if($_clean['identity']=='学生'){
		//数据库验证
		if (!!$_rows = _fetch_array("SELECT 
																stu_number,stu_password 
													FROM 
																stu_user 
												  WHERE 
																stu_number='{$_clean['number']}' AND stu_password='{$_clean['password']}' 
													LIMIT 
																1
				")) {
			//登录成功后，记录登录信息
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
			_location('用户名或密码不正确！','login.php');
		 }
	 }
	 elseif($_clean['identity']=='教师'){
	 	//数据库验证
	 	if (!!$_rows = _fetch_array("SELECT tea_name,tea_password FROM tea_user WHERE tea_name='{$_clean['number']}' AND tea_password='{$_clean['password']}' LIMIT 1")) {
	 		//登录成功后，记录登录信息
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
	 		_location('用户名或密码不正确！','login.php');
	 	}
	 }
	 else {
	 //数据库验证
	 	if (!!$_rows = _fetch_array("SELECT adm_username,adm_password FROM adm_user WHERE adm_username='{$_clean['number']}' AND adm_password='{$_clean['password']}' LIMIT 1")) {
	 		//登录成功后，记录登录信息
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
	 		_location('用户名或密码不正确！','login.php');
	 	}
	 }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-登录</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div id="header">
    <h1><a href=### >科技项目管理平台</a></h1>
 </div>
<div id=index_uni>
	 <div id=login>
	     <h2>请输入您的登录信息<a href="index.php">竞赛信息</a></h2>
	     <form method="post" name="login" action="?action=login">
	          <dl>
	              <dd>用户名：<input type="text" name="number" class="text"/></dd>
	              <dd>密　码：<input type="password" name="password" class="text note"/></dd>
	              <dd>身　份：<label><input type="radio" name="identity" value="学生" checked="checked" />学生 </label><label><input type="radio" name="identity" value="教师" />教师 </label><label><input type="radio" name="identity" value="管理员" />管理员</label></dd>
	              <dd>验证码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
	              <dd><input type="submit" class="submit" value="登录"/><input type="button" class="submit location" value="注册"onclick="location='register.php'"/></dd>
	              
	          </dl>
	     </form>
	</div>
</div>
</body>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</html>
