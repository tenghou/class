window.onload=function () {
	var del = document.getElementById('delete');
	del.onclick = function () {
		if (confirm('ȷ��Ҫɾ���������ݣ�')) {
			location.href='?action=delete&id='+this.name;
		}
	};
};

