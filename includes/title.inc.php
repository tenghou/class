<?php
//定义一个常量，用来授权调用includes里面的文件
define('IN_AC',true);
?>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/header.inc.css" /> 
<link rel="stylesheet" type="text/css" href="style/stu_user.css" />
<link rel="stylesheet" type="text/css" href="style/sdmenu.css" />
<script type="text/javascript" src="js/sdmenu.js"></script>
<script type="text/javascript">
var myMenu;
window.onload=(function() {
	myMenu = new SDMenu("my_menu");
	myMenu.init();
	typeof(fuc_adm_current_pro_distribute)!="undefined"&&
		fuc_adm_current_pro_distribute();
	typeof(fuc_up)!="undefined"&&
		fuc_up();
	typeof(fuc_login)!="undefined"&&
		fuc_login();
});
</script>
<link rel="stylesheet" type="text/css" href="style/<?php echo SCRIPT?>.css" />
