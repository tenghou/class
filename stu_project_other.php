<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_project_other');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//引入头文件
/* include ROOT_PATH.'includes/header.inc.php'; */

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}

//获取项目文档信息
$_result = _fetch_array("SELECT
														doc_id,
														doc_stuName,
														doc_stuNum,
														doc_manage,doc_man_time,doc_man_url,
														doc_development,doc_dev_time,doc_dev_url,
		                                                doc_user,doc_use_time,doc_use_url,
														doc_design,doc_des_time,doc_des_url,
														doc_code,doc_cod_time,doc_cod_url
										  FROM
														document
					                    WHERE
					                                    doc_stuNum = '{$_COOKIE['stu_number']}'
	                   	");
if ($_result) {
	$_html= array();
	$_html['doc_stuName'] = $_result['doc_stuName'];
	$_html['doc_stuNum'] = $_result['doc_stuNum'];
	$_html['doc_man_time'] = $_result['doc_man_time'];
	$_html['doc_man_url'] = _url($_result['doc_man_url']);
	$_html['doc_dev_time'] = $_result['doc_dev_time'];
	$_html['doc_dev_url'] = _url($_result['doc_dev_url']);
	$_html['doc_use_time'] = $_result['doc_use_time'];
	$_html['doc_use_url'] = _url($_result['doc_use_url']);
	$_html['doc_des_time'] = $_result['doc_des_time'];
	$_html['doc_des_url'] = _url($_result['doc_des_url']);
	$_html['doc_cod_time'] = $_result['doc_cod_time'];
	$_html['doc_cod_url'] = _url($_result['doc_cod_url']);
	$_html = _html($_html);
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-项目文档列表</title>
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
		<h2>项目文档列表</h2>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th>项目组长</th><th>项目管理文档</th><th>更新时间</th><th>操作</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_man_url'];}else echo'###'?>" ><?php if($_html['doc_man_url'])echo '项目管理文档'; else echo '暂未提交';?></a></td><td><?php echo _title1($_html['doc_man_time'],10)?></td><td><a href="submit_document.php?id=1">提交文档</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>项目组长</th><th>研发文档</th><th>更新时间</th><th>操作</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_dev_url'];}else echo'###'?>" ><?php if($_html['doc_dev_url'])echo '研发文档'; else echo '暂未提交';?></a></td><td><?php echo _title1($_html['doc_dev_time'],10)?></td><td><a href="submit_document.php?id=2">提交文档</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>项目组长</th><th>用户文档</th><th>更新时间</th><th>操作</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_use_url'];}else echo'###'?>" ><?php if($_html['doc_use_url'])echo '用户文档'; else echo '暂未提交';?></a></td><td><?php echo _title1($_html['doc_use_time'],10)?></td><td><a href="submit_document.php?id=3">提交文档</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>项目组长</th><th>中期报告</th><th>更新时间</th><th>操作</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_des_url'];}else echo'###'?>" ><?php if($_html['doc_des_url'])echo '项目设计报告'; else echo '暂未提交';?></a></td><td><?php echo _title1($_html['doc_des_time'],10)?></td><td><a href="submit_document.php?id=4">提交文档</a></td></tr>
				<tr><td colspan="4"  class="blank"></td></tr>
				<tr><th>项目组长</th><th>结题报告</th><th>更新时间</th><th>操作</th></tr>
				<tr><td><?php echo $_html['doc_stuName']?></td><td><a href="<?php if($_html['doc_man_url']){ ROOT_PATH ;echo $_html['doc_cod_url'];}else echo'###'?>" ><?php if($_html['doc_cod_url'])echo '系统研发代码'; else echo '暂未提交';?></a></td><td><?php echo _title1($_html['doc_cod_time'],10)?></td><td><a href="submit_document.php?id=5">提交文档</a></td></tr>
			</table>
		</div>
		
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







