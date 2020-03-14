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
			zodiac :<?=json_encode($zodiacArr)?>,
			_number : _type
		};
		var _lt = self.ShowTable.instance(json);
		//  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
		_lt.init("SPA", "2"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模
		_lt.run();
	}
</script>
<main class="sixMain">
    <input id="lotteryName" type="hidden" value="極速六合彩 色波">
    <?php include 'header.php';?>
    <?php include 'fast_bet_lhai.php';?>
	<section class="pk-list"  id="Game">
    <?php if($lastOne){?>
    
	<form name="newForm" id="newForm" action="/?r=spsix/index/six-order" method="post">
        <div  class="p-info p-info2">			
		<div class="round-table">
			<table id="table1" class=" sp-tema_a"></table>
		</div>
		<div class="round-table" class="infos">
			<table id="table2" class="tema_a sebotab sp-tema_a text-center" style="width:100%"></table>
		</div>
		<div class="round-table">
			<table id="table3" class="tema_a sp-tema_a"></table>
		</div>
		<div class="round-table">
			<table id="table4" class="tema_a sp-tema_a"></table>
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
    <?php } else {?>
        <section class="g-info spg-info" id="game_info">
            <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
        </section>
    <?php }?>
	</section>
</div>
<div id="AD" style="display:none;" >
    <div id="ShowBall">
        <label></label>
        <div id="Ball">
            <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
        </div>
    </div>
</div>
