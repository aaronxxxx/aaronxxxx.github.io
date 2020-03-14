<div id="MACenterContent">
    <div class="MNav">
        <span class="mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn active" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData" class="pay_cont">
        <form name="form12" id="form12" action="/?r=member/money-log/index" method="get">
            <div class="title_box">
                <div class="title_date">
                    <input name="s_time" id="s_time" value="<?= $time['s_time'] ?>" readonly="readonly" />
                    <span></span>
                    <input name="e_time" id="e_time" value="<?= $time['e_time'] ?>" readonly="readonly" />
                </div>
            </div>
            <div>
                <ul class="all_link_box">
                    <li class="w14">
                        <input type="button" class="d-btn btn_color" value="今日" onclick="setDate('today')" />
                        <span class="down_icon"></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="昨日" onclick="setDate('yesterday')" />
                        <span></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="本周" onclick="setDate('thisWeek')" />
                        <span></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="上周" onclick="setDate('lastWeek')" />
                        <span></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="本月" onclick="setDate('thisMonth')" />
                        <span></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="最近7天" onclick="setDate('lastSeven')" />
                        <span></span>
                    </li>
                    <li class="w14">
                        <input type="button" class="d-btn" value="最近30天" onclick="setDate('lastThirty')" />
                        <span></span>
                    </li>
                </ul>
            </div>
        </form>
        <div class="main_box">
            <div class="record_box pad_top20">
                <table class="rwd-table">
                    <tr>
                        <th>类别</th>
                        <th>盈利</th>
                        <th>有效投注</th>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="类别">电子视讯</td>
                        <td data-th="盈利"><?php echo $live['win_total']; ?></td>
                        <td data-th="有效投注"><?php echo $live['val_money_total']; ?></td>
                    </tr>
                    <!-- <tr class="table_cont">
                        <td data-th="类别">六合彩</td>
                        <td data-th="盈利"><?php echo $six['profit']; ?></td>
                        <td data-th="有效投注"><?php echo $six['bet_money_total']; ?></td>
                    </tr> -->
                    <tr class="table_cont">
                        <td data-th="类别">极速六合彩</td>
                        <td data-th="盈利"><?php echo $spsix['profit']; ?></td>
                        <td data-th="有效投注"><?php echo $spsix['bet_money_total']; ?></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="类别">彩票</td>
                        <td data-th="盈利"><?php echo $lottery['winMoney']; ?></td>
                        <td data-th="有效投注"><?php echo $lottery['allMoney']; ?></td>
                    </tr>
                    <tr class="table_cont total_box">
                        <td data-th="总计" class="total_tex">总计</td>
                        <td data-th="盈利"><?php echo $lottery['winMoney'] + $six['profit'] + $spsix['profit'] + $live['win_total']; ?></td>
                        <td data-th="有效投注"><?php echo $live['val_money_total'] + $six['bet_money_total'] + $spsix['bet_money_total'] + $lottery['allMoney']; ?></td>
                    </tr>
                </table>
            </div>
            <div style="text-align:center;padding-top:20px;font-size:16px">注： 盈利数据需扣除本金，正数为会员盈利，负数为会员负盈利。 (单位：元)</div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>