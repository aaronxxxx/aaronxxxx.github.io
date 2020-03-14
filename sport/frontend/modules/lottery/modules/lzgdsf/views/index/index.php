<script src="/public/luzhu/js/gdklsf.js"></script>
<div id="html_content">
    <div id="layout" class="container">
        <!--彩种分类-->
        <div class="sub-nav bline" id="integrate-nav">
            <div class="ssc-small-nav ssc qiulei">
                <a class="on" href="javascript:void(0)" id="two_side">两面盘</a>
                <a href="javascript:void(0)" id="one_five">单球1~8</a>
                <a href="javascript:void(0)" id='first'>第一球</a>
                <a href="javascript:void(0)" id='second'>第二球</a>
                <a href="javascript:void(0)" id='thirdly'>第三球</a>
                <a href="javascript:void(0)" id='fourthly'>第四球</a>
                <a href="javascript:void(0)" id='fifth'>第五球</a>
                <a href="javascript:void(0)" id='sixth'>第六球</a>
                <a href="javascript:void(0)" id='seventh'>第七球</a>
                <a href="javascript:void(0)" id='eighth'>第八球</a>
            </div>
        </div>
        <!-- 左边 -->
        <div class="sidebar">
            <!--两面长龙排行-->
            <div id="side_left" class="side_left">
                <div id="leftSwapBtn">
                    <ul>
                        <li class="on changlong">两面长龙排行</li>
                        <li class="zuijin" onclick="openUCWindow('/?r=member/lottery/lottery-one&time=<?=date('Y/m/d')?>&type=GDSF', '交易记录')">最近交易记录</li>
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
            <div id="rightLoader">
                <div class="betAreaBox k110">
                    <div class="bet-results-box allline">
                        <ul class="tbpadding" id="topul">
                            <li class="rline l column-9">
                                <h3 style="padding-left:70px;">广东快乐十分</h3>
                            </li>
                            <li class="l column-7" id="resultnum">
                                <h3 id="prevGameNo"><?=$result['qishu']?></h3><h3>期</h3>
                                <p class="numresult k110">
                                    <span id="result0" class="number num<?=$result['ball_1']?>"></span>
                                    <span id="result1" class="number num<?=$result['ball_2']?>"></span>
                                    <span id="result2" class="number num<?=$result['ball_3']?>"></span>
                                    <span id="result3" class="number num<?=$result['ball_4']?>"></span>
                                    <span id="result4" class="number num<?=$result['ball_5']?>"></span>
                                    <span id="result5" class="number num<?=$result['ball_6']?>"></span>
                                    <span id="result6" class="number num<?=$result['ball_7']?>"></span>
                                    <span id="result7" class="number num<?=$result['ball_8']?>"></span>
                                </p>
                            </li>
                        </ul>
                        <ul id="Ul1">
                            <li class="rline l column-9">
                                <h3><strong class="green" id="currGameNo"></strong>&nbsp;期&nbsp;<strong class="lan" id="panname">两面盘</strong>
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
                                    <input name="" type="text" class="input-text width-s1" id="kuaijiexiazhu_input" digitOnly="check_num(this)" oninput="on_input(this)" onpropertychange="on_input(this)" maxlength="9" size="9">
                                </li>
                                <li>
                                    <input type="button" class="btn btn-red width-s5" onclick="order();" value="确 定">
                                </li>
                                <li>
                                    <input type="button" class="btn btn-gray width-s5" onclick="cq_cancel()" value="取 消">
                                </li>
                            </ul>
                        </div>
                        <!--两面盘-->
                        <div class="zhongleitab" style="display: block;">
                            <div class="klctouzhuArea">
                                <table class="w100 touzhuArea t1">
                                    <tr>
                                        <th colspan="12">总和-龙虎</th>
                                    </tr>
                                    <tr>
                                    <?php
                                    $ZongheNum = ['总和大','总和小','总和单','总和双','总和尾大','总和尾小','龙','虎'];
                                    foreach($ZongheNum as $zkey => $zval){
                                    if($zkey==0||$zkey==2||$zkey==4||$zkey==6) {
                                    ?>
                                        <td width="25%" style="border: 0px;">
                                        <table class="w99">
                                    <?php } ?>
                                    <tr class="bet-item">
                                        <td style="text-decoration: none;" class="fontBlue td_cmn"><?=$zval?></td>
                                        <td class="td_cmn bet_odds ball_9_h<?=$zkey+1?>" style="color: red;"><?=$oddslist['ball'][9][$zkey+1]?></td>
                                        <td class="amount ball_9_t<?=$zkey+1?>">
                                            <input name="ball_9_<?=$zkey+1?>" class="ball_9_<?=$zkey+1?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                        </td>
                                    </tr>
                                    <?php if($zkey==1||$zkey==3||$zkey==5||$zkey==7) { ?>
                                        </table>
                                        </td>
                                    <?php }} ?>
                                    </tr>
                                </table>
                            </div>
                            <!--两面第一球至第八球-->
                            <?php
                            $ball=['第一球','第二球','第三球','第四球','第五球','第六球','第七球','第八球'];
                            $type=['大','小','单','双','尾大','尾小','合数单','合数双'];
                            foreach($ball as $key=>$val){
                            if($key==0||$key==4){
                            ?>
                            <div class="klctouzhuArea">
                                <table class="w100">
                                    <tr>
                                    <?php } ?>
                                        <td class="w25">
                                            <table class="t1 touzhuArea w99">
                                                <th colspan="3"><?=$val?></th>
                                                <?php
                                                $i=21;
                                                foreach($type as $key2=>$val2){
                                                ?>
                                                <tr class="bet-item">
                                                    <td class="fontBlue"><?=$val2?></td>
                                                    <td class="td_cmn bet_odds ball_<?=$key+1?>_h<?=$i?>" style="color: red;"><?=$oddslist['ball'][$key+1][$i]?></td>
                                                    <td class="amount ball_<?=$key+1?>_t<?=$i?>">
                                                        <input name="ball_<?=$key+1?>_<?=$i?>" class="ball_<?=$key+1?>_<?=$i?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                    </td>
                                                </tr>
                                                <?php $i++;}?>
                                            </table>
                                        </td>
                                        <?php if($key==3||$key==7){ ?>
                                    </tr>
                                </table>
                            </div>
                            <?php }} ?>
                        </div>
                        <!--单球1~8-->
                        <div class="zhongleitab">
                            <div class="klctouzhuArea">
                                <div class="w100 title1_8btn danqiu ">
                                    <ul>
                                        <li class="dn">1 ~ 4球</li>
                                        <li>5 ~ 8球</li>
                                    </ul>
                                </div>
                                <table class="struct_table ballno-tab touzhuArea w100 t1 danqiuct" style="display: block;">
                                    <tr>
                                        <?php
                                        foreach($ball as $key => $val) {
                                        if($key==4){
                                        ?>
                                    </tr>
                                </table>
                                <table class="struct_table ballno-tab touzhuArea w100 t1 danqiuct">
                                    <tr>
                                        <?php } ?>
                                        <td width="12.5%" style="border: 0px;">
                                            <table style="width: 100%;">
                                                <th colspan="3"><?=$val?></th>
                                                <tr>
                                                    <?php if($key==0||$key==4){ ?>
                                                        <th width="30%">号</th>
                                                    <?php }?>
                                                    <th width="30%">赔率</th>
                                                    <th width="40%" class="amount">金额</th>
                                                </tr>
                                                <tbody>
                                                <?php for($i=1;$i<21;$i++){ ?>
                                                    <tr class="bet-item">
                                                        <?php if($key==0||$key==4){ ?>
                                                            <td class="td_cmn bet_stt fontBlue"><span class="number num<?=$i?>"></span></td>
                                                        <?php } ?>
                                                        <td class="td_cmn bet_odds ball_<?=$key+1?>_h<?=$i?>" style="color: red; width: 34px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?=$oddslist['ball'][$key+1][$i]?></td>
                                                        <td class="amount ball_<?=$key+1?>_t<?=$i?>">
                                                            <input name="ball_<?=$key+1?>_<?=$i?>" class="ball_<?=$key+1?>_<?=$i?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5"></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php if($key==3||$key==7){ ?>
                                    </tr>
                                </table>
                                <?php }} ?>
                            </div>
                        </div>
                        <?php for($b=1;$b<9;$b++){ ?>
                        <div class="zhongleitab">
                            <div class="klctouzhuArea">
                                <table class="struct_table ballno-tab touzhuArea w100 t1">
                                    <tr>
                                        <?php
                                        for($BallNum=1;$BallNum<21;$BallNum++){
                                        if($BallNum==1||$BallNum==6||$BallNum==11||$BallNum==16){
                                        ?>
                                        <td width="25%" style="border: 0px;">
                                            <table style="width: 100%;">
                                            <tr>
                                                <th width="30%">号</th>
                                                <th width="30%">赔率</th>
                                                <th width="40%" class="amount">金额</th>
                                            </tr>
                                            <?php } ?>
                                            <tr class="bet-item">
                                                <td class="td_cmn bet_stt fontBlue"><span class="number num<?=$BallNum?>"></span></td>
                                                <td class="td_cmn bet_odds ball_<?=$b?>_h<?=$BallNum?>" style="color: red;"><?=$oddslist['ball'][$b][$BallNum]?></td>
                                                <td class="amount ball_<?=$b?>_t<?=$BallNum?>">
                                                    <input name="ball_<?=$b?>_<?=$BallNum?>" class="ball_<?=$b?>_<?=$BallNum?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                </td>
                                            </tr>
                                        <?php if($BallNum==5||$BallNum==10||$BallNum==15||$BallNum==20) { ?>
                                            </table>
                                        </td>
                                        <?php }}?>
                                    </tr>
                                </table>
                            </div>
                            <div class="klctouzhuArea">
                                <table class="struct_table ballno-tab touzhuArea w100 t1">
                                    <?php
                                    $BallOther = ['大','小','单','双','尾大','尾小','合数单','合数双','东','南','西','北','中','发','白',''];
                                    for($BallKey=0;$BallKey<16;$BallKey++){
                                    if($BallKey==0||$BallKey==4||$BallKey==8||$BallKey==12) {
                                    ?>
                                    <td width="25%" style="border: 0px;">
                                        <table style="width: 100%;">
                                            <?php }if($BallKey==15){ ?>
                                            <tr>
                                                <td class="td_cmn"></td>
                                                <td class="td_cmn"></td>
                                                <td class="amount"></td>
                                            </tr>
                                            <?php }else{ ?>
                                            <tr class="bet-item">
                                                <td class="fontBlue" width="30%"><?=$BallOther[$BallKey]?></td>
                                                <td class="td_cmn bet_odds ball_<?=$b?>_h<?=$BallKey+21?>" style="color: red;" width="30%"><?=$oddslist['ball'][$b][$BallKey+21]?></td>
                                                <td class="amount ball_<?=$b?>_t<?=$BallKey+21?>" width="40%">
                                                    <input name="ball_<?=$b?>_<?=$BallKey+21?>" class="ball_<?=$b?>_<?=$BallKey+21?> amount-input" style="border: 1px solid #B0B0B0; background-color: transparent" type="text" onkeyup="digitOnly(this)" maxlength="5">
                                                </td>
                                            </tr>
                                            <?php }if($BallKey==3||$BallKey==7||$BallKey==11||$BallKey==15){ ?>
                                        </table>
                                    </td>
                                    <?php }} ?>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
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
                                    <input name="" type="text" class="input-text width-s1" onkeyup="digitOnly(this)" oninput="text_val(this)" id="Text1" maxlength="9" size="9"></li>
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
                                        <tbody>
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