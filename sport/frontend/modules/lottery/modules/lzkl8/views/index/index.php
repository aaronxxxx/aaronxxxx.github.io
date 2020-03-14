<script src="/public/luzhu/js/bjkl8.js"></script>
<div id="html_content">
    <div id="layout" class="container">
        <!--彩种分类-->
        <div class="sub-nav bline" id="integrate-nav">
            <div class="ssc-small-nav ssc qiulei">
                <a class="on" href="javascript:void(0)">选一</a>
                <a href="javascript:void(0)">选二</a>
                <a href="javascript:void(0)">选三</a>
                <a href="javascript:void(0)">选四</a>
                <a href="javascript:void(0)">选五</a>
                <a href="javascript:void(0)">和值</a>
                <a href="javascript:void(0)">上中下</a>
                <a href="javascript:void(0)">奇和偶</a>
            </div>
        </div>
        <!-- 左边 -->
        <div class="sidebar">
            <!--两面长龙排行-->
            <div id="side_left" class="side_left">
                <div id="leftSwapBtn">
                    <ul>
                        <li class="on changlong">两面长龙排行</li>
                        <li class="zuijin" onclick="openUCWindow('/?r=member/lottery/lottery-one&time=<?=date('Y/m/d')?>&type=BJKN', '交易记录')">最近交易记录</li>
                    </ul>
                </div>
                <div class="changlongbox liangmianlong" style="display: block;">
                    <table style="" class="bet-table changlong-table dataArea w100">
                        <tbody id="changlong">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- 右边 -->
        <div style="display: block;" class="main-content bet-content">
            <div class="mains_corll">
                <div id="rightLoader">
                    <div id="html_ctx">
                        <div class="betAreaBox ssc">

                            <div class="bet-results-box allline autos">
                                <ul class="tbpadding" id="topul">
                                    <li class="rline l" style="text-align: center;width: 18%;">
                                        <h3 style="display: inline-block;float: none;">北京快乐8</h3>
                                    </li>
                                    <li class="l column-7" id="resultnum" style="width: calc(81% - 10px);">
                                        <h3 id="prevGameNo"><?=$result['qishu']?></h3><h3>期</h3>
                                        <p class="numresult kl8" style="margin-left: 15px;">
                                            <?php for($i=1;$i<21;$i++){ ?>
                                                <span id="result<?=$i?>" style="float:left;margin-top: 1px;" class="number num<?=isset($result['ball_'.$i.''])?$result['ball_'.$i.'']:1?>"></span>
                                            <?php } ?>
                                        </p>
                                    </li>
                                </ul>
                                <ul id="Ul1">
                                    <li class="rline l" style="text-align: center;width: 18%;">
                                        <h3><strong class="green" id="currGameNo"></strong>&nbsp;期&nbsp;<strong class="lan" id="panname">选一</strong>
                                        </h3>
                                    </li>
                                    <li class="l column-7" style="width: 81%;"><span class="ml10">距离封盘：<b class="red" id="freezeTime">00:00</b></span>
                                        <span class="ml10">距离开奖：<b class="red" id="dealingTime">00:00</b></span>
                                    </li>
                                </ul>
                            </div>
                            <div id="html_area">
                                <!--快捷下注-->
                                <div class="mbtop">
                                    <ul class="l chiplist">
                                        <li class="c50" onclick="set_money(50)"></li>
                                        <li class="c100" onclick="set_money(100)"></li>
                                        <li class="c500" onclick="set_money(500)"></li>
                                        <li class="c1000" onclick="set_money(1000)"></li>
                                        <li class="c5000" onclick="set_money(5000)"></li>
                                        <li class="c10000" onclick="set_money(10000)"></li>
                                    </ul>
                                    <ul class="r betting-form">
                                        <li>金额</li>
                                        <li>
                                            <input name="" type="text" class="input-text width-s1" id="kuaijiexiazhu_input" onkeyup = "digitOnly(this)" oninput="on_input(this)" onpropertychange="on_input(this)" maxlength="9" size="9"></li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定" id="submit_top">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消" id="reset_top" onclick="cq_cancel()">
                                        </li>
                                    </ul>
                                </div>
                                <!--选一-->
                                <div class="zhongleitab" style="display: block;">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                                <?php
                                                for($i=1;$i<81;$i++) {
                                                if ($i == 1 || $i == 17 || $i == 33 || $i == 49 || $i == 65) {
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <th width="30%">号</th>
                                                            <th width="30%">赔率</th>
                                                            <th width="40%" class="amount">金额</th>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr class="bet-item kl8">
                                                        <td class="fontBlue" width="30%"><span class="number num<?= $i ?>"></span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_1_h<?= $i ?>" width="30%"><?= $oddslist['ball'][1][1] ?></td>
                                                        <td class="amount ball_1_t<?= $i ?>" width="40%">
                                                            <input name="ball_1_<?= $i ?>" id="ball_1_<?= $i ?>" class="ball_1_<?= $i ?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                <?php if ($i == 16 || $i == 32 || $i == 48 || $i == 64 || $i == 80) { ?>
                                                    </table>
                                                </td>
                                                <?php }} ?>
                                            </tr>
                                            <tr>
                                                <td>赔率提示:</td>
                                                <td colspan="11"><font color="#000">选一中一赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][1][1]?></b></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--选二-->
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                                <?php
                                                for($i=1;$i<81;$i++) {
                                                if ($i == 1 || $i == 17 || $i == 33 || $i == 49 || $i == 65) {
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr class="bet-item kl8">
                                                        <td class="fontBlue" width="30%"><span class="number num<?= $i ?>"></span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_2_h<?= $i ?>" width="30%"><?= $oddslist['ball'][2][1] ?></td>
                                                        <td class="amount ball_2_t<?= $i ?>" width="40%">
                                                            <input name="ball_2_<?= $i ?>" class="ball_2_<?= $i ?> inp1" type="checkbox">
                                                        </td>
                                                    </tr>
                                                <?php if ($i == 16 || $i == 32 || $i == 48 || $i == 64 || $i == 80) { ?>
                                                    </table>
                                                </td>
                                            <?php }} ?>
                                            </tr>
                                            <tr>
                                                <td>赔率提示:</td>
                                                <td colspan="11"><font color="#000">选二中二赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][2][1]?></b></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--选三-->
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                                <?php
                                                for($i=1;$i<81;$i++) {
                                                if ($i == 1 || $i == 17 || $i == 33 || $i == 49 || $i == 65) {
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr class="bet-item kl8">
                                                        <td class="fontBlue" width="30%"><span class="number num<?= $i ?>"></span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_3_h<?= $i ?>" width="30%"><?= $oddslist['ball'][3][1] ?></td>
                                                        <td class="amount ball_3_t<?= $i ?>" width="40%">
                                                            <input name="ball_3_<?= $i ?>" class="ball_3_<?= $i ?> inp1" type="checkbox">
                                                        </td>
                                                    </tr>
                                                <?php if ($i == 16 || $i == 32 || $i == 48 || $i == 64 || $i == 80) { ?>
                                                    </table>
                                                </td>
                                            <?php }}?>
                                            </tr>
                                            <tr>
                                                <td>赔率提示:</td>
                                                <td colspan="11">
                                                    <font color="#000">选三中二赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][3][2]?>;</b></font>
                                                    <font color="#000">选三中三赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][3][1]?>;</b></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--选四-->
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                            <?php
                                            for($i=1;$i<81;$i++) {
                                            if ($i == 1 || $i == 17 || $i == 33 || $i == 49 || $i == 65) {
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr class="bet-item kl8">
                                                        <td class="fontBlue" width="30%"><span class="number num<?= $i ?>"></span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_4_h<?= $i ?>" width="30%"><?= $oddslist['ball'][4][1] ?></td>
                                                        <td class="amount ball_4_t<?= $i ?>" width="40%">
                                                            <input name="ball_4_<?= $i ?>" class="ball_4_<?= $i ?> inp1" type="checkbox">
                                                        </td>
                                                    </tr>
                                                    <?php if ($i == 16 || $i == 32 || $i == 48 || $i == 64 || $i == 80) { ?>
                                                    </table>
                                                </td>
                                            <?php }} ?>
                                            </tr>
                                            <tr>
                                                <td>赔率提示:</td>
                                                <td colspan="11">
                                                    <font color="#000">选四中二赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][4][3]?>;</b></font>
                                                    <font color="#000">选四中三赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][4][2]?>;</b></font>
                                                    <font color="#000">选四中四赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][4][1]?>;</b></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--选五-->
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                                <?php
                                                for($i=1;$i<81;$i++) {
                                                if ($i == 1 || $i == 17 || $i == 33 || $i == 49 || $i == 65) {
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    </thead>
                                                    <?php } ?>
                                                <tr class="bet-item kl8">
                                                    <td class="fontBlue" width="30%"><span class="number num<?=$i?>"></span></td>
                                                    <td style="color: red;" class="td_cmn bet_odds ball_5_h<?=$i?>" width="30%" ><?=$oddslist['ball'][5][1]?></td>
                                                    <td class="amount ball_5_t<?=$i?>" width="40%"><input name="ball_5_<?=$i?>" id="ball_5_<?=$i?>" class="ball_5_<?=$i?> inp1" type="checkbox"></td>
                                                </tr>
                                                <?php if ($i == 16 || $i == 32 || $i == 48 || $i == 64 || $i == 80) { ?>
                                                    </table>
                                                </td>
                                                <?php }} ?>
                                            </tr>
                                            <tr>
                                                <td>赔率提示:</td>
                                                <td colspan="11">
                                                    <font color="#000">选五中三赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][5][3]?>;</b></font>
                                                    <font color="#000">选五中四赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][5][2]?>;</b></font>
                                                    <font color="#000">选五中五赔率为:</font>
                                                    <font color="red"><b><?=$oddslist['ball'][5][1]?>;</b></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--和值-->
                                <div class="zhongleitab">
                                    <table class="t1 w100 bettable touzhuArea">
                                        <tbody>
                                        <tr>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">总和 大</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h1" beton="TOTAL" bettype="BIG"><?= $oddslist['ball'][6][1]?></td>
                                                        <td class="amount ball_6_t1">
                                                            <input name="ball_6_1" id="ball_6_1" class="ball_6_1 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue" title="和">总和 810</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h5" beton="D_T_T" bettype="TIE"><?= $oddslist['ball'][6][5]?></td>
                                                        <td class="amount ball_6_t5">
                                                            <input name="ball_6_5" id="ball_6_5" class="ball_6_5 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">总和 小</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h2" beton="TOTAL" bettype="SMALL"><?= $oddslist['ball'][6][2]?></td>
                                                        <td class="amount ball_6_t2">
                                                            <input name="ball_6_2" id="ball_6_2" class="ball_6_2 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="amount">&nbsp;</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">总和 单</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h3" beton="TOTAL" bettype="ODD"><?= $oddslist['ball'][6][3]?></td>
                                                        <td class="amount ball_6_t3">
                                                            <input name="ball_6_3" id="ball_6_3" class="ball_6_3 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="amount">&nbsp;</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">总和 双</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h4" beton="TOTAL" bettype="EVEN"><?= $oddslist['ball'][6][4]?></td>
                                                        <td class="amount ball_6_t4">
                                                            <input name="ball_6_4" id="ball_6_4" class="ball_6_4 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="amount">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--上中下-->
                                <div class="zhongleitab">
                                    <table class="t1 w100 bettable touzhuArea">
                                        <tbody>
                                        <tr>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">上盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_7_h1" beton="TOTAL" bettype="BIG"><?= $oddslist['ball'][7][1]?></td>
                                                        <td class="amount ball_7_t1">
                                                            <input name="ball_7_1" id="ball_7_1" class="ball_7_1 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">中盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_7_h2" beton="TOTAL" bettype="SMALL"><?= $oddslist['ball'][7][2]?></td>
                                                        <td class="amount ball_7_t2">
                                                            <input name="ball_7_2" id="ball_7_2" class="ball_7_2 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">下盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_7_h3" beton="TOTAL" bettype="ODD"><?= $oddslist['ball'][7][3]?></td>
                                                        <td class="amount ball_7_t3">
                                                            <input name="ball_7_3" id="ball_7_3" class="ball_7_3 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--奇和偶-->
                                <div class="zhongleitab">
                                    <table class="t1 w100 bettable touzhuArea">
                                        <tbody>
                                        <tr>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">奇盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_8_h1" beton="TOTAL" bettype="BIG"><?= $oddslist['ball'][8][1]?></td>
                                                        <td class="amount ball_8_t1">
                                                            <input name="ball_8_1" id="ball_8_1" class="ball_8_1 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">和盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_8_h2" beton="TOTAL" bettype="SMALL"><?= $oddslist['ball'][8][2]?></td>
                                                        <td class="amount ball_8_t2">
                                                            <input name="ball_8_2" id="ball_8_2" class="ball_8_2 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">偶盘</td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_8_h3" beton="TOTAL" bettype="ODD"><?= $oddslist['ball'][8][3]?></td>
                                                        <td class="amount ball_8_t3">
                                                            <input name="ball_8_3" id="ball_8_3" class="ball_8_3 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--快捷下注-->
                                <div class="mbtop">
                                    <ul class="l chiplist">
                                        <li class="c50" onclick="set_money(50)"></li>
                                        <li class="c100" onclick="set_money(100)"></li>
                                        <li class="c500" onclick="set_money(500)"></li>
                                        <li class="c1000" onclick="set_money(1000)"></li>
                                        <li class="c5000" onclick="set_money(5000)"></li>
                                        <li class="c10000" onclick="set_money(10000)"></li>
                                    </ul>
                                    <ul class="r betting-form">
                                        <li>金额</li>
                                        <li>
                                            <input name="" type="text" class="input-text width-s1" id="Text1" onkeyup="digitOnly(this)" oninput="text_val(this)" maxlength="9" size="9"></li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定" id="Button1">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消" id="Button2">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- 露珠图 -->
                            <div id="html_road">
                                <div class="odds-p" id="ballqueue">
                                    <div class="luzhuct" style="display: block;">
                                        <!--选一露珠图-->
                                        <div class="ballqueue-module paihang">
                                            <table class="bq-tb result-tab w100 t1 dataArea qiehuanluzhu">
                                                <tr>
                                                    <th class="bq-title paihang-ball kon" id="bjkl8_count_isbig">总和大小</th>
                                                    <th class="bq-title" id="bjkl8_count_issingle">总和单双</th>
                                                </tr>
                                            </table>
                                            <table class="luziTable t1 t-td-w4 align-c luzhusan" id = "lz_disp" style="display: block;">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
