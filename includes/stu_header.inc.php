<?php 
//��ֹ�������
if(!defined('IN_AC')){
	exit('Access Defined!');
}

//�Ƿ�������¼
if (isset($_COOKIE['stu_number'])) {
	//��ȡ����
	$_rows0 = _fetch_array("SELECT 
			                                        stu_name,stu_login_count
			                             FROM 
			                                        stu_user 
			                           WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows0) {
		$_html0= array();
		$_html0['name'] = $_rows0['stu_name'];
		$_html0['stu_login_count'] = $_rows0['stu_login_count'];
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
</head>
<body>

<div id="header">
    <h1></h1>
    <ul>
    	<li><a href="#"><?php echo $_html0['name']?></a> ��ӭ����</li>
		<li>�������� <a href="#"><?php echo $_html0['stu_login_count']?> </a>�ε�¼��ϵͳ</li>
		<li><a href="stu_user.php">������ҳ</a></li>
        <li><a href="logout.php">�˳�</a></li>
    </ul>
</div>


<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>��������</span>
		<a href="stu_project_check.php">�걨��Ŀ</a>
		
		<?php 
		$_rows = _query("SELECT
											pro_state
							  FROM
											project
		                    WHERE
		                                    pro_stuNumber = '{$_COOKIE['stu_number']}'
	                   	");
			if ($_rows) {
				$_html = array();
				$_html['pro_state'] = $_rows['pro_state'];
				$_html = _html($_html);
			}
			if (!$_html['pro_state']=='�����'){
				echo'<a href="stu_current_project.php">ͨ����Ŀ</a>';
				echo'<a href="stu_project_other.php">��Ŀ�ĵ�</a>';
			}
		?>
		
		<a href="stu_former_project.php">������Ŀ</a>

	</div>
	<div class="collapsed">
		<span>���߱���</span>
		<a href="cysj.php">��ҵʵ����Ŀ</a>
		<a href="cyxl.php">��ҵѵ����Ŀ</a>
		<a href="cxxl.php">����ѵ����Ŀ</a>
		<a href="kyxl.php">����ѵ����Ŀ</a>
	</div>
	<div class="collapsed">
		<span>�Ŷӹ���</span>
		<a href="stu_teamInfo">�Ŷ���Ϣ</a>
		
		<?php 
			//��ȡ�Ŷӳ�Ա��Ϣ
			$_rows = _fetch_array("SELECT 
					                                        pro_numberofstu
					                             FROM 
					                                        project 
					                           WHERE 
					                                        pro_stuNumber='{$_COOKIE['stu_number']}'
												  LIMIT
															1
												");
												
			if ($_rows) {
				$_html= array();
				$_html['numberofstu'] = $_rows['pro_numberofstu'];
				$_html = _html($_html);
			}
			
			for($i=1;$i<=$_html['numberofstu'];$i++){
				echo '<a href="stu_team.php?id='.$i.'">��Ա'.$i.'</a>';
			}
		?>
	</div>
	<div class="collapsed">
			<span>������Ŀһ��</span>
			<a href="stu_former_all_pro.php">����</a>
			
	</div>
	<div class="collapsed">
		<span>������Ϣ</span>
		<a href="stu_modify.php">���������޸�</a>
		<a href="stu_modifyPass.php">�����޸�</a>
	</div>
	
</div>
</body>
</html>
