<div class="inner">
    <div class="msg-title">六合彩 自选不中 下注单</div>
    <div class="msg-text">
        <form name="LAYOUTFORM" action="/?r=six/index/six-order" method="post" id="form2">
            <div class="PlayType">
                <span style="color:#990000">期数 : <?=$qishu?></span> &nbsp;
                <span style="color:white;background-color:#333;padding:0px 3px 0px 3px;"><?=$ni_name?></span> @
                <span style="color:#FF0000" class="un-text-yew"><b><?=$oddsValue?></b></span> <br />
                <?=$betInfo?><br />组合共 <font id="TotalBall" color="red"><?=count($totalArray)?></font> 组
            </div>
            下注金额:
            <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8"  class="OrderGold" /><br/>
            <div style="display: none;">可赢金额:<b id="pc">0.00</b><br/></div>
            <p id="min" min="<?=$lowestMoney?>">最低限额: <?=$lowestMoney?><br/>
            <p id="max" max="<?=$maxMoney?>">最高限额: <?=$maxMoney?><br/><br/>
            <input type="hidden"  id="user_Money" name="userMoney" value="<?=$userMoney?>">
            <div style="padding-left: 20px">
                <input type="hidden" name="gid" value="NI" onkeypress="return false;"/>
                <input type="hidden" name="period" value="<?=$qishu?>"/>
                <input type="hidden" name="total_count" value="<?=count($totalArray)?>"/>
                <input type="hidden" name="ni_name" value="<?=$ni_name?>"/>
                <?php foreach ($totalArray as $key => $value) { ?>
                    <input type="hidden" name="totalArray[]" value="<?=$value?>"/>
                <?php } ?>
            </div>
            &nbsp;&nbsp;<input type="button" id="res" name="btnCancel" value="取消" class="cancel_cen" />            &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="button" name="btnSubmit" value="确定" class="submit_cen" />          </div>
        </form>
    </div>
</div>
<div class="footer"></div>