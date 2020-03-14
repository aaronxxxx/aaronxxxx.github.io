<main>
    <input id="lotteryName" type="hidden" name="" value="福彩3D">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <h2 id="gameName"></h2>
            <div class="number">第<span id="numbers"></span>期</div>
        </li>
        <li class="d-flex justify-content-between align-items-center pb-3">
            <input class="lotteryResultBtn" type="button" value="开奖记录"  onclick="javascript:location.href='/index.php?r=mobile/lottery/lottery-result/index&gtype=D3'">
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
                    <li class="item mb-2 act"><a data-href="#total"><div class="itemInner">总和 龙虎和</div></a></li>
                    <li class="item mb-2"><a data-href="#SanLian"><div class="itemInner"> 三连</div></a></li>
                    <li class="item mb-2"><a data-href="#f3"><div class="itemInner">跨度</div> </a></li>
                    <li class="item mb-2"><a data-href="#no1"><div class="itemInner">第一球</div> </a></li>
                    <li class="item mb-2"><a data-href="#no2"><div class="itemInner">第二球</div> </a></li>
                    <li class="item mb-2"><a data-href="#no3"><div class="itemInner">第三球</div> </a></li>
                </ul>
            </section>
            <?php include 'fast-bet.php';?> 
            <div id="tabinnerBet" class="tabinnerArea  pl-4 pr-4">
                <div id="total" class="tabinner" >
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('总和大','总和小','总和单','总和单','龙','虎','和');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li>
                                    <span class="bian_td_lab"><?= $arr[$i]?> </span>
                                    <span class="bian_td_odds" id="ball_4_h<?= $i+1 ?>"><?=$oddslists['ball'][4][$i+1]?></span>
                                    <span class="bian_td_inp" id="ball_4_t<?=$i+1 ?>">
                                        <input name="ball_4_<?=$i+1 ?>" id="ball_4_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="SanLian" class="tabinner" >
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('豹子','顺子','对子','半顺','杂六');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li>
                                    <span class="bian_td_lab"><?= $arr[$i]?> </span>
                                    <span class="bian_td_odds" id="ball_5_h<?= $i+1 ?>"><?=$oddslists['ball'][5][$i+1]?></span>
                                    <span class="bian_td_inp" id="ball_5_t<?=$i+1 ?>">
                                        <input name="ball_5_<?=$i+1 ?>" id="ball_5_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                    </span>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="KuaDu" class="tabinner" >
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('0','1','2','3','4','5','6','7','8','9');
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
                <div id="no1" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('0','1','2','3','4','5','6','7','8','9','大','小','单','双');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li><span class="bian_td_lab"><?= $arr[$i]?> </span><span class="bian_td_odds" id="ball_1_h<?= $i+1 ?>"><?=$oddslists['ball'][1][$i+1]?></span><span class="bian_td_inp" id="ball_1_t<?=$i+1 ?>">
                                    <input name="ball_1_<?=$i+1 ?>" id="ball_1_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                </span></li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no2" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('0','1','2','3','4','5','6','7','8','9','大','小','单','双');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li><span class="bian_td_lab"><?= $arr[$i]?> </span><span class="bian_td_odds" id="ball_2_h<?= $i+1 ?>"><?=$oddslists['ball'][2][$i+1]?></span><span class="bian_td_inp" id="ball_2_t<?=$i+1 ?>">
                                    <input name="ball_2_<?=$i+1 ?>" id="ball_2_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                </span></li>
                        <?php }?>
                    </ul>
                </div>
                <div id="no3" class="tabinner">
                    <p class="tit d-flex justify-content-between"><span>选项</span><span>赔率</span><span>金额</span></p>
                    <ul>
                        <?php 
                            $arr= array('0','1','2','3','4','5','6','7','8','9','大','小','单','双');
                            $a = count($arr);
                            for ( $i=0 ; $i<$a ; $i++ ) { ?> 
                                <li><span class="bian_td_lab"><?= $arr[$i]?> </span><span class="bian_td_odds" id="ball_3_h<?= $i+1 ?>"><?=$oddslists['ball'][3][$i+1]?></span><span class="bian_td_inp" id="ball_3_t<?=$i+1 ?>">
                                    <input name="ball_3_<?=$i+1 ?>" id="ball_3_<?=$i+1 ?>" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="5">
                                </span></li>
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
<script type="text/javascript" src="/public/aomen/lottery/js/fc3d.js"></script>
