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
		_lt.init("SPB", "1"); //初始化设定 包括 设定请求ajax 地址
		_lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
		_lt.setBetMode(1);//开启下注模式    1为可下注模式
		_lt.run();
	}
    function qishu(nowQishu) {
        var total = 216;
        var nowarr = nowQishu.slice(-3);
        var now = '';
        var last = '';
        if(nowarr < 100){
            now = nowQishu.slice(-2);
        }else{
            now = nowQishu.slice(-3);
        }
       $('#openQishu').html(now);
       $('#lastQishu').html(total-now);
    }
</script>

<main class="sixMain">
    <!-- <input type="hidden" value="極速六合彩"> -->
    <input type="hidden" id="gold_gmin" value="<?=$lowestMoney;?>" />   <!-- 最低額度 -->
            <input type="hidden" id="gold_gmax" value="<?=$maxMoney;?>" />  <!-- 最高額度 -->
    <ul class="label pl-4 pr-4 pt-4 pb-2 pt-5">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <div class="number">第<span id="gNumber"></span>期</div>
            <div class="qishu">已开<span id="openQishu"></span>期,剩余<span id="lastQishu"></span>期</div>
        </li>
        <li class="d-flex justify-content-between align-items-center pb-3">
            <div id="sp_autoinfo" class="autoinfo d-flex justify-content-between"></div>
        </li>
    </ul>
    <div class="content">
        <section class="tabArea pl-4 pr-4" style="background-color:#f2f2f2;">
            <div class="tabLabel d-flex justify-content-between align-items-end">
                <!-- <p >第<span id="open_qihao"></span>期</p> -->
                <p class="cqc_time"><span id="cqc_text">距离封盘:</span><span id="FCDH"></span></p>
            </div>
        </section>
        <div class="pk-list">
            <div class="lianma-info pb-4 pl-4 pr-4 pt-4">
                <div class="tabinner">
                    <div class="infos">
                        <p class="tit d-flex justify-content-between">
                            <span class="sx-1" style="width:20% !important;">时间</span>
                            <span class="sx-2" style="width:30% !important;">期数</span>
                            <span class="sx-3" style="width:50%!important;">号码</span>
                        </p>
                        <ul class="sixTable">
                            <?php 
                                $spresult_count = count($spsix_result);
                                for ( $i=0 ; $i< $spresult_count ; $i++ ) {?>
                                <li class="d-flex">
                                        <span class="sx-1" style="width:20% !important;"><?=substr( $spsix_result[$i]['create_time'], -8, 5)?></span>
                                        <span class="sx-2" style="width:30% !important;"><?= $spsix_result[$i]['qishu']?></span>
                                        <span class="sx-3" style="width:50% !important;">
                                            <ul class="d-flex justify-content-center">
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_1']?>"><?= $spsix_result[$i]['ball_1']?></ol>
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_2']?>"><?= $spsix_result[$i]['ball_2']?></ol>
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_3']?>"><?= $spsix_result[$i]['ball_3']?></ol>
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_4']?>"><?= $spsix_result[$i]['ball_4']?></ol>
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_5']?>"><?= $spsix_result[$i]['ball_5']?></ol>
                                                <ol class="sixResultBall mr-1 sixball_<?= $spsix_result[$i]['ball_6']?>"><?= $spsix_result[$i]['ball_6']?></ol>
                                                <ol class="sixResultBall sixball_<?= $spsix_result[$i]['ball_7']?>"><?= $spsix_result[$i]['ball_7']?></ol>
                                            </ul>
                                        </span>
                                    </li>
                            
                            <?php
                        }?>
                        </ul>
                    </div>
                </div>
            </div>
      
        </div>
      
        
</main>
<script>
 
</script>