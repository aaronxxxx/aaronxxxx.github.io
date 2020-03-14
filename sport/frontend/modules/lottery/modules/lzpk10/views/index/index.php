<script src="/public/luzhu/js/pk10.js"></script>
<div id="html_content">
    <div id="layout" class="container">
        <!--彩种分类-->
        <div class="sub-nav bline" id="integrate-nav">
            <div class="ssc-small-nav ssc qiulei">
                <a class="on" href="javascript:void(0)">两面盘</a>
                <a href="javascript:void(0)">排名1~10</a>  
                <a href="javascript:void(0)">冠、亚军 组合</a>
                <a href="javascript:void(0)">三、四、五、六名</a>
                <a href="javascript:void(0)">七、八、九、十名</a>
                <a href="javascript:void(0)">pk龙虎</a>
            </div>
        </div>
        <!-- 左边 -->
        <div class="sidebar">
            <!--两面长龙排行-->
            <div id="side_left" class="side_left">
                <div id="leftSwapBtn">
                    <ul>
                        <li class="on changlong">两面长龙排行</li>
                        <li class="zuijin" onclick="openUCWindow('/?r=member/lottery/lottery-one&time=<?=date('Y/m/d')?>&type=BJPK', '交易记录')">最近交易记录</li>
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
                            <div class="bet-results-box allline">
                                <ul class="tbpadding" id="topul">
                                    <li class="rline l column-9">
                                        <h3 style="padding-left:70px;">北京赛车(PK10)</h3>
                                    </li>
                                    <li class="l column-7 pk10" id="resultnum" gametype="BJC">
                                        <h3 id="prevGameNo"><?=$result['qishu']?></h3><h3>期</h3>
                                        <p class="numresult">
                                            <span id="result0" class="kick number num<?=$result['ball_1']?>"></span>
                                            <span id="result1" class="kick number num<?=$result['ball_2']?>"></span>
                                            <span id="result2" class="kick number num<?=$result['ball_3']?>"></span>
                                            <span id="result3" class="kick number num<?=$result['ball_4']?>"></span>
                                            <span id="result4" class="kick number num<?=$result['ball_5']?>"></span>
                                            <span id="result5" class="kick number num<?=$result['ball_6']?>"></span>
                                            <span id="result6" class="kick number num<?=$result['ball_7']?>"></span>
                                            <span id="result7" class="kick number num<?=$result['ball_8']?>"></span>
                                            <span id="result8" class="kick number num<?=$result['ball_9']?>"></span>
                                            <span id="result9" class="kick number num<?=$result['ball_10']?>"></span>
                                        </p>
                                    </li>
                                </ul>
                                <ul id="Ul1">
                                    <li class="rline l column-9">
                                        <h3>
                                            <strong class="green" id="currGameNo"></strong>&nbsp;期&nbsp;<strong class="lan" id="panname">两面盘</strong>
                                        </h3>
                                    </li>
                                    <li class="l column-7"><span class="ml10">距离封盘：<b class="red" id="freezeTime">00:00</b></span>&nbsp;&nbsp;&nbsp;
                                        <span class="ml10">距离开奖：<b class="red" id="dealingTime">00:00</b></span>&nbsp;&nbsp;&nbsp;
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
                                    <div class="pktouzhuArea">
                                        <table class="w100 t1 touzhuArea">
                                            <tr>
                                                <td width="25%" style="border: 0px;" valign="top">
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>冠军</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td width="25%" style="border: 0px;">
                                                                <table class="w100">
                                                                <?php
                                                                $DXDSLH = ['大','小','单','双','龙','虎'];
                                                                foreach($DXDSLH as $key6 => $val6){
                                                                ?>
                                                                <tr class="bet-item">
                                                                    <td class="fontBlue"><?=$val6?></td>
                                                                    <td class="td_cmn bet_odds ball_1_h<?=$key6+11?>" style="color: red;" beton="BALL_1" bettype="BIG"><?= $oddslist['ball'][1][$key6+11]?></td>
                                                                    <td class="amount ball_1_t<?=$key6+11?>">
                                                                        <input name="ball_1_<?=$key6+11?>" class="ball_1_<?=$key6+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第五名</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td width="25%" style="border: 0px;">
                                                                <table class="w100">
                                                                <?php
                                                                $DXDSLH = ['大','小','单','双','龙','虎'];
                                                                foreach($DXDSLH as $key6 => $val6){
                                                                ?>
                                                                <tr class="bet-item">
                                                                    <td class="fontBlue"><?=$val6?></td>
                                                                    <td class="td_cmn bet_odds ball_5_h<?=$key6+11?>" style="color: red;" ><?= $oddslist['ball'][5][$key6+11]?></td>
                                                                    <td class="amount ball_5_t<?=$key6+11?>">
                                                                        <input name="ball_5_<?=$key6+11?>" class="ball_5_<?=$key6+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>亚军</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td width="25%" style="border: 0px;">
                                                                <table class="w100">
                                                                <?php
                                                                $DXDSLH = ['大','小','单','双','龙','虎'];
                                                                foreach($DXDSLH as $key6 => $val6){
                                                                ?>
                                                                <tr class="bet-item">
                                                                    <td class="fontBlue"><?=$val6?></td>
                                                                    <td class="td_cmn bet_odds ball_2_h<?=$key6+11?>" style="color: red;" ><?= $oddslist['ball'][2][$key6+11]?></td>
                                                                    <td class="amount ball_2_t<?=$key6+11?>">
                                                                        <input name="ball_2_<?=$key6+11?>" class="ball_2_<?=$key6+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第六名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双'];
                                                                    foreach($DXDSLH as $key6 => $val6){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val6?></td>
                                                                        <td class="td_cmn bet_odds ball_6_h<?=$key6+11?>" style="color: red;" ><?= $oddslist['ball'][6][$key6+11]?></td>
                                                                        <td class="amount ball_6_t<?=$key6+11?>">
                                                                            <input name="ball_6_<?=$key6+11?>" class="ball_6_<?=$key6+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第九名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_9_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][9][$key+11]?></td>
                                                                        <td class="amount ball_9_t<?=$key+11?>">
                                                                            <input name="ball_9_<?=$key+11?>" class="ball_9_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第三名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双','龙','虎'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_3_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][3][$key+11]?></td>
                                                                        <td class="amount ball_3_t<?=$key+11?>">
                                                                            <input name="ball_3_<?=$key+11?>" class="ball_3_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第七名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_7_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][7][$key+11]?></td>
                                                                        <td class="amount ball_7_t<?=$key+11?>">
                                                                            <input name="ball_7_<?=$key+11?>" class="ball_7_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第十名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_10_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][10][$key+11]?></td>
                                                                        <td class="amount ball_10_t<?=$key+11?>">
                                                                            <input name="ball_10_<?=$key+11?>" class="ball_10_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="25%" style="border: 0px;">
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第四名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双','龙','虎'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_4_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][4][$key+11]?></td>
                                                                        <td class="amount ball_4_t<?=$key+11?>">
                                                                            <input name="ball_4_<?=$key+11?>" class="ball_4_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>第八名</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%" style="border: 0px;">
                                                                    <table class="w100">
                                                                    <?php
                                                                    $DXDSLH = ['大','小','单','双'];
                                                                    foreach($DXDSLH as $key => $val){
                                                                    ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue"><?=$val?></td>
                                                                        <td class="td_cmn bet_odds ball_8_h<?=$key+11?>" style="color: red;" ><?= $oddslist['ball'][8][$key+11]?></td>
                                                                        <td class="amount ball_8_t<?=$key+11?>">
                                                                            <input name="ball_8_<?=$key+11?>" class="ball_8_<?=$key+11?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w100 t1 touzhuArea">
                                                        <thead>
                                                            <tr>
                                                                <th>冠亚军和</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td width="25%" style="border: 0px;">
                                                                <table class="w100">
                                                                <?php
                                                                $GY = ['冠亚大','冠亚小','冠亚单','冠亚双'];
                                                                foreach($GY as $key => $val){
                                                                ?>
                                                                <tr class="bet-item">
                                                                    <td class="fontBlue"><?=$val?></td>
                                                                    <td class="td_cmn bet_odds ball_11_h<?=$key+18?>" style="color: red;" ><?= $oddslist['ball'][11][$key+18]?></td>
                                                                    <td class="amount ball_11_t<?=$key+18?>">
                                                                        <input name="ball_11_<?=$key+18?>" class="ball_11_<?=$key+18?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--排名1~10-->
                                <div class="zhongleitab">
                                    <div class="ssctouzhuArea pk10">
                                        <table class="struct_table ballno-tab touzhuArea w100 t1">
                                            <tr>
                                            <?php
                                            $OneToTen = ['冠军','亚军','第三名','第四名','第五名','第六名','第七名','第八名','第九名','第十名'];
                                            foreach ($OneToTen as $key =>$val){
                                            ?>
                                                <td width="20%" style="border: 0px;">
                                                    <table style="width: 99%;">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3"><?=$val?></th>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">号</th>
                                                                <th width="30%">赔率</th>
                                                                <th class="amount">金额</th>
                                                            </tr>
                                                        </thead>
                                                            <?php for($b=1;$b<11;$b++){ ?>
                                                            <tr class="bet-item">
                                                                <td class="fontBlue"><span class="number num<?=$b?>"></span></td>
                                                                <td class="td_cmn bet_odds ball_<?=$key+1?>_h<?=$b?>" style="color: red;" ><?=$oddslist['ball'][$key+1][$b]?></td>
                                                                <td class="amount ball_<?=$key+1?>_t<?=$b?>">
                                                                    <input name="ball_<?=$key+1?>_<?=$b?>" class="ball_<?=$key+1?>_<?=$b?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                    </table>
                                                </td>
                                            <?php if($key==4){ ?>
                                            </tr>
                                            <tr>
                                            <?php }} ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--冠、亚军 组合-->
                                <div class="zhongleitab">
                                    <table class="w100 t1 touzhuArea">
                                        <thead>
                                            <tr>
                                                <th colspan="4">冠、亚军和(冠军车号 + 亚军车号 = 和)</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                        <?php
                                        $GYH = ['3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','冠亚大','冠亚小','冠亚单','冠亚双','','',''];
                                        foreach ($GYH as $key => $val){
                                        if($key==0||$key==6||$key==12||$key==18){
                                        ?>
                                            <td width="25%" style="border: 0px;">
                                                <table style="width: 100%;">
                                        <?php }if($key < 21){ ?>
                                            <tr class="bet-item">
                                                <td width="30%" class="fontBlue"><?=$val?></td>
                                                <td class="td_cmn bet_odds" style="color: red;" width="30%"><?= $oddslist['ball'][11][$key+1]?></td>
                                                <td class="amount ball_11_t<?=$key+1?>" width="40%">
                                                    <input name="ball_11_<?=$key+1?>" class="ball_11_<?=$key+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                </td>
                                            </tr>
                                        <?php }else{ ?>
                                                <tr>
                                                    <td></td><td></td><td></td>
                                                </tr>
                                        <?php }if($key==5||$key==11||$key==17||$key==23){ ?>
                                                </table>
                                            </td>
                                        <?php }} ?>
                                        </tr>
                                    </table>
                                    <table class="t1 touzhuArea w100 pk10">
                                        <thead>
                                            <tr>
                                                <th colspan="4"><b>冠军</b></th>
                                            </tr>
                                        </thead>
                                            <tr>
                                            <?php
                                            $BallType = ['1','2','3','4','5','6','7','8','9','10','大','小','单','双','龙','虎'];
                                            foreach($BallType as $key1 => $val1){
                                            if ($key1 == 0 || $key1 == 4 || $key1 == 8 || $key1 == 12) {
                                            ?>
                                                <td class="w25" style="border: 0px">
                                                    <table class="w100">
                                            <?php } ?>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue">
                                                            <?php if($key1 < 10) { ?>
                                                            <span class="number num<?=$val1?>"></span>
                                                            <?php }else{ ?>
                                                            <?=$val1?>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="td_cmn bet_odds ball_1_h<?=$key1+1?>" style="color: red;"><?= $oddslist['ball'][1][$key1+1] ?></td>
                                                        <td class="amount ball_1_t<?=$key1+1?>">
                                                            <input name="ball_1_<?=$key1+1?>" class="ball_1_<?=$key1+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                            <?php if ($key1 == 3 || $key1 == 7 || $key1 == 11 || $key1 == 15) { ?>
                                                    </table>
                                                </td>
                                            <?php }} ?>
                                            </tr>
                                        <thead>
                                            <tr>
                                                <th colspan="4"><b>亚军</b></th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <?php
                                            $BallType = ['1','2','3','4','5','6','7','8','9','10','大','小','单','双','龙','虎'];
                                            foreach($BallType as $key1 => $val1){
                                            if ($key1 == 0 || $key1 == 4 || $key1 == 8 || $key1 == 12) {
                                            ?>
                                            <td class="w25" style="border: 0px">
                                                <table class="w100">
                                            <?php } ?>
                                                <tr class="bet-item">
                                                    <td class="fontBlue">
                                                        <?php if($key1 < 10) { ?>
                                                            <span class="number num<?=$val1?>"></span>
                                                        <?php }else{ ?>
                                                            <?=$val1?>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="td_cmn bet_odds ball_2_h<?=$key1+1?>" style="color: red;"><?= $oddslist['ball'][2][$key1+1] ?></td>
                                                    <td class="amount ball_2_t<?=$key1+1?>">
                                                        <input name="ball_2_<?=$key1+1?>" class="ball_2_<?=$key1+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                    </td>
                                                </tr>
                                            <?php if ($key1 == 3 || $key1 == 7 || $key1 == 11 || $key1 == 15) { ?>
                                                </table>
                                            </td>
                                            <?php }} ?>
                                        </tr>
                                    </table>
                                </div>
                                <!--三、四、五、六名-->
                                <div class="zhongleitab">
                                    <table class="w100 pk10">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="t1 touzhuArea w100">
                                                        <?php
                                                        $ThreeToFive = ['第三名','第四名','第五名'];
                                                        foreach ($ThreeToFive as $key3 => $val3){
                                                        ?>
                                                            <thead>
                                                            <tr>
                                                                <th colspan="4"><?=$val3?></th>
                                                            </tr>
                                                            </thead>
                                                            <tr>
                                                                <?php
                                                                $BallType = ['1','2','3','4','5','6','7','8','9','10','大','小','单','双','龙','虎'];
                                                                foreach($BallType as $key1 => $val1){
                                                                if ($key1 == 0 || $key1 == 4 || $key1 == 8 || $key1 == 12) {
                                                                ?>
                                                                <td class="w25" style="border: 0px">
                                                                    <table class="w100">
                                                                    <?php } ?>
                                                                        <tr class="bet-item">
                                                                            <td class="fontBlue">
                                                                                <?php if($key1 < 10) { ?>
                                                                                    <span class="number num<?=$val1?>"></span>
                                                                                <?php }else{ ?>
                                                                                    <?=$val1?>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td class="td_cmn bet_odds ball_<?=$key3+3?>_h<?=$key1+1?>" style="color: red;"><?= $oddslist['ball'][$key3+3][$key1+1] ?></td>
                                                                            <td class="amount ball_<?=$key3+3?>_t<?=$key1+1?>">
                                                                                <input name="ball_<?=$key3+3?>_<?=$key1+1?>" class="ball_<?=$key3+3?>_<?=$key1+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                            </td>
                                                                        </tr>
                                                                    <?php if ($key1 == 3 || $key1 == 7 || $key1 == 11 || $key1 == 15) { ?>
                                                                    </table>
                                                                </td>
                                                                <?php }} ?>
                                                            </tr>
                                                    <?php } ?>
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4">第六名</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                        <?php
                                                        $BallType = ['1','2','3','4','5','6','7','8','9','10','大','小','单','双','',''];
                                                        foreach($BallType as $key1 => $val1){
                                                        if ($key1 == 0 || $key1 == 4 || $key1 == 8 || $key1 == 12) {
                                                        ?>
                                                            <td class="w25" style="border: 0px">
                                                                <table class="w100">
                                                                <?php } ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue">
                                                                            <?php if($key1 < 10) { ?>
                                                                                <span class="number num<?=$val1?>"></span>
                                                                            <?php }else{ ?>
                                                                                <?=$val1?>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <?php if($key1 < 14) { ?>
                                                                            <td class="td_cmn bet_odds ball_6_h<?=$key1+1?>" style="color: red;"><?= $oddslist['ball'][6][$key1+1] ?></td>
                                                                            <td class="amount ball_6_t<?=$key1+1?>">
                                                                                <input name="ball_6_<?=$key1+1?>" class="ball_6_<?=$key1+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                            </td>
                                                                        <?php }else{ ?>
                                                                            <td></td><td></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php if ($key1 == 3 || $key1 == 7 || $key1 == 11 || $key1 == 15) { ?>
                                                                </table>
                                                            </td>
                                                        <?php }} ?>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--七、八、九、十名-->
                                <div class="zhongleitab">
                                    <table class="w100 pk10">
                                        <tr>
                                            <td>
                                                <table class="t1 touzhuArea w100">
                                                    <?php
                                                    $SevenToTen = ['第七名','第八名','第九名','第十名'];
                                                    foreach ($SevenToTen as $key4 => $val4){
                                                    ?>
                                                        <thead>
                                                        <tr>
                                                            <th colspan="4"><?=$val4?></th>
                                                        </tr>
                                                        </thead>
                                                        <tr>
                                                        <?php
                                                        $BallType = ['1','2','3','4','5','6','7','8','9','10','大','小','单','双','',''];
                                                        foreach($BallType as $key5 => $val5){
                                                        if ($key5 == 0 || $key5 == 4 || $key5 == 8 || $key5 == 12) {
                                                        ?>
                                                            <td class="w25" style="border: 0px">
                                                                <table class="w100">
                                                                <?php } ?>
                                                                    <tr class="bet-item">
                                                                        <td class="fontBlue">
                                                                            <?php if($key5 < 10) { ?>
                                                                                <span class="number num<?=$val5?>"></span>
                                                                            <?php }else{ ?>
                                                                                <?=$val5?>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <?php if($key5 < 14) { ?>
                                                                            <td class="td_cmn bet_odds ball_<?=$key4+7?>_h<?=$key5+1?>" style="color: red;"><?= $oddslist['ball'][$key4+7][$key5+1] ?></td>
                                                                            <td class="amount ball_<?=$key4+7?>_t<?=$key5+1?>">
                                                                                <input name="ball_<?=$key4+7?>_<?=$key5+1?>" class="ball_<?=$key4+7?>_<?=$key5+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                                            </td>
                                                                        <?php }else{ ?>
                                                                            <td></td><td></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php if ($key5 == 3 || $key5 == 7 || $key5 == 11 || $key5 == 15) { ?>
                                                                </table>
                                                            </td>
                                                        <?php }} ?>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--pk龙虎-->
                                <div class="zhongleitab">
                                    <table style="display: table;" class="t1 w100 bettable ball_sc_1 ball_sc touzhuArea">
                                        <tr>
                                            <?php
                                            $LongHu = ['1V10 龙虎','2V9 龙虎','3V8 龙虎','4V7 龙虎','5V6 龙虎'];
                                            foreach ($LongHu as $key =>$val){
                                                ?>
                                            <td style="border: 0px;">
                                                <table style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3"><?=$val?></th>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">号</th>
                                                            <th width="30%">赔率</th>
                                                            <th width="40%" class="amount">金额</th>
                                                        </tr>
                                                    </thead>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue" width="30%"><span>龙</span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_<?=$key+1?>_h15"><?= $oddslist['ball'][$key+1][15]?></td>
                                                        <td class="amount ball_<?=$key+1?>_t15">
                                                            <input name="ball_<?=$key+1?>_15" class="ball_<?=$key+1?>_15 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                    <tr class="bet-item">
                                                        <td class="fontBlue"><span>虎</span></td>
                                                        <td style="color: red;" class="td_cmn bet_odds ball_<?=$key+1?>_h16"><?= $oddslist['ball'][$key+1][16]?></td>
                                                        <td class="amount ball_<?=$key+1?>_t16">
                                                            <input name="ball_<?=$key+1?>_16" class="ball_<?=$key+1?>_16 amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                        </td>
                                                    </tr>
                                                </table>
                                                </td>
                                            <?php } ?>
                                        </tr>
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
                                        <!--两面盘露珠图-->
                                        <div class="ballqueue-module paihang">
                                            <table class="bq-tb result-tab w100 t1 dataArea qiehuanluzhu">
                                                <tbody>
                                                    <tr>
                                                        <th class="bq-title paihang-ball kon" id="count_isbig">冠、亚军和 大小</th>
                                                        <th class="bq-title" id="count_issingle">冠、亚军单双</th>
                                                    </tr>
                                                </tbody>
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
