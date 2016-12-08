<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_current_project');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//引入头文件
/* include ROOT_PATH.'includes/header.inc.php'; */

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
$_year = date(Y);

//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_stuNumber = '{$_COOKIE['stu_number']}' AND pro_year='$_year'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_college,pro_teacher,pro_state,pro_url,pro_mark,pro_point
							  FROM
											project
		                    WHERE
		                                    pro_stuNumber = '{$_COOKIE['stu_number']}' AND pro_year='$_year'
						ORDER BY
											pro_point DESC
							   LIMIT
		                                    $_pagenum,$_pagesize
	                   	");

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
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width=40%>项目名称</th><th width=10%>申报人</th><th width=11%>学院</th><th width=10%>指导老师</th><th>项目点评</th><th width=5%>分数</th><th width=8%>申报状态</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['pro_id'] = $_rows['pro_id'];
						$_html['pro_name'] = $_rows['pro_name'];
						$_html['pro_applicant'] = $_rows['pro_applicant'];
						$_html['pro_college'] = $_rows['pro_college'];
						$_html['pro_teacher'] = $_rows['pro_teacher'];
						$_html['pro_state'] = $_rows['pro_state'];
						$_html['pro_url'] = $_rows['pro_url'];
						$_html['pro_mark'] = $_rows['pro_mark'];
						$_html['pro_point'] = $_rows['pro_point'];
			   	?>
				
				<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],27)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><a href="stu_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td class="mark" title="<?php echo $_html['pro_mark']?>"><?php if(!$_html['pro_mark']) echo '暂未置评';else echo '<a href="stu_mark_detail.php?id='.$_html['pro_id'].'">'._title($_html['pro_mark'],8).'</a>'?></td><td><?php echo $_html['pro_point']?></td><td><?php echo $_html['pro_state']?></td></tr>
				
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







