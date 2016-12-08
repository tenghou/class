<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_search_former');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}

if($_GET['keyword']==''){
	_alert_back('请输入搜索关键字！');
}

if($_GET['type']){
	if($_GET['type']==proname){
		$_pro = 'pro_name';
	}elseif($_GET['type']==proapplicant){
		$_pro = 'pro_applicant';
	}elseif($_GET['type']==procollege){
		$_pro = 'pro_college';
	}elseif($_GET['type']==prosort){
		$_pro = 'pro_sort';
	}elseif($_GET['type']==proyear){
		$_pro = 'pro_yaer';
	}elseif($_GET['type']==prostate){
		$_pro = 'pro_state';
	}
}else{
	_alert_back('非法操作！');
}

if($_GET['keyword']){
	$_clean = array();
	$_clean['keyword'] = _check_keyword($_GET['keyword']);

}

//分页函数_paging_search($_type)里面定义的变量
$type=$_GET['type'];
$keyword=$_GET['keyword'];

//定义当前年份
$_year = date(Y);

//分页模块
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year<'$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'",10);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											pro_name,pro_applicant,pro_college,pro_sort,pro_year,pro_state,pro_url
							  FROM
											project
							WHERE
											pro_year<'$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'
						ORDER BY
											pro_No
							LIMIT
											$_pagenum,$_pagesize
							");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>四川大学科技项目管理平台-往期项目列表</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/tea_header.inc.php';
	?>

	<div id=main>
		<h2>搜索结果列表</h2>
		<div id=search>
				<form method="get" name="tea_search" action="tea_search_former.php">
					<select class="select" name="type">
						<option <?php if($type==proname) echo 'selected="selected"' ?> value="proname">按项目名称</option>
						<option <?php if($type==proapplicant) echo 'selected="selected"' ?> value="proapplicant">按申报人</option>
						<option <?php if($type==procollege) echo 'selected="selected"' ?> value="procollege">按学院</option>
						<option <?php if($type==prosort) echo 'selected="selected"' ?> value="prosort">按项目分类</option>
						<option <?php if($type==proyear) echo 'selected="selected"' ?> value="proyear">按年度</option>
						<option <?php if($type==prostate) echo 'selected="selected"' ?> value="prostate">按申报状态</option>
					</select>
					<input type="text" name="keyword" class="text"  value="<?php echo $keyword?>"/>
					<input type="submit" class="submit" value="搜索" />
					
				</form>
			</div>
			<div id=table>
				<table cellspacing="1">
					<tr><th width=40%>项目名称</th><th width=12%>申报人</th><th width=16%>学院</th><th>项目分类</th><th>年度</th><th>申报状态</th><th>操作</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['pro_name'] = $_rows['pro_name'];
						$_html['pro_applicant'] = $_rows['pro_applicant'];
						$_html['pro_college'] = $_rows['pro_college'];
						$_html['pro_sort'] = $_rows['pro_sort'];
						$_html['pro_year'] = $_rows['pro_year'];
						$_html['pro_state'] = $_rows['pro_state'];
						$_html['pro_url'] = $_rows['pro_url'];
			   	?>
				
				<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],25)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_year']?></td><td><?php echo $_html['pro_state']?></td><td>查看</td></tr>
				
				<?php 
						}
						_free_result($_result);
					?>					
				</table>
			
				<?php 
					//_pageing函数调用分页，1|2，1表示数字分页，2表示文本分页
					_paging_search(2);
				?>
			</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







