<?php 
//��ֹ�������
if(!defined('IN_AC')){
	exit('Access Defined!');
}
//�Ƿ�������¼
if (isset($_COOKIE['tea_name'])) {
	//��ȡ����
	$_rows0 = _fetch_array("SELECT 
			                                        tea_name,tea_login_count
			                             FROM 
			                                        tea_user
			                           WHERE 
			                                        tea_name='{$_COOKIE['tea_name']}'");
	if ($_rows0) {
		$_html0= array();
		$_html0['name'] = $_rows0['tea_name'];
		$_html0['tea_login_count'] = $_rows0['tea_login_count'];
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
		<li>�������� <a href="#"><?php echo $_html0['tea_login_count']?></a> �ε�¼��ϵͳ</li>
		<li><a href="tea_user.php">������ҳ</a></li>
        <li><a href="logout.php">�˳�</a></li>
    </ul>
</div>

<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>ָ����Ŀ</span>
		<a href="tea_current_project">��ǰָ����Ŀ</a>
		<a href="tea_former_project">����ָ����Ŀ</a>

	</div>
	<div class="collapsed">
		<span>��Ŀһ��</span>
		<a href="tea_cysj.php">��ҵʵ����Ŀ</a>
		<a href="tea_cyxl.php">��ҵѵ����Ŀ</a>
		<a href="tea_cxxl.php">����ѵ����Ŀ</a>
		<a href="tea_kyxl.php">����ѵ����Ŀ</a>
	</div>
	
<?php 
	if (!!$_rows = _fetch_array("SELECT 
															tea_name 
												FROM 
															tea_user 
											  WHERE
														    tea_name='{$_COOKIE['tea_name']}' AND tea_adj='1' 
												LIMIT 
															1
	")){
			echo'<div class="collapsed">';
			echo'<span>��Ŀ����</span>';
			echo'<a href="tea_mark.php">��Ŀ����</a>';
			echo'</div>';
	}
?>

	
	<div class="collapsed">
		<span>������Ϣ</span>
		<a href="tea_modify.php">���������޸�</a>
		<a href="tea_modifyPass.php">�����޸�</a>
	</div>
	
</div>
</body>
</html>
