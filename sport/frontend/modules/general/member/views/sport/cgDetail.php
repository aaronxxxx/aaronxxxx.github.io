<div id="MACenterContent">
    <div id="MNav">
        <span class="mbtn" >交易记录</span>
        <div class="navSeparate"></div>
    </div>
    <div id="MNavLv2">
        <span class="MGameType MCurrentType" onclick="chgType('ballRecord');">体育赛事</span>｜
        <span class="MGameType" onclick="chgType('liveHistory');">视讯直播</span>｜
        <span class="MGameType" onclick="chgType('skRecord');">彩票</span>｜
        <span class="MGameType" onclick="chgType('moneylog');">盈利统计</span>｜
        <span class="MGameType" onclick="chgType('cqRecord');">存取款记录</span>｜
    </div>
    <div id="MMainData" style="margin-top: 8px;">
        <div class="MControlNav">
            <input type="text" value="<?= $param['time']; ?>" readonly="true" style="width: 80px;text-align: center;"/>
            <input type="text" value="串关" readonly="true" style="width: 40px;text-align: center;"/>
            <input type="text" value="主订单号：<?= $param['order_num'] ?>" readonly="true" style="width: 200px;text-align: center;"/>
            <input type="button" class="MBtnStyle" value="上一页" onclick="syy('cg','<?= $param['time'] ?>');"  />
        </div>
        <table class="MMain" border="1">
            <tr>
                <th>联赛名</th>
                <th>主客队</th>
                <th>投注详细信息</th>
                <th>投注/开赛时间</th>
                <th>状态</th>
            </tr>
            <?php
            foreach ($cgDetail as $k => $v) {
                ?>
                <tr>
                    <td style="text-align:center;width: 80px;"><?= $v['match_name'] ?></td>
                    <td style="text-align:center;min-width: 100px;"><?= $v['master_guest'] ?></td>
                    <td style="text-align:center;width: 120px;"><?= $v['bet_info'] ?>
                        <?php if ($v['status'] != 0 && $v['status'] != 3 && $v['MB_Inball'] != '') {?>
                            <br/>[<?=$v['MB_Inball']?>:<?=$v['TG_Inball']?>]
                        <?php }?>
                    </td>
                    <td style="text-align:center;min-width: 100px;"><?= $v['bet_time'] ?><br/><?= $v['match_endtime'] ?></td>
                    <?php if ($v['status'] == 0) {?>
                    <td style="text-align:center;width: 60px;">未结算</td>
                    <?php }elseif($v['status'] == 1){?>
                    <td style="text-align:center;width: 60px;">赢</td>
                    <?php }elseif($v['status'] == 2){?>
                    <td style="text-align:center;width: 60px;">输</td>
                    <?php }elseif($v['status'] == 3){?>
                    <td style="text-align:center;width: 60px;">注单无效</td>
                    <?php }elseif($v['status'] == 4){?>
                    <td style="text-align:center;width: 60px;">赢一半</td>
                    <?php }elseif($v['status'] == 5){?>
                    <td style="text-align:center;width: 60px;">输一半</td>
                    <?php }elseif($v['status'] == 6){?>
                    <td style="text-align:center;width: 60px;">其他无效</td>
                    <?php }elseif($v['status'] == 7){?>
                    <td style="text-align:center;width: 60px;">红卡取消</td>
                    <?php }elseif($v['status'] == 8){?>
                    <td style="text-align:center;width: 60px;">和</td>
                    <?php }?>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>