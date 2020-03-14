<link rel="stylesheet" href="/public/aomen/css/betView.css">
<div id="layerInner" class="inner" xmlns="http://www.w3.org/1999/html">
    <div class="msg-title text-center">极速六合彩 连码 下注单</div>
    <div class="msg-text">
        <form id="form2" onsubmit="return false" method="post" action="/?r=spsix/index/six-order" name="LAYOUTFORM">
            <div class="PlayType">
                <span>期数 :<span class="colorRed"> <?php echo $qishu;?></span></span><br>
                <span><?php echo $ch_name;?></span> @<span  class="colorRed"><?php echo $betInfo;?></span></span>
                <br>组合共<font id="TotalBall" class="colorRed"><?php echo count($totalArray);?></font>组
            </div>
            <br>
            <p class="text-center">
                下注金额:
                <input id="gold" class="OrderGold" type="text" name="gold" min="0" maxlength="8" pattern="[0-9]*" style="border: 1px solid black;">
                <input type="hidden" value="<?php echo $qishu;?>" name="period">
            </p>
            <div class="d-flex limitMoney">
                <p id='min' min="<?php echo $lowestMoney;?>">最低限额: <?php echo $lowestMoney;?></p>
                <p id='max' max="<?php echo $maxMoney;?>">最高限额: <?php echo $maxMoney;?></p>
                <div style="padding-left: 20px">
                    <input type="hidden" value="CH" name="gid">
                    <input type="hidden" value="<?php echo count($totalArray);?>" name="total_count">
                    <input type="hidden" value="<?php echo $ch_name;?>" name="ch_name">
                    <?php foreach ($postInfo as $value){ ?>
                    <input type="hidden" name="totalArray[]" value="<?=$value ?>" />
                    <?php }?>
                </div>
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
