<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm_search_former');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['adm_username'])) {
	_alert_back('���¼���ٽ��иò���');
}

if($_GET['keyword']==''){
	_alert_back('�����������ؼ��֣�');
}

if($_GET['type']){
	if($_GET['type']==proname){
		$_pro = 'pro_name';
	}elseif($_GET['type']==proapplicant){
		$_pro = 'pro_applicant';
	}elseif($_GET['type']==procollege){
		$_pro = 'pro_college';
	}elseif($_GET['type']==prosort){
		$_pro = 'pro_sort';
	}elseif($_GET['type']==proyear){
		$_pro = 'pro_yaer';
	}elseif($_GET['type']==proteacher){
		$_pro = 'pro_teacher';
	}elseif($_GET['type']==prostate){
		$_pro = 'pro_state';
	}
}else{
	_alert_back('�Ƿ�������');
}

if($_GET['keyword']){
	$_clean = array();
	$_clean['keyword'] = _check_keyword($_GET['keyword']);

}

//��ҳ����_paging_search($_type)���涨��ı���
$type=$_GET['type'];
$keyword=$_clean['keyword'];

$_year = date(Y);
//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year <'$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'",10);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_year,pro_teacher,pro_state,pro_url
							  FROM
											project
							WHERE
											pro_year <'$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'
						ORDER BY
											pro_year DESC
							   LIMIT
											$_pagenum,$_pagesize
						");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-������Ŀ�б�</title>
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
		<h2>������Ŀ�б�</h2>
			<div id=search>
				<form method="get" name="adm_search" action="adm_search_former.php">
					<select class="select" name="type">
						<option <?php if($type==proname) echo 'selected="selected"' ?> value="proname">����Ŀ����</option>
						<option <?php if($type==proapplicant) echo 'selected="selected"' ?> value="proapplicant">���걨��</option>
						<option <?php if($type==procollege) echo 'selected="selected"' ?> value="procollege">��ѧԺ</option>
						<option <?php if($type==prosort) echo 'selected="selected"' ?> value="prosort">����Ŀ����</option>
						<option <?php if($type==proyear) echo 'selected="selected"' ?> value="proyear">�����</option>
						<option <?php if($type==proteacher) echo 'selected="selected"' ?> value="proteacher">��ָ����ʦ</option>
						<option <?php if($type==prostate) echo 'selected="selected"' ?> value="prostate">���걨״̬</option>
					</select>
					<input type="text" name="keyword" class="text"  value="<?php echo $keyword?>"/>
					<input type="submit" class="submit" value="����" />
					
				</form>
			</div>
						
			<div id=table>
			<table cellspacing="1">
				<tr><th width=39%>��Ŀ����</th><th width=10%>�걨��</th><th width=12%>ѧԺ</th><th width=10%>��Ŀ����</th><th>���</th><th width=10%>ָ����ʦ</th><th width=8%>�걨״̬</th><th>����</th></tr>
				<?php 
						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['pro_id'] = $_rows['pro_id'];
							$_html['pro_name'] = $_rows['pro_name'];
							$_html['pro_applicant'] = $_rows['pro_applicant'];
							$_html['pro_stuNumber'] = $_rows['pro_stuNumber'];
							$_html['pro_college'] = $_rows['pro_college'];
							$_html['pro_sort'] = $_rows['pro_sort'];
							$_html['pro_year'] = $_rows['pro_year'];
							$_html['pro_teacher'] = $_rows['pro_teacher'];
							$_html['pro_state'] = $_rows['pro_state'];
							$_html['pro_url'] = $_rows['pro_url'];

				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],27)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><?php echo $_html['pro_year']?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php echo $_html['pro_state']?></td><td>�鿴</td></tr>
					
					<?php 
						}
						_free_result($_result);
					?>	
														
				</table>
				<?php 
					//_pageing�������÷�ҳ��1|2��1��ʾ���ַ�ҳ��2��ʾ�ı���ҳ
					_paging_search(2);
				?>
		</div>
		
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>






