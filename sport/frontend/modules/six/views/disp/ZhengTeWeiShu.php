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
		_lt.init("SPB", "2"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模式
		_lt.run();

	}
</script>
<main class="sixMain">
	<input id="lotteryName" type="hidden" value="六合彩 平特尾数">
		<?php include 'header.php';?>
		<?php include 'fast_bet_lhai.php';?>
    	<section class="pk-list"  id="Game">
        	<form name="newForm" id="newForm" action="/?r=six/index/six-order" method="post">
				<div  class="p-info p-info2">
					<div class="round-table">
						<table id="table1" class="tema_a sp-tema_a text-center"></table>
					</div>
					<div class="round-table" class="infos">
						<table id="table2" class="tema_a sp-tema_a text-center pb-4"></table>
					</div>
					<div class="round-table">
						<table id="table3" class="tema_a sp-tema_a text-center"></table>
					</div>
					<div class="round-table">
						<table id="table4" class="tema_a sp-tema_a text-center"></table>
					</div>
				</div>
            	<div class="orderbtn">
					<p class="p-btn btns pt-5 pb-5">
						<input class="yes submit mr-2" type="button" name="btnBet" value="确定"/>
						<input id="res1" class="no cancel" type="reset" value="取消"/>
					</p>
           		</div>
				<input type="hidden" name="gid" id="gid" />
				<input type="hidden" name="showTableN" id="showTableN" value="2" />
				<input type="hidden" name="Line" id="Line" value="" />
            </form>
        </section>
	</div>
</div>
</main>
	<!-- <script>
        $.get("/?r=six/index/ajax&rtype=home", function(data,hm){
            var result = data;
            var result2 = JSON.parse(result);
            var sp_result = result2.kjresult[0];
            var str =sp_result.ball_1 +',' +sp_result.ball_2 +','+sp_result.ball_3 +','+sp_result.ball_4 +','+sp_result.ball_5+', '+sp_result.ball_6 +','+sp_result.ball_7;
            $('#var str =sp_result.ball_1 +',' +sp_result.ball_2 +','+sp_result.ball_3 +','+sp_result.ball_4 +','+sp_result.ball_5+','+sp_result.ball_6 +','+sp_result.ball_7;').append(str);              
        });
        </script> -->