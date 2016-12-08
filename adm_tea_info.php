<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_info');
//引入公共文件
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}
//获取数据
	$_rows = _fetch_array("SELECT
			                                        tea_name,tea_sex,tea_idNumber,tea_age,tea_college,tea_field,tea_post,tea_title,tea_phoneNumber,tea_email 
			                             FROM 
			                                        tea_user 
			                           WHERE 
			                                        tea_name='{$_GET['name']}'");

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
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-指导老师信息</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		include ROOT_PATH.'includes/adm_header.inc.php';
	?>	

	<div id=main>
		<h2>指导老师信息</h2>
		<dl>
					<dd>姓　　　名：　<?php echo $_html['name'] ?></dd>
					<dd>性　　　别：　<?php echo $_html['sex']?></dd>
					<dd>身 份 证 号：　<?php echo $_html['idNumber']?></dd>
					<dd>年　　　龄：　<?php echo $_html['age'];?></dd>
					<dd>学院或单位：　<?php echo $_html['college'];?></dd>
					<dd>研 究 领 域：　<?php echo $_html['field'];?></dd>
					<dd>职　　　务：　<?php echo $_html['post'];?></dd>
					<dd>职　　　称：　<?php echo $_html['title'];?></dd>
					<dd>联 系 电 话：　<?php echo $_html['phoneNumber'];?></dd>
					<dd>电 子 邮 箱：　<?php echo $_html['email'];?></dd>				
					<dd><input type="button" class="back" value="返回"onclick="history.back()"/></dd>
		</dl>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







