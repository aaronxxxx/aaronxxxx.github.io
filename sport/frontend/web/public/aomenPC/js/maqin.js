$(function () {
	ajaxlogin();
	setTimeout(function () {
		var login = $('#user_name').html();
		if (login) {
			setInterval("ajaxlogin()", 30000); //获取登录状态
		}
	}, 5000);
	//登录
	$("#inputlogin").click(function () {
		login();
	});
	//登出
	$('.login_out').click(function () {
		$.post('/?r=passport/user-api/logout', {},
			function (rst) {
				window.location.reload();
			},
			"html");
	})
	$('input[name=reg_username]').keyup(function () {
		this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
	}).focus(function () {
		$(this).blur(function () {
			this.value = (/[^a-zA-Z0-9]/g.test(this.value)) ? '' : this.value;
		});
	});
	$('input[name=real_name]').keyup(function () {
		this.value = this.value.replace(/[^\u4e00-\u9fa5a-zA-Z]/, '');
	}).focus(function () {
		$(this).blur(function () {
			this.value = (/[^\u4e00-\u9fa5a-zA-Z]/.test(this.value)) ? '' : this.value;
		});
	});
	$('input[name=phone]').keyup(function () {
		this.value = this.value.replace(/[^0-9]+/, '');
	}).focus(function () {
		$(this).blur(function () {
			this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value;
		});
	});
	$('input[name=qq]').keyup(function () {
		this.value = this.value.replace(/[^0-9]+/, '');
	}).focus(function () {
		$(this).blur(function () {
			this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value;
		});
	});

	$("#reg_username").bind('input propertychange', function () {
		var username = $("#reg_username").val();
		var reg = /^[a-zA-Z\d]\w{2,10}[a-zA-Z\d]$/;
		if (username === '') {
			$(".remind").html('');
			return false;
		}
		if (username.length < 4 || username.length > 12) {
			$(".remind").html('用户名为4-12个字符').css('color', 'red');
			return false;
		}
		if (!reg.test(username)) {
			$(".remind").html('账号只能是数字和字母组合').css('color', 'red');
			return false;
		}
		$.get("/?r=passport/user-api/unique-user-name", {
			name: username,
		}, function (r) {
			if (r.code == 0) { //不存在相同用户名
				$('#is_user_name').val('1'); //注册凭证，不可删除
				//页面变化自己写
				$(".remind").html('账户可注册').css('color', 'green');
			} else { //存在相同用户名
				$('#is_user_name').val('2'); //注册凭证，不可删除
				//页面变化自己写
				$(".remind").html('注册账户已存在！').css('color', 'red');
			}
		}, "json");
	});
	$('#reg_password').bind('input propertychange', function () {
		var reg_password = $("#reg_password").val();
		var reg = /^[a-zA-Z\d]\w{4,10}[a-zA-Z\d]$/;
		if (reg_password == '') {
			$(".reminds").html('');
			return false;
		}
		if (reg_password.length < 6 || reg_password.length > 12) {
			$(".reminds").html('密码为6-12个字符').css('color', 'red');
			return false;
		}
		if (reg_password.length > 6 || reg_password.length < 12) {
			$(".reminds").html('');
			return false;
		}
		if (!reg.test(reg_password)) {
			$(".reminds").html('密码只能是数字、英文或两者组合').css('color', 'red');
			return false;
		}
	});
	$('#reg_passwd').bind('input propertychange', function () {
		var reg_passwd = $("#reg_passwd").val();
		var reg = /^\w{6,12}$/;
		if (reg_passwd == '') {
			$(".remindss").html('');
			return false;
		}
		if (reg_passwd.length < 6 || reg_passwd.length > 12) {
			$(".remindss").html('密码为6-12个字符').css('color', 'red');
			return false;
		}
		if (reg_passwd.length > 6 || reg_passwd.length < 12) {
			$(".remindss").html('');
			return false;
		}
		if (!reg.test(reg_passwd)) {
			$(".remindss").html('密码只能是数字、英文或两者组合').css('color', 'red');
			return false;
		}
	});
	$("#real_name").bind('input propertychange', function () {
		var real_name = $("#real_name").val();
		var de = /^[a-zA-Z\u4e00-\u9fa5 ]{1,20}$/;
		if (real_name === '') {
			$(".realremind").html('');
			return false;
		}
		if (!de.test(real_name)) {
			$(".realremind").html('姓名只能是中文或者英文').css('color', 'red');
			return false;
		}
	});
	$('#phone').bind('input propertychange', function () {
		var phone = $("#phone").val();
		var de = /^1[34578]\d{9}$/;
		if (phone == '') {
			$(".reminding").html('');
			return false;
		}
		if (!de.test(phone)) {
			$(".reminding").html('请填写正确的号码').css('color', 'red');
			return false;
		}
		if (de.test(phone)) {
			$(".reminding").html('');
			return false;
		}
	});
	$('#qq').bind('input propertychange', function () {
		var qq = $("#qq").val();
		if (qq == '') {
			$(".remindt").html('');
			return false;
		}
		if (qq.length < 6 || qq.length > 15) {
			$(".remindt").html('请填写qq号').css('color', 'red');
			return false;
		}
		if (qq.length > 6 || qq.length < 15) {
			$(".remindt").html('');
			return false;
		}
	});
	$('#email').bind('input propertychange', function () {
		var email = $("#email").val();
		var ds = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (email == '') {
			$(".remindh").html('');
			return false;
		}
		if (!ds.test(email)) {
			$(".remindh").html('请填写正确的邮箱').css('color', 'red');
			return false;
		}
		if (ds.test(email)) {
			$(".remindh").html('');
			return false;
		}
	});

	//会员注册验证
	$("#OK2").click(function () {
		if ($('#is_real_name').val() != 1) {
			alert("真实姓名已存在！");
			return false;
		}
		if ($('#is_user_name').val() != 1) {
			alert("注册账户已存在！");
			return false;
		}
		var username = $("#reg_username").val();
		var agent_name = $("#agent_name").val();
		var pwd = $("#reg_password").val();
		var chkpwd = $("#reg_passwd").val();
		var withdraw_pwd = $("#pwd1").val() + $("#pwd2").val() + $("#pwd3").val() + $("#pwd4").val();
		var real_name = $("#real_name").val();
		var phone = $("#phone").val();
		var qq = $("#qq").val();
		var email = $("#email").val();
		var pararms = $("#myFORM").serialize();
		if (username === '') {
			alert("请填写正确的账号");
			return false;
		}
		if (!(/^[a-zA-Z\d]\w{2,11}[a-zA-Z\d]$/.test(username))) {
			alert('账号只能是数字、字母或两者组合');
			return false;
		} else if (pwd === '' || withdraw_pwd === '') {
			alert("密码不能为空");
			return false;
		} else if (chkpwd === '') {
			alert("确认密码不能为空");
			return false;
		} else if (chkpwd !== pwd) {
			alert("两次密码输入不一致");
			return false;
		} else if (real_name === '') {
			alert("真实姓名不能为空");
			return false;
		}
		if ($('#is_phone').val() == 1) {
			if (!(/^1[34578]\d{9}$/.test(phone))) {
				alert("手机号码有误，请重填");
				return false;
			}
		}
		if ($('#is_email').val() == 1) {
			var ema = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!(ema.test(email))) {
				alert("邮箱输入有误，请重填");
				return false;
			}
		}
		$.post("/?r=passport/user-api/register", {
				name: username,
				pwd: pwd,
				withdraw_pwd: withdraw_pwd,
				real_name: real_name,
				phone: phone,
				qq: qq,
				email: email,
				agent_name: agent_name,
				pararms: pararms
			},
			function (result) {
				if (result.code === 0) {
					alert("注册成功");
					document.location.href = '/?r=site/index';
				} else {
					alert(result.msg);
				}
			}, "json");
	});
	//代理注册
	$("#agents_submit").click(function () {
		var username = $("#username1").val();
		var pwd = $("#password1").val();
		var chkpwd = $("#repassword").val();
		var real_name = $("#real_name").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var qq = $("#qq").val();
		var pararms = $("#myFORM").serialize();
		var reg = /^[a-zA-Z\d]\w{2,11}[a-zA-Z\d]$/;

		if (username === '') {
			alert("账号不能为空");
			return false;
		} else if (!reg.test(username)) {
			alert('账号只能是数字和字母组合');
			return false;
		} else if (pwd === '') {
			alert("密码不能为空");
			return false;
		} else if (chkpwd === '') {
			alert("确认密码不能为空");
			return false;
		} else if (chkpwd !== pwd) {
			alert("两次密码输入不一致");
			return false;
		} else if (real_name === '') {
			alert("真实姓名不能为空");
			return false;
		} else if (!(/^1[34578]\d{9}$/.test(phone))) {
			alert("手机号码有误，请重填");
			return false;
		} else if (phone === '') {
			alert("电话不能为空");
			return false;
		}

		$.post("/?r=passport/user-api/agents-register", {
				username: username,
				password: pwd,
				repassword: chkpwd,
				real_name: real_name,
				tel: phone,
				email: email,
				qq: qq,
				pararms: pararms
			},
			function (result) {
				if (result.code === 0) {
					alert("注册成功");
					document.location.reload();
				} else {
					alert(result.msg);
				}
			}, "json");
	});
})

function ajaxlogin() {
	$.post('/?r=passport/user-api/login', function (data) {
		if (data.code == 0) {
			$("#audioWrap").html("");
			$('#loginbox').hide();
			$('#userinfo').show();
			$('#user_name').html(data.data.user.name);
			$('#user_money').html(data.data.user.money);
			$('#msg_num').html(data.data.user.msg_num);
			$('.navlogin').html("<a href='/?r=member/msg/index'>会员中心<span>MEMBER</span></a>");
			if (data.data.user.msg_num > 0) {
				$("#audioWrap").html("<audio src='public/aomenPC/msg.mp3' autoplay='autoplay' loop='loop'/>");
			}
		} else if (data.code == 3) {
			alert(data.msg);
			$("#yzm").val('').focus();
			$("#rmNum").click();
		}
	}, 'json');
}

/**
 * 字段校验及登录
 * @returns {Boolean}
 */
function login() {
	var name = $("#username").val();
	var pwd = $("#password").val();
	var yzm = $("#rmNum").val();
	if (name == "" || name === "帐号") {
		alert("用户名不能为空");
		return false;
	} else if (pwd == "" || pwd == '******') {
		alert("密码不能为空");
		return false;
	} else if (yzm == "" || yzm == '验证码') {
		alert("验证码不能为空");
		return false;
	}

	$.post("/?r=passport/user-api/login", {
		cmd: 'login',
		name: name,
		pwd: pwd,
		verifyCode: yzm
	}, function (rst) {
		if (rst.code === 0) {
			console.log(rst);
			$("#loginbox").hide();
			$("#userinfoss").show();
			$("#user_name").html(rst.data.user.name);
			$("#user_money").html(rst.data.user.money);
			$("#msg_num").html(rst.data.user.msg_num);
			$('.navlogin').html("<a href='/?r=member/msg/index'>会员中心<span>MEMBER</span></a>");
			if (rst.data.user.msg_num > 0) {
				$("#audioWrap").html("<audio src='public/aomenPC/msg.mp3' autoplay='autoplay' loop='loop'/>");
			}
			window.location.reload();
		} else {
			alert(rst.msg);
			$("#yzm").val('').focus();
			$("#rmNum").click();
		}
	}, "json");
}

function loginCheck() {
	var pass = false;
	$.ajax({
		async: false,
		url: '/?r=passport/user-api/login-check',
		dataType: 'json',
		success: function (data) {
			if (data.status) {
				pass = true;
			} else {
				alert('请先登录！');
			}
		}
	});
	return pass;
}

function Go_forget_pwd() {
	alert("请联系客服!");
}

//影片种类
function mlaftVideo() {
	layer.closeAll();
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['../../video/mlaft/index.html', 'no'],
		success: function () {
			$('.layui-layer-max').hide();
			var winCheck = function () {
				var display = $('.layui-layer-min').css('display');
				if (display == 'none') {
					$('.layui-layer-max').show();
				} else {
					$('.layui-layer-max').hide();
				}
			};
			setInterval(winCheck, 100);
		}
	});
}

function bjpk10Video() {
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['../../video/bjpk10/index.html', 'no'],
		success: function () {
			$('.layui-layer-max').hide();
			var winCheck = function () {
				var display = $('.layui-layer-min').css('display');
				if (display == 'none') {
					$('.layui-layer-max').show();
				} else {
					$('.layui-layer-max').hide();
				}
			};
			setInterval(winCheck, 100);
		}
	});
}

function fkscVideo() {
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['../../video/ssrc/index.html', 'no'],
		success: function () {
			$('.layui-layer-max').hide();
			var winCheck = function () {
				var display = $('.layui-layer-min').css('display');
				if (display == 'none') {
					$('.layui-layer-max').show();
				} else {
					$('.layui-layer-max').hide();
				}
			};
			setInterval(winCheck, 100);
		}
	});
}

function ssccqVideo() {
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['../../video/ssccq/index.html', 'no'],
		success: function () {
			$('.layui-layer-max').hide();
			var winCheck = function () {
				var display = $('.layui-layer-min').css('display');
				if (display == 'none') {
					$('.layui-layer-max').show();
				} else {
					$('.layui-layer-max').hide();
				}
			};
			setInterval(winCheck, 100);
		}
	});
}