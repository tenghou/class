<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_modify');

session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}
//判断是否提交了
if ($_GET['action'] == 'tea_modifyPass') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);
	//	print_r($_clean);

	//新增用户  
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query("UPDATE tea_user SET
																	tea_password='{$_clean['password']}'
																	
											WHERE
											                        tea_name='{$_COOKIE['tea_name']}'					
				");
//判断是否修改成功
	if (_affected_rows() == 1) {
		_close();
		_session_destroy();
		_location('恭喜你，修改成功！','tea_modifyPass.php');
	} else {
		_close();
		_session_destroy();
		_location('很遗憾，修改失败！','tea_modifyPass.php');
	}
}
//是否正常登录
if (isset($_COOKIE['tea_name'])) {
	//获取数据
	$_rows = _fetch_array("SELECT 
															tea_name
												FROM 
															tea_user 
											 WHERE 
															tea_name='{$_COOKIE['tea_name']}' 
												 LIMIT 
															1
										");
		 if ($_rows) {
			$_html= array();
			$_html['name'] = $_rows['tea_name'];
				
			$_html = _html($_html);
		} 
	}
	else {
		_alert_back('非法登录');
	} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>四川大学科技项目管理平台-个人中心</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
	?>	

	<div id=main>
		<div id="info">
				<h2>修改资料</h2>
				<form method="post" name="tea_modifyPass" action="?action=tea_modifyPass">
					<dl>
						<dt>请认真填写以下内容</dt>
						<dd>姓　　名：<?php echo $_html['name'] ?></dd>
						<dd>密　　码：<input type="password" name="password" class="text note"/></dd>
						<dd>密码确认：<input type="password" name="notpassword" class="text note"/></dd>
		                <dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
						<dd><input type="submit" class="submit" value="确认" /></dd>
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