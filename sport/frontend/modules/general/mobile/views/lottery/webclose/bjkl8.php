<main>
    <input id="lotteryName" type="hidden" name="" value="北京快乐8">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <h2 id="gameName"></h2>
            <div class="number">第<span id="numbers"></span>期</div>
        </li>
        <li class="d-flex justify-content-between align-items-center pb-3">
            <input class="lotteryResultBtn" type="button" value="开奖记录"  onclick="javascript:location.href='/index.php?r=mobile/lottery/lottery-result/index&gtype=BJKN'">
            <div id="autoinfo" class="autoinfo">
                <ul id="autoinfo1" class="d-flex justify-content-between mb-1"></ul>
                <ul id="autoinfo2" class="d-flex justify-content-between"></ul>
            </div>
        </li>
    </ul>
    <div class="content">
        <form name="orders">
            <section class="tabArea  pl-4 pr-4 pb-2">
                <div class="tabLabel d-flex justify-content-between align-items-end">
                    <p >第<span id="open_qihao"></span>期</p>
                    <p class="cqc_time"><span id="cqc_text">距离封盘:</span><span id="cqc_time"></span></p>
                </div>
                <ul id="tab" class="tab d-flex flex-wrap justify-content-between">
                    <li class="item mb-2 act"><a data-href="#total"><div class="itemInner">和值</div></a></li>
                    <li class="item mb-2"><a data-href="#shang"><div class="itemInner"> 上中下</div></a></li>
                    <li class="item mb-2"><a data-href="#chiOu"><div class="itemInner">奇和偶</div> </a></li>
                    <li class="item mb-2 hidden"></li>
                    <li class="item mb-2 hidden"></li>
                    <li class="item mb-2"><a data-href="#syuan1"><div class="itemInner">选一</div> </a></li>
                    <li class="item mb-2"><a data-href="#syuan2"><div class="itemInner">选二</div> </a></li>
                    <li class="item mb-2"><a data-href="#syuan3"><div class="itemInner">选三</div> </a></li>
                    <li class="item mb-2"><a data-href="#syuan4"><div class="itemInner">选四</div> </a></li>
                    <li class="item mb-2"><a data-href="#syuan5"><div class="itemInner">选五</div> </a></li>
                </ul>
            </section>
            <?php include 'fast-bet.php';?> 
            <div id="tabinnerBet" class="tabinnerArea  pl-4 pr-4">
                <div id="total" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('总和大','总和小','总和单','总和单','总和810');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li>
                                    <span class="bian_td_lab"><?= $arr[$i]?> </span>
                                    <span class="bian_td_odds" id="ball_6_h<?= $i+1 ?>"><?=$oddslists['ball'][6][$i+1]?></span>
                                    <span class="bian_td_inp" id="ball_6_t<?=$i+1 ?>">
                                        <input name="ball_6_<?=$i+1 ?>" id="ball_6_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="shang" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('上盘','中盘','下盘');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li>
                                    <span class="bian_td_lab"><?= $arr[$i]?> </span>
                                    <span class="bian_td_odds" id="ball_7_h<?= $i+1 ?>"><?=$oddslists['ball'][7][$i+1]?></span>
                                    <span class="bian_td_inp" id="ball_7_t<?=$i+1 ?>">
                                        <input name="ball_7_<?=$i+1 ?>" id="ball_7_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="chiOu" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('奇盘','和盘','偶盘');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li>
                                    <span class="bian_td_lab"><?= $arr[$i]?> </span>
                                    <span class="bian_td_odds" id="ball_8_h<?= $i+1 ?>"><?=$oddslists['ball'][8][$i+1]?></span>
                                    <span class="bian_td_inp" id="ball_8_t<?=$i+1 ?>">
                                        <input name="ball_8_<?=$i+1 ?>" id="ball_8_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="syuan1" class="tabinner" >
                    <div class="d-flex">
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    </div>
                    <div class="d-flex">
                        <ul class="w-50">
                            <?php
                            for($b=1;$b<41;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_1_h".$b."\">".$oddslists['ball'][1][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_1_t".$b."\"><input name=\"ball_1_".$b."\" id=\"ball_1_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                            <ul class="w-50">
                            <?php
                            for($b=41;$b<81;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_1_h".$b."\">".$oddslists['ball'][1][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_1_t".$b."\"><input name=\"ball_1_".$b."\" id=\"ball_1_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="syuan2" class="tabinner" >
                    <div class="d-flex">
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    </div>
                    <div class="d-flex">
                        <ul class="w-50">
                            <?php 
                            for($b=1;$b<41;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_2_h".$b."\">".$oddslists['ball'][2][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_2_t".$b."\"><input name=\"ball_2_".$b."\" id=\"ball_2_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                            <ul class="w-50">
                            <?php
                            for($b=41;$b<81;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_2_h".$b."\">".$oddslists['ball'][2][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_2_t".$b."\"><input name=\"ball_2_".$b."\" id=\"ball_2_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="syuan3" class="tabinner" >
                    <div class="d-flex">
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    </div>
                    <div class="d-flex">
                        <ul class="w-50">
                            <?php
                            for($b=1;$b<41;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_3_h".$b."\">".$oddslists['ball'][3][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_3_t".$b."\"><input name=\"ball_3_".$b."\" id=\"ball_3_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                            <ul class="w-50">
                            <?php
                            for($b=41;$b<81;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_3_h".$b."\">".$oddslists['ball'][3][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_3_t".$b."\"><input name=\"ball_3_".$b."\" id=\"ball_3_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="syuan4" class="tabinner" >
                    <div class="d-flex">
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    </div>
                    <div class="d-flex">
                        <ul class="w-50">
                            <?php
                            for($b=1;$b<41;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_4_h".$b."\">".$oddslists['ball'][4][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_4_t".$b."\"><input name=\"ball_4_".$b."\" id=\"ball_4_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                            <ul class="w-50">
                            <?php
                            for($b=41;$b<81;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_4_h".$b."\">".$oddslists['ball'][4][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_4_t".$b."\"><input name=\"ball_4_".$b."\" id=\"ball_4_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="syuan5" class="tabinner" >
                    <div class="d-flex">
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                        <p class="tit w-50 d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    </div>
                    <div class="d-flex">
                        <ul class="w-50">
                            <?php
                            for($b=1;$b<41;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_5_h".$b."\">".$oddslists['ball'][5][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_5_t".$b."\"><input name=\"ball_5_".$b."\" id=\"ball_5_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                            <ul class="w-50">
                            <?php
                            for($b=41;$b<81;$b++){
                                echo '<li>';
                                echo "<span class=\"bian_td_lab\">".$b."</span>";
                                echo "<span class=\"bian_td_odds\" id=\"ball_5_h".$b."\">".$oddslists['ball'][5][1]."</span>";
                                echo "<span class=\"bian_td_inp bian_td_two\" id=\"ball_5_t".$b."\"><input name=\"ball_5_".$b."\" id=\"ball_5_".$b."\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"checkbox\" maxlength=\"5\"></span>";
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="btns pt-5 pb-5">
                <a class="submit mr-3" onclick="order()">确认</a>
                <a class="cancel" href="#" id="res1" onclick="reset()">取消</a>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript" src="/public/aomen/lottery/js/kl8.js"></script>