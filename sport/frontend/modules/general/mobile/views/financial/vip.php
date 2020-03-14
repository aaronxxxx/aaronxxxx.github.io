<?php
use yii\widgets\LinkPager;
?>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include 'member_top.php'?>
    <div class="charge report">
        <form id="historyForm" class="historyForm">
            <select name="trantype" onchange="lx(this.value);">
                <option value="5">金额交易记录</option>
            </select>
            <div class="h_tg"></div>
            <input type="hidden" readonly="" class="subdate hasDatepicker" value="2016-01-23 00:00:00" onclick="seleCalendar(this);" id="beginDate" size="20" maxlength="20">
            <input type="hidden" readonly="" class="subdate hasDatepicker" value="2016-02-22 23:59:59" onclick="seleCalendar(this);" id="endDate" size="20" maxlength="20">
            <input type="hidden" id="targetpage" value="0">
            <input type="hidden" id="pageCount" value="1">
            <input type="hidden" id="currOderId" value="">
        </form>
        <ul id="cx_tab" class="tab d-flex justify-content-between">
            <li class="chargeitem">
                <a onclick="cx('ck');">
                    <div class="chargeitemInner text-center">存款记录</div>
                </a>
            </li>
            <li class="chargeitem">
                <a onclick="cx('hk');">
                    <div class="chargeitemInner text-center">汇款记录</div>
                </a>
            </li>
            <li class="chargeitem">
                <a onclick="cx('qk');">
                    <div class="chargeitemInner text-center">提款记录</div>
                </a>
            </li>
        </ul>
        <!-- <div class="datepicker">
            <ul class="d-flex justify-content-between fastDate mb-3">
                <li class="item">
                    <a href=""><p>今日</p></a>
                </li>
                <li class="item">
                    <a href=""><p>昨日</p></a>
                </li>
                <li class="item">
                    <a href=""><p>本周</p></a>
                </li>
                <li class="item">
                    <a href=""><p>上周</p></a>
                </li>
            </ul>
            <div class="datepickerInput d-flex justify-content-center">
                <input id="past_datepic" class="text-center" type="text" onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php $d=strtotime("-1 day");echo date("Y-m-d h:i", $d)  ?>">~
                <input id="now_datepic" class="text-center" type="text" onclick="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo date("Y-m-d h:i")?>">
                &emsp;<input class="text-center" type="button" value="搜寻">
            </div>
        </div> -->

        <div id="tabinner" class="tabinner">
            <!-- <h4 class="dateTitle text-center"><?php  echo date("Y-m-d")?></h4> -->
        <?php
            if ($arr1['type'] == '') {?>

                <table class="MMain" cellspacing="0">
                    <thead>
                    <tr class="title_tr">
                        <th>存款流水号</th>
                        <th>存款时间</th>
                        <th>存款金额</th>
                        <th>存款状态</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody id="general-msg">
                    <?php
                    if ($arr1['order_num'] != '') {
                        foreach ($arr as $key => $value) {
                            ?>
                            <tr>
                                <td style="text-align:center;"><?= $value['order_num'] ?></td>
                                <td style="text-align:center;"><?= $value['update_time'] ?></td>
                                <td style="text-align:center;"><?= $value['order_value'] ?></td>
                                <td style="text-align:center;"><?= $value['statusString'] ?></td>
                                <td style="text-align:center;"><?= $value['about'] ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">暂无在线存款信息。</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <?php
                    if ($arr1['order_num'] != '') {
                        ?>
                        <tfoot id="msgfoot" >
                        <tr><td colspan='5' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                </table>
                <!-- 存款记录按钮效果 -->
                <script>$('.chargeitem').eq(0).addClass('act');</script>
                <?php } else if ($arr1['type'] == 'hk') { ?>
                <table class="MMain" cellspacing="0">
                    <thead>
                    <tr class="title_tr">
                        <th width="23%">汇款流水号</th>
                        <th width="20%">汇款时间</th>
                        <th width="10%">汇款金额</th>
                        <th width="10%">汇款银行</th>
                        <th width="27%">汇款方式</th>
                        <th width="10%">汇款状态</th>
                    </tr>
                    </thead>
                    <tbody id="general-msg">
                    <?php
                    if ($arr1['order_num'] != '') {
                        foreach ($arr as $key => $value) {
                            ?>
                            <tr>
                                <td><?= $value["order_num"]; ?></td>
                                <td><?= $value["update_time"]; ?></td>
                                <td><?= $value["order_value"]; ?></td>
                                <td><?= $value["pay_card"]; ?></td>
                                <td><?= $value["manner"]; ?></td>
                                <td><?= $value["status"]; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">暂无汇款信息。</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <?php
                    if ($arr1['order_num'] != '') {
                        ?>
                        <tfoot id="msgfoot" >
                        <tr><td colspan='6' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                </table>
                   <!-- 汇款记录按钮效果 -->
                   <script>$('.chargeitem').eq(1).addClass('act');</script>
                <?php } else if ($arr1['type'] == 'qk') {?>
                <table class="MMain" cellspacing="0">
                    <thead>
                    <tr class="title_tr">
                        <th>取款流水号</th>
                        <th>取款时间</th>
                        <th>取款金额</th>
                        <th>取款状态</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody id="general-msg">
                    <?php
                    if ($arr1['order_num'] != '') {
                        foreach ($arr as $key => $value) {
                            ?>
                            <tr>
                                <td><?= $value["order_num"]; ?></td>
                                <td><?= $value["update_time"]; ?></td>
                                <td><?= $value["order_value"]; ?></td>
                                <td><?= $value["status"]; ?></td>
                                <td><?= $value['about'] ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">暂无取款信息。</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <?php
                    if ($arr1['order_num'] != '') {
                        ?>
                        <tfoot id="msgfoot" >
                        <tr><td colspan='5' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                </table>
                   <!-- 提款记录按钮效果 -->
                   <script>$('.chargeitem').eq(2).addClass('act');</script>
                <?php } else {?>
                <table class="MMain" cellspacing="0">
                    <thead>
                    <tr class="title_tr">
                        <th wifth="24%">订单号</th>
                        <th wifth="15%">游戏类型</th>
                        <th wifth="13%">转账类型</th>
                        <th wifth="13%">转账金额</th>
                        <th wifth="22%">更新时间</th>
                        <th wifth="13%">结果反馈</th>
                    </tr>
                    </thead>
                    <tbody id="general-msg">
                    <?php
                    if ($arr1['order_num'] != '') {
                        foreach ($arr as $key => $value) {
                            ?>
                            <tr id="myrefreshtr">
                                <td style="text-align:center;width: 150px;"><?= $value['order_num'] ?></td>
                                <td style="text-align:center;width: 100px;"><?= $value['live_type'] ?></td>
                                <td style="text-align:center;width: 150px;"><?= $value['zz_type'] ?></td>
                                <td style="text-align:center;width: 100px;"><?= $value['zz_money'] ?></td>
                                <td style="text-align:center;width: 150px;"><?= $value['do_time'] ?></td>
                                <td style="text-align:center;width: 200px;"><?= $value['result']?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                AG极速厅成功转入|转出：<?= $arr1['in_ag_total'] ?> | <?= $arr1['out_ag_total'] ?>
                            </td>
                            <td colspan="3" style="text-align:center;">
                                AG国际厅成功转入|转出：<?= $arr1['in_agin_total'] ?> | <?= $arr1['out_agin_total'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                AG BBIN厅成功转入|转出：<?= $arr1['in_ag_bbin_total'] ?> | <?= $arr1['out_ag_bbin_total'] ?>
                            </td>
                            <td colspan="3" style="text-align:center;">
                                DS厅成功转入|转出：<?= $arr1['in_ds_total'] ?> | <?= $arr1['out_ds_total'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                MG厅成功转入|转出：<?= $arr1['in_mg_total'] ?> | <?= $arr1['out_mg_total'] ?>
                            </td>
                            <td colspan="3" style="text-align:center;">
                                OG厅成功转入|转出：<?= $arr1['in_og_total'] ?> | <?= $arr1['out_og_total'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                KG厅成功转入|转出：<?= $arr1['in_kg_total'] ?> | <?= $arr1['out_kg_total'] ?>
                            </td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">暂无账转信息。</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <?php
                    if ($arr1['order_num'] != '') {
                        ?>
                        <tfoot id="msgfoot" >
                        <tr><td colspan='6' style='text-align:center;'><?= LinkPager::widget(['pagination' => $pages]); ?></td></tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                </table>
                   <!-- 转账记录按钮效果 -->
                   <script>$('.chargeitem').eq(3).addClass('act');</script>
                <?php }?>
        </div>
































        </div>
    </div>

</main>
<script>
// 控制member_top的tab
$(function(){
    $('#finance .financeitem').eq(2).addClass('act').siblings().removeClass('act');
});
</script>