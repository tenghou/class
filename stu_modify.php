<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_modify');

session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
//判断是否提交了
if ($_GET['action'] == 'stu_modify') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	//$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['birth'] = _check_empty($_POST['birth'],'出生日期');
	$_clean['college'] = _check_empty($_POST['college'],'学院');
	$_clean['major'] = _check_empty($_POST['major'],'专业');
	$_clean['grade'] = _check_empty($_POST['grade'],'年级');
	//	$_clean['number'] = _check_empty($_POST['number'],'学号');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'联系电话');
	//	print_r($_clean);

	//新增用户
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query("UPDATE stu_user SET
													
													stu_email='{$_clean['email']}',
													stu_id='{$_clean['id']}',
													stu_sex='{$_clean['sex']}',
													stu_birth='{$_clean['birth']}',
													stu_college='{$_clean['college']}',
													stu_major='{$_clean['major']}',
													stu_grade='{$_clean['grade']}',
													stu_phoneNumber='{$_clean['phoneNumber']}'
								WHERE
													stu_number='{$_COOKIE['stu_number']}'
			");
	//判断是否修改成功
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			_location('恭喜你，修改成功！','stu_modify.php');
		} else {
			_close();
			_session_destroy();
			_location('很遗憾，没有做任何修改！','stu_modify.php');
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
	//获取数据
		$_rows = _fetch_array("SELECT 
				                                        stu_name,stu_number,stu_sex,stu_id,stu_birth,stu_college,stu_major,stu_grade,stu_phoneNumber,stu_email 
				                             FROM 
				                                        stu_user 
				                           WHERE 
				                                        stu_number='{$_COOKIE['stu_number']}'");
		if ($_rows) {
			$_html= array();
			$_html['name'] = $_rows['stu_name'];
			$_html['number'] = $_rows['stu_number'];
			$_html['sex'] = $_rows['stu_sex'];
			$_html['id'] = $_rows['stu_id'];
			$_html['birth'] = $_rows['stu_birth'];
			$_html['college'] = $_rows['stu_college'];
			$_html['major'] = $_rows['stu_major'];
			$_html['grade'] = $_rows['stu_grade'];
			$_html['phoneNumber'] = $_rows['stu_phoneNumber'];
			$_html['email'] = $_rows['stu_email'];
			$_html = _html($_html);
			
			//性别选择
			 if ($_html['sex'] == '男') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" checked="checked" /> 男 </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" /> 女</label>';
			} elseif ($_html['sex'] == '女') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" />男</label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" checked="checked" /> 女</label>';
			}else {
			_alert_back('此用户不存在');
			} 
		}
	?>

	<div id=main>
		<div id="info">
				<h2>修改资料</h2>
				<form method="post" name="stu_modify" action="?action=stu_modify">
					<dl>
						<dt>请认真填写以下内容</dt>
						<dd>姓　　名：<?php  echo $_html['name']  ?></dd>
						<dd>学　　号：<?php  echo $_html['number']  ?></dd>
						<dd>性　　别：<?php echo $_html['sex_html']?></dd>
						<dd>身份证号：<input type="text"  class="text"  name="id" value="<?php echo $_html['id']?>"  /> (*必填)</dd>
						<dd>出生日期：<input type="text"  class="text"  name="birth" value="<?php echo $_html['birth']?>"  /> (*必填)</dd>
						<dd>学　　院：<input type="text"  class="text"  name="college" value="<?php echo $_html['college']?>" /> (*必填)</dd>
						<dd>专　　业：<input type="text"  class="text"  name="major" value="<?php echo $_html['major']?>"  /> (*必填)</dd>
						<dd>年　　级：<input type="text"  class="text"  name="grade" value="<?php echo $_html['grade']?>" /> (*必填)</dd>
						<dd>联系电话：<input type="text" class="text"  name="phoneNumber"  value="<?php echo $_html['phoneNumber']?>" /> (*必填)</dd>
						<dd>电子邮箱：<input type="text" class="text"  name="email" value="<?php echo $_html['email']?>"  /></dd>				
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







