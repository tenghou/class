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
if ($_GET['action'] == 'tea_modify') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['idNumber'] = _check_id($_POST['idNumber']);
	$_clean['age'] = _check_empty($_POST['age'],'年龄');
	$_clean['college'] = _check_empty($_POST['college'],'学院或单位');
	$_clean['field'] = _check_empty($_POST['field'],'研究领域');
	$_clean['post'] = _check_empty($_POST['post'],'职务');
	$_clean['title'] = _check_empty($_POST['title'],'职称');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'联系电话');
	$_clean['email'] = _check_email($_POST['email']);
	//	print_r($_clean);

	//新增用户
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query("UPDATE tea_user SET
													tea_sex='{$_clean['sex']}',
													tea_idNumber='{$_clean['idNumber']}',
													tea_age='{$_clean['age']}',
													tea_college='{$_clean['college']}',
													tea_field='{$_clean['field']}',
													tea_post='{$_clean['post']}',
													tea_title='{$_clean['title']}',
													tea_phoneNumber='{$_clean['phoneNumber']}',
													tea_email='{$_clean['email']}'
								WHERE
													tea_name='{$_COOKIE['tea_name']}'
			");
	//判断是否修改成功
			if (_affected_rows() == 1) {
				_close();
				_session_destroy();
				_location('恭喜你，修改成功！','tea_modify.php');
			} else {
				_close();
				_session_destroy();
				_location('很遗憾，没有做任何修改！','tea_modify.php');
			}
}
//是否正常登录
if (isset($_COOKIE['tea_name'])) {
	//获取数据
	$_rows = _fetch_array("SELECT
			                                        tea_name,tea_sex,tea_idNumber,tea_age,tea_college,tea_field,tea_post,tea_title,tea_phoneNumber,tea_email 
			                             FROM 
			                                        tea_user 
			                           WHERE 
			                                        tea_name='{$_COOKIE['tea_name']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['tea_name'];
		$_html['sex'] = $_rows['tea_sex'];
		$_html['idNumber'] = $_rows['tea_idNumber'];
		$_html['age'] = $_rows['tea_age'];
		$_html['college'] = $_rows['tea_college'];
		$_html['field'] = $_rows['tea_field'];
		$_html['post'] = $_rows['tea_post'];
		$_html['title'] = $_rows['tea_title'];
		$_html['phoneNumber'] = $_rows['tea_phoneNumber'];
		$_html['email'] = $_rows['tea_email'];
		$_html = _html($_html);
		
		//性别选择
		if ($_html['sex'] == '男') {
			$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" checked="checked" /> 男 </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" /> 女</label>';
		} elseif ($_html['sex'] == '女') {
			$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" /> 男 </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" checked="checked" /> 女</label>';
		}/* else {
		_alert_back('此用户不存在');
		} */
	}
} else {
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
				<form method="post" name="tea_modify" action="?action=tea_modify">
					<dl>
						<dt>请认真填写以下内容</dt>
						<dd>姓　　　名：<?php echo $_html['name'] ?></dd>
						<dd>性　　　别：<?php echo $_html['sex_html']?></dd>
						<dd>身 份 证 号：<input type="text" name="idNumber" class="text" value="<?php echo $_html['idNumber'];?>"/> (*必填)</dd>
						<dd>年　　　龄：<input type="text" name="age" class="text" value="<?php echo $_html['age'];?>"/> (*必填)</dd>
						<dd>学院或单位：<input type="text" name="college" class="text" value="<?php echo $_html['college'];?>"/> (*必填)</dd>
						<dd>研 究 领 域：<input type="text" name="field" class="text" value="<?php echo $_html['field'];?>"/> (*必填)</dd>
						<dd>职　　　务：<input type="text" name="post" class="text" value="<?php echo $_html['post'];?>"/> (*必填)</dd>
						<dd>职　　　称：<input type="text" name="title" class="text" value="<?php echo $_html['title'];?>"/> (*必填)</dd>
						<dd>联 系 电 话：<input type="text" name="phoneNumber" class="text" value="<?php echo $_html['phoneNumber'];?>"/> (*必填)</dd>
						<dd>电 子 邮 箱：<input type="text" name="email" class="text" value="<?php echo $_html['email'];?>"/></dd>				
		                <dd>验　证　码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
						<dd><input type="submit" class="submit tea_submit" value="确认" /></dd>
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







