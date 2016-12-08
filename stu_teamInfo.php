<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_team');

session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
//判断是否提交了
if ($_GET['action'] == 'submit') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	$_clean = array();
	$_clean['name'] = _check_empty($_POST['name'],'团队名称');
	$_clean['numberofstu'] = _check_empty($_POST['numberofstu'],'团队人数');
	//	print_r($_clean);

	//新增用户
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query("UPDATE project SET
													pro_teamName='{$_clean['name']}',
													pro_numberofstu='{$_clean['numberofstu']}'
								WHERE
													pro_stuNumber='{$_COOKIE['stu_number']}'
			");
	//判断是否修改成功
		if (_affected_rows() >= 1) {
			_close();
			_session_destroy();
			_location('恭喜你，操作成功！','stu_teamInfo.php');
		} else {
			_close();
			_session_destroy();
			_location('很遗憾，操作失败！','stu_teamInfo.php');
		}
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
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';
		
		//获取数据队长信息
		$_rows = _fetch_array("SELECT 
				                                        pro_applicant,pro_teamName,pro_numberofstu
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_COOKIE['stu_number']}'");
		if ($_rows) {
			$_html= array();
			$_html['pro_applicant'] = $_rows['pro_applicant'];
			$_html['numberofstu'] = $_rows['pro_numberofstu'];
			$_html['pro_teamName'] = $_rows['pro_teamName'];
			$_html = _html($_html);
		}
	?>

	<div id=main>
		<div id="info">
				<h2>团队信息</h2>
				<form method="post" name="register" action="?action=submit">
				<dl>
					<dt>请认真填写一下内容</dt>
					<dd>队长姓名：<?php  echo $_html['pro_applicant']  ?></dd>
					<dd>团队名称：<input type="text" name="name" class="text"  value="<?php echo $_html['pro_teamName']?>" /> (*必填)</dd>
					<dd>团队人数：<input type="text" name="numberofstu" class="count"  value="<?php echo $_html['numberofstu']?>" /> (*必填)</dd>
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







