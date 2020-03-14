<?php
// use yii\widgets\LinkPager;
$data=explode("=", $_SERVER['QUERY_STRING']);
?>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include Yii::$app->basePath.'/modules/general/mobile/views/financial/member_top.php'?>
    <div class="charge report">
        <form id="historyForm" class="historyForm">
            <select class="pt-2 pb-2" name="trantype" onchange="lx(this.value);">
                <option value="4">视讯直播记录</option>
                <option value="2">盈利统计记录</option>
                <option value="3">彩票投注记录</option>
                <option value="5">金额交易记录</option>
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
        <div class="datepicker">
            <ul id="" class="d-flex justify-content-between fastDate mb-3">
                <li class="item">
                    <a href="/?r=mobile/live/live-detail&time=<?php  echo date("Y-m-d")?>">
                        <p>今日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="/?r=mobile/live/live-detail&time=<?php  echo date("Y-m-d",strtotime("-1 day"))?>">
                        <p>昨日</p>
                    </a>
                </li>
                <!-- <li class="item">
                    <a href="">
                        <p>本周</p>
                    </a>
                </li>
                <li class="item">
                    <a href="">
                        <p>上周</p>
                    </a>
                </li> -->
            </ul>
            <!-- <div class="datepickerInput d-flex justify-content-center">
                <input id="past_datepic" class="text-center" type="text"
                    onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm'});"
                    value="<?php $d=strtotime("-1 day");echo date("Y-m-d h:i", $d)  ?>">~
                <input id="now_datepic" class="text-center" type="text"
                    onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm'});"
                    value="<?php echo date("Y-m-d h:i")?>">
                    &emsp;<input class="text-center" type="button" value="搜寻">
            </div> -->
        </div>

        <div id="tabinner" class="tabinner">
            <h4 class="dateTitle text-center"><?php echo $data[2]; ?></h4>
            <table class="MMain" cellspacing="0">
            <thead>
                <tr class="title_tr">
                    <th style="width: 20%;font-size: 18px;">订单号</th>
                    <th style="width: 20%;font-size: 18px;">游戏类型</th>
                    <th style="width: 20%;font-size: 18px;">投注内容</th>
                    <th style="width: 10%;font-size: 18px;">投注金额</th>
                    <th style="width: 10%;font-size: 18px;">有效投注</th>
                    <th style="width: 10%;font-size: 18px;">输赢结果</th>
                    <th style="width: 10%;font-size: 18px;">游戏平台</th>
                </tr>
            </thead>
            <tbody id="general-msg">
                <?php
                if ($arr['result'] != 1) {
                    foreach ($arr2 as $key => $rows) {
                        ?>
                        <tr>
                            <td style="text-align:center;width: 20%;padding-left: 0px;padding-right: 0px;font-size: 12px;"><?= $rows['order_num'] ?></td>
                            <td style="text-align:center;width: 20%;padding-left: 2px;padding-right: 2px;font-size: 12px;"><?= $rows['live_type'] ?></td>
                            <td style="text-align:center;width: 20%;padding-left: 2px;padding-right: 2px;font-size: 12px;"><?= $rows['bet_info'] ?></td>
                            <td style="text-align:center;width: 10%;padding-left: 2px;padding-right: 2px;font-size: 12px;"><?= $rows['bet_money'] ?></td>
                            <td style="text-align:center;width: 10%;padding-left: 2px;padding-right: 2px;font-size: 12px;"><?= $rows['valid_bet_amount'] ?></td>
                            <td style="text-align:center;width: 10%;padding-left: 2px;padding-right: 2px;font-size: 12px;"><?= $rows['live_win'] ?></td>
                            <td style="text-align:center;width: 10%;padding-left: 0px;padding-right: 0px;font-size: 12px;"><?= $rows['game_type'] ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                <td colspan="10" style="text-align:center;">暂时没有下注信息。</td>        
                <?php
            }
            ?>
            </tbody>
            <?php
            if ($arr['result'] != 1) {
                ?>
            <tfoot id="msgfoot">
                <tr><td colspan='10' style='text-align:center;'><?= $page_list?></td></tr>
            </tfoot>
            <?php
            }
            ?>
            
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