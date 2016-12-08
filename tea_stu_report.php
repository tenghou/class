<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_stu_report');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}

//分页模块
global $_pagesize,$_pagenum;
_page("SELECT id FROM report WHERE stuNumber = '{$_GET['stuNum']}'",9);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											time,url,name
							  FROM
											report
		                    WHERE
		                                    stuNumber = '{$_GET['stuNum']}'
						ORDER BY
											time DESC
							   LIMIT
		                                    $_pagenum,$_pagesize
	                   	");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>四川大学科技项目管理平台-项目周报</title>
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
		<h2>项目周报列表</h2>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width="20%">申报人</th><th width="30%">项目周报</th><th width="40%">更新时间</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['name'] = $_rows['name'];
						$_html['time'] = $_rows['time'];
						$_html['url'] = _url($_rows['url']);

				?>
				<tr><td><?php echo $_html['name']?></td><td><a href="<?php if($_html['url']){ ROOT_PATH ;echo $_html['url'];}else echo'#'?>" title="点击下载">项目周报</a></td><td><?php echo $_html['time']?></td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>	
				<tr><td colspan="4"><a href="tea_current_project.php" style="float:right;margin-right:23px;">返回</a></td></tr>
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







