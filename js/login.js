window.onload=fuc_login=function(){
	code();
	//��¼��֤
	var fm = document.getElementsByTagName('form')[0];

	fm.onsubmit = function () {
		
		if (fm.number.value.length == 0) {
			alert('�û�������Ϊ��');
			fm.number.value = ''; //���
			fm.number.focus(); //�������������ֶ�
			return false;
		}
		if (/[<>\'\"\ \��]/.test(fm.username.value)) {
		alert('�û������ð����Ƿ��ַ�');
		fm.number.value = ''; //���
		fm.number.focus(); //�������������ֶ�
		return false;
	}

	};
}
