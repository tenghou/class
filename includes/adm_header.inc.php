<?php 
//��ֹ�������
if(!defined('IN_AC')){
	exit('Access Defined!');
}
//�Ƿ�������¼
if (isset($_COOKIE['adm_username'])) {
	//��ȡ����
	$_rows0 = _fetch_array("SELECT 
			                                        adm_username,adm_login_count
			                             FROM 
			                                        adm_user
			                           WHERE 
			                                        adm_username='{$_COOKIE['adm_username']}'");
	if ($_rows0) {
		$_html0= array();
		$_html0['name'] = $_rows0['adm_username'];
		$_html0['adm_login_count'] = $_rows0['adm_login_count'];
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
		<li>�������� <a href="#"><?php echo $_html0['adm_login_count']?></a> �ε�¼��ϵͳ</li>
		<li><a href="adm_user.php">������ҳ</a></li>
        <li><a href="logout.php">�˳�</a></li>
    </ul>
</div>


<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>�����Ϣ</span>
		<a href="adm_add_admin.php">��ӹ���Ա</a>
		<a href="adm_add_adjudicator.php">���������ʦ</a>
		<a href="adm_add_competition.php">��Ӿ�����Ϣ</a>
	</div>
	<div class="collapsed">
		<span >��ǰ��Ŀ����</span>
		<a href="adm_current_allpro.php">����</a>
		
	</div>
	<div class="collapsed">
		<span>��ǰ��Ŀ����</span>
		<a href="adm_current_pro_distribute.php">����</a>
		<a href="adm_current_cysj_dis.php">��ҵʵ����Ŀ</a>
		<a href="adm_current_cyxl_dis.php">��ҵѵ����Ŀ</a>
		<a href="adm_current_cxxl_dis.php">����ѵ����Ŀ</a>
		<a href="adm_current_kyxl_dis.php">����ѵ����Ŀ</a>
	</div>
	<div class="collapsed">
		<span>��ǰ�����ʾ</span>
		<a href="adm_current_pro_publicity.php">����</a>
		<a href="adm_current_cysj_publicity.php">��ҵʵ����Ŀ</a>
		<a href="adm_current_cyxl_publicity.php">��ҵѵ����Ŀ</a>
		<a href="adm_current_cxxl_publicity.php">����ѵ����Ŀ</a>
		<a href="adm_current_kyxl_publicity.php">����ѵ����Ŀ</a>
	</div>
	<div class="collapsed">
			<span>��ǰ��Ŀһ��</span>
			<a href="adm_current_project_passed.php">��ͨ��</a>
			<a href="adm_current_project_notpassed.php">δͨ��</a>
	</div>
	<div class="collapsed">
		<span>������Ŀ</span>
		<a href="adm_former_allpro.php">����</a>
		<a href="adm_former_cysj.php">��ҵʵ����Ŀ</a>
		<a href="adm_former_cyxl.php">��ҵѵ����Ŀ</a>
		<a href="adm_former_cxxl.php">����ѵ����Ŀ</a>
		<a href="adm_former_kyxl.php">����ѵ����Ŀ</a>
	</div>
	<div class="collapsed">
		<span>������Ϣ</span>
		<a href="adm_modifyPass.php">�����޸�</a>
	</div>
	
</div>
</body>
</html>
