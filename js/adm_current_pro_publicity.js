window.onload=fuc_adm_current_pro_distribute=function () {
	var all = document.getElementById('all');
	var fm = document.getElementsByTagName('form')[0];
	all.onclick = function () {
		//form.elements��ȡ���ڵ����б�
		//checked��ʾ��ѡ
		for (var i=0;i<fm.elements.length;i++) {
			if (fm.elements[i].name!='chkall') {
				fm.elements[i].checked = fm.chkall.checked;
			}
		}
	};
	fm.onsubmit = function(){
		if (fm.adjudicator.value=='') {
			alert('����дҪ�������������ʦ');
			fm.adjudicator.focus(); //�������������ֶ�
			return false;
		}else{
			return true;
		}
	};
	
};
