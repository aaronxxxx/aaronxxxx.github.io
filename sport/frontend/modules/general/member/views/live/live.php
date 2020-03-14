<div id="MACenterContent">
    <div class="MNav">
        <span class="active mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData">
        <div id="MMainData" class="pay_cont">
            <div class="title_box">
                <h2>- 视讯直播 -</h2>
            </div>
            <div class="main_box">
                <div class="record_box">
                    <table class="rwd-table">
                        <tr>
                            <th>日期</th>
                            <th>下注金额</th>
                            <th>有效投注</th>
                            <th>结果</th>
                            <th>明细</th>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time1"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_today_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_today_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_today_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time1"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time2"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day1_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day1_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day1_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time2"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time3"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day2_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day2_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day2_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time3"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time4"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day3_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day3_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day3_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time4"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time5"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day4_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day4_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day4_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time5"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time6"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day5_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day5_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day5_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time6"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont">
                            <td data-th="日期"><?php echo ($arr["time7"]); ?></td>
                            <td data-th="下注金额"><?php echo $arr1["live_day6_result"]; ?></td>
                            <td data-th="有效投注"><?php echo $arr2["live_day6_result"]; ?></td>
                            <td data-th="结果"><?php echo $arr3["live_day6_result"]; ?></td>
                            <td data-th="明细"><a href="/?r=member/live/live-detail&time=<?php echo ($arr["time7"]); ?>"></a></td>
                        </tr>
                        <tr class="table_cont total_box">
                            <td data-th="总计" class="total_tex">总计</td>
                            <td data-th="下注金额"><?php echo ($arr["bet_money_total"]); ?></td>
                            <td data-th="有效投注"><?php echo ($arr["val_money_total"]); ?></td>
                            <td data-th="结果"><?php echo ($arr["bet_win_total"]); ?></td>
                            <td data-th="明细"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>