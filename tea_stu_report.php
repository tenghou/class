<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','tea_stu_report');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('���¼���ٽ��иò���');
}

//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT id FROM report WHERE stuNumber = '{$_GET['stuNum']}'",9);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
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
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��Ŀ�ܱ�</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/tea_header.inc.php';
	?>
	
	<div id=main>
		<h2>��Ŀ�ܱ��б�</h2>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width="20%">�걨��</th><th width="30%">��Ŀ�ܱ�</th><th width="40%">����ʱ��</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['name'] = $_rows['name'];
						$_html['time'] = $_rows['time'];
						$_html['url'] = _url($_rows['url']);

				?>
				<tr><td><?php echo $_html['name']?></td><td><a href="<?php if($_html['url']){ ROOT_PATH ;echo $_html['url'];}else echo'#'?>" title="�������">��Ŀ�ܱ�</a></td><td><?php echo $_html['time']?></td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>	
				<tr><td colspan="4"><a href="tea_current_project.php" style="float:right;margin-right:23px;">����</a></td></tr>
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







