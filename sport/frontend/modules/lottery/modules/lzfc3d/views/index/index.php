<script src="/public/luzhu/js/fc3d.js"></script>
<div id="html_content">
    <div id="layout" class="container">
        <!--彩种分类-->
        <div class="sub-nav bline" id="integrate-nav">
            <div class="ssc-small-nav ssc qiulei pdlf150">
                <a class="on" href="javascript:void(0)" id="two_side">两面盘</a>
                <a href="javascript:void(0)" id="one_five">单球1~3</a>
                <a href="javascript:void(0)" id='first'>1~3球</a>
            </div>
        </div>
        <!-- 左边 -->
        <div class="sidebar">
            <!--两面长龙排行-->
            <div id="side_left" class="side_left">
                <div id="leftSwapBtn">
                    <ul>
                        <li class="jiaoyis" onclick="openUCWindow('/?r=member/lottery/lottery-one&time=<?=date('Y/m/d')?>&type=D3', '交易记录')">最近交易记录</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 右边 -->
        <div style="display: block;" class="main-content bet-content">
            <div class="mains_corll">
                <div id="rightLoader">
                    <div id="html_ctx">
                        <div class="betAreaBox ssc">
                            <div class="bet-results-box allline">
                                <ul class="tbpadding" id="topul">
                                    <li class="rline l column-9">
                                        <h3 style="padding-left:70px;">福彩3D</h3>
                                    </li>
                                    <li class="l column-7" id="resultnum">
                                        <h3 id="prevGameNo"><?=$result['qishu']?>
                                        </h3><h3>期</h3>
                                        <p class="numresult">
                                            <span id="result0" class="kick number num<?=$result['ball_1']?>"></span>
                                            <span id="result1" class="kick number num<?=$result['ball_2']?>"></span>
                                            <span id="result2" class="kick number num<?=$result['ball_3']?>"></span>
                                        </p>
                                    </li>
                                </ul>
                                <ul id="Ul1">
                                    <li class="rline l column-9">
                                        <h3><strong class="green" id="currGameNo"></strong>&nbsp;期&nbsp;<strong class="lan" id="panname">两面盘</strong></h3>
                                    </li>
                                    <li class="l column-7">
                                        <span class="ml10">距离封盘：<b class="red" id="freezeTime">00:00</b></span>
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
                                            <input name="" type="text" class="input-text width-s1" id="kuaijiexiazhu_input" onkeyup = "digitOnly(this)" oninput="on_input(this)" onpropertychange="on_input(this)" maxlength="9" size="9">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定" id="submit_top">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消" id="reset_top">
                                        </li>
                                    </ul>
                                </div>
                                <!--两面盘-->
                                <div class="zhongleitab" style="display: block;">
                                    <table class="bettable san-list t1 w100 touzhuArea" cellpadding="0" cellspacing="0">
                                        <?php
                                        $ball = ['第一球','第二球','第三球'];
                                        foreach($ball as $key => $val){
                                        ?>
                                            <tr>
                                                <th colspan="4"><?=$val?></th>
                                            </tr>
                                            <tr>
                                                <?php
                                                $BallType = ['大','小','单','双'];
                                                $Num = 11;
                                                foreach($BallType as $key2 => $val2){
                                                ?>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="t1 w100 bettable" style="border: 0px;">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><?=$val2?></td>
                                                            <td style="color:red;" class="td_cmn bet_odds ball_<?=$key+1?>_h<?=$Num?>">
                                                                <?=$oddslist['ball'][$key+1][$Num]?>
                                                            </td>
                                                            <td class="amount ball_<?=$key+1?>_t<?=$Num?>">
                                                                <input name="ball_<?=$key+1?>_<?=$Num?>" class="ball_<?=$key+1?>_<?=$Num?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php $Num++; } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <br>
                                    <!--3连-->
                                    <div class="sanlian">
                                        <table class="bettable qiansan san-list t1 w100 touzhuArea">
                                            <tr>
                                                <th colspan="15">3连</th>
                                                <tbody class="qiansan san-list">
                                                <tr>
                                                    <?php
                                                    $SanLian = ['豹子','顺子','对子','半顺','杂六'];
                                                    foreach($SanLian as $san => $val3){
                                                    ?>
                                                    <td width="20%" style="border: 0px;">
                                                        <table style="width: 100%;">
                                                            <tr class="bet-item">
                                                                <td class="fontBlue"><?=$val3?></td>
                                                                <td style="color: red;" class="td_cmn bet_odds ball_5_h<?=$san+1?>">
                                                                    <?=$oddslist['ball'][5][$san+1]?>
                                                                </td>
                                                                <td class="amount ball_5_t<?=$san+1?>">
                                                                    <input name="ball_5_<?=$san+1?>" class="ball_5_<?=$san+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                </tbody>
                                        </table>
                                    </div>
                                    <!--跨度-->
                                    <div class="kuadu">
                                        <table class="bettable qiansan san-list t1 w100 touzhuArea">
                                            <tr>
                                                <th colspan="15">跨度</th>
                                            </tr>
                                            <tbody class="qiansan san-list">
                                            <tr>
                                                <?php for($k=0;$k<10;$k++){ ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><span class="number num<?=$k?>"></span></td>
                                                            <td style="color: red;" class="td_cmn bet_odds ball_6_h<?=$k+1?>">
                                                                <?=$oddslist['ball'][6][$k+1]?>
                                                            </td>
                                                            <td class="amount ball_6_t<?=$k+1?>">
                                                                <input name="ball_6_<?=$k+1?>" class="ball_6_<?=$k+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php if($k==4){ ?>
                                            </tr>
                                            <tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <table class="w100 touzhuArea">
                                        <tr>
                                            <?php
                                            $ZongHe = ['总和 大','总和 小','总和 单','总和 双','龙','虎','和'];
                                            foreach($ZongHe as $zong => $val4){
                                            ?>
                                            <td width="25%" style="border: 0px;">
                                                <table class="t1 w100 bettable">
                                                    <tr class="bet-item">
                                                        <td class="fontBlue"><?=$val4?></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_4_h<?=$zong+1?>">
                                                            <?=$oddslist['ball'][4][$zong+1]?>
                                                        </td>
                                                        <td class="amount ball_4_t<?=$zong+1?>">
                                                            <input name="ball_4_<?=$zong+1?>" class="ball_4_<?=$zong+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php if($zong == 3){ ?>
                                        </tr>
                                        <tr>
                                        <?php }} ?>
                                        </tr>
                                    </table>
                                </div>
                                <!--单球1~3-->
                                <div class="zhongleitab">
                                    <div class="common betArea touzhuArea">
                                        <div class="ssctouzhuArea">
                                            <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                                <tr>
                                                    <?php foreach($ball as $dq => $val5){ ?>
                                                    <td width="20%" style="border: 0px;">
                                                        <table style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="3"><?=$val5?></th>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">号</th>
                                                                <th width="30%">赔率</th>
                                                                <th width="40%" class="amount">金额</th>
                                                            </tr>
                                                            </thead>
                                                            <?php for($d=0;$d<10;$d++){ ?>
                                                            <tr class="bet-item">
                                                                <td class="fontBlue" width="30%"><span class="number num<?=$d?>"></span></td>
                                                                <td style="color: red;" class="td_cmn bet_odds ball_<?=$dq+1?>_h<?=$d+1?>">
                                                                    <?=$oddslist['ball'][$dq+1][$d+1]?>
                                                                </td>
                                                                <td class="amount ball_<?=$dq+1?>_t<?=$d+1?>">
                                                                    <input name="ball_<?=$dq+1?>_<?=$d+1?>" class="ball_<?=$dq+1?>_<?=$d+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--1~3球-->
                                <div class="zhongleitab">
                                    <?php foreach($ball as $one => $val6) { ?>
                                        <div class="ssctouzhuArea">
                                            <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                                <tr>
                                                    <th colspan="15"><?=$val6?></th>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $ball_title = ['0','1','2','3','4','5','6','7','8','9','大','小','单','双',''];
                                                    foreach($ball_title as $title => $val7) {
                                                    if($title==0||$title==3||$title==6||$title==9||$title==12) {
                                                    ?>
                                                    <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    <?php }if($title==14) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="amount"></td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue" width="30%">
                                                            <?php if($title<10) { ?>
                                                            <span class="number num<?= $title ?>"></span>
                                                            <?php }else { ?>
                                                            <?=$val7?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_<?=$one+1?>_h1" width="30%" beton="BALL" bettype="NO_0"><?=$oddslist['ball'][$one+1][$title+1]?></td>
                                                        <td class="amount ball_<?=$one+1?>_t<?=$title+1?>" width="40%">
                                                            <input name="ball_<?=$one+1?>_<?=$title+1?>" class="ball_<?=$one+1?>_<?=$title+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <?php }if($title==2||$title==5||$title==8||$title==11||$title==14){ ?>
                                                    </table>
                                                    </td>
                                                    <?php }} ?>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php } ?>
                                    <!--总和大 总和小-->
                                    <div class="klctouzhuArea">
                                        <table class="w100 touzhuArea">
                                            <tr>
                                                <?php
                                                $ZongHe = ['总和 大','总和 小','总和 单','总和 双','龙','虎','和'];
                                                foreach($ZongHe as $zong => $val4){
                                                ?>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="t1 w100 bettable">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><?=$val4?></td>
                                                            <td style="color: red;" class="td_cmn bet_odds ball_4_h<?=$zong+1?>">
                                                                <?=$oddslist['ball'][4][$zong+1]?>
                                                            </td>
                                                            <td class="amount ball_4_t<?=$zong+1?>">
                                                                <input name="ball_4_<?=$zong+1?>" class="ball_4_<?=$zong+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php if($zong == 3){ ?>
                                            </tr>
                                            <tr>
                                                <?php }}?>
                                            </tr>
                                        </table>
                                    </div>
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
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定" id="Button1">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消" id="Button2">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>