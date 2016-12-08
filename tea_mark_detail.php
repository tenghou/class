<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_mark_detail');
//开启session，验证 验证码
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}
//判断地址栏的id是否存在
if(!isset($_GET['id'])){
	_alert_back('非法操作！');
}

$id=$_GET['id'];
$_rows = _fetch_array("SELECT
													pro_id,pro_name,pro_applicant,pro_college,pro_sort,pro_point,pro_mark
									  FROM
													project
									WHERE
													pro_id='{$_GET['id']}'
							");
							
if ($_rows) {					
	$_html = array();
	$_html['pro_id'] = $_rows['pro_id'];
	$_html['pro_name'] = $_rows['pro_name'];
	$_html['pro_applicant'] = $_rows['pro_applicant'];
	$_html['pro_college'] = $_rows['pro_college'];
	$_html['pro_sort'] = $_rows['pro_sort'];
	$_html['pro_point'] = $_rows['pro_point'];
	$_html['pro_mark'] = $_rows['pro_mark'];
	$_html = _html($_html);
}

if($_GET['action']=='submit'){
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['point'] = _check_empty($_POST['point'],'项目分数');
	$_clean['mark'] = _check_mark($_POST['mark'],300);
	
	_query("UPDATE project SET
														
														pro_point='{$_clean['point']}',
														pro_mark='{$_clean['mark']}'
									WHERE
														pro_id='{$_GET['id']}'
				");

		//判断是否修改成功
			if (_affected_rows() == 1) {
				_close();
				_session_destroy();
				_location('恭喜你，点评成功！','tea_mark.php');
			} else {
				_close();
				_session_destroy();
				_alert_back('很遗憾，点评失败！','tea_mark_detail.php?id='.$id);
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
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
	?>	
	
	<div id=main>
		<h2>项目评分</h2>
		
		<div id=table>
		<form method="post" action="?id=<?php echo$_html['pro_id']?>&action=submit">
			<table cellspacing="1">
				<tr><th>项目名称</th><th>申报人</th><th>学院</th><th>项目分类</th></tr>
				<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td></tr>
			</table>
			
			
			<dl>
				<dd>项目分数：<input type="text"  class="text" name="point" value="<?php echo $_html['pro_point']?>"/></dd>
				<dd>项目点评：<textarea name="mark" ><?php echo $_html['pro_mark']?></textarea></dd>
				<dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" /> <input type="submit" class="submit" value="确定" /><input type="button" class="back" value="返回"onclick="location='tea_mark.php'"/></dd>
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







