//等在网页加载完毕再执行
window.onload = function () {
	code();
	//表单验证
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function () {
		//能用客户端验证的，尽量用客户端
		//JS对于PHP课程来说，选学，并不强制掌握
		//用户名验证
		if (fm.name.value.length < 2 || fm.name.value.length > 10) {
			alert('姓名不得小于2位或者大于10位');
			fm.name.value = ''; //清空
			fm.name.focus(); //将焦点以至表单字段
			return false;
		}
		if (/[<>\'\"\ ]/.test(fm.name.value)) {
			alert('姓名不得包含非法字符');
			fm.name.value = ''; //清空
			fm.name.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.number.value=='') {
			alert('学号不能为空');
			fm.number.focus(); //将焦点以至表单字段
			return false;
		}
		//密码验证
		if (fm.password.value.length < 6) {
			alert('密码不得小于6位');
			fm.password.value = ''; //清空
			fm.password.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.password.value != fm.notpassword.value) {
			alert('密码和密码确认必须一致');
			fm.notpassword.value = ''; //清空
			fm.notpassword.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.id.value.length !=18) {
			alert('身份证号码有误');
			fm.id.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.birth.value=='') {
			alert('出生日期不能为空');
			fm.birth.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.college.value=='') {
			alert('学院不能为空');
			fm.college.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.major.value=='') {
			alert('专业不能为空');
			fm.major.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.grade.value=='') {
			alert('年级不能为空');
			fm.grade.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.phoneNumber.value=='') {
			alert('电话号码不能为空');
			fm.phoneNumber.focus(); //将焦点以至表单字段
			return false;
		}
				
		//邮箱验证
		if(fm.email.value.length != 0){
			if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
				alert('邮件格式不正确');
				fm.email.value = ''; //清空
				fm.email.focus(); //将焦点以至表单字段
				return false;
			}
		}
		
				
		//验证码验证
		if (fm.code.value.length != 4) {
			alert('验证码必须是4位');
			fm.code.value = ''; //清空
			fm.code.focus(); //将焦点以至表单字段
			return false;
		}
		
		
		return true;
	};
};









