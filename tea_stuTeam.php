<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','tea_stuTeam');
//���빫���ļ�
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('���¼���ٽ��иò���');
}

$number=$_GET['stu_number'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-�Ŷ���Ϣ</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
		
		//��ȡ���ݶӳ���Ϣ
		$_rows1 = _fetch_array("SELECT 
				                                        pro_teamName,pro_stuNumber
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_GET['stu_number']}'");
		if ($_rows1) {
			$_html1= array();
			$_html1['pro_teamName'] = $_rows1['pro_teamName'];
			$_html1['pro_stuNumber'] = $_rows1['pro_stuNumber'];
			$_html1 = _html($_html1);
		}
		
	?>	

	<div id=main>
		<h2>�Ŷ���Ϣ</h2>
		
				<?php 
				//��ҳģ��
				global $_pagesize,$_pagenum;
				_page("SELECT id FROM team WHERE captainNumber='{$_GET['stu_number']}'",1);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
				$_result = _query("SELECT 
								                                        name,number,sex,idNumber,college,major,grade,phoneNumber,email 
								                             FROM 
								                                        team
								                           WHERE 
								                                        captainNumber='{$_GET['stu_number']}'
													ORDER BY
																		serialNumber
														   LIMIT
																		$_pagenum,$_pagesize
										");

						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['name'] = $_rows['name'];
							$_html['number'] = $_rows['number'];
							$_html['sex'] = $_rows['sex'];
							$_html['id'] = $_rows['idNumber'];
							$_html['college'] = $_rows['college'];
							$_html['major'] = $_rows['major'];
							$_html['grade'] = $_rows['grade'];
							$_html['phoneNumber'] = $_rows['phoneNumber'];
							$_html['email'] = $_rows['email'];
						}
				   	?>
		
		<dl>
					<dd>�Ŷ����ƣ���<?php  echo $_html1['pro_teamName']  ?></dd>
					<dd>�ա���������<?php  echo $_html['name']  ?></dd>
					<dd>ѧ�����ţ���<?php  echo $_html['number']  ?></dd>
					<dd>�ԡ����𣺡�<?php echo $_html['sex']?></dd>
					<dd>���֤�ţ���<?php echo $_html['id']?></dd>
					<dd>ѧ����Ժ����<?php echo $_html['college']?></dd>
					<dd>ר����ҵ����<?php echo $_html['major']?></dd>
					<dd>�ꡡ��������<?php echo $_html['grade']?></dd>
					<dd>��ϵ�绰����<?php echo $_html['phoneNumber']?></dd>
					<dd>�������䣺��<?php echo $_html['email']?></dd>		
					<dd><input type="button" class="back" value="���ضӳ���Ϣ"onclick="location='tea_stu_info.php?stu_number=<?php echo $_html1['pro_stuNumber']?>'"/></dd>
					
		</dl>
				<?php 
					_free_result($_result);
					//_pageing�������÷�ҳ��1��ʾ���ַ�ҳ
					_paging_team(1);
				?>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







