window.onload=fuc_adm_current_pro_distribute=function () {
	var all = document.getElementById('all');
	var fm = document.getElementsByTagName('form')[0];
	all.onclick = function () {
		//form.elements获取表单内的所有表单
		//checked表示已选
		for (var i=0;i<fm.elements.length;i++) {
			if (fm.elements[i].name!='chkall') {
				fm.elements[i].checked = fm.chkall.checked;
			}
		}
	};
	fm.onsubmit = function(){
		if (fm.adjudicator.value=='') {
			alert('请填写要分配给的评审老师');
			fm.adjudicator.focus(); //将焦点以至表单字段
			return false;
		}else{
			return true;
		}
	};
	
};
