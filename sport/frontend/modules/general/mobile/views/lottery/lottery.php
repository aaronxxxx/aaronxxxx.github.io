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
                <option value="4">彩票投注记录</option>
                <option value="3">视讯直播记录</option>
                <option value="5">金额交易记录</option>
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
        </div>-->

        <div id="tabinner" class="tabinner text-center">
            <h4 class="dateTitle text-center"><?php echo $arr1["time"]; ?></h4>
            <table class="MMain" cellspacing="0">
                <thead>
                    <tr class="title_tr">
                        <th style="width: 20%">游戏名称</th>
                        <th style="width: 30%">下注金额</th>
                        <th style="width: 30%">未结算金额</th>
                        <th style="width: 20%">结果</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-lhc&time=<?php echo ($arr1["time"]); ?>&type=LT">六合彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["lhc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["lhc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["lhc"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-splhc&time=<?php echo ($arr1["time"]); ?>&type=LT">极速六合彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["splhc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["splhc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["splhc"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=D3">3D彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["d3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["d3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["d3"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=P3">排列三</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["p3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["p3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["p3"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=T3">上海时时乐</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["t3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["t3"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["t3"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=CQ">重庆时时彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["cq"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["cq"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["cq"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TJ">极速时时彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["tj"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["tj"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["tj"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GXSF">广西十分彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["gxsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["gxsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["gxsf"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GDSF">广东十分彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["gdsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["gdsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["gdsf"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TJSF">天津十分彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["tjsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["tjsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["tjsf"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=CQSF">重庆十分彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["cqsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["cqsf"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["cqsf"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=BJKN">北京快乐8</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["bjkn"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["bjkn"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["bjkn"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=GD11">广东十一选五</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["gd11"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["gd11"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["gd11"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=BJPK">北京PK拾</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["bjpk"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["bjpk"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["bjpk"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=SSRC">极速赛车</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["ssrc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["ssrc"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["ssrc"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=MLAFT">幸运飞艇</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["mlaft"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["mlaft"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["mlaft"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=TS">腾讯分分彩</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["ts"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["ts"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["ts"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2"><a  class="pagelink" href="/?r=mobile/lottery/lottery-one&time=<?php echo ($arr1["time"]); ?>&type=ORPK">老PK拾</a></td>
                        <td class="pt-2 pb-2"><?php echo ($arr1["orpk"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr2["orpk"]); ?></td>
                        <td class="pt-2 pb-2"><?php echo ($arr3["orpk"]); ?></td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2">总计</td>
                        <td class="pt-2 pb-2" ><?php echo ($arr1["sum"]); ?></td>
                        <td class="pt-2 pb-2" ><?php echo ($arr2["sum"]); ?></td>
                        <td class="pt-2 pb-2" ><?php echo ($arr3["sum"]); ?></td>
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
