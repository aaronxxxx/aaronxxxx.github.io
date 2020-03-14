<script>
		window.onload = function() {
			var nx_array = {};
			var ary = {};
			var _type = "text";
			var json = {
				hall : 0,
				menu : '',
				inner : '',
				title : '',
				ad : '',
				ball : '',
				grp : '',
				rule : '',
				tips : '',
				zodiac :<?=json_encode($zodiacArr)?>,
				_number : _type
			};
			var _lt = self.ShowTable.instance(json);
			_lt.init("OEOU", "{$showTableN}"); //初始化设定 包括 设定请求ajax 地址
			_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
			_lt.setBetMode(1);//开启下注模式    1为可下注模式
			_lt.run();
		}
	</script>
	<main class="sixMain">
		<input id="lotteryName" type="hidden" value="六合彩 兩面">
		<?php include 'header.php';?>
		<?php include 'fast_bet_lhai.php';?>
		<section class="g-nr" id="Game">
			<form name="newForm" id="newForm" action="/?r=six/index/six-order" method="post">
				<div  class="p-info p-info2">
					<div class="round-table">
						<table id="table1" class="tema_a sp-tema_a text-center"></table>
					</div>
					<div class="round-table" class="infos">
						<table id="table2" class="tema_a sp-tema_a text-center"></table>
					</div>
					<div class="round-table">
						<table id="table3" class="tema_a sp-tema_a text-center"></table>
					</div>
					<div class="round-table">
						<table id="table4" class="tema_a sp-tema_a text-center"></table>
					</div>
				</div>
				<!--特单 特单-->
				<!--正码一-->
				<div class="qiu_one mt-2 mb-1 pb-4" id="div-lm">
					<div class="qiu qiu_six">
						<ul class="d-flex justify-content-between">
							<li class="text-center act">正码一</li>
							<li class="text-center">正码二</li>
							<li class="text-center">正码三</li>
							<li class="text-center">正码四</li>
							<li class="text-center">正码五</li>
							<li class="text-center">正码六</li>
						</ul>
					</div>
				</div>
				<div class="orderbtn ">
					<p class="p-btn btns pt-5 pb-5">
						<input class="yes submit mr-2" type="button" name="btnBet" value="确定"/>
						<input id="res1" class="no cancel" type="reset" value="取消"/>
					</p>
				</div>
				<input type="hidden" name="gid" id="gid" />
				<input type="hidden" name="Line" id="Line" value="" />
			</form>
		</section>
	</div>
</div>
</main>




<script type="text/javascript">
	$(document).ready(function(){
		$('#div-lm').find('.p-info').eq(0).show().siblings('.p-info').hide();
		$('.qiu li').click(function () {
			$(this).addClass('act').siblings().removeClass('act');
			$(this).parents(".qiu_one").siblings().find(".p-info").hide();
			$(this).parents(".qiu_one").find(".p-info").eq($(this).index()).show().siblings('.p-info').hide();
		});
	});
</script>
