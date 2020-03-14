<?php

use yii\widgets\LinkPager;
$type=isset($_GET['type']) ? $_GET['type'] : 'D3';
$time = isset($_GET['time']) ? $_GET['time'] : date('Y-m-d');
?>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include Yii::$app->basePath.'/modules/general/mobile/views/financial/member_top.php'?>
    <div class="charge report">
        <form id="historyForm" class="historyForm">
            <select class="pt-2 pb-2" name="trantype" onchange="lx(this.value);">
                <option value="4">彩票投注记录</option>
                <option value="2">盈利统计记录</option>
                <option value="3">视讯直播记录</option>
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
                    <a href="/?r=mobile/lottery/lottery-one&time=<?= date('Y-m-d',strtotime('-0 day'))?>&type=<?= $type?>">
                        <p>今日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="/?r=mobile/lottery/lottery-one&time=<?= date('Y-m-d',strtotime('-1 day'))?>&type=<?= $type?>">
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
        <!-- <div id="MACenterContent"> -->
            <!-- <div style="width:100%; height: 24px; margin: 50px auto 0px; color: #333333; font-size: 28px; text-align: center;">
                <span class="jiaoyi"><?php echo $arr1["time"]; ?>--<?= $arr1['type'] ?></span>
            </div> -->
            <h2 class="gameType"><?= $arr1['type'] ?></h2>
            <h4 class="dateTitle text-center"><?php  echo $arr1["time"];?></h4>
            <table class="MMain lotteryjilu">
                <thead>
                <tr class="title_tr">
                    <th>期号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>反水</th>
                    <th>赔率</th>
                    <th>结果</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody id="general-msg">
                <?php
                if ($arr1['result'] != 1) {
                    foreach ($arr2 as $key => $value) {
                        ?>
                        <tr >
                            <td ><?= $value['qishu'] ?></td>
                            <td  ><?= $value['contentName'] ?></td>
                            <td  ><?= $value['bet_money_one'] ?></td>
                            <td  ><?= $value['fs'] ?></td>
                            <td  ><?= $value['bet_rate'] ?></td>
                            <td  ><?= $value['money_result'] ?></td>
                            <td ><?= $value['status_result'] ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">暂时没有下注信息。</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <?php
                if($arr1['result'] != 1){
                    ?>
                    <tfoot id="msgfoot">
                    <tr><td colspan='7' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
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

