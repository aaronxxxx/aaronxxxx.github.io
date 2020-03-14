
<div class="inner">
    <div class="msg-title">极速六合彩 连码 下注单</div>
        <div class="msg-text">
            <form id="form2" name="LAYOUTFORM" action="/?r=spsix/index/six-order" method="post" onsubmit="return false">
            <div class="PlayType">
                <span class="rr">期数 : <?=$qishu?></span> &nbsp;
                <span style="color:white;background-color:#333;padding:0px 3px 0px 3px;"> <?=$ch_name?></span> @
                <b class="OddsL"><?=$odds_string?> </b> <br /><?=$betInfo?><br />组合共 <font id="TotalBall" color="red"><?=$count?>
                    </font> 组 </div>          <br />下注金额:
            <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8" class="OrderGold"  /><br />
            <input type="hidden" name="period"  value="<?=$qishu?>"/><br />
            <div style="display: none;">          可赢金额:          <b id="pc">0.00</b><br />          </div>
            最低限额: <?=$lowestMoney?><br />        最高限额: <?=$maxMoney?><br />
            <div style="padding-left: 20px">
                <input type="hidden" id="lowestMoney" value="<?=$lowestMoney?>">
                <input type="hidden" id="maxMoney" value="<?=$maxMoney?>">
                <input type="hidden" id="userMoney" value="<?=$userMoney?>">
                <input type="reset" id="res" name="btnCancel" value="取消" class="cancel_cen" />           &nbsp;&nbsp;
                <input type="button" name="btnSubmit" value="确定" class="submit_cen" />          </div>
                <input type="hidden" name="gid" value="CH" />
                <input type="hidden" name="total_count" value="<?=$count?>" />
                <input type="hidden" name="ch_name" value="<?=$ch_name?>" />
                <?php foreach ($totalArray as $key=>$to)  {?>
                    <input type="hidden" name="totalArray[]" value="<?=$to?>" />
                <?php } ?>
            </form>
        </div>
</div>
<div class="footer"></div>
