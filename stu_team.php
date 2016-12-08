<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','stu_team');

session_start();
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}
//�жϵ�ַ����id�Ƿ����
if(!isset($_GET['id'])){
	_alert_back('�Ƿ�������');
}

//�ж��Ƿ��ύ��
if ($_GET['action'] == 'submit') {
	//������֤��
	_check_code($_POST['code'], $_SESSION['code']);
	//������֤�ļ�
	include ROOT_PATH.'includes/stu_modify.func.php';
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['number'] = _check_empty($_POST['number'],'ѧ��');
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['college'] = _check_empty($_POST['college'],'ѧԺ');
	$_clean['major'] = _check_empty($_POST['major'],'רҵ');
	$_clean['grade'] = _check_empty($_POST['grade'],'�꼶');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'��ϵ�绰');
	//	print_r($_clean);

	//����һ���������ж����ݿ����Ƿ���ڸó�Ա������
	$_rows0 = _fetch_array("SELECT 
				                                        id
				                             FROM 
				                                        team
				                           WHERE 
				                                        captainNumber='{$_COOKIE['stu_number']}' AND serialNumber='{$_GET['id']}'");
		//�����ڣ������
		if($_rows0){
			_query("UPDATE team SET
														
														number='{$_clean['number']}',
														name='{$_clean['name']}',
														email='{$_clean['email']}',
														idNumber='{$_clean['id']}',
														sex='{$_clean['sex']}',
														college='{$_clean['college']}',
														major='{$_clean['major']}',
														grade='{$_clean['grade']}',
														phoneNumber='{$_clean['phoneNumber']}'
									WHERE
														captainNumber='{$_COOKIE['stu_number']}' AND serialNumber='{$_GET['id']}'
				");
		}else{
			_query(
						"INSERT INTO team (
																number,
																name,
																email,
																idNumber,
																sex,
																college,
																major,
																grade,
																phoneNumber,
																captainNumber,
																serialNumber
														 )
											VALUES (
																'{$_clean['number']}',
																'{$_clean['name']}',
																'{$_clean['email']}',
																'{$_clean['id']}',
																'{$_clean['sex']}',
																'{$_clean['college']}',
																'{$_clean['major']}',
																'{$_clean['grade']}',
																'{$_clean['phoneNumber']}',
																'{$_COOKIE['stu_number']}',
																'{$_GET['id']}'
														)"
			);
			}
		//�ж��Ƿ��޸ĳɹ�
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			_location('��ϲ�㣬�����ɹ���','stu_team.php?id='.$_GET['id']);
		} else {
			_close();
			_session_destroy();
			_location('���ź�������ʧ�ܣ�','stu_team.php?id='.$_GET['id']);
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��������</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
		
		//��ȡ����
		$_rows = _fetch_array("SELECT 
				                                        name,number,sex,idNumber,college,major,grade,phoneNumber,email 
				                             FROM 
				                                        team
				                           WHERE 
				                                        captainNumber='{$_COOKIE['stu_number']}' AND serialNumber='{$_GET['id']}'");
		if ($_rows) {
			$_html= array();
			$_html['name'] = $_rows['name'];
			$_html['number'] = $_rows['number'];
			$_html['sex'] = $_rows['sex'];
			$_html['id'] = $_rows['idNumber'];
			$_html['college'] = $_rows['college'];
			$_html['major'] = $_rows['major'];
			$_html['grade'] = $_rows['grade'];
			$_html['phoneNumber'] = $_rows['phoneNumber'];
			$_html['email'] = $_rows['email'];
			$_html = _html($_html);
			
			//�Ա�ѡ��
			 if ($_html['sex'] == '��') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" checked="checked" /> �� </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" /> Ů</label>';
			} elseif ($_html['sex'] == 'Ů') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="��" />��</label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="Ů" checked="checked" /> Ů</label>';
			}else {
			_alert_back('���û�������');
			}
		}
		
		//��ȡ���ݶӳ���Ϣ
		$_rows1 = _fetch_array("SELECT 
				                                        pro_applicant,pro_teamName
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_COOKIE['stu_number']}'");
		if ($_rows1) {
			$_html1= array();
			$_html1['captainName'] = $_rows1['pro_applicant'];
			$_html1['teaName'] = $_rows1['pro_teamName'];
			$_html1 = _html($_html1);
		}
	?>

	<div id=main>
		<div id="info">
				<h2>�Ŷӳ�Ա</h2>
				<form method="post" name="register" action="?id=<?php echo $_GET['id']?>&action=submit">
				<dl>
					<dt>��������дһ������</dt>
					<dd>�Ŷ����ƣ�<?php  echo $_html1['teaName']  ?></dd>
					<dd>�ӳ�������<?php  echo $_html1['captainName']  ?></dd>
					<dd>�ա�������<input type="text" name="name" class="text"  value="<?php echo $_html['name']?>" /> (*����)</dd>
					<dd>ѧ�����ţ�<input type="text" name="number" class="text"  value="<?php echo $_html['number']?>" /> (*����)</dd>
					<?php 
						if(!$_html['sex_html']){
							echo '<dd>�ԡ�����<label><input type="radio" name="sex" value="��" checked="checked" />��</label> <label><input type="radio" name="sex" value="Ů" />Ů</label></dd>';
						}else{
							echo '<dd>�ԡ�����'.$_html['sex_html'].'</dd>';
						}
						
					
					?>
					<dd>���֤�ţ�<input type="text" name="id" class="text"  value="<?php echo $_html['id']?>" /> (*����)</dd>
					<dd>ѧ����Ժ��<input type="text" name="college" class="text"  value="<?php echo $_html['college']?>" /> (*����)</dd>
					<dd>ר����ҵ��<input type="text" name="major" class="text"  value="<?php echo $_html['major']?>" /> (*����)</dd>
					<dd>�ꡡ������<input type="text" name="grade" class="text"  value="<?php echo $_html['grade']?>" /> (*����)</dd>
					<dd>��ϵ�绰��<input type="text" name="phoneNumber" class="text"  value="<?php echo $_html['phoneNumber']?>" /> (*����)</dd>
					<dd>�������䣺<input type="text" name="email" class="text"  value="<?php echo $_html['email']?>" /></dd>				
	                <dd>�� ֤ �룺<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
					<dd><input type="submit" class="submit" value="ȷ��" /></dd>
				</dl>
			</form>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







