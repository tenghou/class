<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm_former_cyxl');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}
$_year = date(Y);
//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year !='$_year' AND pro_sort ='创业训练项目'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_year,pro_teacher,pro_state,pro_url
							  FROM
											project
							WHERE
											pro_year !='$_year' AND pro_sort ='创业训练项目'
						ORDER BY
											pro_year DESC
							   LIMIT
											$_pagenum,$_pagesize
						");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-往期创业训练项目列表</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/adm_header.inc.php';
	?>	

	<div id=main>
		<h2>往期创业训练项目列表</h2>
			<div id=search>
				<form method="get" name="adm_search" action="adm_search_former.php">
					<select class="select" name="type">
						<option selected="selected" value="proname">按项目名称</option>
						<option value="proapplicant">按申报人</option>
						<option value="procollege">按学院</option>
						<option value="prosort">按项目分类</option>
						<option value="proyear">按年度</option>
						<option value="proteacher">按指导老师</option>
						<option value="prostate">按申报状态</option>
					</select>
					<input type="text" name="keyword" class="text" />
					<input type="submit" class="submit" value="搜索" />
					
				</form>
			</div>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width=39%>项目名称</th><th width=10%>申报人</th><th width=12%>学院</th><th width=10%>项目分类</th><th>年度</th><th width=10%>指导老师</th><th width=8%>申报状态</th><th>操作</th></tr>
				<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['pro_id'] = $_rows['pro_id'];
							$_html['pro_name'] = $_rows['pro_name'];
							$_html['pro_applicant'] = $_rows['pro_applicant'];
							$_html['pro_stuNumber'] = $_rows['pro_stuNumber'];
							$_html['pro_college'] = $_rows['pro_college'];
							$_html['pro_sort'] = $_rows['pro_sort'];
							$_html['pro_year'] = $_rows['pro_year'];
							$_html['pro_teacher'] = $_rows['pro_teacher'];
							$_html['pro_state'] = $_rows['pro_state'];
							$_html['pro_url'] = $_rows['pro_url'];

				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],27)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_year']?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php echo $_html['pro_state']?></td><td>查看</td></tr>
					
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







