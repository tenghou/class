<?php 

//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','index');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-������Ϣ</title>
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
    <h1><a href=### >�Ƽ���Ŀ����ƽ̨</a></h1>
 </div>
<div id=index_uni>
	 <div id=index>
	     <h2>������Ϣ<a href="login.php">��¼</a></h2>
	        <dl>
	            <dd>
	            	<h1><strong><?php echo $_html['title']?></strong></h1>
	            	<p>����ʱ�䣺<?php echo $_html['time']?>���������ˣ�<?php echo $_html['author']?></p>
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
