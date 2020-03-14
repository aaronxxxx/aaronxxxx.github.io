<div id="MACenterContent">
    <div class="MNav">
        <span class="mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="active mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData" class="pay_cont">
        <div class="title_box">
            <h2>- 彩票 -</h2>
        </div>
        <div>
            <ul class="all_link_box">
                <li class="w50">
                    <a href="?r=member/lottery/lottery" class="d-btn"><span>当日交易</span></a>
                    <span></span>
                </li>
                <li class="w50">
                    <a href="#" class="d-btn btn_color"><span>历史交易</span></a>
                    <span class="down_icon"></span>
                </li>
            </ul>
        </div>
        <div class="main_box">
            <div class="today_box">

            </div>
            <div class="record_box">
                <table class="rwd-table">
                    <tr>
                        <th>日期</th>
                        <th>下注金额</th>
                        <th>未结算金额</th>
                        <th>结果</th>
                        <th>明细</th>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time1"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time1"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time1"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time1"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time1"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time2"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time2"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time2"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time2"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time2"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time3"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time3"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time3"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time3"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time3"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time4"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time4"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time4"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time4"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time4"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time5"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time5"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time5"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time5"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time5"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time6"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time6"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time6"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time6"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time6"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="日期"><?php echo ($arr["time7"]); ?></td>
                        <td data-th="下注金额"><?php echo ($arr2["time7"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time7"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time7"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery&time=<?php echo ($arr["time7"]); ?>"></a></td>
                    </tr>
                    <tr class="table_cont total_box">
                        <td class="total_tex">总计</td>
                        <td data-th="下注金额"><?php echo ($arr2["time_sum"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr3["time_sum"]); ?></td>
                        <td data-th="结果"><?php echo ($arr4["time_sum"]); ?></td>
                        <td data-th="明细"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>