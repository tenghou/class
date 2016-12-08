<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm_current_cxxl_dis');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}

//批量分配
if ($_GET['action'] == 'distribute' && isset($_POST['ids'])) {
	$_clean = array();
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	$_clean['adjudicator'] = _check_keyword($_POST['adjudicator']);
	//分配之前，先验证该教师是否为评审
	if (!!$_rows = _fetch_array("SELECT 
																tea_name,tea_adj 
													FROM 
																tea_user 
												  WHERE 
																tea_name='{$_clean['adjudicator']}' AND tea_adj='1' 
													LIMIT 
																1
				")){
						_query("UPDATE project SET
																	pro_adjudicator='{$_clean['adjudicator']}'
													   WHERE
																	pro_id
															  IN
																	({$_clean['ids']})
									");
						if (_affected_rows()) {
						_close();
						_location('分配成功','adm_current_pro_distribute.php');
						} else {
							_close();
							_alert_back('分配失败');
						}
	}else{
		_alert_back('该老师不是评审老师，请先将其添加为评审老师！');
	}
	
}

$_year = date(Y);
//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year='$_year' AND pro_sort='创新训练项目'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_teacher,pro_adjudicator,pro_url
							  FROM
											project
							WHERE
											pro_year='$_year' AND pro_sort='创新训练项目'
						ORDER BY
											pro_No DESC
							   LIMIT
											$_pagenum,$_pagesize
						");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/adm_current_pro_distribute.js"></script>
<title>四川大学科技项目管理平台-项目分配</title>
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
		<h2>当前创新训练项目列表</h2>
			<div id=search>
				<form method="get" name="adm_search" action="adm_search_current.php">
					<select class="select" name="type">
						<option selected="selected" value="proname">按项目名称</option>
						<option value="proapplicant">按申报人</option>
						<option value="procollege">按学院</option>
						<option value="prosort">按项目分类</option>
						<option value="proteacher">按指导教师</option>
						<option value="proadjudicator">按评审教师</option>
					</select>
					<input type="text" name="keyword" class="text" />
					<input type="submit" class="submit" value="搜索" />
					
				</form>
			</div>	
			<div id=table>
			<form method="post" action="?action=distribute">
				<table cellspacing="1">
					<tr><th width=39%>项目名称</th><th width=10%>申报人</th><th width=12%>学院</th><th width=10%>项目分类</th><th>指导教师</th><th>评审教师</th><th>操作</th><th>分配</th></tr>
					<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['pro_id'] = $_rows['pro_id'];
							$_html['pro_name'] = $_rows['pro_name'];
							$_html['pro_applicant'] = $_rows['pro_applicant'];
							$_html['pro_stuNumber'] = $_rows['pro_stuNumber'];
							$_html['pro_college'] = $_rows['pro_college'];
							$_html['pro_sort'] = $_rows['pro_sort'];
							$_html['pro_teacher'] = $_rows['pro_teacher'];
							$_html['pro_adjudicator'] = $_rows['pro_adjudicator'];
							$_html['pro_url'] = $_rows['pro_url'];
				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php 
					if($_html['pro_adjudicator']==''){echo '待分配';} else echo $_html['pro_adjudicator']?></td><td>查看</td><td><input name="ids[]" value="<?php echo $_html['pro_id']?>" type="checkbox" /></td></tr>
					
					<?php 
						}
						_free_result($_result);
					?>	
					<tr><td colspan="8"><label for="all">全选 <input type="checkbox" name="chkall" id="all" /></label> <input type="submit"  class="submit" value="批量分配给" /><input type="text" name="adjudicator" class="text" /></td></tr>
									
				</table>
			</form>
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







