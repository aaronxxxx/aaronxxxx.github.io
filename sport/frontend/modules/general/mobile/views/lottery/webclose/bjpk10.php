<main>
    <input id="lotteryName" type="hidden" name="" value="北京赛车">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <h2 id="gameName"></h2>
            <div class="number">第<span id="numbers"></span>期</div>
        </li>
        <li class="d-flex justify-content-between align-items-center pb-3">
            <input class="lotteryResultBtn" type="button" value="开奖记录"  onclick="javascript:location.href='/index.php?r=mobile/lottery/lottery-result/index&gtype=BJPK'">
            <div id="autoinfo" class="autoinfo d-flex justify-content-between"></div>
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
                    <li class="item item mb-2 act"><a data-href="#total"><div class="itemInner">冠,亚军和</div></a></li>
                    <li class="item mb-2"><a data-href="#pk"><div class="itemInner">pk龙虎</div> </a></li>
                    <li class="item mb-2 hidden"></li>
                    <li class="item mb-2 hidden"></li>
                    <li class="item mb-2 hidden"></li>
                    <li class="item mb-2 "><a data-href="#no1"><div class="itemInner">冠军</div> </a></li>
                    <li class="item mb-2"><a data-href="#no2"><div class="itemInner">亚军</div> </a></li>
                    <li class="item mb-2"><a data-href="#no3"><div class="itemInner">第三名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no4"><div class="itemInner">第四名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no5"><div class="itemInner">第五名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no6"><div class="itemInner">第六名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no7"><div class="itemInner">第七名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no8"><div class="itemInner">第八名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no9"><div class="itemInner">第九名</div> </a></li>
                    <li class="item mb-2"><a data-href="#no10"><div class="itemInner">第十名</div> </a></li>
                </ul>
            </section>
            <?php include 'fast-bet.php';?> 
            <div id="tabinnerBet" class="tabinnerArea  pl-4 pr-4">
                <div id="total" class="tabinner" >
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                        $arr= array('18'=>'冠亚大','19'=>'冠亚小','20'=>'冠亚单','21'=>'冠亚双','1'=>'3','2'=>'4','3'=>'5','4'=>'6','5'=>'7','6'=>'8','7'=>'9','8'=>'10','9'=>'11','10'=>'12','11'=>'13','12'=>'14','13'=>'15','14'=>'16','15'=>'17','16'=>'18','17'=>'19');
                        foreach ($arr as $key => $value) {?>
                            <li>
                                <span class="bian_td_lab"><?=$value?> </span>
                                <span class="bian_td_odds" id="ball_11_h<?= $key ?>"><?=$oddslists['ball'][11][$key]?></span>
                                <span class="bian_td_inp" id="ball_11_t<?=$key ?>">
                                    <input name="ball_11_<?= $key ?>" id="ball_11_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                </span>
                            </li>
                        <?php }?>
                        <!-- by yang -->
                    </ul>
                </div>
                <div id="pk" class="tabinner" >
                    <?php 
                            $arr= array('1','2','3','4','5');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) {
                                $b = $a+$a; ?> 
                            <h3 class="text-center mb-2 mt-1"><?= $arr[$i]?>V<?= $b-$i?>龙虎</h3> 
                            <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                            <ul> 
                                <li> <span class="bian_td_lab">龙</span> <span class="bian_td_odds" id="ball_<?= $arr[$i]?>_h15"><?=$oddslists['ball'][$arr[$i]][15]?> </span> <span class="bian_td_inp" id="ball_<?= $arr[$i]?>_t15"><input name="ball_<?= $arr[$i]?>_15" id="ball_<?= $arr[$i]?>_15" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5"> </span> </li> 
                                <li> <span class="bian_td_lab">虎</span> <span class="bian_td_odds" id="ball_<?= $arr[$i]?>_h16"><?=$oddslists['ball'][$arr[$i]][16]?> </span> <span class="bian_td_inp" id="ball_<?= $arr[$i]?>_t16"><input name="ball_<?= $arr[$i]?>_16" id="ball_<?= $arr[$i]?>_16" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5"> </span> </li> 
                            </ul> 
                        <?php }?>
                </div>
                <div id="no1" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_1_h<?= $key ?>"><?=$oddslists['ball'][1][$key]?></span>
                                    <span class="bian_td_inp" id="ball_1_t<?=$key ?>">
                                        <input name="ball_1_<?=$key ?>" id="ball_1_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no2" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div> </span>
                                    <span class="bian_td_odds" id="ball_2_h<?= $key ?>"><?=$oddslists['ball'][2][$key]?></span>
                                    <span class="bian_td_inp" id="ball_2_t<?=$key ?>">
                                        <input name="ball_2_<?=$key ?>" id="ball_2_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no3" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_3_h<?= $key ?>"><?=$oddslists['ball'][3][$key]?></span>
                                    <span class="bian_td_inp" id="ball_3_t<?=$key ?>">
                                        <input name="ball_3_<?=$key ?>" id="ball_3_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no4" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_4_h<?= $key ?>"><?=$oddslists['ball'][4][$key]?></span>
                                    <span class="bian_td_inp" id="ball_4_t<?=$key ?>">
                                        <input name="ball_4_<?=$key ?>" id="ball_4_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no5" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_5_h<?= $key ?>"><?=$oddslists['ball'][5][$key]?></span>
                                    <span class="bian_td_inp" id="ball_5_t<?=$key ?>">
                                        <input name="ball_5_<?=$key ?>" id="ball_5_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no6" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                                $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_6_h<?= $key ?>"><?=$oddslists['ball'][6][$key]?></span>
                                    <span class="bian_td_inp" id="ball_6_t<?=$key ?>">
                                        <input name="ball_6_<?=$key ?>" id="ball_6_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no7" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_7_h<?= $key ?>"><?=$oddslists['ball'][7][$key]?></span>
                                    <span class="bian_td_inp" id="ball_7_t<?=$key ?>">
                                        <input name="ball_7_<?=$key ?>" id="ball_7_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no8" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_8_h<?= $key ?>"><?=$oddslists['ball'][8][$key]?></span>
                                    <span class="bian_td_inp" id="ball_8_t<?=$key ?>">
                                        <input name="ball_8_<?=$key ?>" id="ball_8_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no9" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div></span>
                                    <span class="bian_td_odds" id="ball_9_h<?= $key ?>"><?=$oddslists['ball'][9][$key]?></span>
                                    <span class="bian_td_inp" id="ball_9_t<?=$key ?>">
                                        <input name="ball_9_<?=$key ?>" id="ball_9_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no10" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr = array('11'=>'大','12'=>'小','13'=>'单','14'=>'双','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
                            $a = count($arr);
                            foreach ($arr as $key => $value) { ?> 
                                <li>
                                    <span class="bian_td_lab"><div class="m-auto ballc_<?=$value?>"><?= $value?> </div> </span>
                                    <span class="bian_td_odds" id="ball_10_h<?= $key ?>"><?=$oddslists['ball'][10][$key]?></span>
                                    <span class="bian_td_inp" id="ball_10_t<?=$key ?>">
                                        <input name="ball_10_<?=$key ?>" id="ball_10_<?=$key ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                
            </div>
            <div class="btns pt-5 pb-5">
                <a class="submit mr-3" onclick="order()">确认</a>
                <a class="cancel" href="#" id="res1" onclick="reset()">取消</a>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript" src="/public/aomen/lottery/js/pk10.js"></script>
