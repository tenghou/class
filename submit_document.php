<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','submit_document');
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}
$id=$_GET['id'];
//判断地址栏的id是否存在
if(isset($_GET['id'])){
	if(!($_GET['id']==1||$_GET['id']==2||$_GET['id']==3||$_GET['id']==4||$_GET['id']==5)){
		_alert_back('不存在此页面！');
	}
}else{
	_alert_back('非法操作！');
}
//获取项目类型
if(!!isset($_GET['id'])){
	if($_GET['id']==1){
		$title='项目管理文档';
	}elseif($_GET['id']==2){
		$title='研发文档';
	}elseif($_GET['id']==3){
		$title='用户文档';
	}elseif($_GET['id']==4){
		$title='中期报告';
	}elseif($_GET['id']==5){
		$title='结题报告';
	}
}else{
	_alert_back('非法操作！');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name,
													stu_college
			                         FROM 
			                                        stu_user 
			                       WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html['college'] = $_rows['stu_college'];

		$_html = _html($_html);
	}

if ($_GET['action'] == 'submit') {
/* 	$type=$_POST['type']; */
	//检验验证码
	_check_code($_POST['code'], $_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/stu_modify.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['url'] = _check_empty($_POST['url'],'项目管理文档');
	
	//创建一个布尔量判断数据库中是否存在该学生的数据
	$_rows1 = _fetch_array("SELECT 
			                                        doc_id
			                         FROM 
			                                        document 
			                       WHERE 
			                                        doc_stuNum='{$_COOKIE['stu_number']}'");
	if($_GET['id']==1){
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_man_time,
																			doc_man_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE document SET
																doc_man_time=NOW(),
																doc_man_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==2){
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_dev_time,
																			doc_dev_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE document SET
																doc_dev_time=NOW(),
																doc_dev_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==3){
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_use_time,
																			doc_use_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE document SET
																doc_use_time=NOW(),
																doc_use_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==4){
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_des_time,
																			doc_des_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE document SET
																doc_des_time=NOW(),
																doc_des_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}elseif($_GET['id']==5){
		if(!$_rows1){
			//插入一条新数据
			_query(
									"INSERT INTO document (
																			doc_stuName,
																			doc_stuNum,
																			doc_cod_time,
																			doc_cod_url
																	 )
														VALUES (
																			'{$_html['name']}',
																			'{$_COOKIE['stu_number']}',
																			NOW(),
																			'{$_clean['url']}'
																	)"
						);
		}else{
			//若存在数据，则更新
			_query("UPDATE document SET
																doc_cod_time=NOW(),
																doc_cod_url='{$_clean['url']}'
												WHERE
																doc_stuNum='{$_COOKIE['stu_number']}'
												  LIMIT
																1
					");
			
		}
	}
			
			
			//判断是否成功存入数据库
			if (_affected_rows() ==1) {
				_close();
				_session_destroy();
				echo "<script type='text/javascript'>alert('恭喜你，提交成功！');location.href='stu_project_other.php';</script>";
				/* _location('恭喜你，报名成功！','submit_pro.php'); */
				
			} else {
				_close();
				_session_destroy();
				echo "<script type='text/javascript'>alert('很遗憾，提交失败！');location.href='submit_document.php?id=".$id.";</script>";
			} 

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<script type="text/javascript" src="js/submit_document.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>四川大学科技项目管理平台-提交项目报告</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//引入头文件
		include ROOT_PATH.'includes/stu_header.inc.php';

		$_rows = _fetch_array("SELECT 
					                                        stu_name,
															stu_college
					                         FROM 
					                                        stu_user 
					                       WHERE 
					                                        stu_number='{$_COOKIE['stu_number']}'");
			if ($_rows) {
				$_html= array();
				$_html['name'] = $_rows['stu_name'];
				$_html['college'] = $_rows['stu_college'];
		
				$_html = _html($_html);
			}
	?>
	
	<div id=main class=submi_pro>
		<h2>提交项目报告</h2>
		<form method="post" action="?id=<?php echo $_GET['id']?>&action=submit">
		<dl>
			<dd>项目队长：<?php echo $_html['name']?></dd>
			<dd>所属学院：<?php echo $_html['college']?></dd>
			<dd><?php echo $title?>：<input type="text" name="url" id="url" readonly="readonly" class="text" /> <a href="javascript:;" title="<?php echo $_GET['id']?>"  id="up">上传</a></dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"/><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="提交报告" /><input type="button" class="submit location" value="返回"onclick="location='stu_project_other.php'"/></dd>
		</dl>
		</form>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







