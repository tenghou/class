<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','cxxl');
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
<title>四川大学科技项目管理平台-创业训练项目</title>
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
		<h2>创业训练项目说明</h2>
		<div class="content">
			<span>面向我院本科生团队，在导师指导下，团队中每个学生在项目实施过程中扮演一个或多个具体的角色，通过编制商业计划书、开展可行性研究、模拟企业运行、参加企业实践、撰写创业报告等工作。</span>
			<div id=js><a href="submit_pro.php?sort=3">点击报名</a></div>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







