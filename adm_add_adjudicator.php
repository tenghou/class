<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm_add_adjudicator');
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
	$_clean['sex'] = $_POST['sex'];
	$_clean['password'] = _check_password('123456','123456',6);
	$_clean['email'] = _check_email($_POST['email']);
	//	print_r($_clean);
	//添加评审老师之前，共有两种情况，①数据库中已有此老师，②数据库中没有
	//首先判断数据库中是否有此老师
	if(_fetch_array("SELECT tea_name from tea_user where tea_name ='{$_clean['name']}' limit 1")){
		//若有，判断该老师是否为评审老师
		_is_repeat("SELECT 
										tea_name 
						   FROM 
										tea_user 
					     WHERE 
										tea_name ='{$_clean['name']}' AND tea_adj='1'
						   LIMIT 
										1",'对不起，该账户已是评审老师');
		//若此老师不是评审老师，则将其评审老师状态及tea_adj更新为1
		_query("UPDATE tea_user SET
															tea_adj='1'
											WHERE
															tea_name ='{$_clean['name']}'
				");
		}else{
			//若数据库中没有此老师，则插入该评审老师的信息
			_query("INSERT INTO tea_user (
															tea_name,
															tea_sex,
															tea_password,
															tea_email,
															tea_adj
														)
										VALUES (
															'{$_clean['name']}',
															'{$_clean['sex']}',
															'{$_clean['password']}',
															'{$_clean['email']}',
															'1'
													
													)
					");
			}
		if (_affected_rows() == 1) {
			_close();
			_location('恭喜你，添加成功！','adm_add_adjudicator.php');
		} else {
			_close();
			_location('很遗憾，添加失败！','adm_add_adjudicator.php');
		} 
}

//分页模块
global $_pagesize,$_pagenum;
_page("SELECT tea_id FROM tea_user WHERE tea_adj='1'  ",5);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result = _query("SELECT
											tea_id,tea_name,tea_email,tea_last_time
							  FROM
											tea_user
							WHERE 
											tea_adj='1'
						ORDER BY
											tea_id
						       LIMIT
											$_pagenum,$_pagesize
		");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-个人中心</title>
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
					<tr><th colspan="5">评审老师列表</th></tr>
					<tr><th width=7%>ID</th><th>姓名</th><th>邮箱</th><th>最后登录时间</th><th width=8%>操作</th></tr>
					<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['id'] = $_rows['tea_id'];
							$_html['name'] = $_rows['tea_name'];
							$_html['email'] = $_rows['tea_email'];
							$_html['time'] = $_rows['tea_last_time'];
				   	?>
					
					<tr><td><?php echo $_html['id']?></td><td><?php echo $_html['name']?></td><td><?php if($_html['email']) echo $_html['email']; else echo '暂无';?></td><td><?php echo $_html['time']?></td><td>查看</td></tr>
					
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
						<dt>添加评审老师（密码默认为123456）</dt>
						<dd>姓　　名：<input type="text" name="name" class="text" /> (*必填)</dd>
						<dd>性　　别：<label><input type="radio" name="sex" value="男" checked="checked" />男</label> <label><input type="radio" name="sex" value="女" />女</label></dd>
						<dd>电子邮箱：<input type="text" name="email" class="text" /></dd>
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







