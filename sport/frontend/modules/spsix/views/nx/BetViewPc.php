<div class="inner">
    <div class="msg-title">极速六合彩 合肖  下注单</div>
    <div class="msg-text">
        <form name="LAYOUTFORM" action="/?r=spsix/index/six-order" method="post" onsubmit="return false" id="form2">
            <div class="PlayType">
                <span style="color:#990000">期数 : <?=$qishu?></span>
                <span style="color:white;background-color:#333;padding:0px 3px 0px 3px;"><?=$descName?></span>@
                <b class="OddsL"><?=$oddsValue?> </b>           <br/>
                <span style="background-color:#c1d7e5;color:#333"><b><?=$animalString;?></b></span>
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
            <p id='min' min="<?php echo $lowestMoney;?>">最低限额: <?php echo $lowestMoney;?></p>
            <p id='max' max="<?php echo $maxMoney;?>">最高限额: <?php echo $maxMoney;?></p>
            <div style="padding-left: 20px">
            <input type="button" id="res" class="cancel_cen" name="btnCancel" value="取消" />&nbsp;&nbsp;
            <input type="button" class="submit_cen" name="btnSubmit" value="确定" />          </div>
            <input type="hidden"  id="user_Money" name="userMoney" value="<?=$userMoney?>">
            <input type="hidden" name="rs_r" value="" />
            <input type="hidden" name="gid" value="NX" />
            <input type="hidden" name="period" value="<?=$qishu?>" />
            <input type="hidden" name="concede_r" value="NX_IN" />
            <input type="hidden" name="select_count" value="<?=$postCount?>" />
            <input type="hidden" name="num" value="<?=$postAnimal?>" />
        </form>
    </div>
</div>
<div class="footer"></div>