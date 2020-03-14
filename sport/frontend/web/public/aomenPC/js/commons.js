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
		content: ['/public/video/mlaft/index.html', 'no'],
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
		content: ['/public/video/bjpk10/index.html', 'no'],
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

function orpkVideo() {
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['/public/video/orpk/index.html', 'no'],
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
		content: ['/public/video/ssrc/index.html', 'no'],
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
		content: ['/public/video/cqssc/index.html', 'no'],
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

function tjsscVideo() {
	layer.open({
		type: 2,
		title: '开奖视频',
		area: ['700px', '500px'],
		anim: 5,
		shade: false,
		fixed: false, //不固定
		maxmin: true,
		content: ['/public/video/tjssc/index.html', 'no'],
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

var headerNav = {
	// 主選單 active
	listActive: function listActive() {
		var _url = window.location.href;
		var url = _url.split('/').pop();
	
		if ( url == 'site' ) {
			var url = './';
			$('header nav ul li a[href="'+url+'"], #header #main-Menual li a[href="'+url+'"], .top .nav li a[href="'+url+'"]').addClass('current');
		} else {
			$('header nav ul li a, #header #main-Menual li a, .top .nav li a').removeClass('current');
			$('header nav ul li a[href="/?r=site/'+url+'"], #header #main-Menual li a[href="/?r=site/'+url+'"], .top .nav li a[href="/?r=site/'+url+'"]').addClass('current');
		}
	}
}

$(function(){
	// 主選單 active
	headerNav.listActive();
})