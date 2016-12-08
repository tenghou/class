<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','adm_search_current');
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
	}elseif($_GET['type']==proteacher){
		$_pro = 'pro_teacher';
	}elseif($_GET['type']==proadjudicator){
		$_pro = 'pro_adjudicator';
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

//��������
if ($_GET['action'] == 'distribute' && isset($_POST['ids'])) {
	$_clean = array();
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	$_clean['adjudicator'] = _check_keyword($_POST['adjudicator']);
	/* //����֮ǰ������֤����Ŀ�Ƿ��Ѿ�����
	if(!!$_rows = _fetch_array("SELECT 
																pro_id,pro_adjudicator
													FROM 
																project 
												  WHERE
																pro_id IN ({$_clean['ids']}) AND pro_adjudicator !=null
													
				")){
				_alert_back('�Բ��𣬸���Ŀ�ѷ��䣡');
	} */
	//��֤�ý�ʦ�Ƿ�Ϊ����
	if (!!$_rows = _fetch_array("SELECT 
																tea_name,tea_adj 
													FROM 
																tea_user 
												  WHERE 
																tea_name='{$_clean['adjudicator']}' AND tea_adj='1' 
													LIMIT 
																1
				")){
						_query("UPDATE project SET
																	pro_adjudicator='{$_clean['adjudicator']}'
													   WHERE
																	pro_id
															  IN
																	({$_clean['ids']})
									");
						if (_affected_rows()) {
						_close();
						_location('����ɹ�','adm_search_current.php');
						} else {
							_close();
							_alert_back('����ʧ��');
						}
	}else{
		_alert_back('����ʦ����������ʦ�����Ƚ������Ϊ������ʦ��');
	}
	
}

$_year = date(Y);
//��ҳģ��
global $_pagesize,$_pagenum;
_page("SELECT pro_id FROM project WHERE pro_year='$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'",9);   //��һ��������ȡ���������ڶ���������ָ��ÿҳ������
$_result = _query("SELECT
											pro_id,pro_name,pro_applicant,pro_stuNumber,pro_college,pro_sort,pro_teacher,pro_adjudicator,pro_url
							  FROM
											project
							WHERE
											pro_year='$_year' AND ".$_pro." LIKE '%{$_clean['keyword']}%'
						ORDER BY
											pro_No DESC
							   LIMIT
											$_pagenum,$_pagesize
						");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/adm_current_pro_distribute.js"></script>
<link rel="stylesheet" type="text/css" href="style/adm_current_pro_distribute.css" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��Ŀ����</title>
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
			<div id=search>
				<form method="get" name="adm_search" action="adm_search_current.php">
					<select class="select" name="type">
						<option <?php if($type==proname) echo 'selected="selected"' ?> value="proname">����Ŀ����</option>
						<option <?php if($type==proapplicant) echo 'selected="selected"' ?> value="proapplicant">���걨��</option>
						<option <?php if($type==procollege) echo 'selected="selected"' ?> value="procollege">��ѧԺ</option>
						<option <?php if($type==prosort) echo 'selected="selected"' ?> value="prosort">����Ŀ����</option>
						<option <?php if($type==proteacher) echo 'selected="selected"' ?> value="proteacher">��ָ����ʦ</option>
						<option <?php if($type==proadjudicator) echo 'selected="selected"' ?> value="proadjudicator">�������ʦ</option>
					</select>
					<input type="text" name="keyword" value="<?php echo $_clean[keyword]?>" class="text" />
					<input type="submit" class="submit" value="����" />
					
				</form>
			</div>		
			<div id=table>
			<form method="post" action="?type=<?php echo $type?>&keyword=<?php echo $keyword?>&action=distribute">
							<table cellspacing="1">
					<tr><th width=39%>��Ŀ����</th><th width=10%>�걨��</th><th width=12%>ѧԺ</th><th width=10%>��Ŀ����</th><th>ָ����ʦ</th><th>�����ʦ</th><th>����</th><th>����</th></tr>
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
							$_html['pro_url'] = $_rows['pro_url'];
				   	?>
					
					<tr><td title="<?php echo $_html['pro_name']?>"><a href="<?php if($_html['pro_url']){ ROOT_PATH ;echo $_html['pro_url'];}else echo'###'?>" ><?php echo _title($_html['pro_name'],20)?></a></td><td><a href = "adm_stu_info.php?stu_number=<?php echo $_html['pro_stuNumber']?>"><?php echo $_html['pro_applicant']?></a></td><td title="<?php echo $_html['pro_college']?>"><?php echo _title1($_html['pro_college'],5)?></td><td><?php echo _title1($_html['pro_sort'],4)?></td><td><a href="adm_tea_info.php?name=<?php echo $_html['pro_teacher']?>"><?php echo $_html['pro_teacher']?></a></td><td><?php 
					if($_html['pro_adjudicator']==''){echo '������';} else echo $_html['pro_adjudicator']?></td><td>�鿴</td><td><input name="ids[]" value="<?php echo $_html['pro_id']?>" type="checkbox" /></td></tr>
					
					<?php 
						}
						_free_result($_result);
					?>	
					<tr><td colspan="8"><label for="all">ȫѡ <input type="checkbox" name="chkall" id="all" /></label> <input type="submit"  class="submit" value="���������" /><input type="text" name="adjudicator" class="text" /></td></tr>
									
				</table>
			</form>
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







