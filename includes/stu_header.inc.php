<?php 
//防止恶意调用
if(!defined('IN_AC')){
	exit('Access Defined!');
}

//是否正常登录
if (isset($_COOKIE['stu_number'])) {
	//获取数据
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
    	<li><a href="#"><?php echo $_html0['name']?></a> 欢迎您！</li>
		<li>这是您第 <a href="#"><?php echo $_html0['stu_login_count']?> </a>次登录本系统</li>
		<li><a href="stu_user.php">返回首页</a></li>
        <li><a href="logout.php">退出</a></li>
    </ul>
</div>


<div id="my_menu" class="sdmenu">
	<div class="collapsed">
		<span>竞赛管理</span>
		<a href="stu_project_check.php">申报项目</a>
		
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
			if (!$_html['pro_state']=='待审核'){
				echo'<a href="stu_current_project.php">通过项目</a>';
				echo'<a href="stu_project_other.php">项目文档</a>';
			}
		?>
		
		<a href="stu_former_project.php">往期项目</a>

	</div>
	<div class="collapsed">
		<span>在线报名</span>
		<a href="cysj.php">创业实践项目</a>
		<a href="cyxl.php">创业训练项目</a>
		<a href="cxxl.php">创新训练项目</a>
		<a href="kyxl.php">科研训练项目</a>
	</div>
	<div class="collapsed">
		<span>团队管理</span>
		<a href="stu_teamInfo">团队信息</a>
		
		<?php 
			//获取团队成员信息
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
				echo '<a href="stu_team.php?id='.$i.'">成员'.$i.'</a>';
			}
		?>
	</div>
	<div class="collapsed">
			<span>往期项目一览</span>
			<a href="stu_former_all_pro.php">所有</a>
			
	</div>
	<div class="collapsed">
		<span>个人信息</span>
		<a href="stu_modify.php">个人资料修改</a>
		<a href="stu_modifyPass.php">密码修改</a>
	</div>
	
</div>
</body>
</html>
