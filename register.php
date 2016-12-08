<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
/* define('SCRIPT','register'); */
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<link rel="stylesheet" type="text/css" href="style/register.css" />
<link rel="stylesheet" type="text/css" href="style/header.inc.css" /> 
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<title>四川大学科技项目管理平台-注册</title>

</head>

<?php
//判断是否提交了
if ($_GET['action'] == 'register') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
 	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php'; 
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['number'] = _check_empty($_POST['number'],'学号');
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['birth'] = _check_empty($_POST['birth'],'出生日期');
	$_clean['college'] = _check_empty($_POST['college'],'学院');
	$_clean['major'] = _check_empty($_POST['major'],'专业');
	$_clean['grade'] = _check_empty($_POST['grade'],'年级');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'联系电话');
	//	print_r($_clean);
	//在新增之前，要判断用户名是否重复
	_is_repeat(
		"SELECT stu_number FROM stu_user WHERE stu_number='{$_clean['number']}' LIMIT 1",
		'对不起，该学号已被注册'
			);

	//新增用户
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query(
							"INSERT INTO stu_user (
																	stu_number,
																	stu_name,
																	stu_password,
																	stu_email,
																	stu_id,
																	stu_sex,
																	stu_birth,
																	stu_college,
																	stu_major,
																	stu_grade,
																	stu_phoneNumber
															 )
												VALUES (
																	'{$_clean['number']}',
																	'{$_clean['name']}',
																	'{$_clean['password']}',
																	'{$_clean['email']}',
																	'{$_clean['id']}',
																	'{$_clean['sex']}',
																	'{$_clean['birth']}',
																	'{$_clean['college']}',
																	'{$_clean['major']}',
																	'{$_clean['grade']}',
																	'{$_clean['phoneNumber']}'
															)"
				);
	if (_affected_rows() == 1) {
			_close();
			_location('恭喜你，注册成功！','index.php');
		} else {
			_close();
			_location('很遗憾，注册失败！','register.php');
		}
	}

?>

<body>

<div id="header">
    <h1><a href=### >科技项目管理平台</a></h1>
 </div>
 
<div id=main>
	<div id="info">
			<h2>注册</h2>
			<form method="post" name="register" action="?action=register">
				<dl>
					<dt>请认真填写一下内容</dt>
					<dd>姓　　名：<input type="text" name="name" class="text" /> (*必填)</dd>
					<dd>学　　号：<input type="text" name="number" class="text" /> (*必填)</dd>
					<dd>性　　别：<label><input type="radio" name="sex" value="男" checked="checked" />男</label> <label><input type="radio" name="sex" value="女" />女</label></dd>
					<dd>密　　码：<input type="password" name="password" class="text note"/> (*必填)</dd>
					<dd>密码确认：<input type="password" name="notpassword" class="text note"/> (*必填)</dd>
					<dd>身份证号：<input type="text" name="id" class="text" /> (*必填)</dd>
					<dd>出生日期：<input type="text" name="birth" class="text" /> (*必填)</dd>
					<dd>学　　院：<input type="text" name="college" class="text" /> (*必填)</dd>
					<dd>专　　业：<input type="text" name="major" class="text" /> (*必填)</dd>
					<dd>年　　级：<input type="text" name="grade" class="text" /> (*必填)</dd>
					<dd>联系电话：<input type="text" name="phoneNumber" class="text" /> (*必填)</dd>
					<dd>电子邮箱：<input type="text" name="email" class="text" /></dd>				
	                <dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
					<dd><input type="submit" class="submit" value="确认" /><input type="button" class="submit location" value="返回"onclick="location='login.php'"/></dd>
				</dl>
			</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







