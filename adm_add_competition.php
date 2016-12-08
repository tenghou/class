<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('���¼���ٽ��иò���');
}


if ($_GET['action'] == 'submit') {
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	//����һ�������飬��������ύ�����ĺϷ�����
	$_clean = array();
	$_clean['title'] = _check_empty($_POST['title'],'����');
	$_clean['content'] = _check_competition($_POST['content'],'��������');
	
	//����һ���������ж����ݿ����Ƿ��������
	$_rows1 = _fetch_array("SELECT 
			                                        *
			                         FROM 
			                                        competition
			                           ");
		if(!$_rows1){
			//����һ��������
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
			//���������ݣ������
			_query("UPDATE competition SET
																com_title='{$_clean['title']}',
																com_author='{$_COOKIE['adm_username']}',
																com_content='{$_clean['content']}',
																com_time=NOW()
						");
			
		}
		//�ж��Ƿ��޸ĳɹ�
		if (_affected_rows() >= 1) {
			_close();
			_location('��ϲ�㣬�����ɹ���','adm_add_competition.php');
		} else {
			_close();
			_alert_back('���ź�������ʧ�ܣ������·�����','adm_add_competition.php');
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="style/adm_add_competition.css" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��������</title>
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
		<h2>����������Ϣ</h2>
		<form method="post" action="?action=submit">
			<h3>���⣺<input type="text" name="title" class="title" value="<?php echo $_html['title']?>"/></h3>
			<textarea id="TextArea1" name="content" class="ckeditor"><?php echo $_html['content']?></textarea>
			<input type="submit" class="submit" value="ȷ��" />
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







