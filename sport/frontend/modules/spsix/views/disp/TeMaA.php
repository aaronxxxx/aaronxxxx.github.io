<link href="/public/aomen/css/fast_bet_lhai.css" rel="stylesheet" type="text/css"/>
<script src="/public/aomen/js/fast_bet_lhai.js" type="text/javascript"></script>
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
		_lt.init("SP", "{$showTableN}"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模式
		_lt.run();
	}
	$(function () {
        $("#hit").click(function () {
            $(".mengfixd").show();
        })
        $("#close").click(function () {
            $(".mengfixd").hide();
        })
    })
</script>
        <?php include 'header.php';?>
        <?php include 'fast_bet_lhai.php';?>
		<section class="g-nr" id="Game">
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
                        <input type="hidden" name="Line" id="Line" value="" />
                    </form>
		</section>
	</div>
