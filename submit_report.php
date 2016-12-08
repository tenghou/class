<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','submit_report');
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}



if ($_GET['action'] == 'submit') {
/* 	$type=$_POST['type']; */

	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['name'] = $_POST['name'];
	$_clean['pro_repurl'] = _check_empty($_POST['rep_url'],'项目周报');

	//更新project表中的项目周报最新时间
	_query("UPDATE project SET
														pro_reptime=NOW()
									WHERE
														pro_stuNumber='{$_COOKIE['stu_number']}' AND pro_id='{$_GET['id']}'
										LIMIT
														1
			");
	
	//更新report项目周报表中的信息
	_query(
							"INSERT INTO report (
																	name,
																	stuNumber,
																	url,
																	time
															 )
												VALUES (
																	'{$_clean['name']}',
																	'{$_COOKIE['stu_number']}',
																	'{$_clean['pro_repurl']}',
																	NOW()
															)"
				);
		//判断是否成功存入数据库
		if (_affected_rows() ==1) {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('恭喜你，提交成功！');location.href='stu_current_project.php';</script>";
			/* _location('恭喜你，报名成功！','submit_pro.php'); */
			
		} else {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('很遗憾，提交失败！');location.href='submit_report.php';</script>";
		} 
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_report.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>四川大学科技项目管理平台-提交项目报告</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';
		$_rows = _fetch_array("SELECT 
					                                        stu_name,
															stu_college
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
		
				$_html = _html($_html);
			}
	?>
	
	<div id=main class=submi_pro>
		<h2>提交项目报告</h2>
		<form method="post" action="?id=<?php echo $_GET['id']?>&action=submit">
		<dl>
			<dd><input type="hidden" name="name" value="<?php echo $_html['name']?>" /></dd>
			<dd>项目队长：<?php echo $_html['name']?></dd>
			<dd>所属学院：<?php echo $_html['college']?></dd>
			<dd>项目周报：<input type="text" name="rep_url" id="url" readonly="readonly" class="text" /> <a href="javascript:;"  id="up">上传</a></dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="提交报告" /><input type="button" class="submit location" value="返回"onclick="location='stu_current_project.php'"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







