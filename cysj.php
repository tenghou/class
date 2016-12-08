<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','cysj');
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
<title>四川大学科技项目管理平台-创业实践项目</title>
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
		<h2>创业实践项目说明</h2>
		<div class="content">
			<span>面向我院学生团队，在学校导师和企业导师共同指导下，利用前期创新训练项目的成果，提出一项具有市场前景的创新性产品或者服务，并可以成立工作室或公司，以此为基础开展创业实践活动。</span>
			<div id=js><a href="submit_pro.php?sort=1">点击报名</a></div>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







