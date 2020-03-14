<script src="/public/luzhu/js/cqssc.js"></script>
<div id="html_content">
    <div id="layout" class="container">
        <!--彩种分类-->
        <div class="sub-nav bline" id="integrate-nav">
            <div class="ssc-small-nav ssc qiulei">
                <a class="on" href="javascript:void(0)" id="two_side">两面盘</a>
                <a href="javascript:void(0)" id="one_five">单球1~5</a>
                <a href="javascript:void(0)" id='first'>第一球</a>
                <a href="javascript:void(0)" id='second'>第二球</a>
                <a href="javascript:void(0)" id='thirdly'>第三球</a>
                <a href="javascript:void(0)" id='fourthly'>第四球</a>
                <a href="javascript:void(0)" id='fifth'>第五球</a>
                  <a href="javascript:void(0)">牛牛</a>
            </div>
        </div>
        <!-- 左边 -->
        <div class="sidebar">
            <!--两面长龙排行-->
            <div id="side_left" class="side_left">
                <div id="leftSwapBtn">
                    <ul>
                        <li class="on changlong">两面长龙排行</li>
                        <li class="zuijin" onclick="openUCWindow('/?r=member/lottery/lottery-one&time=<?=date('Y/m/d')?>&type=CQ', '交易记录')">最近交易记录</li>
                    </ul>
                </div>

                <div class="changlongbox liangmianlong" style="display: block;">
                    <table style="" class="bet-table changlong-table dataArea w100">
                        <tbody id="changlong"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- 右边 -->
        <div class="main-content bet-content">
            <div class="mains_corll">
                <div id="rightLoader">
                    <div id="html_ctx">
                        <div class="betAreaBox ssc">
                            <div class="bet-results-box allline">
                                <ul class="tbpadding" id="topul">
                                    <li class="rline l column-9">
                                        <h3 style="padding-left:70px;">重庆时时彩</h3>
                                    </li>
                                    <li class="l column-7" id="resultnum">
                                        <h3 id="prevGameNo"><?=$result['qishu']?></h3>
                                        <h3>期</h3>
                                        <p class="numresult">
                                            <span id="result0" class="kick number num<?=$result['ball_1']?>"></span>
                                            <span id="result1" class="kick number num<?=$result['ball_2']?>"></span>
                                            <span id="result2" class="kick number num<?=$result['ball_3']?>"></span>
                                            <span id="result3" class="kick number num<?=$result['ball_4']?>"></span>
                                            <span id="result4" class="kick number num<?=$result['ball_5']?>"></span>
                                        </p>
                                    </li>
                                </ul>
                                <ul id="Ul1">
                                    <li class="rline l column-9">
                                        <h3><strong class="green" id="currGameNo"></strong>&nbsp;期&nbsp;<strong class="lan" id="panname">两面盘</strong></h3>
                                    </li>
                                    <li>
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
                                            <input name="" type="text" class="input-text width-s1" id="kuaijiexiazhu_input" onkeyup = "digitOnly(this)" oninput="on_input(this)" onpropertychange="on_input(this)" maxlength="9" size="9"></li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order()" value="确 定" id="submit_top"></li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" value="取 消" onclick="cq_cancel()"></li>
                                    </ul>
                                </div>
                                <!--两面盘-->
                                <div class="zhongleitab" style="display: block;">
                                    <table class="bettable san-list t1 w100 touzhuArea" cellpadding="0" cellspacing="0">
                                        <?php
                                        $ball = ['第一球','第二球','第三球','第四球','第五球'];
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
                                                    <table class="t1 w100 bettable">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><?=$val2?></td>
                                                            <td style="color:red;" class="td_cmn bet_odds ball_<?=$key+1?>_h<?=$Num?>">
                                                                <?=$oddslist['ball'][$key+1][$Num]?>
                                                            </td>
                                                            <td class="amount ball_<?=$key+1?>_t<?=$Num?>">
                                                                <input name="ball_<?=$key+1?>_<?=$Num?>" class="ball_<?=$key+1?>_<?=$Num?> amount-input" style="background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php $Num++; } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
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
                                                        <td style="color: red;" class="td_cmn bet_odds ball_6_h<?=$zong+1?>">
                                                            <?=$oddslist['ball'][6][$zong+1]?>
                                                        </td>
                                                        <td class="amount ball_6_t<?=$zong+1?>">
                                                            <input name="ball_6_<?=$zong+1?>" class="ball_6_<?=$zong+1?> amount-input" style="background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
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
                                <!--单球1~5-->
                                <div class="zhongleitab">
                                    <div class="common betArea touzhuArea">
                                        <div class="ssctouzhuArea">
                                            <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                                <tr>
                                                    <?php foreach($ball as $dq => $val5){ ?>
                                                    <td width="20%" style="border: 0px;">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <th colspan="3"><?=$val5?></th>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">号</th>
                                                                <th width="30%">赔率</th>
                                                                <th width="40%" class="amount">金额</th>
                                                            </tr>
                                                            <?php for($d=0;$d<10;$d++){ ?>
                                                            <tr class="bet-item">
                                                                <td class="fontBlue" width="30%"><span class="number num<?=$d?>"></span></td>
                                                                <td style="color: red;" class="td_cmn bet_odds ball_<?=$dq+1?>_h<?=$d+1?>">
                                                                    <?=$oddslist['ball'][$dq+1][$d+1]?>
                                                                </td>
                                                                <td class="amount ball_<?=$dq+1?>_t<?=$d+1?>">
                                                                    <input name="ball_<?=$dq+1?>_<?=$d+1?>" class="ball_<?=$dq+1?>_<?=$d+1?> amount-input" style="background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
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
                                <!--第一球 - 第五球-->
                                <?php foreach ($ball as $key => $val){ ?>
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea">
                                        <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                            <tr>
                                            <?php
                                            $ball_title = ['0','1','2','3','4','5','6','7','8','9','大','小','单','双',''];
                                            foreach($ball_title as $title => $val1) {
                                                if($title==0||$title==3||$title==6||$title==9||$title==12) {
                                            ?>
                                            <td width="20%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <th width="30%">号</th>
                                                        <th width="30%">赔率</th>
                                                        <th width="40%" class="amount">金额</th>
                                                    </tr>
                                                    <?php } if($title==14) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue" width="30%">
                                                            <?php if($title<10) { ?>
                                                            <span class="number num<?= $title ?>"></span>
                                                            <?php } else { ?>
                                                                <?=$val1?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_<?=$key+1?>_h1" width="30%"><?=$oddslist['ball'][$key+1][$title+1]?></td>
                                                        <td class="amount ball_<?=$key+1?>_t<?=$title+1?>" width="40%">
                                                            <input name="ball_<?=$key+1?>_<?=$title+1?>" class="ball_<?=$key+1?>_<?=$title+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5"></td>
                                                    </tr>
                                                    <?php } if($title==2||$title==5||$title==8||$title==11||$title==14){ ?>
                                                </table>
                                            </td>
                                            <?php }} ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="ssctouzhuArea">
                                        <table class="w100 touzhuArea">
                                            <tr>
                                                <?php
                                                $ZongHe = ['总和 大','总和 小','总和 单','总和 双','龙','虎','和'];
                                                foreach($ZongHe as $zong => $val2){
                                                ?>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="t1 w100 bettable">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><?=$val2?></td>
                                                            <td style="color: red;" class="td_cmn bet_odds ball_6_h<?=$zong+1?>">
                                                                <?=$oddslist['ball'][6][$zong+1]?>
                                                            </td>
                                                            <td class="amount ball_6_t<?=$zong+1?>">
                                                                <input name="ball_6_<?=$zong+1?>" class="ball_6_<?=$zong+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
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
                                    <?php
                                    $FirstToThird = ['前三','中三','后三'];
                                    foreach ($FirstToThird as $key3 => $val3){
                                    ?>
                                    <div class="ssctouzhuArea">
                                        <table class="bettable qiansan san-list t1 w100 touzhuArea">
                                            <tr>
                                                <th colspan="15"><?=$val3?></th>
                                            </tr>
                                            <tbody class="qiansan san-list">
                                            <tr>
                                            <?php
                                            $BallType = ['豹子','顺子','对子','半顺','杂六'];
                                            foreach ($BallType as $key4 =>$val4){
                                            ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 100%;">
                                                        <tr class="bet-item">
                                                            <td class="fontBlue"><?=$val4?></td>
                                                            <td style="color: red;" class="td_cmn bet_odds ball_<?=$key3+7?>_h1"><?=$oddslist['ball'][$key3+7][$key4+1]?></td>
                                                            <td class="amount ball_<?=$key3+7?>_t<?=$key4+1?>">
                                                                <input name="ball_<?=$key3+7?>_<?=$key4+1?>" class="ball_<?=$key3+7?>_<?=$key4+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            <?php } ?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <!--牛牛-->
                                <div class="zhongleitab">
                                    <table class="bettable qiansan san-list t1 w100 touzhuArea">
                                        <tbody class="qiansan san-list">
                                            <tr>
                                                <?php
                                                $NiuNiu = ['无牛','牛1','牛2','牛3','牛4','牛5','牛6','牛7','牛8','牛9','牛牛','牛大','牛小','牛单','牛双'];
                                                foreach ($NiuNiu as $key5 => $val5){
                                                ?>
                                                <td width="20%" style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <tr class="bet-item">
                                                        <td class="fontBlue "><?=$val5?></td>
                                                        <td style="color: red;" class="td_cmn bet_odds bian_td_odds" id="ball_10_h<?=$key5+1?>"><?=$oddslist['ball'][10][$key5+1]?></td>
                                                        <td class="amount ball_10_t<?=$key5+1?>">
                                                            <input name="ball_10_<?=$key5+1?>" class="ball_10_<?=$key5+1?> amount-input" style="background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                </table>
                                                </td>
                                                <?php if($key5 == 4 || $key5 == 9){ ?>
                                            </tr>
                                            <tr>
                                               <?php }} ?>
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
                                            <input name="" type="text" class="input-text width-s1" id="Text1"  oninput="text_val(this)" maxlength="9" size="9"></li>
                                        <li>
                                            <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定">
                                        </li>
                                        <li>
                                            <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                <!-- 露珠图 -->
                    <div id="html_road">
                        <div class="odds-p" id="ballqueue">
                            <div class="luzhuct" style="display: block;">
                             <!--两面盘露珠图-->
                                <div class="ballqueue-module paihang">
                                    <table class="bq-tb result-tab w100 t1 dataArea qiehuanluzhu">
                                        <tr id='count_ball'>
                                            <th class="bq-title paihang-ball kon" id="count_isbig">总和大小</th>
                                            <th class="bq-title" id="count_issingle">总和单双</th>
                                            <th class="td-last bq-title" id="longhu">龙虎和</th>
                                        </tr>
                                        <tr id='which_ball' style="display:none;">
                                            <th class="bq-title paihang-ball kon" id="ball_isbig">大小</th>
                                            <th class="bq-title" id="ball_longhu">开奖结果</th>
                                            <th class="td-last bq-title" id="ball_issingle">单双</th>
                                        </tr>
                                    </table>
                                    <table class="luziTable t1 t-td-w4 align-c luzhusan" id = "lz_disp" style="display: block;"></table>
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