<?php
//����һ��������������Ȩ����includes������ļ�
define('IN_AC',true);
//���������������ָ����ҳ������
define('SCRIPT','cysj');
//���빫���ļ�
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['stu_number'])) {
	_alert_back('���¼���ٽ��иò���');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk2312" />
<link rel="stylesheet" type="text/css" href="style/cxxl.css" />
<title>�Ĵ���ѧ�Ƽ���Ŀ����ƽ̨-��ҵʵ����Ŀ</title>
<?php 
include ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<div id="body">
	<?php 
		//����ͷ�ļ�
		include ROOT_PATH.'includes/stu_header.inc.php';
	?>

	<div id=main>
		<h2>��ҵʵ����Ŀ˵��</h2>
		<div class="content">
			<span>������Ժѧ���Ŷӣ���ѧУ��ʦ����ҵ��ʦ��ָͬ���£�����ǰ�ڴ���ѵ����Ŀ�ĳɹ������һ������г�ǰ���Ĵ����Բ�Ʒ���߷��񣬲����Գ��������һ�˾���Դ�Ϊ������չ��ҵʵ�����</span>
			<div id=js><a href="submit_pro.php?sort=1">�������</a></div>
		</div>
	</div>
</div>
<?php
    require ROOT_PATH.'includes/footer.inc.php';
?>
</body>

</html>







