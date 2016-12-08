<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','kyxl');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<link rel="stylesheet" type="text/css" href="style/cxxl.css" />
<title>四川大学科技项目管理平台- 科研训练项目</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';
	?>

	<div id=main>
		<h2>科研训练项目说明</h2>
		<div class="content">
			<span>是面向我院本科生个人或团队，参与教师科研课题研究。在导师指导下，完成训练计划任务，得到科学研究方面的训练。</span>		
			<div id=js><a href="submit_pro.php?sort=4">点击报名</a></div>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







