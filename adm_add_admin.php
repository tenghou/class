<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm_add_admin');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}

//判断是否提交了
if ($_GET['action'] == 'add') {
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);

	//判断是否重复
	_is_repeat("SELECT 
										adm_username 
						   FROM 
										adm_user 
					     WHERE 
										adm_username='{$_clean['name']}'
						   LIMIT 
										1",'对不起，该账户已是管理员');
	
	_query("INSERT INTO adm_user (
															adm_username,
															adm_password
														)
										VALUES (
															'{$_clean['name']}',
															'{$_clean['password']}'
													
													)
					");
	if (_affected_rows() == 1) {
		_close();
		_location('恭喜你，添加成功！','adm_add_admin.php');
	} else {
		_close();
		_location('很遗憾，添加失败！','adm_add_admin.php');
	}
}
//分页模块
global $_pagesize,$_pagenum;
_page("SELECT adm_id FROM adm_user",5);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											adm_id,adm_username,adm_last_time,adm_last_ip
							  FROM
											adm_user
						ORDER BY
											adm_id
						       LIMIT
											$_pagenum,$_pagesize
		");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-添加管理员</title>
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
		<h2>添加信息</h2>
		<div id=table>
			<table cellspacing="1">
				<tr><th colspan="5">管理员列表</th></tr>
				<tr><th width=7%>ID</th><th>账号</th><th>最后登录时间</th><th>最后登录IP</th><th>操作</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['id'] = $_rows['adm_id'];
						$_html['name'] = $_rows['adm_username'];
						$_html['time'] = $_rows['adm_last_time'];
						$_html['ip'] = $_rows['adm_last_ip'];
			   	?>
				
				<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['name']?></td><td><?php echo $_html['time']?></td><td><?php if($_html['ip']) echo $_html['ip'];else echo '暂无登录记录';?></td><td>操作</td></tr>
				
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
		
		<div id="info">
			<form method="post" name="add" action="?action=add">
				<dl>
					<dt>添加管理员</dt>
					<dd>账　　号：<input type="text" name="name" class="text" /> </dd>
					<dd>密　　码：<input type="password" name="password" class="text note"/> </dd>
					<dd>密码确认：<input type="password" name="notpassword" class="text note"/> </dd>
					<dd><input type="submit" class="submit" value="确认添加" /></dd>
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







