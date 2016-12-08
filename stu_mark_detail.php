<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_mark_detail');
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
<title>四川大学科技项目管理平台-当前项目列表</title>
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
		<h2>当前项目列表</h2>
		<?php 
			$_rows = _fetch_array("SELECT
																pro_name,pro_applicant,pro_college,pro_sort,pro_point,pro_mark,pro_state
												  FROM
																project
												WHERE
																pro_id='{$_GET['id']}'
												  LIMIT
												  				1
										");
										
			if ($_rows) {					
				$_html = array();
				$_html['pro_name'] = $_rows['pro_name'];
				$_html['pro_applicant'] = $_rows['pro_applicant'];
				$_html['pro_college'] = $_rows['pro_college'];
				$_html['pro_sort'] = $_rows['pro_sort'];
				$_html['pro_point'] = $_rows['pro_point'];
				$_html['pro_mark'] = $_rows['pro_mark'];
				$_html['pro_state'] = $_rows['pro_state'];
				$_html = _html($_html);
			}
		?>
			<div id=table>
				<table cellspacing="1">
					<tr><th>项目名称</th><th>申报人</th><th>学院</th><th>项目分类</th><th>分数</th><th>申报状态</th></tr>
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_point']?></td><td><?php echo $_html['pro_state']?></td></tr>
				</table>
			
				<form>
				<dl>
					<dd>项目点评：<textarea name="mark"  readonly="readonly"><?php echo $_html['pro_mark']?></textarea></dd>
					<dd><input type="button" class="back" value="返回"onclick="location='stu_project_check.php'"/></dd>
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







