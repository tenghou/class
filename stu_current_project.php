<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_current_project');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

//����ͷ�ļ�
/* include ROOT_PATH.'includes/header.inc.php'; */

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
$_year = date(Y);

//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_stuNumber = '{$_COOKIE['stu_number']}' AND pro_year='$_year'AND pro_state='ͨ��'",10);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_college,pro_sort,pro_teacher,pro_state,pro_url,pro_repurl,pro_reptime
							  FROM
											project
		                    WHERE
		                                    pro_stuNumber = '{$_COOKIE['stu_number']}' AND pro_year='$_year' AND pro_state='ͨ��'
						ORDER BY
											pro_No 
							   LIMIT
		                                    $_pagenum,$_pagesize
	                   	");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
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
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width=40%>��Ŀ����</th><th width=10%>�걨��</th><th>ѧԺ</th><th>��Ŀ����</th><th>ָ����ʦ</th><th>��Ŀ�ܱ�</th><th>����ʱ��</th><th>����</th></tr>
				<?php 
					while (!!$_rows = _fetch_array_list($_result)) {
						$_html = array();
						$_html['id'] = $_rows['pro_id'];
						$_html['pro_name'] = $_rows['pro_name'];
						$_html['pro_applicant'] = $_rows['pro_applicant'];
						$_html['pro_college'] = $_rows['pro_college'];
						$_html['pro_sort'] = $_rows['pro_sort'];
						$_html['pro_teacher'] = $_rows['pro_teacher'];
						/* $_html['pro_state'] = $_rows['pro_state']; */
						$_html['pro_url'] = _url($_rows['pro_url']);
						/* $_html['pro_repurl'] = _url($_rows['pro_repurl']);*/
						$_html['pro_reptime'] = $_rows['pro_reptime']; 
						
				?>
				<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],27)?></a></td><td><?php echo $_html['pro_applicant']?></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],3)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><a href="stu_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><a href="stu_report.php">����鿴</a></td><td><?php echo _title1($_html['pro_reptime'],10)?></td><td><a href="submit_report.php?id=<?php echo $_html['id']?>">�ύ����</a></td></tr>
				
				<?php 
					}
					_free_result($_result);
				?>					
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







