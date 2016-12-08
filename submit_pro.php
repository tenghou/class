<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','submit_pro');
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
//判断地址栏的sort是否存在
if(isset($_GET['sort'])){
	if(!($_GET['sort']==1||$_GET['sort']==2||$_GET['sort']==3||$_GET['sort']==4)){
		_alert_back('不存在此页面！');
	}
}else{
	_alert_back('非法操作！');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name,
													stu_college,
													stu_major,
		                                            stu_grade,
													stu_number,
													stu_phoneNumber,
													stu_email
			                         FROM 
			                                        stu_user 
			                       WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html['college'] = $_rows['stu_college'];
		$_html['major'] = $_rows['stu_major'];
		$_html['grade'] = $_rows['stu_grade'];
		$_html['stuNumber'] = $_rows['stu_number'];
		$_html['stuphoneNumber'] = $_rows['stu_phoneNumber'];
		$_html['stuemail'] = $_rows['stu_email'];
		$_html = _html($_html);
	}

	//获取项目分类
	if (isset($_GET['sort'])) {
		if($_GET['sort']==1){
			$_sort = '创业实践项目';
		}elseif($_GET['sort']==2){
			$_sort = '创业训练项目';
		}elseif($_GET['sort']==3){
			$_sort = '创新训练项目';
		}elseif($_GET['sort']==4){
			$_sort = '科研训练项目';
		}
	}else{
		_alert_back('非法操作');
	}
	$_year = date(Y);

if ($_GET['action'] == 'submit') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['name'] = _check_empty($_POST['name'],'项目名称');
	$_clean['teacher'] = _check_empty($_POST['teacher'],'指导老师');
	$_clean['url'] = _check_empty($_POST['url'],'申报书');
	$_clean['sex'] = $_POST['sex'];
	$_clean['password'] = _check_password('123456','123456',6);
	
	//判断数据库中是否有该老师信息
	if(!_fetch_array("SELECT tea_name from tea_user where tea_name ='{$_clean['teacher']}' limit 1")){
	//将指导老师添加到教师表中，以便老师登录，默认密码为123456
	_query("INSERT INTO tea_user (
															tea_name,
															tea_sex,
															tea_password
														)
										VALUES (
															'{$_clean['teacher']}',
															'{$_clean['sex']}',
															'{$_clean['password']}'
													)
					");
	}
	
	//在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query(
							"INSERT INTO project (
																	pro_stuNumber,
																	pro_name,
																	pro_applicant,
																	pro_sort,
																	pro_url,
																	pro_teacher,
																	pro_stuemail,
																	pro_college,
																	pro_major,
																	pro_grade,
																	pro_stuphoneNumber,
																	pro_year
															 )
												VALUES (
																	'{$_html['stuNumber']}',
																	'{$_clean['name']}',
																	'{$_html['name']}',
																	'$_sort',
																	'{$_clean['url']}',
																	'{$_clean['teacher']}',
																	'{$_html['stuemail']}',
																	'{$_html['college']}',
																	'{$_html['major']}',
																	'{$_html['grade']}',
																	'{$_html['stuphoneNumber']}',
																	'$_year'
															)"
				);
		//判断是否成功存入数据库
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('恭喜你，报名成功！');location.href='submit_pro.php?sort=$_GET[sort]';</script>";
			/* _location('恭喜你，报名成功！','submit_pro.php'); */
			
		} else {
			_close();
			_session_destroy();
			echo "<script type='text/javascript'>alert('很遗憾，报名失败！');location.href='submit_pro.php?sort=$_GET[sort]';</script>";
		} 
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_pro.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
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

		$_rows = _fetch_array("SELECT 
					                                        stu_name,
															stu_college,
															stu_major,
				                                            stu_grade,
															stu_number,
															stu_phoneNumber,
															stu_email
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
				$_html['major'] = $_rows['stu_major'];
				$_html['grade'] = $_rows['stu_grade'];
				$_html['stuNumber'] = $_rows['stu_number'];
				$_html['stuphoneNumber'] = $_rows['stu_phoneNumber'];
				$_html['stuemail'] = $_rows['stu_email'];
				$_html = _html($_html);
			}
		
	?>
	
	<div id=main class=submi_pro>
		<h2>上传项目申报书</h2>
		<form method="post" action="?sort=<?php echo $_GET[sort]?>&action=submit">
		<dl>
			<dd><input type="hidden" name="major" value="<?php echo $_html['major']?>" /></dd>
			<dd><input type="hidden" name="grade" value="<?php echo $_html['grade']?>" /></dd>
			<dd><input type="hidden" name="stuNumber" value="<?php echo $_html['stuNumber']?>" /></dd>
			<dd><input type="hidden" name="stuphoneNumber" value="<?php echo $_html['stuphoneNumber']?>" /></dd>
			<dd><input type="hidden" name="stuemail" value="<?php echo $_html['stuemail']?>" /></dd>
			<dd>项目队长：<?php echo $_html['name']?></dd>
			<dd>所属学院：<?php echo $_html['college']?></dd>
			<dd>项目名称：<input type="text" name="name" class="text" /></dd>
			<dd>指导老师：<input type="text" name="teacher" class="text" /></dd>
			<dd>老师性别：<label><input type="radio" name="sex" value="男" checked="checked" />男</label> <label><input type="radio" name="sex" value="女" />女</label></dd>
			<dd>申 报 书：<input type="text" name="url" id="url" readonly="readonly" class="text" /> <a href="javascript:;" title="<?php echo $_GET['sort']?>" id="up">上传</a></dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="提交报名" /><input type="button" class="submit location" value="返回"onclick="history.back()"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







