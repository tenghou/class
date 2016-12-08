<?php 
//防止恶意调用
if(!defined('IN_AC')){
	exit('Access Defined!');
}
//是否正常登录
if (isset($_COOKIE['tea_name'])) {
	//获取数据
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
    	<li><a href="#"><?php echo $_html0['name']?></a> 欢迎您！</li>
		<li>这是您第 <a href="#"><?php echo $_html0['tea_login_count']?></a> 次登录本系统</li>
		<li><a href="tea_user.php">返回首页</a></li>
        <li><a href="logout.php">退出</a></li>
    </ul>
</div>

<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>指导项目</span>
		<a href="tea_current_project">当前指导项目</a>
		<a href="tea_former_project">往期指导项目</a>

	</div>
	<div class="collapsed">
		<span>项目一览</span>
		<a href="tea_cysj.php">创业实践项目</a>
		<a href="tea_cyxl.php">创业训练项目</a>
		<a href="tea_cxxl.php">创新训练项目</a>
		<a href="tea_kyxl.php">科研训练项目</a>
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
			echo'<span>项目评分</span>';
			echo'<a href="tea_mark.php">项目评分</a>';
			echo'</div>';
	}
?>

	
	<div class="collapsed">
		<span>个人信息</span>
		<a href="tea_modify.php">个人资料修改</a>
		<a href="tea_modifyPass.php">密码修改</a>
	</div>
	
</div>
</body>
</html>
