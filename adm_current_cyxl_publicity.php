<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm_current_cyxl_publicity');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('���¼���ٽ��иò���');
}

//��������
if ($_GET['action'] == 'publicity' && isset($_POST['ids'])) {
	$_clean = array();
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	$_clean['result'] = $_POST['result'];
	if($_clean['result'] == 'ͨ��'){
		_query("UPDATE project SET
													pro_state='ͨ��'
									   WHERE
													pro_id
											  IN
													({$_clean['ids']})
					");
			if (_affected_rows()) {
			_close();
			_location('��ʾ�ɹ�','adm_current_pro_publicity.php');
			} else {
				_close();
				_alert_back('��ʾʧ��');
			}
	}else{
		_query("UPDATE project SET
														pro_state='δͨ��'
										   WHERE
														pro_id
												  IN
														({$_clean['ids']})
						");
			if (_affected_rows()) {
				_close();
				_location('��ʾ�ɹ�','adm_current_pro_publicity.php');
			} else {
				_close();
				_alert_back('��ʾʧ��');
			}
	}
	
}

$_year = date(Y);
//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year='$_year' AND pro_sort='��ҵѵ����Ŀ'",10);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_teacher,pro_adjudicator,pro_point,pro_state,pro_url
							  FROM
											project
							WHERE
											pro_year='$_year' AND pro_sort='��ҵѵ����Ŀ'
						ORDER BY
											pro_point DESC
							   LIMIT
											$_pagenum,$_pagesize
						");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/adm_current_pro_publicity.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��Ŀ��ʾ</title>
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
		<h2>��ǰ������Ŀ�б�</h2>
						
			<div id=table>
			<form method="post" action="?action=publicity">
				<table cellspacing="1">
					<tr><th width=40%>��Ŀ����</th><th width=8%>�걨��</th><th width=11%>ѧԺ</th><th>��Ŀ����</th><th>ָ����ʦ</th><th>�����ʦ</th><th>����</th><th>�걨״̬</th><th>����</th></tr>
					<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['pro_id'] = $_rows['pro_id'];
							$_html['pro_name'] = $_rows['pro_name'];
							$_html['pro_applicant'] = $_rows['pro_applicant'];
							$_html['pro_stuNumber'] = $_rows['pro_stuNumber'];
							$_html['pro_college'] = $_rows['pro_college'];
							$_html['pro_sort'] = $_rows['pro_sort'];
							$_html['pro_teacher'] = $_rows['pro_teacher'];
							$_html['pro_adjudicator'] = $_rows['pro_adjudicator'];
							$_html['pro_point'] = $_rows['pro_point'];
							$_html['pro_state'] = $_rows['pro_state'];
							$_html['pro_url'] = $_rows['pro_url'];
				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],22)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php 
					if($_html['pro_adjudicator']==''){echo '������';} else echo $_html['pro_adjudicator']?></td><td><?php echo $_html['pro_point']?></td><td><?php echo $_html['pro_state']?></td><td><input name="ids[]" value="<?php echo $_html['pro_id']?>" type="checkbox" /></td></tr>
					
					<?php 
						}
						_free_result($_result);
					?>	
					<tr><td colspan="10"><label for="all">ȫѡ <input type="checkbox" name="chkall" id="all" /></label> <label style="margin-left: 10px;"><input type="submit"  name="result" class="submit" value="ͨ��" /></label><label style="margin-left: 10px;"><input type="submit"  name="result" class="submit" value="��̭" /></label></td></tr>
									
				</table>
			</form>
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







