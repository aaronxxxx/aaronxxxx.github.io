'use strict';

var themeRoot = 'themes/saiban/assets/yuntsai/',
	headerH = $('#top-nav').innerHeight() + $('#header').innerHeight(),
	bannerH = $('#banner').innerHeight(),
	qishu = $('#qishu').val() ? $('#qishu').val() : null;

// 投注清單
function layerButton() {
	$('body').on('click', '[data-button=layer]', function () {
		var bodyType = $(this).parents('.container').attr('data-type'),
			PknameId = $(this).parents('.card-footer').siblings('.card-header').find('h4').attr('data-name-id'),
			MultinameId = $(this).parents('.figure-group').attr('data-name-id'),
			active = $(this).parents('.card-footer').siblings('.card-header').find('h4').text(),
			Pk_name1 = $(this).parents('.media').find('h4.pk_name1').text(),
			Pk_name2 = $(this).parents('.media').find('h4.pk_name2').text(),
			Pk_img1 = $(this).parents('.media').find('[data-id=pk_img1]').attr('src'),
			Pk_img2 = $(this).parents('.media').find('[data-id=pk_img2]').attr('src'),
			Pk_Vs = $(this).parents('.media').find('[data-id=vs]').text(),
			Pk_Rangfen = $(this).parents('.media').find('[data-id=rangfen]').text(),
			Pk_Pkid = $(this).parents('.media').find('.pkid span').text(),
			Pk_Choice = $(this).parents('.card-footer').siblings('.card-header').find('h4').text(),
			Pk_Odds = $(this).parents('.card-footer').siblings('.card-header').find('.odds').text(),
			Multi_Vs = $(this).parents('.media').find('[data-id=title]').text(),
			Multi_Pkid = $(this).parents('.media').find('.pkid span').text(),
			Multi_Choice = $(this).parent().siblings('.col-6').find('p').text(),
			Multi_Odds = $(this).parent().siblings().find('.odds').text(),
			Multi_Banner = $(this).parents('.media').find('.media-header').css('background-image');
		$('body').append($('.betting_list').clone());
		$('.betting_list:last').attr('id', 'betting_list');
		layer.open({
			type: 1,
			title: false,
			closeBtn: 0,
			shadeClose: false,
			shade: [0.8, '#000'],
			skin: 'layer-ext-betting_list',
			area: '960px',
			anim: 1,
			isOutAnim: true,
			resize: false,
			scrollbar: false,
			content: $('#betting_list'),
			success: function success() {
				switch (bodyType) {
					case 'pk-mode':
						// 生成Pk結構
						$('#betting_list').attr({
							'data-game-type': '1',
							'data-name-id': PknameId
						});
						$('#betting_list [data-id=name1]').html(Pk_name1);
						$('#betting_list [data-id=name2]').html(Pk_name2);
						$('#betting_list [data-id=img1]').css('background', 'white url(' + Pk_img1 + ') no-repeat center center/cover');
						$('#betting_list [data-id=img2]').css('background', 'white url(' + Pk_img2 + ') no-repeat center center/cover');
						$('#betting_list [data-id=vs]').html(Pk_Vs);
						$('#betting_list [data-id=rangfen]').html(Pk_Rangfen);
						$('#betting_list [data-id=pkid]').html(Pk_Pkid);
						$('#betting_list [data-id=choice]').html(Pk_Choice);
						$('#betting_list [data-id=odds]').html(Pk_Odds);
						//點選此項目頭像效果
						if (active == $('#betting_list [data-id=name1]').text()) {
							$('.left_people').addClass('activeBorder');
						} else if (active == $('#betting_list [data-id=name2]').text()) {
							$('.right_people').addClass('activeBorder');
						}
						break;
					case 'multi-mode':
						// 生成多項目結構
						$('#betting_list').attr({
							'data-game-type': '2',
							'data-name-id': MultinameId
						});
						$('#betting_list [data-id=vs]').html(Multi_Vs);
						$('#betting_list [data-id=rangfen]').closest('li').hide();
						$('#betting_list [data-id=pkid]').html(Multi_Pkid);
						$('#betting_list [data-id=choice]').html(Multi_Choice);
						$('#betting_list [data-id=odds]').html(Multi_Odds);
						$('#betting_list .banner').css({
							'background': Multi_Banner,
							'height': '120px',
							'display': 'flex',
							'justify-content': 'center',
							'align-items': 'center'
						}).html('<h3 class="banner-title">' + Multi_Vs + '</h3>');
						break;
				}
				// 將送出按鈕關閉
				$('#betting_list [data-button=submit]').addClass('disble_btn');
				// 關閉彈窗
				$('#betting_list [data-button=layer-close]').on('click', function () {
					$('.people').removeClass('activeBorder');
					layer.closeAll();
				});
				// 輸入金額
				$('#betting_list [name=betting_dollars]').keyup(function () {
					// 判斷有無輸入金額
					if ($('#betting_list [name=betting_dollars]').val() == '') {
						$('#betting_list [data-button=submit]').attr('data-button-id', '').prop('disabled', true).addClass('disble_btn');
					} else if ($('#betting_list [name=betting_dollars]').val() !== '') {
						$('#betting_list [data-button=submit]').attr('data-button-id', 'betting_confirm').prop('disabled', false).removeClass('disble_btn');
					}
					$('#betting_list .betting_money').html(Math.round($('#betting_list [name=betting_dollars]').val() * $('#betting_list [data-id=odds]').text() * 100) / 100);
				});
				// 點擊送出功能
				$('#betting_list [data-button=submit]').on('click', function () {
					var data = $(this).attr('data-button-id'),
						type = $('#betting_list').attr('data-game-type'),
						pkid = $('#betting_list [data-id=pkid]').text(),
						money = $('#betting_list [name=betting_dollars]').val(),
						item = $('#betting_list').attr('data-name-id'),
						text = $('#betting_list .betting_list_textarea').val();
					if (data == 'betting_confirm') {
						$.ajax({
							type: "post",
							url: "/?r=event/index/insert-order",
							data: {
								qishu: qishu,
								game_type: type,
								game_id: pkid,
								bet_money: money,
								game_item_id: item,
								message: text
							},
							dataType: "json",
							success: function success(result) {
								if (result.code == 10) {
									alert("投注成功");
									layer.closeAll();
									document.location.reload();
								} else {
									alert(result.msg);
								}
							}
						});
					} else {
						return false;
					}
				});
			},
			end: function end() {
				$('#betting_list').remove();
			}
		});
	});
}

var sport = {
	init: function init() {
		$.get("/themes/saiban/assets/yuntsai/files/new.json", function (data) {
			data = data[qishu];

			//PK
			for (var i = 0; i < data.pk.length; i++) {

				//根據項目注入
				if ($('#pkGroup .pkID-' + i).length < 1) {
					$('#pkGroup').append($('#thisIsCopyUse .pkClone').clone());
					$('#pkGroup li:last').addClass('pkID-' + i);
				}

				//指定項目
				var thisPkItem = $('#pkGroup .pkID-' + i);
				thisPkItem.find('[data-id=vs]').html(data.pk[i].home.name + ' VS ' + data.pk[i].customer.name);
				thisPkItem.find('.pkid').html('编号:<span>' + data.pk[i].no + '</span>');

				/* 透過先行指定變數的作法，減輕行數，一次指定需給予數值*/
				//轉為後台判別，前台僅作顯示

				thisPkItem.find('[data-id=project]').html(data.pk[i].home.name + ' 让 ' + data.pk[i].customer.name + ' ' + data.pk[i].rangfen + ' 票');
				thisPkItem.find('[data-id=rangfen]').html(data.pk[i].rangfen);
				thisPkItem.find('[data-id=pk_img1]').attr('src', data.pk[i].home.imgUrl);
				thisPkItem.find('.pk_name1').html(data.pk[i].home.name).attr('data-name-id', data.pk[i].home.id);
				thisPkItem.find('[data-id=pk_peilu1]').html(data.pk[i].home.rate);
				thisPkItem.find('[data-id=pk_jieshao1]').html(data.pk[i].home.description);
				thisPkItem.find('[data-id=pk_img2]').attr('src', data.pk[i].customer.imgUrl);
				thisPkItem.find('.pk_name2').html(data.pk[i].customer.name).attr('data-name-id', data.pk[i].customer.id);
				thisPkItem.find('[data-id=pk_peilu2]').html(data.pk[i].customer.rate);
				thisPkItem.find('[data-id=pk_jieshao2]').html(data.pk[i].customer.description);

				var $btnTools = thisPkItem.find('.card-footer .tools');

				// 左邊個人連結
				$btnTools.find('[data-icon=pk1] a.btn').each(function (index, e) {
					if (data.pk[i].home.url[index] != null && data.pk[i].home.url[index].length > 0) {
						$(this).attr('onclick', 'openUCWindow(' + '"' + data.pk[i].home.url[index] + '"' + ', "")').removeClass('disble_a');
						$(this).find('img').attr('src', '/themes/saiban/assets/images/sport/icon00' + (index + 1) + '.png');
					} else if (data.pk[i].home.url[index] == null || data.pk[i].home.url[index].length == 0) {
						return false;
					}
				});

				// 右邊個人連結
				$btnTools.find('[data-icon=pk2] a.btn').each(function (index, e) {
					if (data.pk[i].customer.url[index] != null && data.pk[i].customer.url[index].length > 0) {
						$(this).attr('onclick', 'openUCWindow(' + '"' + data.pk[i].customer.url[index] + '"' + ', "")').removeClass('disble_a');
						$(this).find('img').attr('src', '/themes/saiban/assets/images/sport/icon00' + (index + 1) + '.png');
					} else if (data.pk[i].customer.url[index] == null || data.pk[i].customer.url[index].length == 0) {
						return false;
					}
				});
				// Pk暫停下注
				if (data.pk[i].home.status == '2') {
					thisPkItem.find('.bet_left').prop('disabled', true).addClass('disble_btn');
				} else {
					thisPkItem.find('.bet_left').prop('disabled', false).removeClass('disble_btn');
				}
				if (data.pk[i].customer.status == '2') {
					thisPkItem.find('.bet_right').prop('disabled', true).addClass('disble_btn');
				} else {
					thisPkItem.find('.bet_right').prop('disabled', false).removeClass('disble_btn');
				}
			}
			//Multiple
			for (var i = 0; i < data.multi.length; i++) {

				if ($('#multiGroup .multiID-' + i).length < 1) {
					$('#multiGroup').append($('#thisIsCopyUse .multiClone').clone());
					$('#multiGroup li:last').addClass('multiID-' + i);
				}
				//指定項目
				var thisMultiItem = $('#multiGroup .multiID-' + i);

				thisMultiItem.find('[data-id=title]').html(data.multi[i].title);
				thisMultiItem.find('.pkid').html('编号:<span>' + data.multi[i].no + '</span>');
				thisMultiItem.find('.media-header').css('background', '#DFDFDF url(' + data.multi[i].banner + ') no-repeat center center/cover');

				// 生成項目類型
				thisMultiItem.find('.row').html('');
				var $cloneOne = $('#thisIsCopyUse .multiClone .figure-group');
				for (var o = 0; o < data.multi[i].item.length; o++) {
					$cloneOne.attr('data-name-id', data.multi[i].item[o][0]);
					$cloneOne.find('[data-id=item]').html(data.multi[i].item[o][2]);
					$cloneOne.find('[data-id=item-peilu]').html(data.multi[i].item[o][3]);
					// Multi暫停下注
					if (data.multi[i].item[o][1] == '2') {
						$cloneOne.find('.multi_btn').prop('disabled', true).addClass('disble_btn');
					} else if (data.multi[i].item[o][1] == '1') {
						$cloneOne.find('.multi_btn').prop('disabled', false).removeClass('disble_btn');
					}
					thisMultiItem.find('.row').append($cloneOne.clone());
				}
			}

			// 圖片自適應
			$(".imgLiquidFill").imgLiquid();

			// 側邊時間樣式
			$('[data-id=open-date]').html(data.Official.kaijiang_time[0]);
			$('[data-id=open-time]').html(data.Official.kaijiang_time[1]);
			$('[data-id=feng-date]').html(data.Official.fenpan_time[0]);
			$('[data-id=feng-time]').html(data.Official.fenpan_time[1]);
		}, "json");
	}
};

var sidebar = {
	init: function init() {
		$('#sidebar .sidebar-wrapper .card .card-body table tbody tr:first-of-type').attr('data-hidden', true);
	},
	scroll: function scroll() {

		var $sidebar = $("#sidebar");
		var top = '20vh';
		$sidebar.css('top', top);
		var offsetTop = $sidebar.offset();

		$(window).scroll(function () {
			if ($(window).scrollTop() > offsetTop.top) {
				$sidebar.stop().animate({
					top: offsetTop.top + $(window).scrollTop()
				}, 1000, 'easeInOutCubic');
			} else {
				$sidebar.stop().animate({
					top: top
				}, 1000, 'easeInOutCubic');
			}
		});
	},
	collapse: function collapse() {
		var $close = $(".sidebar-close"),
			$open = $(".sidebar-open");
		$('#sidebar .sidebar-wrapper button').on('click', function () {
			if ($(this).attr('data-collapse') == 'close') {
				$open.css({
					transform: 'translateX(0%) translateY(-50%)'
				});
				$close.css({
					transform: 'translateX(calc(100% + 24px))'
				});
			} else {
				$open.css({
					transform: 'translateX(calc(100% + 24px)) translateY(-50%)'
				});
				$close.css({
					transform: 'translateX(0%)'
				});
			}
		});
	}
};

var scrollToFunc = {
	target: function scrollToID() {
		$('.scrollToID').on('click', function (e) {
			e.preventDefault();

			var _target = $(this).attr('data-target'),
				target = $('[data-type=' + _target + ']');
			$('html, body').animate({
				scrollTop: target.offset().top - headerH
			}, 1000, 'easeInOutQuint');
		});
	}
};

$(function () {
	layer.config({
		path: '/themes/saiban/assets/js/layer/layer.js' //layer.js所在的目录，可以是绝对目录，也可以是相对目录
	});

	// 項目讀取並載入
	sport.init();

	// 綁定按鈕事件
	layerButton();

	// scroll
	sidebar.scroll();
	// scroll to id
	scrollToFunc.target();

	setInterval(sport.init, 2000);

	$('.time-top').on('click', function () {
		var thisBtn = $(this).attr('data-id');
		$('.time-top').removeClass('act');
		$(this).addClass('act');
		$('.time-bottom').hide();
		$('.time-tab').find('#' + thisBtn).show();
	})
});

$(window).on('load', function () {
	// layer 關閉
	layer.closeAll();
});