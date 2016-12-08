<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','adm');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('请登录后再进行该操作');
}


if ($_GET['action'] == 'submit') {
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['title'] = _check_empty($_POST['title'],'标题');
	$_clean['content'] = _check_competition($_POST['content'],'竞赛新闻');
	
	//创建一个布尔量判断数据库中是否存在数据
	$_rows1 = _fetch_array("SELECT 
			                                        *
			                         FROM 
			                                        competition
			                           ");
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO competition (
																			com_title,
																			com_author,
																			com_content,
																			com_time
																	 )
														VALUES (
																			'{$_clean['title']}',
																			'{$_COOKIE['adm_username']}',
																			'{$_clean['content']}',
																			NOW()
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE competition SET
																com_title='{$_clean['title']}',
																com_author='{$_COOKIE['adm_username']}',
																com_content='{$_clean['content']}',
																com_time=NOW()
						");
			
		}
		//判断是否修改成功
		if (_affected_rows() >= 1) {
			_close();
			_location('恭喜你，发布成功！','adm_add_competition.php');
		} else {
			_close();
			_alert_back('很遗憾，发布失败，请重新发布！','adm_add_competition.php');
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="style/adm_add_competition.css" />
<title>四川大学科技项目管理平台-个人中心</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/adm_header.inc.php';
		
		$_rows = _fetch_array("SELECT
													com_title,com_author,	com_content,com_time
									  FROM
													competition
											");
		if ($_rows) {
			$_html = array();
			$_html['title'] = $_rows['com_title'];
			$_html['author'] = $_rows['com_author'];
			$_html['time'] = $_rows['com_time'];
			
			$_html = _html($_html);
			$_html['content'] = html_entity_decode($_rows['com_content']);
			
		}
	?>	
    
	<div id=main_editor>
		<h2>发布竞赛信息</h2>
		<form method="post" action="?action=submit">
			<h3>标题：<input type="text" name="title" class="title" value="<?php echo $_html['title']?>"/></h3>
			<textarea id="TextArea1" name="content" class="ckeditor"><?php echo $_html['content']?></textarea>
			<input type="submit" class="submit" value="确定" />
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







