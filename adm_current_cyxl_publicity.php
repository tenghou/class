<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm_current_cyxl_publicity');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}

//批量分配
if ($_GET['action'] == 'publicity' && isset($_POST['ids'])) {
	$_clean = array();
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	$_clean['result'] = $_POST['result'];
	if($_clean['result'] == '通过'){
		_query("UPDATE project SET
													pro_state='通过'
									   WHERE
													pro_id
											  IN
													({$_clean['ids']})
					");
			if (_affected_rows()) {
			_close();
			_location('公示成功','adm_current_pro_publicity.php');
			} else {
				_close();
				_alert_back('公示失败');
			}
	}else{
		_query("UPDATE project SET
														pro_state='未通过'
										   WHERE
														pro_id
												  IN
														({$_clean['ids']})
						");
			if (_affected_rows()) {
				_close();
				_location('公示成功','adm_current_pro_publicity.php');
			} else {
				_close();
				_alert_back('公示失败');
			}
	}
	
}

$_year = date(Y);
//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year='$_year' AND pro_sort='创业训练项目'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_teacher,pro_adjudicator,pro_point,pro_state,pro_url
							  FROM
											project
							WHERE
											pro_year='$_year' AND pro_sort='创业训练项目'
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
<script type="text/javascript" src="js/adm_current_pro_publicity.js"></script>
<title>四川大学科技项目管理平台-项目公示</title>
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
		<h2>当前所有项目列表</h2>
						
			<div id=table>
			<form method="post" action="?action=publicity">
				<table cellspacing="1">
					<tr><th width=40%>项目名称</th><th width=8%>申报人</th><th width=11%>学院</th><th>项目分类</th><th>指导教师</th><th>评审教师</th><th>分数</th><th>申报状态</th><th>操作</th></tr>
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
							$_html['pro_point'] = $_rows['pro_point'];
							$_html['pro_state'] = $_rows['pro_state'];
							$_html['pro_url'] = $_rows['pro_url'];
				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],22)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php 
					if($_html['pro_adjudicator']==''){echo '待分配';} else echo $_html['pro_adjudicator']?></td><td><?php echo $_html['pro_point']?></td><td><?php echo $_html['pro_state']?></td><td><input name="ids[]" value="<?php echo $_html['pro_id']?>" type="checkbox" /></td></tr>
					
					<?php 
						}
						_free_result($_result);
					?>	
					<tr><td colspan="10"><label for="all">全选 <input type="checkbox" name="chkall" id="all" /></label> <label style="margin-left: 10px;"><input type="submit"  name="result" class="submit" value="通过" /></label><label style="margin-left: 10px;"><input type="submit"  name="result" class="submit" value="淘汰" /></label></td></tr>
									
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







