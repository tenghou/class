<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_info');
//引入公共文件
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}
//获取数据
$_rows = _fetch_array("SELECT 
		                                        stu_name,stu_number,stu_sex,stu_id,stu_birth,stu_college,stu_major,stu_grade,stu_phoneNumber,stu_email 
		                             FROM 
		                                        stu_user 
		                           WHERE 
		                                        stu_number='{$_GET['stu_number']}'");
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-创业训练项目</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
		
//获取团队名称
		$_rows1 = _fetch_array("SELECT 
				                                        pro_teamName
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_html['number']}'");
		if ($_rows1) {
			$_html1= array();
			$_html1['pro_teamName'] = $_rows1['pro_teamName'];
			$_html1 = _html($_html1);
		}
		
	?>	

	<div id=main>
		<h2>学生信息</h2>
		
		<dl>
					<dd>团队名称：　<a href="tea_stuTeam.php?stu_number=<?php echo $_html['number']?>"><?php  echo $_html1['pro_teamName']  ?></a></dd>
					<dd>队　　长：　<?php  echo $_html['name']  ?></dd>
					<dd>学　　号：　<?php  echo $_html['number']  ?></dd>
					<dd>性　　别：　<?php echo $_html['sex']?></dd>
					<dd>身份证号：　<?php echo $_html['id']?></dd>
					<dd>出生日期：　<?php echo $_html['birth']?></dd>
					<dd>学　　院：　<?php echo $_html['college']?></dd>
					<dd>专　　业：　<?php echo $_html['major']?></dd>
					<dd>年　　级：　<?php echo $_html['grade']?></dd>
					<dd>联系电话：　<?php echo $_html['phoneNumber']?></dd>
					<dd>电子邮箱：　<?php echo $_html['email']?></dd>		
					<dd><input type="button" class="back" value="返回"onclick="history.back()"/></dd>
					
				</dl>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







