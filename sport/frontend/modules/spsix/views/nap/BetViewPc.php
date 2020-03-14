<div class="inner">
    <div class="msg-title">极速六合彩 正码过关 下注单</div>
    <div class="msg-text">
        <form name="MyForm" action="/?r=spsix/nap/bet-view" method="get" onsubmit="return false;">
        <input type="hidden" name="gid" value="NAP" />
        <div class="PlayType">            期数 :<?=$qishu?>
            <br />
        </div>
        <div style="text-align:center;width:90%;">

            <?php foreach ($game as $key=>$g){
                if ($g != ''){?>
                    <div>
                        <span style="color:white;background-color:#333;padding:0px 3px 0px 3px;">正码<?= $boll[$key-1]?> <?= $gameInfo[$key][0]?></span> @
                        <span style="color:#FF0000"><b><?= $odds_NAP[$key]["h".$gameInfo[$key][1]] ?></b></span>
                        <input type="hidden" name="game1" value="<?=$g?>" />
                        <input type="hidden" name="ioratio1" value="Array" />

                    </div>
                <?php }} ?>

            <br />
            </div>          模式 :
        <select name="wkind"><option value="S" selected="selected">单注</option> </select>
        <select name="wstar"><option value="' . $selectCount . '"><?= $selectCount?>串1</option></select>
        <select name="wteam" style="display:none">   </select>
        <input type="hidden" name="teamcount" value="<?=$selectCount?>" />
        </form>

        <form name="LAYOUTFORM" action="/?r=spsix/index/six-order" method="post" onsubmit="return false">
        <label for="gold">下注金额:</label>
        <input type="text" pattern="[0-9]*" min="0" id="gold" name="gold" maxlength="8" class="OrderGold"  /><br />
        <div style="display: none;">可赢金额:<span style="colo:#FF0000" id="pc">0.00</span>
        <br />
        </div>
            最低限额:<?= $lowestMoney?><br />
            最高限额: <?= $maxMoney ?><br />          <br />
            <input type="hidden" id="lowestMoney" value="<?= $lowestMoney?>">
            <input type="hidden" id="maxMoney" value="<?= $maxMoney?>">
            <input type="hidden" id="userMoney" value="<?= $userMoney?>">
    <div style="padding-left: 20px">
    <input type="reset" id="res" class="cancel_cen" name="btnCancel" value="取消" />           &nbsp;&nbsp;
    <input type="button" class="submit_cen" name="btnSubmit" value="确定" />
    <input type="hidden" name="teamcount" value="<?=$selectCount?>" />
    <input type="hidden" name="ratio_now" value="1.00000000" id="ratio_now" />
    <input type="hidden" name="line_type" value="" />
    <input TYPE="hidden" name="gid" value="NAP" />
    <input TYPE="hidden" name="type" value="4" />
    <input TYPE="hidden" name="period" value="<?=$qishu?>" />
    <input TYPE="hidden" name="gnum" value="<?=$qishu?>" />

        <?php foreach ($game as $key=>$g){
            if ($g != ''){?>
                <input type="hidden" name="game<?=$key?>" value="正码<?= $boll[$key-1]?> <?=$gameInfo[$key][0] ?>" />
                <input type="hidden" name="radio<?=$key?>" value="<?= $odds_NAP[$key]["h" . $gameInfo[$key][1]] ?>">
                <input type="hidden" name="oddindex<?=$key?>" value="<?=$gameInfo[$key][1] ?>">
            <?php }} ?>

    </div>
</form>
</div>
</div>
<div class="footer"></div>


