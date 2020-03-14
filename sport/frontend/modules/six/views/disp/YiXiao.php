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
		_lt.init("SPB", "1"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模式
		_lt.run();
	}
</script>
<main class="sixMain">
    <input id="lotteryName" type="hidden" value="六合彩 一肖">
    <?php include 'header.php';?>
    <?php include 'fast_bet_lhai.php';?>
    <section class="pk-list"  id="Game">
    <?php if($lastOne){?>
        <form name="newForm" id="newForm" action="/?r=six/index/six-order" method="post">
            <div class="p-info2">
                <div class="round-table">
                    <table id="table1" class="tema_a sp-tema_a  pr-4 pl-4 pb-4 text-center" style="width:100%;" data-digits="4"></table>
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
                <p class="p-btn btns pt-5 pb-5">
                <input class="yes submit mr-2" type="button" name="btnBet" value="确定"/>
                    <input id="res1" class="no cancel" type="reset" value="取消"/>
                </p>
            </div>
            <input type="hidden" name="gid" id="gid" />
            <input type="hidden" name="Line" id="Line" value="" />
        </form>
    <?php } else {?>
        <section class="g-info spg-info" id="game_info">
            <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 六合彩目前休盘，请等待下一期开盘。</div>
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
<script>
    $(document).ready(function () {
        $('.six_tab input').click(function () {
            $(this).attr('checked',true);
            $(this).parents('.item').siblings().removeClass('act');
            $(this).parents('.item').addClass('act');
        });
    });
    var tag1="";
    function displayAD(){
        if(tag1==""){
            var ad=document.getElementById('AD');
            ad.style.display="block";
            tag1="block";
            document.getElementById("checkzh").value="隐藏组合";
            return;

        }
        if(tag1=="block"){
            var ad=document.getElementById('AD');
            ad.style.display="none";
            tag1="";
            document.getElementById("checkzh").value="查看组合";
            return;
        }
        //$('#AD').;

    }
</script>
