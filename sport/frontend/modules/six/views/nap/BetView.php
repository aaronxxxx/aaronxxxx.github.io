<link rel="stylesheet" href="/public/aomen/css/betView.css">
<div id="layerInner" class="inner">
    <div class="msg-title text-center">六合彩 正码过关 下注单</div>
    <div class="msg-text">
        <form name="MyForm" action="/?r=six/nap/mobile-bet-view" method="get" onsubmit="return false;">
            <input type="hidden" name="gid" value="NAP" />
            <div class="PlayType">期数 :  <?=$qishu?><br /></div>
            <div style="text-align:center;width:90%;">
                <?php if($postNews['game1']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码一  <?=$game1Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP1["h" . $game1Info[1]]?> </b></span>
                        <input type="hidden" name="game1" value="<?=$postNews['game1']?>" />
                        <input type="hidden" name="ioratio1" value="Array" />
                    </div>
                <?php } if($postNews['game2']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码二  <?=$game2Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP2["h" . $game2Info[1]]?> </b></span>
                        <input type="hidden" name="game2" value="<?=$postNews['game2']?>" />
                        <input type="hidden" name="ioratio2" value="Array" />
                    </div>
                <?php } if($postNews['game3']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码三  <?=$game3Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP3["h" . $game3Info[1]]?> </b></span>
                        <input type="hidden" name="game3" value="<?=$postNews['game3']?>" />
                        <input type="hidden" name="ioratio3" value="Array" />
                    </div>
                <?php } if($postNews['game4']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码四  <?=$game4Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP4["h" . $game4Info[1]]?> </b></span>
                        <input type="hidden" name="game4" value="<?=$postNews['game4']?>" />
                        <input type="hidden" name="ioratio4" value="Array" />
                    </div>
                <?php } if($postNews['game5']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码五  <?=$game5Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP5["h" . $game5Info[1]]?> </b></span>
                        <input type="hidden" name="game5" value="<?=$postNews['game5']?>" />
                        <input type="hidden" name="ioratio5" value="Array" />
                    </div>
                <?php } if($postNews['game6']){?>
                    <div>
                        <span style="color:white;background-color:#703e0e;padding:0px 3px 0px 3px;">正码六  <?=$game6Info[0]?></span> @
                        <span style="color:#FF0000"><b> <?=$odds_NAP6["h" . $game6Info[1]]?> </b></span>
                        <input type="hidden" name="game6" value="<?=$postNews['game6']?>" />
                        <input type="hidden" name="ioratio6" value="Array" />

                    </div>n
                <?php }?>
                <br />
                </div>模式 :
            <select name="wkind" class="mr-2 mb-2"><option value="S" selected="selected">单注</option></select>
            <select name="wstar"><option value="<?=$selectCount?>"><?=$selectCount?>串1</option></select>
            <select name="wteam" style="display:none"></select>
            <input type="hidden" name="teamcount" value="<?=$selectCount?>" />
        </form>

        <form name="LAYOUTFORM" action="/?r=six/index/six-order" method="post" onsubmit="return false" id="form2">
            <label for="gold">下注金额:</label>
            <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8" class="OrderGold"  /><br />
            <div style="display: none;">可赢金额:<span style="colo:#FF0000" id="pc">0.00</span>
            <br />
            </div>
            <div class="d-flex limitMoney">
                <p id="min" min="<?=$lowestMoney?>">最低限额:  <?=$lowestMoney?></p>
                <p id="max" max="<?=$maxMoney?>"></p>最高限额:  <?=$maxMoney?>
            </div>
            <div style="padding-left: 20px">
                <input type="hidden" name="teamcount" value="<?=$selectCount?>"/>
                <input type="hidden" name="ratio_now" value="1.00000000" id="ratio_now" />
                <input type="hidden" name="line_type" value=""/>
                <input TYPE="hidden" name="gid" value="NAP"/>
                <input TYPE="hidden" name="type" value="4"/>
                <input TYPE="hidden" name="period" value="<?=$qishu?>"/>
                <input TYPE="hidden" name="gnum" value="<?=$qishu?>"/>
                <?php if($postNews['game1']){?>
                    <input type="hidden" name="game1" value="正码一 <?=$game1Info[0]?>" />
                    <input type="hidden" name="radio1" value="<?=$odds_NAP1["h" . $game1Info[1]]?>">
                    <input type="hidden" name="oddindex1" value="<?=$game1Info[1]?>">
                <?php } if($postNews['game2']){?>
                    <input type="hidden" name="game2" value="正码二 <?=$game2Info[0]?>" />
                    <input type="hidden" name="radio2" value="<?=$odds_NAP2["h" . $game2Info[1]]?>">
                    <input type="hidden" name="oddindex2" value="<?=$game2Info[1]?>">
                <?php } if($postNews['game3']){?>
                    <input type="hidden" name="game3" value="正码三 <?=$game3Info[0]?>" />
                    <input type="hidden" name="radio3" value="<?=$odds_NAP3["h" . $game3Info[1]]?>">
                    <input type="hidden" name="oddindex3" value="<?=$game3Info[1]?>">
                <?php } if($postNews['game4']){?>
                    <input type="hidden" name="game4" value="正码四 <?=$game4Info[0]?>" />
                    <input type="hidden" name="radio4" value="<?=$odds_NAP4["h" . $game4Info[1]]?>">
                    <input type="hidden" name="oddindex4" value="<?=$game4Info[1]?>">
                <?php } if($postNews['game5']){?>
                    <input type="hidden" name="game5" value="正码五 <?=$game5Info[0]?>" />
                    <input type="hidden" name="radio5" value="<?=$odds_NAP5["h" . $game5Info[1]]?>">
                    <input type="hidden" name="oddindex5" value="<?=$game5Info[1]?>">
                <?php } if($postNews['game6']){?>
                    <input type="hidden" name="game6" value="正码六 <?=$game6Info[0]?>" />
                    <input type="hidden" name="radio6" value="<?=$odds_NAP6["h" . $game6Info[1]]?>">
                    <input type="hidden" name="oddindex6" value="<?=$game6Info[1]?>">
                <?php }?>
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
