$(function () {
	ajaxlogin();
	getMsgInfo(); //获取公告信息
	setTimeout(function () {
		var login = $('#user_name').html();
		if (login) {
			setInterval("ajaxlogin()", 30000); //获取登录状态
		}
	}, 5000);
	// 关闭首页广告
	$(".ui-button-text").click(function () {
		$(".tanmeng").hide();
	})
	//验证码
	$("#check-code-wrapper").click(function () {
		var verify = document.getElementById('vPic');
		verify.setAttribute('src', '/?r=site/captcha&' + Math.random());
	});
	//登录
	$("#login-box").click(function () {
		login();
	});
	//登出
	$('.login_out').click(function () {
		$.post('/?r=passport/user-api/logout', {},
			function (rst) {
				// window.location.reload();
				window.location.href = '/?=site/index';
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
		this.value = this.value.replace(/[^a-zA-Z\u4e00-\u9fa5]+/, '');
	}).focus(function () {
		$(this).blur(function () {
			this.value = (/[^a-zA-Z\u4e00-\u9fa5]+/.test(this.value)) ? '' : this.value;
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
		if (username == '') {
			$(".remind").html('4 - 12 字元，限英文、数字').css('color', 'red');
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
			$(".reminds").html('6 - 12 字元，限英文、数字').css('color', 'red');
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
			$(".remindss").html('请再次确认密码').css('color', 'red');
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
		if (!de.test(real_name)) {
			$(".realremind").html('姓名只能是中文或者英文').css('color', 'red');
			return false;
		}
	});
	$('#phone').bind('input propertychange', function () {
		var phone = $("#phone").val();
		// var de = /^1[34578]\d{9}$/;
		var de = /^\d{5,20}$/;
		if (phone == '') {
			$(".reminding").html('请输入您的手机号码').css('color', 'red');
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
			$(".remindt").html('请输入您的QQ号码').css('color', 'red');
			return false;
		}
		if (qq.length < 6 || qq.length > 15) {
			$(".remindt").html('请填写QQ号').css('color', 'red');
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
			$(".remindh").html('请输入您的电子邮箱').css('color', 'red');
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
	$("#btn-submit").click(function () {
		// if ($('#is_real_name').val() != 1) {
		// 	alert("真实姓名已存在！");
		// 	return false;
		// }
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
		var trade_type = $("#trade_type").val();
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
		} else if (withdraw_pwd.length != 4) {
			alert("取款密码仅可输入四位数字");
			return false;
		} else if (chkpwd !== pwd) {
			alert("两次密码输入不一致");
			return false;
		} else if (real_name === '') {
			// alert("真实姓名不能为空");
			// return false;
		} else if (trade_type == '-' || trade_type == '') {
			alert("交易方式不能为空");
			return false;
		}

		// if ($('#is_phone').val() == 1) {
		// 	// if (!(/^1[34578]\d{9}$/.test(phone))) {
		// 	if (!(/^\d{5,20}$/.test(phone))) {
		// 		alert("手机号码有误，请重填");
		// 		return false;
		// 	}
		// }

		// if ($('#is_email').val() == 1) {
		// 	var ema = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		// 	if (!(ema.test(email))) {
		// 		alert("邮箱输入有误，请重填");
		// 		return false;
		// 	}
		// }

		$.post("/?r=passport/user-api/register", {
				name: username,
				pwd: pwd,
				withdraw_pwd: withdraw_pwd,
				real_name: real_name,
				phone: phone,
				qq: qq,
				email: email,
				agent_name: agent_name,
				trade_type: trade_type,
				pararms: pararms
			},
			function (result) {
				if (result.code === 0) {
					alert("注册成功");
					document.location.href = '/?r=member/index/index';
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

/**
 * 最新公告信息
 * @returns {undefined}
 */
function HotNewsHistory() {
	var features = 'height=500,width=500,top=0, left=0,scrollbars=yes,resizable=yes';
	window.open('/?r=member/announcement/notice', 'HotNewsHistory', features);
}

/**
 * 打开在线客服窗口
 * @returns {}
 */
$.post("/?r=passport/user-api/onlinekf", {},
	function (res) {
		urlkefu = "http://" + res;
	}, "html");

function openOnlineServiceWindow() {
	var name = '在线客服窗口'; //网页名称，可为空;
	var iWidth = 626; //弹出窗口的宽度;
	var iHeight = 528; //弹出窗口的高度;
	//获得窗口的垂直位置
	var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
	//获得窗口的水平位置
	var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
	window.open(urlkefu, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');
}

/**
 * 打开用户中心窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @returns {}
 */
function openUCWindow(url, title) {
	openWindow(url, title, 1020, 570);
}

/**
 * 打开窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @param {int} width       窗口宽度
 * @param {int} height      窗口高度
 * @returns {}
 */
function openWindow(url, title, width, height) {
	var iTop = (window.screen.availHeight - 30 - height) / 2; // 获得窗口的垂直位置
	var iLeft = (window.screen.availWidth - 10 - width) / 2; // 获得窗口的水平位置
	window.open(url, title, 'height=' + height + ',,innerHeight=' + height +
		',width=' + width + ',innerWidth=' + width + ',top=' + iTop +
		',left=' + iLeft +
		',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no').focus();
	// window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
}

function BBOnlineService() {
	var url = 'http://chat6.livechatvalue.com/chat/chatClient/chatbox.jsp?companyID=513240&configID=45123&jid=6222556093'; //转向网页的地址;
	var name = '窗口'; //网页名称，可为空;
	var iWidth = 626; //弹出窗口的宽度;
	var iHeight = 528; //弹出窗口的高度;
	//获得窗口的垂直位置
	var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
	//获得窗口的水平位置
	var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
	window.open(url, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');
	// window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
}

function ajaxlogin() {
	$.post('/?r=passport/user-api/login', function (data) {
		if (data.code == 0) {
			$("#audioWrap").html("");
			$('#loginbox').hide();
			$('#userinfoss').show();
			$('#user_name').html(data.data.user.name);
			$('#user_money').html(data.data.user.money);
			$('#msg_num').html(data.data.user.msg_num);
			if (data.data.user.msg_num > 0) {
				$("#audioWrap").html("<audio src='public/aomenPC/msg.mp3' autoplay='autoplay' loop='loop'/>");
			}
		} else if (data.code == 3) {
			alert(data.msg);
			$("#rmNum").val('').focus();
			$("#vPic").click();
		}
	}, 'json');
}

/**
 * 字段校验及登录
 * @returns {Boolean}
 */
function login() {
	var name = $("#login_account").val();
	var pwd = $("#login_password").val();
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
			if (rst.data.user.msg_num > 0) {
				$("#audioWrap").html("<audio src='public/aomenPC/msg.mp3' autoplay='autoplay' loop='loop'/>");
			}
			// window.location.reload();
			window.location.href = '/?r=member/index/index';
		} else {
			alert(rst.msg);
			$("#rmNum").val('').focus();
			$("#vPic").click();
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

function menu_click(id) {
	parent.topFrame.document.getElementById("textGlitter" + id).click();
}

function page_click(id) {
	window.parent.document.getElementById(id).click();
}
$(window.parent.parent.document).find("#mainFrame").height(1454);

/**
 * 获取公告信息
 * @returns {}
 */
function getMsgInfo() {
	$.post("/?r=passport/user-api/json", {},
		function (rst) {
			$("#msg").html(rst);
		},
		"json");
}

/**
 * 文字閃爍
 * @param id   jquery selecor
 * @param arr  ['#FFFFFF','#FF0000']
 * @param s    milliseconds
 */
function toggleColor(id, arr, s) {
    var self = this;
    self._i = 0;
    self._timer = null;
    self.run = function () {
        if (arr[self._i]) {
            $(id).css('color', arr[self._i]);
        }
        self._i == 0 ? self._i++ : self._i = 0;
        self._timer = setTimeout(function () {
            self.run(id, arr, s);
        }, s);
    }
    self.run();
}