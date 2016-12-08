<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_user');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//验证是否登录
if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-个人中心</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';
	?>

	<div id=main>
		<h2>科技項目管理平台欢迎您</h2>
		<h3>申报原则及要求(请仔细阅读以下内容)</h3>
		<?php echo '<br/>';?>
		<h3>1.  学校鼓励对创新创业训练项目具有浓厚兴趣的本科生积极申报。</h3>
		<h3>2.  学校鼓励不同年级（特别是2-3年级）的学生、跨专业的学生组成项目团队申报，整个项目团队原则上为3-5人。毕业年级学生原则上参与项目申报。鼓励高年级学生作为项目负责人，带动低年级学生参与项目。</h3>
		<h3>3.  申请立项的项目，应具有一定的学术性、创新性和拓展性等特点，应进行可行性论证。应符合学校的相关原则和要求。</h3>
		<h3>4.  每个学生只能参与2个项目（作为项目负责人只能申报1个项目）2013年立项的项目的负责人不能申报2014的项目。每个项目团队限定1名负责人，整个团队3-5人，创业实践类项目不超过10人。</h3>
		<h3>5.  创新训练、创业训练、科研训练及萌芽基金项目完成期限为1年，创业实践项目原则上在2年内完成。各类项目应在项目组成员在校期间完成。</h3>
		<h3>6.  担任项目的指导教师副教授及上职称，最多指导5个项目。</h3>
		<h3>7. 已获得资助并正在实施或已经结题的“大学生创新创业训练计划”、大学生课外学术科研基金项目、“挑战杯”大学生课外学术科技作品竞赛等其他资助的项目不得重复申报。</h3>
	</div>
</div>	
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







