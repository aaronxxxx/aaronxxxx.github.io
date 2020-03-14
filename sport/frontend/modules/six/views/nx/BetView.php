<link rel="stylesheet" href="/public/aomen/css/betView.css">
<div id="layerInner" class="inner">
    <div class="msg-title text-center">六合彩 合肖  下注单</div>
    <div class="msg-text">
        <form name="LAYOUTFORM" action="/?r=six/index/six-order" method="post" onsubmit="return false" id="form2">
            <div class="PlayType">
                <span >期数: <span class="colorRed"><?=$qishu?></span> </span> <br>
                <span><?=$descName?></span>
                    @ <b class="OddsL colorRed"><?=$oddsValue?> </b>         <br>
                <span style="color:#583805;"><b><?=$animalString;?></b></span>
            </div>
            <label for="gold">
                <br/>
                下注金额:
            </label>
            <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8" class="OrderGold" value=""/><br/>
            <div style="display: none;">
                可赢金额:
                <span style="color:#FF0000" id="pc">0.00</span><br/>
            </div>
            <div class="d-flex limitMoney">
                <p id='min' min="<?php echo $lowestMoney;?>">最低限额: <?php echo $lowestMoney;?></p>
                <p id='max' max="<?php echo $maxMoney;?>">最高限额: <?php echo $maxMoney;?></p>
            </div>
  
            <input type="hidden" name="rs_r" value="" />
            <input type="hidden" name="gid" value="NX" />
            <input type="hidden" name="period" value="<?=$qishu?>" />
            <input type="hidden" name="concede_r" value="NX_IN" />
            <input type="hidden" name="select_count" value="<?=$postCount?>" />
            <input type="hidden" name="num" value="<?=$postAnimal?>" />
        </form>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#layerInner').parent('.layui-layer-content').siblings('.layui-layer-btn').addClass('OrderGoldBtn');
    // 高度添加
    var layerInner = $('#layerInner').height(),
    OrderGoldBtn = $('.OrderGoldBtn').height();
    $('.layui-layer-content').css('height',layerInner+OrderGoldBtn+10+'px');
});
</script>