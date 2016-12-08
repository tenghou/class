<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','tea_stuTeam');
//引入公共文件
require dirname(_FILE_).'/includes/common.inc.php';

if (!isset($_COOKIE['tea_name'])) {
	_alert_back('请登录后再进行该操作');
}

$number=$_GET['stu_number'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<title>四川大学科技项目管理平台-团队信息</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		require ROOT_PATH.'includes/tea_header.inc.php';
		
		//获取数据队长信息
		$_rows1 = _fetch_array("SELECT 
				                                        pro_teamName,pro_stuNumber
				                             FROM 
				                                        project 
				                           WHERE 
				                                        pro_stuNumber='{$_GET['stu_number']}'");
		if ($_rows1) {
			$_html1= array();
			$_html1['pro_teamName'] = $_rows1['pro_teamName'];
			$_html1['pro_stuNumber'] = $_rows1['pro_stuNumber'];
			$_html1 = _html($_html1);
		}
		
	?>	

	<div id=main>
		<h2>团队信息</h2>
		
				<?php 
				//分页模块
				global $_pagesize,$_pagenum;
				_page("SELECT id FROM team WHERE captainNumber='{$_GET['stu_number']}'",1);   //第一个参数获取总条数，第二个参数，指定每页多少条
				$_result = _query("SELECT 
								                                        name,number,sex,idNumber,college,major,grade,phoneNumber,email 
								                             FROM 
								                                        team
								                           WHERE 
								                                        captainNumber='{$_GET['stu_number']}'
													ORDER BY
																		serialNumber
														   LIMIT
																		$_pagenum,$_pagesize
										");

						while (!!$_rows = _fetch_array_list($_result)) {
							$_html = array();
							$_html['name'] = $_rows['name'];
							$_html['number'] = $_rows['number'];
							$_html['sex'] = $_rows['sex'];
							$_html['id'] = $_rows['idNumber'];
							$_html['college'] = $_rows['college'];
							$_html['major'] = $_rows['major'];
							$_html['grade'] = $_rows['grade'];
							$_html['phoneNumber'] = $_rows['phoneNumber'];
							$_html['email'] = $_rows['email'];
						}
				   	?>
		
		<dl>
					<dd>团队名称：　<?php  echo $_html1['pro_teamName']  ?></dd>
					<dd>姓　　名：　<?php  echo $_html['name']  ?></dd>
					<dd>学　　号：　<?php  echo $_html['number']  ?></dd>
					<dd>性　　别：　<?php echo $_html['sex']?></dd>
					<dd>身份证号：　<?php echo $_html['id']?></dd>
					<dd>学　　院：　<?php echo $_html['college']?></dd>
					<dd>专　　业：　<?php echo $_html['major']?></dd>
					<dd>年　　级：　<?php echo $_html['grade']?></dd>
					<dd>联系电话：　<?php echo $_html['phoneNumber']?></dd>
					<dd>电子邮箱：　<?php echo $_html['email']?></dd>		
					<dd><input type="button" class="back" value="返回队长信息"onclick="location='tea_stu_info.php?stu_number=<?php echo $_html1['pro_stuNumber']?>'"/></dd>
					
		</dl>
				<?php 
					_free_result($_result);
					//_pageing函数调用分页，1表示数字分页
					_paging_team(1);
				?>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







