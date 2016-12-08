<?php 
//防止恶意调用
if(!defined('IN_AC')){
	exit('Access Defined!');
}
//是否正常登录
if (isset($_COOKIE['adm_username'])) {
	//获取数据
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
    	<li><a href="#"><?php echo $_html0['name']?></a> 欢迎您！</li>
		<li>这是您第 <a href="#"><?php echo $_html0['adm_login_count']?></a> 次登录本系统</li>
		<li><a href="adm_user.php">返回首页</a></li>
        <li><a href="logout.php">退出</a></li>
    </ul>
</div>


<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>添加信息</span>
		<a href="adm_add_admin.php">添加管理员</a>
		<a href="adm_add_adjudicator.php">添加评审老师</a>
		<a href="adm_add_competition.php">添加竞赛信息</a>
	</div>
	<div class="collapsed">
		<span >当前项目初审</span>
		<a href="adm_current_allpro.php">所有</a>
		
	</div>
	<div class="collapsed">
		<span>当前项目分配</span>
		<a href="adm_current_pro_distribute.php">所有</a>
		<a href="adm_current_cysj_dis.php">创业实践项目</a>
		<a href="adm_current_cyxl_dis.php">创业训练项目</a>
		<a href="adm_current_cxxl_dis.php">创新训练项目</a>
		<a href="adm_current_kyxl_dis.php">科研训练项目</a>
	</div>
	<div class="collapsed">
		<span>当前结果公示</span>
		<a href="adm_current_pro_publicity.php">所有</a>
		<a href="adm_current_cysj_publicity.php">创业实践项目</a>
		<a href="adm_current_cyxl_publicity.php">创业训练项目</a>
		<a href="adm_current_cxxl_publicity.php">创新训练项目</a>
		<a href="adm_current_kyxl_publicity.php">科研训练项目</a>
	</div>
	<div class="collapsed">
			<span>当前项目一览</span>
			<a href="adm_current_project_passed.php">已通过</a>
			<a href="adm_current_project_notpassed.php">未通过</a>
	</div>
	<div class="collapsed">
		<span>往期项目</span>
		<a href="adm_former_allpro.php">所有</a>
		<a href="adm_former_cysj.php">创业实践项目</a>
		<a href="adm_former_cyxl.php">创业训练项目</a>
		<a href="adm_former_cxxl.php">创新训练项目</a>
		<a href="adm_former_kyxl.php">科研训练项目</a>
	</div>
	<div class="collapsed">
		<span>个人信息</span>
		<a href="adm_modifyPass.php">密码修改</a>
	</div>
	
</div>
</body>
</html>
