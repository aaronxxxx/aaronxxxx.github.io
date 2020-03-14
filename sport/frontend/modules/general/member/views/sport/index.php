<?php
$type = isset($type)?$type:0
?>
<div id="MACenter-content">
    <div id="MACenterContent">
        <div id="MNav">
            <span class="mbtn">交易记录</span>
            <div class="navSeparate"></div>
        </div>
        <div id="MNavLv2">
            <span class="MGameType MCurrentType" onclick="chgType('ballRecord');">体育赛事</span>｜
            <span class="MGameType" onclick="chgType('liveHistory');">视讯直播</span>｜
            <span class="MGameType" onclick="chgType('skRecord');">彩票</span>｜
            <span class="MGameType" onclick="chgType('moneylog');">盈利统计</span>｜
            <span class="MGameType" onclick="chgType('cqRecord');">存取款记录</span>
        </div>
        <div id="MMainData">
            <div class="MControlNav">
                <?php if($type==0){?>
                <input type="text" value="历史交易" readonly="true" style="width: 60px;text-align: center;"/>
                <?php }else{?>
                <input type="text" value="<?= $time; ?>" readonly="true" style="width: 80px;text-align: center;"/>
                <input type="button" class="MBtnStyle" value="上一页" onclick="chgType('ballRecord');"  />
                <?php }?>
            </div>
            <div class="MPanel" style="display: block;">
                <table class="MMain" border="1">
                    <tbody>
                    <tr>
                        <?php if($type==0){?>
                            <th width="20%">日期</th>
                        <?php }else{?>
                            <th width="20%">游戏名称</th>
                        <?php }?>
                        <th width="30%">下注金额</th>
                        <th width="30%">未结算金额</th>
                        <th width="20%">结果</th>
                    </tr>
                    <?php $sum1 = $sum2 = $sum3 = 0;
                    $ballType = ["ft"=>"足球","bk"=>"篮球","tn"=>"网球","bs"=>"棒球",
                        "vb"=>"排球", "gj"=>"冠军","cg"=>"串关","op"=>"其他"];
                    if($type!=1){
                        for($i=0;$i<count($allBetMoney);$i++){?>
                        <tr align="right" class="MColor1">
                            <td style="text-align: center;">
                                <a class="pagelink" href="/?r=member/sport/sport&day_diff=<?= (date('Y-m-d', strtotime(-$i.' day'))); ?>"><?= (date('Y-m-d', strtotime(-$i.' day'))); ?></a>
                            </td>
                            <td style="text-align: center;"><?= ($allBetMoney[$i]); ?></td>
                            <td style="text-align: center;"><?= ($allNoCountMoney[$i]); ?></td>
                            <td style="text-align: center;"><?= ($allWinMoney[$i]); ?></td>
                        </tr>
                        <?php
                            $sum1 +=$allBetMoney[$i];
                            $sum2 +=$allNoCountMoney[$i];
                            $sum3 +=$allWinMoney[$i];
                        }}else{ foreach($ballType as $i=>$v){?>
                        <tr align="right" class="MColor1">
                            <td style="text-align: center;">
                                <a class="pagelink" href="/?r=member/sport/detail&type=<?=$i?>&day_diff=<?= ($time); ?>"><?= ($v); ?></a>
                            </td>
                            <td style="text-align: center;"><?= ($allBetMoney[$i]); ?></td>
                            <td style="text-align: center;"><?= ($allNoCountMoney[$i]); ?></td>
                            <td style="text-align: center;"><?= ($allWinMoney[$i]); ?></td>
                        </tr>

                    <?php
                        $sum1 +=$allBetMoney[$i];
                        $sum2 +=$allNoCountMoney[$i];
                        $sum3 +=$allWinMoney[$i];
                    }}?>
                        <tr>
                            <td style="text-align: center;">总计</td>
                            <td style="text-align: center;" align="right"><?= ($sum1); ?></td>
                            <td style="text-align: center;" align="right"><?= ($sum2); ?></td>
                            <td style="text-align: center;" align="right"><?= ($sum3); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>