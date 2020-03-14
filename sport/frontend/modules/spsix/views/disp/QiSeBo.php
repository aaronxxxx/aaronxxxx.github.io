<link rel="stylesheet" href="/public/aomen/css/fast_bet_lhai.css" />
<script src="/public/aomen/js/fast_bet_lhai.js" type="text/javascript"></script>
<script>
	window.onload = function() {
		var nx_array = {};
		var ary = {};
		// var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
		//var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
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
			zodiac : <?=json_encode($zodiacArr)?>,
			_number : _type
		};
		var _lt = self.ShowTable.instance(json);
		//  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
		_lt.init("C7", "2"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模式
		_lt.run();
	}
</script>
<!-- <style>
  table {
  table-layout: fixed;
  }
</style>
    <section class="back f15em"><a href="/?r=spsix/disp/index" class="go-back">&lt;</a> 极速六合彩
		<span style="float: right"><a href="/?r=mobile/lottery/lottery">下注状况</a>&nbsp;&nbsp;&nbsp;余额:<span id="user_money"><?=$userMoney;?></span></span>
	</section>
    <div class="pdcenter">
        <div id="clock" style="display: none">
			<b></b><span id="HKTime"></span>
		</div>
		<section class="name">七色波</section>
		<section class="g-info spg-info" id="game_info">
			<p>
				当前期数：第<span style="font-weight: bold;" id="gNumber"></span>期
			</p>
			<p>
                封盘时间：<span id="gametime">&nbsp;</span>
			</p>
			<p>
				剩余时间：<span id="ui-countdown" class="f00"><span id="FCDH"style="font-weight: bold;"></span>
                                    <span id="close_msg"style="display: none;">&nbsp;</span></span>
			</p>
		</section>
		<input type="hidden" id="gold_gmin" value="<?=$lowestMoney;?>" />
		<input type="hidden" id="gold_gmax" value="<?=$maxMoney;?>" /> -->
		<?php include 'header.php';?>
        <?php include 'fast_bet_lhai.php';?>
        <section class="pk-list"  id="Game">
            <form name="newForm" id="newForm" action="/?r=spsix/index/six-order" method="post">
                <div  class="p-info p-info2">
                    <div class="round-table">
                        <table id="table1" class="tema_a sp-tema_a"></table>
                    </div>
                    <div class="round-table" class="infos">
                        <table id="table2" class="tema_a sp-tema_a"></table>
                    </div>
                    <div class="round-table">
                        <table id="table3" class="tema_a sp-tema_a"></table>
                    </div>
                    <div class="round-table">
                        <table id="table4" class="tema_a sp-tema_a"></table>
                    </div>
                </div>
                <div class="orderbtn">
                    <p class="p-btn">
                    <input class="yes" type="button" name="btnBet" value="确定"/>
                        <input class="no" type="reset" value="取消"/>
                        
                    </p>
                </div>
                <input type="hidden" name="gid" id="gid" />
                <input type="hidden" name="showTableN" id="showTableN" value="2" />
                <input type="hidden" name="Line" id="Line" value="" />
            </form>
        </section>
    </div>

