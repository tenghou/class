<?php 

//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','index');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-竞赛信息</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
	
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
</head>
<body>
<div id="header">
    <h1><a href=### >科技项目管理平台</a></h1>
 </div>
<div id=index_uni>
	 <div id=index>
	     <h2>竞赛信息<a href="login.php">登录</a></h2>
	        <dl>
	            <dd>
	            	<h1><strong><?php echo $_html['title']?></strong></h1>
	            	<p>发布时间：<?php echo $_html['time']?>　　发布人：<?php echo $_html['author']?></p>
					<br />
					<?php echo $_html['content']?>
					
				</dd>	              
	        </dl>
	</div>
</div>
</body>
<?php
   // require ROOT_PATH.'includes/footer.inc.php';
?>
</html>
