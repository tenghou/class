<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_report');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}

//ɾ���ܱ�
if($_GET['action']=='delete' &&isset($_GET['id'])){
	//��֤�ܱ��Ƿ����
	if (!!$_rows = _fetch_array("SELECT 
															id
												FROM 
															report 
											 WHERE 
															id='{$_GET['id']}' 
												 LIMIT 
															1
										")) {
		//ɾ������
		_query("DELETE FROM 
												report 
								WHERE 
												id='{$_GET['id']}' 
									LIMIT 
												1
		");
		//�ж��Ƿ�ɾ���ɹ�
		if (_affected_rows() == 1) {
			_close();
			_location('��ϲ�㣬ɾ���ɹ���','stu_report.php');
		} else {
			_close();
			_location('���ź���ɾ��ʧ�ܣ�','stu_report.php');
		}
	}else{
		_alert_back('���ܱ������ڣ�');
	}
}

//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT id FROM report WHERE stuNumber = '{$_COOKIE['stu_number']}'",9);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											id,time,url,name
							  FROM
											report
		                    WHERE
		                                    stuNumber = '{$_COOKIE['stu_number']}'
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
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��Ŀ�ܱ�</title>

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
		<h2>��Ŀ�ܱ�</h2>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width="20%">�걨��</th><th width="30%">��Ŀ�ܱ�</th><th width="40%">����ʱ��</th><th>����</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['id'] = $_rows['id'];
						$_html['name'] = $_rows['name'];
						$_html['time'] = $_rows['time'];
						$_html['url'] = $_rows['url'];

				?>
				<tr><td><?php echo $_html['name']?></td><td><a href="<?php if($_html['url']){ ROOT_PATH ;echo $_html['url'];}else echo'#'?>" title="�������">��Ŀ�ܱ�</a></td><td><?php echo $_html['time']?></td><td><input type="button" id="delete" name="<?php echo $_html['id']?>" value="ɾ��" onclick="if (confirm('ȷ��Ҫɾ���������ݣ�')) {location.href='?action=delete&id='+this.name;}"/></td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>	
				<tr><td colspan="4"><a href="stu_current_project.php" style="float:right;margin-right:23px;">����</a></td></tr>
			</table>
			
				<?php 
					//_pageing�������÷�ҳ��1|2��1��ʾ���ַ�ҳ��2��ʾ�ı���ҳ
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







