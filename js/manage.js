window.onload = function() {
	manage();
	function manage() {
		var level = document.getElementById('level');
		var level_name = document.getElementsByTagName('option');
		for (var i = 0; i < level_name.length; i++) {
			if (level_name[i].value == level.value) {
				level_name[i].setAttribute('selected','selected');
			}
		}
	}
};
function checkUpdateForm() {
	var form = document.update;
	var admin_pass = form.admin_pass;
	if (admin_pass.value != '') {
		if (admin_pass.length < 6) {
			alert('密码不得小于6位');
			admin_pass.focus();
			return false;
		}
	} else if (admin_pass.value == '') {
		alert('密码不得为空');
		return false;
	}
	return true;
}
function checkAddForm() {
	var form = document.add;
	var admin_user = form.admin_user;
	var admin_pass = form.admin_pass;
	var admin_notpass = form.admin_notpass;
	if (admin_user.value == '' || admin_user.length < 6) {
		alert('密码不得为空并且比小于2位');
		admin_user.focus();
		return false;
	}
	if (admin_pass.value == '' || admin_pass.length < 6) {
		alert('密码不得为空并且比小于2位');
		admin_pass.focus();
		return false;
	}
	if (admin_notpass.value != admin_pass.value) {
		alert('二次密码不一致');
		admin_pass.focus();
		return false;
	}
	return true;
}
function checkcontent() {
	var fm = document.content;
	if (fm.title.value == '' || fm.title.value.length > 50 || fm.title.value.length < 5) {
		alert('标题不得为空，不得小于5位且不的大于50位');
		fm.title.focus();
		return false;
	}
	if (fm.nav.value == '') {
		alert('不得为空');
	}
	return true;
}