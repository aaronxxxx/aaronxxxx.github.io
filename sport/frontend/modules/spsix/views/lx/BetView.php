<link rel="stylesheet" href="/public/aomen/css/betView.css">
<div id="layerInner" class="inner">
    <div class="msg-title text-center">极速六合彩 <?=$lx_name?> 下注单</div>
    <div class="msg-text">
        <form name="LAYOUTFORM" action="/?r=spsix/index/six-order" method="post" id="form2">
            <div class="PlayType">期数 : <?=$qishu?> <br /></div>
            <?php foreach ($totalArray as $key => $value) { ?>
                <div style="text-align:left;width:90%;">
                    <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;"><?=$lx_sub_name?></span> @
                    <span style="color:#FF0000" class="un-text-yew"><b><?=$oddsValueArray[$key]?></b></span>
                    <span><b><?=$value?></b></span>
                </div>
            <?php } ?>
            <label for="gold">下注金额:</label>
            <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8" class="OrderGold" onkeypress="" onkeyup="" /><br />
            <div style="display: none;">可赢金额:<span style="color:#FF0000" class="un-text-yew" id="pc">0.00</span><br />
            </div>
            <div  class="d-flex limitMoney">
                <p id="min" min="<?=$lowestMoney?>">最低限额:<?=$lowestMoney?></p>
                <p id="max" max="<?=$maxMoney?>">最高限额: <?=$maxMoney?></p>
            </div>
            <div style="padding-left: 20px">
                <input type="hidden" name="rs_r" value="" />
                <input type="hidden" name="period" value="<?=$qishu?>" />
                <input type="hidden" name="gid" value="<?=$gid?>" />
                <input type="hidden" name="total_count" value="<?=count($totalArray)?>" />
                <input type="hidden" name="lx_name" value="<?=$lx_sub_name?>" />
                <?php foreach ($totalArray as $key => $value) { ?>
                    <input type="hidden" name="totalArray[]" value="<?=$value?>" />
                    <input type="hidden" name="oddsIndexArray[]" value="<?=$oddsIndexArray[$key]?>" />
                <?php } ?>
            </div>
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