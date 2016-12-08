<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_cysj');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}

$_year = date(Y);
//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_sort = '创业实践项目' AND pro_year='$_year'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_name,pro_applicant,pro_college,pro_sort,pro_teacher,pro_state
							  FROM
											project
							WHERE
											pro_sort = '创业实践项目' AND pro_year='$_year'
						ORDER BY
											pro_No
							LIMIT
											$_pagenum,$_pagesize
							");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-创业实践项目</title>
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
		<h2>指导项目列表</h2>
			<div id=search>
				<form method="get" name="tea_search" action="tea_search_current.php">
					<select class="select" name="type">
						<option selected="selected" value="proname">按项目名称</option>
						<option value="proapplicant">按申报人</option>
						<option value="procollege">按学院</option>
						<option value="prosort">按项目分类</option>
						<option value="proteacher">按指导老师</option>
					</select>
					<input type="text" name="keyword" class="text" />
					<input type="submit" class="submit" value="搜索" />
					
				</form>
			</div>			
			<div id=table>
			<table cellspacing="1">
				<tr><th width=40%>项目名称</th><th width=8%>申报人</th><th width=11%>学院</th><th>项目分类</th><th>指导老师</th><th>申报状态</th><th>操作</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['pro_name'] = $_rows['pro_name'];
						$_html['pro_applicant'] = $_rows['pro_applicant'];
						$_html['pro_college'] = $_rows['pro_college'];
						$_html['pro_sort'] = $_rows['pro_sort'];
						$_html['pro_state'] = $_rows['pro_state'];
						$_html['pro_teacher'] = $_rows['pro_teacher'];
			   	?>
				
				<tr><td title="<?php echo $_html['pro_name']?>"><?php echo _title($_html['pro_name'],20)?></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_teacher']?></td><td><?php echo $_html['pro_state']?></td><td>查看</td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>					
			</table>
			
				<?php 
					//_pageing函数调用分页，1|2，1表示数字分页，2表示文本分页
					_paging(2);
				?>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







