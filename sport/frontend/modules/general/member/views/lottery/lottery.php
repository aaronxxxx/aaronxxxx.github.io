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
                    <a href="#" class="d-btn btn_color"><span>当日交易</span></a>
                    <span class="down_icon"></span>
                </li>
                <li class="w50">
                    <a href="?r=member/lottery/lottery-date" class="d-btn"><span>历史交易</span></a>
                    <span></span>
                </li>
            </ul>
        </div>
        <!-- 彩票歷史交易 -->
        <div class="main_box">
            <div class="today_box">
                <input type="text" value="<?php echo ($arr1["time"]); ?>" readonly="true" />
            </div>
            <div class="record_box">
                <table class="rwd-table">
                    <tr>
                        <th>游戏名称</th>
                        <th>下注金额</th>
                        <th>未结算金额</th>
                        <th>结果</th>
                        <th>明细</th>
                    </tr>
                    <!-- <tr class="table_cont">
                        <td data-th="游戏名称">六合彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["lhc"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["lhc"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["lhc"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-lhc&time=<?php echo ($arr1["time"]); ?>&type=LT"></a></td>
                    </tr> -->
                    <tr class="table_cont">
                        <td data-th="游戏名称">极速六合彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["splhc"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["splhc"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["splhc"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lotterysp-lhc&time=<?php echo ($arr1["time"]); ?>&type=LT"></a></td>
                    </tr>
                    <!-- <tr class="table_cont">
                        <td data-th="游戏名称">3D彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["d3"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["d3"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["d3"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=LT"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">排列三</td>
                        <td data-th="下注金额"><?php echo ($arr1["p3"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["p3"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["p3"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=P3"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">上海时时乐</td>
                        <td data-th="下注金额"><?php echo ($arr1["t3"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["t3"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["t3"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=T3"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">重庆时时彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["cq"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["cq"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["cq"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=CQ"></a></td>
                    </tr> -->
                    <tr class="table_cont">
                        <td data-th="游戏名称">极速时时彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["tj"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["tj"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["tj"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TJ"></a></td>
                    </tr>
                    <!-- <tr class="table_cont">
                        <td data-th="游戏名称">广西十分彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["gxsf"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["gxsf"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["gxsf"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GXSF"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">广东十分彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["gdsf"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["gdsf"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["gdsf"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GDSF"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">天津十分彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["tjsf"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["tjsf"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["tjsf"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TJSF"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">重庆十分彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["cqsf"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["cqsf"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["cqsf"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=CQSF"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">北京快乐8</td>
                        <td data-th="下注金额"><?php echo ($arr1["bjkn"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["bjkn"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["bjkn"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=BJKN"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">广东十一选五</td>
                        <td data-th="下注金额"><?php echo ($arr1["gd11"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["gd11"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["gd11"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GD11"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">北京PK拾</td>
                        <td data-th="下注金额"><?php echo ($arr1["bjpk"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["bjpk"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["bjpk"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=BJPK"></a></td>
                    </tr> -->
                    <tr class="table_cont">
                        <td data-th="游戏名称">极速赛车</td>
                        <td data-th="下注金额"><?php echo ($arr1["ssrc"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["ssrc"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["ssrc"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=SSRC"></a></td>
                    </tr>
                    <!-- <tr class="table_cont">
                        <td data-th="游戏名称">幸运飞艇</td>
                        <td data-th="下注金额"><?php echo ($arr1["mlaft"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["mlaft"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["mlaft"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=MLAFT"></a></td>
                    </tr>
                    <tr class="table_cont">
                        <td data-th="游戏名称">腾讯分分彩</td>
                        <td data-th="下注金额"><?php echo ($arr1["ts"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["ts"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["ts"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TS"></a></td>
                    </tr> -->
                    <tr class="table_cont">
                        <td data-th="游戏名称">老PK拾</td>
                        <td data-th="下注金额"><?php echo ($arr1["orpk"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["orpk"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["orpk"]); ?></td>
                        <td data-th="明细"><a href="/?r=member/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=ORPK"></a></td>
                    </tr>
                    <tr class="table_cont total_box">
                        <td data-th="总计" class="total_tex">总计</td>
                        <td data-th="下注金额"><?php echo ($arr1["sum"]); ?></td>
                        <td data-th="未结算金额"><?php echo ($arr2["sum"]); ?></td>
                        <td data-th="结果"><?php echo ($arr3["sum"]); ?></td>
                        <td data-th="明细"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="MControlNav">
        <select name="foo" id="MSelectType" class="MFormStyle" onchange="cx(this.value);">
            <?php
            if ($arr1["time"] == $arr1["time2"]) {
            ?>
                <option label="今日交易" value="today" selected="selected">今日交易</option>
                <option label="历史交易" value="history">历史交易</option>
            <?php
            } else {
            ?>
                <option label="历史交易" value="history" selected="selected">历史交易</option>
                <option label="今日交易" value="today">今日交易</option>
            <?php
            }
            ?>
        </select>
        <input type="text" value="<?php echo ($arr1["time"]); ?>" readonly="true" style="width: 80px;text-align: center;" />
    </div> -->
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');
</script>