<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','upword');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

$year = date(Y);

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('请登录后再进行该操作');
}

$_rows = _fetch_array("SELECT 
			                                        stu_name 
			                             FROM 
			                                        stu_user 
			                           WHERE 
			                                        stu_number='{$_COOKIE['stu_number']}'");
	if ($_rows) {
		$_html= array();
		$_html['name'] = $_rows['stu_name'];
		$_html = _html($_html);
	}
	

if($_GET['action'] == 'up'){
	
	//只能判别，判断该人员是否已经申请了当年项目
	if(_fetch_array("SELECT pro_id from project where pro_stuNumber ='{$_COOKIE['stu_number']}' AND pro_year='$year' limit 1")){
		_alert_back('你已经作为队长申报了一个项目，根据相关规定无法再作为队长申报项目！');
	}
	
	//设置上传文件的类型
	$_files = array('application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	
	//判断类型是否是数组里的一种
	if (is_array($_files)) {
		if (!in_array($_FILES['userfile']['type'],$_files)) {
			_alert_back('上传文件必须是doc或docx！');
		}
	}
	//判断文件错误类型
	if ($_FILES['userfile']['error'] > 0) {
		switch ($_FILES['userfile']['error']) {
			case 1: _alert_back('上传文件超过约定值1');
				break;
			case 2: _alert_back('上传文件超过约定值2');
				break;
			case 3: _alert_back('部分文件被上传');
				break;
			case 4: _alert_back('没有任何文件被上传！');
				break;
		}
		exit;
	}
	
	//判断配置大小
	if ($_FILES['userfile']['size'] > 2000000) {
		_alert_back('上传的文件不得超过2M');
	}
	

	//获取项目分类
	if (isset($_GET['sort'])) {
		if($_GET['sort']==1){
			$_sort = '创业实践项目';
		}elseif($_GET['sort']==2){
			$_sort = '创业训练项目';
		}elseif($_GET['sort']==3){
			$_sort = '创新训练项目';
		}elseif($_GET['sort']==4){
			$_sort = '科研训练项目';
		}
	}else{
		_alert_close('非法操作！');
	}
		
	//获取文件的扩展名
	$_n = explode('.', $_FILES['userfile']['name']);
	$_name = 'word/'.$_sort.'-'.$_html['name'].'.'.$_n[1];
	//移动文件
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		if	(!move_uploaded_file($_FILES['userfile']['tmp_name'],$_name)) {
			_alert_back('移动失败');
		} else {
			//_alert_close('上传成功！');
			echo "<script>alert('上传成功！');window.opener.document.getElementById('url').value='$_name';window.close();</script>";
		}
	} else {
		_alert_back('上传的临时文件不存在！');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />

<title>四川大学科技项目管理平台-个人中心</title>
</head>
<body>
	
	<div id="upword" style="padding:20px;">
		<form enctype="multipart/form-data" action="upword.php?sort=<?php echo $_GET[sort]?>&action=up" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
			选择项目申报书: <input type="file" name="userfile" />
			<input type="submit"   value="上传" />
		</form>
	</div>
	

</body>

</html>







