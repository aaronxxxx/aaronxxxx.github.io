<?php
use yii\widgets\LinkPager;
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="MACenterContent">
            <div id="MNav">
                <span class="mbtn" >交易记录</span>
                <div class="navSeparate"></div>
            </div>
            <div id="MNavLv2">
                <span class="MGameType" onclick="chgType('ballRecord');">体育赛事</span>｜
                <span class="MGameType" onclick="chgType('liveHistory');">视讯直播</span>｜
                <span class="MGameType" onclick="chgType('skRecord');">彩票</span>｜
                <span class="MGameType" onclick="chgType('moneylog');">盈利统计</span>｜
                <span class="MGameType" onclick="chgType('cqRecord');">存取款记录</span>｜
            </div>
            <div id="MMainData">
                <?php $ballType = ["ft"=>"足球","bk"=>"篮球","tn"=>"网球","bs"=>"棒球",
                    "vb"=>"排球", "gj"=>"冠军","cg"=>"串关","op"=>"其他"];?>
                <div class="MControlNav">
                    <input type="text" value="<?= $time; ?>" readonly="true" style="width: 80px;text-align: center;"/>
                    <input type="text" value="<?= $ballType[$type]; ?>" readonly="true" style="width: 80px;text-align: center;"/>
                    <input type="button" class="MBtnStyle" value="上一页" onclick='syy("sport", "<?= $time ?>")' />
                </div>

                <table class="MMain" border="1">
                    <thead>
                        <tr>
                            <?php if($type!='cg'){?>
                                <th>订单号</th>
                                <th>联赛名</th>
                                <th>主客队</th>
                                <th>投注详细信息</th>
                                <th>投注金额</th>
                                <th>结果</th>
                                <th>投注时间</th>
                                <th>状态</th>
                            <?php }else{?>
                                <th>订单号</th>
                                <th>模式</th>
                                <th>结算详细信息</th>
                                <th>投注金额</th>
                                <th>结果</th>
                                <th>投注时间</th>
                                <th>状态</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody id="general-msg">
                    <?php if($type !='cg'){if(count($detailData)==0){?>
                        <td colspan="8" style="text-align:center;">暂时没有下注信息。</td>
                    <?php }else{ foreach ($detailData as $key => $v) {?>
                        <tr>
                            <td style="text-align:center;width: 100px;"><?= $v["order_num"]; ?></td>
                            <td style="text-align:center;min-width: 90px;"><?= $v["match_name"]; ?></td>
                            <td style="text-align:center;width: 100px;"><?= $v["master_guest"]; ?></td>
                            <td style="text-align:center;width: 100px;"><?= $v["bet_info"]; ?></br>
                            <?php if ($v['status'] != 0 && $v['status'] != 3 && $v['status'] != 8) {
                                if($type =='gj'){ echo $v['xResult']?>
                                <?php }elseif ($v['MB_Inball'] && $v['MB_Inball'] != '') {?>
                                    [<?=$v['MB_Inball']?>:<?=$v['TG_Inball']?>]
                                <?php }
                            }?>
                            </td>
                            <td style="text-align:center;width: 100px;"><?= $v["bet_money"]; ?></td>
                            <td style="text-align:center;width: 100px;"><?= ($v["win"] + $v["fs"])?>
                            <?php if ($v['status'] != 0 && $v['status'] != 3 && $v['status'] != 8) {?>
                               </br>(反水:<?=$v['fs']?>)
                            <?php }?>
                            </td>
                            <td style="text-align:center;min-width: 70px;"><?= $v["bet_time"]; ?></td>
                            <?php if($v['status']==0){
                                if($v['lose_ok']==0 &&$v['ball_sort']=='足球滚球'){?>
                            <td style="text-align:center;width: 100px;">未结算</br>(确认中)</td>
                            <?php }elseif($v['ball_sort']=='篮球滚球' || ($v['ball_sort']=='足球滚球'&&$v['lose_ok']==1)){?>
                            <td style="text-align:center;width: 100px;">未结算</br>(已确认)</td>
                            <?php }else{?>
                            <td style="text-align:center;width: 100px;">未结算</td>
                            <?php }}elseif($v['status']==1){?>
                            <td style="text-align:center;width: 100px;">赢</td>
                            <?php }elseif($v['status']==2){?>
                            <td style="text-align:center;width: 100px;">输</td>
                            <?php }elseif($v['status']==3){?>
                            <td style="text-align:center;width: 100px;">注单无效</td>
                            <?php }elseif($v['status']==4){?>
                            <td style="text-align:center;width: 100px;">赢一半</td>
                            <?php }elseif($v['status']==5){?>
                            <td style="text-align:center;width: 100px;">输一半</td>
                            <?php }elseif($v['status']==6){?>
                            <td style="text-align:center;width: 100px;">进球无效</td>
                            <?php }elseif($v['status']==7){?>
                            <td style="text-align:center;width: 100px;">红卡无效</td>
                            <?php }elseif($v['status']==8){?>
                            <td style="text-align:center;width: 100px;">和局</td>
                            <?php }?>
                            </tr>
                        <?php }}?>
                    </tbody>
                    <tfoot id="msgfoot">
                        <tr>
                            <td colspan='8' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                        </tr>
                    </tfoot>
                </table>
                    <?php }else{ if(count($detailData)){?>
                        <tbody id="general-msg">
                        <?php foreach ($detailData as $key => $v) {?>
                            <tr>
                                <td style="text-align:center;width: 100px;"><?= $v["order_num"]; ?></td>
                                <td style="text-align:center;min-width: 60px;"><?= $v["cg_count"]; ?>串1</td>
                                <td style="text-align:center;width: 120px;">
                                    已结算:<?= $v["js_num"]; ?>&nbsp;
                                    [<a style="color: #F37605;" href="/?r=member/sport/cg-detail&gid=<?= $v["id"]; ?>&day_diff=<?= $time; ?>&order_num=<?= $v["order_num"]; ?>">详细</a>]
                                </td>
                                <td style="text-align:center;width: 100px;"><?= $v["bet_money"]; ?></td>
                                <?php if($v['status']!=0 && $v['status']!=3){ $v['fs'] = $v['fs']; }?>
                                <td style="text-align:center;width: 100px;">
                                    <?= ($v["win"] + $v["fs"])?>
                                    <?php if($v['status']!=0 && $v['status']!=3){?>
                                    </br>(反水:<?=$v['fs']?>)
                                <?php }?>
                                </td>
                                <td style="text-align:center;min-width: 70px;"><?= $v["bet_time"]; ?></td>
                                <?php if($v['status']==1 || $v['status']==2 ||$v['status']==3 && $v['js_num']==$v['cg_count']){?>
                                <td style="text-align:center;width: 100px;">已结算</td>
                                <?php }elseif($v['js_num']==$v['cg_count']){?>
                                <td style="text-align:center;width: 100px;">已结算</td>
                                <?php }elseif($v['status'] == 3){?>
                                <td style="text-align:center;width: 100px;">平手或无效</td>
                                <?php }else{?>
                                <td style="text-align:center;width: 100px;">等待单式结算</td>
                                <?php }?>
                            </tr>
                            <?php }?>
                            </tbody>
                            <tfoot id="msgfoot">
                                <tr><td colspan='8' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
                            </tfoot>
                        <?php }else{?>
                            <td colspan="7" style="text-align:center;">暂时没有下注信息。</td>
                        <?php }} ?>
                </table>
            </div>
        </div>        
    </body>
</html>

