<script>
		 window.onload = function () {
        var nx_array = {};
        var ary = {};
        // var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        //var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        var _type = "text";
        var json = {
            hall: 0,
            menu: '',
            inner: '',
            title: '',
            ad: '',
            ball: '',
            grp: '',
            rule: '',
            tips: '',
            zodiac:<?=json_encode($zodiacArr)?>,
            _number: _type
        };
        var _lt = self.ShowTable.instance(json);
        //  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
        _lt.init("NAP", "0"); //初始化设定 包括 设定请求ajax 地址
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
        _lt.setBetMode(1);//开启下注模式    1为可下注模式
        _lt.run();
        _lt.displayNAP();
    }
	</script>
	<main class="sixMain">
		<input id="lotteryName" type="hidden" value="六合彩 正码过关">
		<?php include 'header.php';?>
		<?php include 'fast_bet_lhai.php';?>
		<section class="g-nr" id="Game">
			<form  name="lt_form" id="lt_form" action="/?r=six/nap/mobile-bet-view" method="post">
				<div class="qiu_one mt-2 mb-1" id="div-lm">
					<div class="qiu qiu_six">
						<ul class="d-flex justify-content-between">
							<li class="text-center act" data-tabinner="#nas_tabinner1">正码一</li>
							<li class="text-center" data-tabinner="#nas_tabinner2">正码二</li>
							<li class="text-center" data-tabinner="#nas_tabinner3">正码三</li>
							<li class="text-center" data-tabinner="#nas_tabinner4">正码四</li>
							<li class="text-center" data-tabinner="#nas_tabinner5">正码五</li>
							<li class="text-center" data-tabinner="#nas_tabinner6">正码六</li>
						</ul>
					</div>
				</div>
				<div class="nas_tabinnerArea pr-4 pl-4">
                    <?php  
                            $gametype = 'NAP';
                            $napArr =array('_ODD'=>'单','_EVEN'=>'双','_OVER'=>'大','_UNDER'=>'小','_SODD'=>'和单','_SEVEN'=>'和双','_SOVER'=>'和大','_SUNDER'=>'和小','_FOVER'=>'尾大','_FUNDER'=>'尾小','_R'=>'红','_G'=>'绿','_B'=>'蓝');
                            for ($i=1; $i < 7 ; $i++) { ?>
                    <div id="nas_tabinner<?= $i?>" class="tabinner nas_tabinner pb-4" style="display:none;">
                        <p class="tit napTit"><span style="width:100%">赔率</span></p>
                        <ul class="d-flex flex-wrap napItemBox">
                                <?php $j = 0 ;
                                    foreach ($napArr as $key => $value){$j++;?>
                                    <li class="napItem">
                                        <div>
                                            <label class="d-flex justify-content-around">
                                                <input type="radio" value="<?=$gametype.$i.$key?>" name="game<?= $i?>" />
                                                <p><?=$value?></p>  
                                                <p class="colorRed" id="<?=$gametype.$i.'_'.$j?>"></p>
                                            </label>
                                        </div>
                                    </li>
                                  <?php } ?>
                        </ul>
                    </div>
                         <?php   } ?>
				</div>
				<div class="orderbtn">
                    <p class="p-btn btns pt-5 pb-5">
                        <input type="button" class="yes submit mr-2" name="btnSubmit" value="确定" onclick="xiaZhu('NAP','lt_form','form2')"/>
                        <input type="button" class="no cancel" name="btnReset" value="取消" />
                    </p>
				</div>
				<input type="hidden" name="gid" id="gid" />
				<input type="hidden" name="Line" id="Line" value="" />
			</form>
		</section>
	</div>
</div>
</main>
<script src="/public/aomen/js/LianMaVerify.js"></script>



<script type="text/javascript">
	$(document).ready(function(){
		$('#nas_tabinner1').show();
		$('.qiu li').click(function () {
			var tabinner = $(this).data('tabinner');
			$(this).addClass('act').siblings().removeClass('act');
			$('.nas_tabinnerArea').find('.nas_tabinner').hide();
			$(tabinner).slideDown('slow');
		});
    });
</script>
