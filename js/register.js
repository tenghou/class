//������ҳ���������ִ��
window.onload = function () {
	code();
	//����֤
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function () {
		//���ÿͻ�����֤�ģ������ÿͻ���
		//JS����PHP�γ���˵��ѡѧ������ǿ������
		//�û�����֤
		if (fm.name.value.length < 2 || fm.name.value.length > 10) {
			alert('��������С��2λ���ߴ���10λ');
			fm.name.value = ''; //���
			fm.name.focus(); //�������������ֶ�
			return false;
		}
		if (/[<>\'\"\ ]/.test(fm.name.value)) {
			alert('�������ð����Ƿ��ַ�');
			fm.name.value = ''; //���
			fm.name.focus(); //�������������ֶ�
			return false;
		}
		if (fm.number.value=='') {
			alert('ѧ�Ų���Ϊ��');
			fm.number.focus(); //�������������ֶ�
			return false;
		}
		//������֤
		if (fm.password.value.length < 6) {
			alert('���벻��С��6λ');
			fm.password.value = ''; //���
			fm.password.focus(); //�������������ֶ�
			return false;
		}
		if (fm.password.value != fm.notpassword.value) {
			alert('���������ȷ�ϱ���һ��');
			fm.notpassword.value = ''; //���
			fm.notpassword.focus(); //�������������ֶ�
			return false;
		}
		if (fm.id.value.length !=18) {
			alert('���֤��������');
			fm.id.focus(); //�������������ֶ�
			return false;
		}
		if (fm.birth.value=='') {
			alert('�������ڲ���Ϊ��');
			fm.birth.focus(); //�������������ֶ�
			return false;
		}
		if (fm.college.value=='') {
			alert('ѧԺ����Ϊ��');
			fm.college.focus(); //�������������ֶ�
			return false;
		}
		if (fm.major.value=='') {
			alert('רҵ����Ϊ��');
			fm.major.focus(); //�������������ֶ�
			return false;
		}
		if (fm.grade.value=='') {
			alert('�꼶����Ϊ��');
			fm.grade.focus(); //�������������ֶ�
			return false;
		}
		if (fm.phoneNumber.value=='') {
			alert('�绰���벻��Ϊ��');
			fm.phoneNumber.focus(); //�������������ֶ�
			return false;
		}
				
		//������֤
		if(fm.email.value.length != 0){
			if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
				alert('�ʼ���ʽ����ȷ');
				fm.email.value = ''; //���
				fm.email.focus(); //�������������ֶ�
				return false;
			}
		}
		
				
		//��֤����֤
		if (fm.code.value.length != 4) {
			alert('��֤�������4λ');
			fm.code.value = ''; //���
			fm.code.focus(); //�������������ֶ�
			return false;
		}
		
		
		return true;
	};
};









