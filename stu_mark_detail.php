<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','tea_mark_detail');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��ǰ��Ŀ�б�</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
	?>
	
	<div id=main>
		<h2>��ǰ��Ŀ�б�</h2>
		<?php 
			$_rows = _fetch_array("SELECT
																pro_name,pro_applicant,pro_college,pro_sort,pro_point,pro_mark,pro_state
												  FROM
																project
												WHERE
																pro_id='{$_GET['id']}'
												  LIMIT
												  				1
										");
										
			if ($_rows) {					
				$_html = array();
				$_html['pro_name'] = $_rows['pro_name'];
				$_html['pro_applicant'] = $_rows['pro_applicant'];
				$_html['pro_college'] = $_rows['pro_college'];
				$_html['pro_sort'] = $_rows['pro_sort'];
				$_html['pro_point'] = $_rows['pro_point'];
				$_html['pro_mark'] = $_rows['pro_mark'];
				$_html['pro_state'] = $_rows['pro_state'];
				$_html = _html($_html);
			}
		?>
			<div id=table>
				<table cellspacing="1">
					<tr><th>��Ŀ����</th><th>�걨��</th><th>ѧԺ</th><th>��Ŀ����</th><th>����</th><th>�걨״̬</th></tr>
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_point']?></td><td><?php echo $_html['pro_state']?></td></tr>
				</table>
			
				<form>
				<dl>
					<dd>��Ŀ������<textarea name="mark"  readonly="readonly"><?php echo $_html['pro_mark']?></textarea></dd>
					<dd><input type="button" class="back" value="����"onclick="location='stu_project_check.php'"/></dd>
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







