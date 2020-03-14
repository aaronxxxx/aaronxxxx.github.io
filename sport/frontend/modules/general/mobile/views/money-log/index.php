<?php
use yii\widgets\LinkPager;
?>
<style>
.picker{font-size:24px;}
</style>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include Yii::$app->basePath.'/modules/general/mobile/views/financial/member_top.php'?>
    <div class="charge report">
        <form id="historyForm" class="historyForm">
            <select class="pt-2 pb-2" name="trantype" onchange="lx(this.value);">
                <option value="2">盈利统计记录</option>
                <option value="3">视讯直播记录</option>
                <option value="5">金额交易记录</option>
                <option value="4">彩票投注记录</option>
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
            <ul id="dateBtn" class="d-flex justify-content-between fastDate mb-3">
                <li class="item">
                    <a href="/?r=mobile/money-log/index&s_time=<?php echo date("Y-m-d") ?>">
                        <p>今日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="/?r=mobile/money-log/index&s_time=<?php echo date("Y-m-d", strtotime('-1 day')) ?>&e_time=<?php echo date("Y-m-d", strtotime('-1 day')) ?>">
                        <p>昨日</p>
                    </a>
                </li>
                <li class="item">
                    <a href="/?r=mobile/money-log/index&s_time=<?php echo date("Y-m-d", strtotime("last sunday")) ?>&e_time=<?php echo date("Y-m-d" )?>">
                        <p>本周</p>
                    </a>
                </li>
                <li class="item">
                    <a href="/?r=mobile/money-log/index&s_time=<?php echo date("Y-m-d", strtotime('-2 sunday')) ?>&e_time=<?php echo date("Y-m-d", strtotime('-1 saturday')) ?>">
                        <p>上周</p>
                    </a>
                </li>
            </ul>
            <div class="datepickerInput d-flex justify-content-center">
                <input id="past_datepic" class="text-center" type="text" value="<?= $time['s_time']?>">~
                <input id="now_datepic" class="text-center" type="text" value="<?= $time['e_time']?>">
                    &emsp;
                <input class="text-center" type="button" value="搜寻" onclick="data_search();">
            </div>
        </div>
        <div id="tabinner" class="tabinner">
            <h4 id="dataTitle" class="dateTitle text-center">
                <?php 
                    if ($time['s_time'] === $time['e_time']){ // 當天的數據
                        echo $time['s_time']; 
                    }else{                                                    // 日期區間
                        echo $time['s_time'].' ~ '.$time['e_time']; 
                    }
                ?>
            </h4>
            <table class="MMain text-center" cellspacing="0">
                <thead>
                    <tr class="title_tr">
                        <th style="width: 20%">游戏名称</th>
                        <th style="width: 30%">有效投注</th>
                        <th style="width: 30%">盈利金额</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td class="pt-2 pb-2">电子视讯盈利</td>
                        <td class="pt-2 pb-2"><?php echo ($live['val_money_total']); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($live["win_total"]); ?></td>
                    </tr>
                    <tr >
                        <td class="pt-2 pb-2">六合盈利</td>
                        <td class="pt-2 pb-2"><?php echo ($six['bet_money_total']); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($six['profit']); ?></td>
                    </tr>
                    <tr >
                        <td class="pt-2 pb-2">极速六合盈利</td>
                        <td class="pt-2 pb-2"><?php echo ($spsix['bet_money_total']); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($spsix['profit']); ?></td>
                    </tr>
                    <tr >
                        <td class="pt-2 pb-2">彩票盈利</td>
                        <td class="pt-2 pb-2"><?php echo ($lottery['allMoney']); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($lottery['winMoney']); ?></td>
                    </tr>
                    <!-- <tr >
                        <td class="pt-2 pb-2">合计总盈利</td>
                        <td class="pt-2 pb-2"><?php echo ($live['val_money_total']+$six['bet_money_total']+$spsix['bet_money_total']+$lottery['allMoney']); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($live["win_total"]+$six['profit']+$spsix['profit']+$lottery['winMoney']); ?></td>
                    </tr> -->
                </tbody>
            </table>
            <div style="height: 100px;"></div>


        </div>
       
</main>
<script>
    $(function () {
        $('#finance .financeitem').eq(2).addClass('act').siblings().removeClass('act');
        $('#past_datepic').pickadate({
            monthsFull: [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月' ],
            monthsShort: [ '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二' ],
            weekdaysShort: [ '日', '一', '二', '三', '四', '五', '六' ],
            today: '今天',
            clear: '清除',
            close: '关闭',
            format:'yyyy-mm-dd',
        });
        $('#now_datepic').pickadate({
            monthsFull: [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月' ],
            monthsShort: [ '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二' ],
            weekdaysShort: [ '日', '一', '二', '三', '四', '五', '六' ],
            today: '今天',
            clear: '清除',
            close: '关闭',
            format:'yyyy-mm-dd',
        });  
    });
    // 日期搜尋btn
    function data_search() {
        var s_time_str = $('#past_datepic').val(),
            e_time_str = $('#now_datepic').val();
            if(s_time_str == '' || e_time_str == '' ){
                alert('请填日期!')
            }
            window.location.href = '/?r=mobile/money-log/index&s_time='+ s_time_str +'&e_time=' +e_time_str;
    }
</script>