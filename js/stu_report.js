window.onload=function () {
	var del = document.getElementById('delete');
	del.onclick = function () {
		if (confirm('确定要删除此条数据？')) {
			location.href='?action=delete&id='+this.name;
		}
	};
};

