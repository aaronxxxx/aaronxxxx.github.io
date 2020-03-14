<?php

use yii\widgets\LinkPager;
?>
<div id="MACenterContent">
    <div class="MNav">
        <span class="mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="active mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData" class="pay_cont">
        <div class="main_box">
            <div class="time_box">
                <input type="text" value="<?= $arr1['type'] ?>" readonly="true" style="text-align: left;" />
                <input type="text" value="<?= $arr1['time'] ?>" readonly="true" />
            </div>
            <div class="record_box">
                <table class="rwd-table">
                    <tr>
                        <th>订单号</th>
                        <th>彩票期号</th>
                        <th>投注玩法</th>
                        <th>投注内容</th>
                        <th>投注金额</th>
                        <th>反水</th>
                        <th>赔率</th>
                        <th>输赢结果</th>
                        <th>投注时间</th>
                        <th>状态</th>
                    </tr>
                    <?php
                    if ($arr1['result'] != 1) {
                        foreach ($arr2 as $key => $rows) {
                    ?>
                            <tr class="table_cont">
                                <td data-th="订单号"><?= $rows["order_sub_num"] ?></td>
                                <td data-th="彩票期号"><?= $rows["qishu"] ?></td>
                                <td data-th="投注玩法"><?= $rows["rtype_str_sub"] ?></td>
                                <td data-th="投注内容"><?= $rows["number"] ?></td>
                                <td data-th="投注金额"><?= $rows["bet_money_one"] ?></td>
                                <td data-th="反水"><?= $rows["fs"] ?></td>
                                <td data-th="赔率"><?= $rows["bet_rate"] ?></td>
                                <td data-th="输赢结果"><?= $rows["money_result"] ?></td>
                                <td data-th="投注时间"><?= $rows["bet_time"] ?></td>
                                <td data-th="状态"><?= $rows["status_result"] ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="table_cont">
                            <td colspan="10">暂时没有下注信息。</td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if ($arr1['result'] != 1) {
                    ?>
                        <tr>
                            <td colspan='10'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="btn_box">
                <input type="button" class="confirm_btn" value="上一页" onclick="syy('caipiao','<?= $arr1["time"] ?>');" />
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>