<div id="MACenterContent">
    <div class="MNav">
        <span class="active mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData">
        <div id="MMainData" class="pay_cont">
            <div class="main_box">
                <div class="time_box">
                    <h2>视讯直播</h2>
                    <input type="text" value="<?= $arr['time'] ?>" readonly="true" />
                </div>
                <div class="record_box">
                    <table class="rwd-table">
                        <tr>
                            <th>编号</th>
                            <th>订单号</th>
                            <th>下注时间</th>
                            <th>游戏类型</th>
                            <th>投注内容</th>
                            <th>投注金额</th>
                            <th>有效投注</th>
                            <th>输赢结果</th>
                            <th>游戏平台</th>
                        </tr>
                        <?php
                        if ($arr['result'] != 1) {
                            foreach ($arr2 as $key => $rows) {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="编号"><?= $rows['i'] ?></td>
                                    <td data-th="订单号"><?= $rows['order_num'] ?></td>
                                    <td data-th="下注时间"><?= date($rows['order_time'], strtotime("+12 hours")) ?></td>
                                    <td data-th="游戏类型"><?= $rows['live_type'] ?></td>
                                    <td data-th="投注内容"><?= $rows['bet_info'] ?></td>
                                    <td data-th="投注金额"><?= $rows['bet_money'] ?></td>
                                    <td data-th="有效投注"><?= $rows['valid_bet_amount'] ?></td>
                                    <td data-th="输赢结果"><?= $rows['live_win'] ?></td>
                                    <td data-th="游戏平台"><?= $rows['game_type'] ?></td>
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
                        if ($arr['result'] != 1) {
                        ?>
                            <tr>
                                <td colspan='10'><?= $page_list ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="btn_box">
                    <input type="button" class="confirm_btn" value="上一页" onclick="chgType('liveHistory');">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>