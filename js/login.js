window.onload=fuc_login=function(){
	code();
	//登录验证
	var fm = document.getElementsByTagName('form')[0];

	fm.onsubmit = function () {
		
		if (fm.number.value.length == 0) {
			alert('用户名不得为空');
			fm.number.value = ''; //清空
			fm.number.focus(); //将焦点以至表单字段
			return false;
		}
		if (/[<>\'\"\ \　]/.test(fm.username.value)) {
		alert('用户名不得包含非法字符');
		fm.number.value = ''; //清空
		fm.number.focus(); //将焦点以至表单字段
		return false;
	}

	};
}
