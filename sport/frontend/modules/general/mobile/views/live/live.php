<?php
// use yii\widgets\LinkPager;
?>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include Yii::$app->basePath.'/modules/general/mobile/views/financial/member_top.php'?>
    <div class="charge report">
        <form id="historyForm" class="historyForm">
            <select class="pt-2 pb-2" name="trantype" onchange="lx(this.value);">
                <option value="3">视讯直播记录</option>
                <option value="5">金额交易记录</option>
                <option value="4">彩票投注记录</option>
                <option value="2">盈利统计记录</option>
            </select>
            <div class="h_tg"></div>
            <input type="hidden" readonly="" class="subdate hasDatepicker" value="2016-01-23 00:00:00"
                onclick="seleCalendar(this);" id="beginDate" size="20" maxlength="20">
            <input type="hidden" readonly="" class="subdate hasDatepicker" value="2016-02-22 23:59:59"
                onclick="seleCalendar(this);" id="endDate" size="20" maxlength="20">
            <input type="hidden" id="targetpage" value="0">
            <input type="hidden" id="pageCount" value="1">
            <input type="hidden" id="currOderId" value="">
        </form>
        <!-- <div class="datepicker">
            <ul id="" class="d-flex justify-content-between fastDate mb-3">
                <li class="item">
                    <a href="">
                        <p>今日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="">
                        <p>昨日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="">
                        <p>本周</p>
                    </a>
                </li>
                <li class="item">
                    <a href="">
                        <p>上周</p>
                    </a>
                </li>
            </ul>
            <div class="datepickerInput d-flex justify-content-center">
                <input id="past_datepic" class="text-center" type="text"
                    onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm'});"
                    value="<?php $d=strtotime("-1 day");echo date("Y-m-d h:i", $d)  ?>">~
                <input id="now_datepic" class="text-center" type="text"
                    onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm'});"
                    value="<?php echo date("Y-m-d h:i")?>">
                    &emsp;<input class="text-center" type="button" value="搜寻">
            </div>
        </div> -->

        <div id="tabinner" class="tabinner">
            <h4 class="dateTitle text-center"><?php  echo date("Y-m-d")?></h4>
                <table class="MMain"  cellspacing="0">
                    <thead>
                        <tr class="title_tr">
                            <th width="22%">日期</th>
                            <th width="29%">下注金额</th>
                            <th width="29%">有效投注</th>
                            <th width="20%">结果</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr >
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time1"]); ?>"><?php echo ($arr["time1"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_today_result"]; ?></td>
                            <td><?php echo $arr2["live_today_result"]; ?></td>
                            <td><?php echo $arr3["live_today_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time2"]); ?>"><?php echo ($arr["time2"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day1_result"]; ?></td>
                            <td><?php echo $arr2["live_day1_result"]; ?></td>
                            <td><?php echo $arr3["live_day1_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time3"]); ?>"><?php echo ($arr["time3"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day2_result"]; ?></td>
                            <td><?php echo $arr2["live_day2_result"]; ?></td>
                            <td><?php echo $arr3["live_day2_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time4"]); ?>"><?php echo ($arr["time4"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day3_result"]; ?></td>
                            <td><?php echo $arr2["live_day3_result"]; ?></td>
                            <td><?php echo $arr3["live_day3_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time5"]); ?>"><?php echo ($arr["time5"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day4_result"]; ?></td>
                            <td><?php echo $arr2["live_day4_result"]; ?></td>
                            <td><?php echo $arr3["live_day4_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-2 pb-2">
                                <a class="pagelink"
                                    href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time6"]); ?>"><?php echo ($arr["time6"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day5_result"]; ?></td>
                            <td><?php echo $arr2["live_day5_result"]; ?></td>
                            <td><?php echo $arr3["live_day5_result"]; ?></td>
                        </tr>
                        <tr >
                            <td class="pt-2 pb-2">
                                <a class="pagelink" href="/?r=mobile/live/live-detail&time=<?php echo ($arr["time7"]); ?>"><?php echo ($arr["time7"]); ?></a>
                            </td>
                            <td><?php echo $arr1["live_day6_result"]; ?></td>
                            <td><?php echo $arr2["live_day6_result"]; ?></td>
                            <td><?php echo $arr3["live_day6_result"]; ?></td>
                        </tr>
                        <tr>
                            <td class="pt-3 pb-">总计</td>
                            <td><?php echo ($arr["bet_money_total"]); ?></td>
                            <td><?php echo ($arr["val_money_total"]); ?></td>
                            <td><?php echo ($arr["bet_win_total"]); ?></td>
                        </tr> 
                    </tbody>
      

                </table>
                <div style="height: 100px;"></div>



        </div>

</main>
<script>
    // 控制member_top的tab
    $(function () {
        $('#finance .financeitem').eq(2).addClass('act').siblings().removeClass('act');
    });
</script>