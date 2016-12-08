<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','stu_team');

session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
//判断地址栏的id是否存在
if(!isset($_GET['id'])){
	_alert_back('非法操作！');
}

//判断是否提交了
if ($_GET['action'] == 'submit') {
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	$_clean = array();
	$_clean['name'] = _check_name($_POST['name'],2,10);
	$_clean['number'] = _check_empty($_POST['number'],'学号');
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['id'] = _check_id($_POST['id']);
	$_clean['sex'] = _check_sex($_POST['sex']);
	$_clean['college'] = _check_empty($_POST['college'],'学院');
	$_clean['major'] = _check_empty($_POST['major'],'专业');
	$_clean['grade'] = _check_empty($_POST['grade'],'年级');
	$_clean['phoneNumber'] = _check_empty($_POST['phoneNumber'],'联系电话');
	//	print_r($_clean);

	//创建一个布尔量判断数据库中是否存在该成员的数据
	$_rows0 = _fetch_array("SELECT 
				                                        id
				                             FROM 
				                                        team
				                           WHERE 
				                                        captainNumber='{$_COOKIE['stu_number']}' AND serialNumber='{$_GET['id']}'");
		//若存在，则更新
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
		//判断是否修改成功
		if (_affected_rows() == 1) {
			_close();
			_session_destroy();
			_location('恭喜你，操作成功！','stu_team.php?id='.$_GET['id']);
		} else {
			_close();
			_session_destroy();
			_location('很遗憾，操作失败！','stu_team.php?id='.$_GET['id']);
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>四川大学科技项目管理平台-个人中心</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';
		
		//获取数据
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
			
			//性别选择
			 if ($_html['sex'] == '男') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" checked="checked" /> 男 </label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" /> 女</label>';
			} elseif ($_html['sex'] == '女') {
				$_html['sex_html'] = '<label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="男" />男</label><label style="cursor:pointer;margin-right:10px;"><input type="radio" name="sex" value="女" checked="checked" /> 女</label>';
			}else {
			_alert_back('此用户不存在');
			}
		}
		
		//获取数据队长信息
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
				<h2>团队成员</h2>
				<form method="post" name="register" action="?id=<?php echo $_GET['id']?>&action=submit">
				<dl>
					<dt>请认真填写一下内容</dt>
					<dd>团队名称：<?php  echo $_html1['teaName']  ?></dd>
					<dd>队长姓名：<?php  echo $_html1['captainName']  ?></dd>
					<dd>姓　　名：<input type="text" name="name" class="text"  value="<?php echo $_html['name']?>" /> (*必填)</dd>
					<dd>学　　号：<input type="text" name="number" class="text"  value="<?php echo $_html['number']?>" /> (*必填)</dd>
					<?php 
						if(!$_html['sex_html']){
							echo '<dd>性　　别：<label><input type="radio" name="sex" value="男" checked="checked" />男</label> <label><input type="radio" name="sex" value="女" />女</label></dd>';
						}else{
							echo '<dd>性　　别：'.$_html['sex_html'].'</dd>';
						}
						
					
					?>
					<dd>身份证号：<input type="text" name="id" class="text"  value="<?php echo $_html['id']?>" /> (*必填)</dd>
					<dd>学　　院：<input type="text" name="college" class="text"  value="<?php echo $_html['college']?>" /> (*必填)</dd>
					<dd>专　　业：<input type="text" name="major" class="text"  value="<?php echo $_html['major']?>" /> (*必填)</dd>
					<dd>年　　级：<input type="text" name="grade" class="text"  value="<?php echo $_html['grade']?>" /> (*必填)</dd>
					<dd>联系电话：<input type="text" name="phoneNumber" class="text"  value="<?php echo $_html['phoneNumber']?>" /> (*必填)</dd>
					<dd>电子邮箱：<input type="text" name="email" class="text"  value="<?php echo $_html['email']?>" /></dd>				
	                <dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
					<dd><input type="submit" class="submit" value="确认" /></dd>
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







