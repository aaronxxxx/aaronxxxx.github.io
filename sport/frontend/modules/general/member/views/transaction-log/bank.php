<?php

use yii\widgets\LinkPager;

?>
<div id="MACenterContent">
    <div class="MNav">
        <span class="mbtn" onclick="chgType('liveHistory');">视讯直播</span>
        <span class="mbtn" onclick="chgType('skRecord');">彩票</span>
        <span class="mbtn" onclick="chgType('moneylog');">盈利统计</span>
        <span class="mbtn active" onclick="chgType('cqRecord');">存取款记录</span>
    </div>
    <div id="MMainData" class="pay_cont">
        <div class="title_box">
            <div class="title_date">
                <input type="text" value="<?= date('Y-m-d', strtotime('-6 day')) ?>" readonly>
                <span></span>
                <input type="text" value="<?= date('Y-m-d') ?>" readonly="readonly" />
            </div>
        </div>
        <div>
            <ul class="all_link_box">
                <li class="w25">
                    <input type="button" class="d-btn btn_color" data-target="ck" value="在线存款记录" onclick="cx('ck')" />
                    <span class="down_icon"></span>
                </li>
                <li class="w25">
                    <input type="button" class="d-btn" data-target="hk" value="汇款记录" onclick="cx('hk')" />
                    <span></span>
                </li>
                <li class="w25">
                    <input type="button" class="d-btn" data-target="qk" value="取款记录" onclick="cx('qk')" />
                    <span></span>
                </li>
            </ul>
        </div>
        <div class="main_box">
            <div class="record_box pad_top20">
                <?php
                if ($arr1['type'] == '') {
                ?>
                    <table class="rwd-table">
                        <tr>
                            <th>存款流水号</th>
                            <th>存款时间</th>
                            <th>存款金额</th>
                            <th>存款状态</th>
                            <th>备注</th>
                        </tr>
                        <?php
                        if ($arr1['order_num'] != '') {
                            foreach ($arr as $key => $value) {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="存款流水号"><?= $value['order_num'] ?></td>
                                    <td data-th="存款时间"><?= $value['update_time'] ?></td>
                                    <td data-th="存款金额"><?= $value['order_value'] ?></td>
                                    <td data-th="存款状态"><?= $value['statusString'] ?></td>
                                    <td data-th="备注"><?= $value['about'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="table_cont">
                                <td colspan="5">暂无在线存款信息。</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if ($arr1['order_num'] != '') {
                        ?>
                            <tr>
                                <td colspan='5'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else if ($arr1['type'] == 'hk') {
                ?>
                    <table class="rwd-table">
                        <tr>
                            <th>汇款流水号</th>
                            <th>汇款时间</th>
                            <th>汇款金额</th>
                            <th>汇款银行</th>
                            <th>汇款方式</th>
                            <th>汇款状态</th>
                        </tr>
                        <?php
                        if ($arr1['order_num'] != '') {
                            foreach ($arr as $key => $value) {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="汇款流水号"><?= $value["order_num"]; ?></td>
                                    <td data-th="汇款时间"><?= $value["update_time"]; ?></td>
                                    <td data-th="汇款金额"><?= $value["order_value"]; ?></td>
                                    <td data-th="汇款银行"><?= $value["pay_card"]; ?></td>
                                    <td data-th="汇款方式"><?= $value["manner"]; ?></td>
                                    <td data-th="汇款状态"><?= $value["status"]; ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="table_cont">
                                <td colspan="6">暂无汇款信息。</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if ($arr1['order_num'] != '') {
                        ?>
                            <tr>
                                <td colspan='6'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else if ($arr1['type'] == 'qk') {
                ?>
                    <table class="rwd-table">
                        <tr>
                            <th>取款流水号</th>
                            <th>取款时间</th>
                            <th>取款金额</th>
                            <th>取款状态</th>
                            <th>备注</th>
                        </tr>
                        <?php
                        if ($arr1['order_num'] != '') {
                            foreach ($arr as $key => $value) {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="取款流水号"><?= $value["order_num"]; ?></td>
                                    <td data-th="取款时间"><?= $value["update_time"]; ?></td>
                                    <td data-th="取款金额"><?= $value["order_value"]; ?></td>
                                    <td data-th="取款状态"><?= $value["status"]; ?></td>
                                    <td data-th="备注"><?= $value["about"]; ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="table_cont">
                                <td colspan="5">暂无取款信息。</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if ($arr1['order_num'] != '') {
                        ?>
                            <tr>
                                <td colspan='5'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <table class="rwd-table">
                        <tr>
                            <th>订单号</th>
                            <th>游戏类型</th>
                            <th>转账类型</th>
                            <th>转账金额</th>
                            <th>更新时间</th>
                            <th>结果反馈</th>
                        </tr>
                        <?php
                        if ($arr1['order_num'] != '') {
                            foreach ($arr as $key => $value) {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="订单号"><?= $value['order_num'] ?></td>
                                    <td data-th="游戏类型"><?= $value['live_type'] ?></td>
                                    <td data-th="转账类型"><?= $value['zz_type'] ?></td>
                                    <td data-th="转账金额"><?= $value['zz_money'] ?></td>
                                    <td data-th="更新时间"><?= $value['do_time'] ?></td>
                                    <td data-th="结果反馈"><?= $value['result'] ?></td>
                                    <!--<td id="<?= $value['id'] ?>" style="text-align:center;width: 200px;"><?= $value['result'] . $value['cancel_button'] ?></td>-->
                                </tr>
                            <?php
                            }
                            ?>
                            <?php /*
                            <tr class="table_cont">
                                <td colspan="3">
                                    AG极速厅成功转入|转出：<?= $arr1['in_ag_total'] ?> | <?= $arr1['out_ag_total'] ?>
                                </td>
                                <td colspan="3">
                                    AG国际厅成功转入|转出：<?= $arr1['in_agin_total'] ?> | <?= $arr1['out_agin_total'] ?>
                                </td>
                            </tr>
                            <tr class="table_cont">
                                <td colspan="3">
                                    AG_BBIN厅成功转入|转出：<?= $arr1['in_ag_bbin_total'] ?> | <?= $arr1['out_ag_bbin_total'] ?>
                                </td>
                                <td colspan="3">
                                    DS厅成功转入|转出：<?= $arr1['in_ds_total'] ?> | <?= $arr1['out_ds_total'] ?>
                                </td>
                            </tr>
                            <tr class="table_cont">
                                <td colspan="3">
                                    AG_MG厅成功转入|转出：<?= $arr1['in_ag_mg_total'] ?> | <?= $arr1['out_ag_mg_total'] ?>
                                </td>
                                <td colspan="3">
                                    OG厅成功转入|转出：<?= $arr1['in_og_total'] ?> | <?= $arr1['out_og_total'] ?>
                                </td>
                            </tr>
                            <tr class="table_cont">
                                <td colspan="3">
                                    KG厅成功转入|转出：<?= $arr1['in_kg_total'] ?> | <?= $arr1['out_kg_total'] ?>
                                </td>
                                <td colspan="3">
                                    VR厅成功转入|转出：<?= $arr1['in_vr_total'] ?> | <?= $arr1['out_vr_total'] ?>
                                </td>
                            </tr>
                            */ ?>
                        <?php
                        } else {
                        ?>
                            <tr class="table_cont">
                                <td colspan="6">暂无账转信息。</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if ($arr1['order_num'] != '') {
                        ?>
                            <tr>
                                <td colspan='6'><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myrecord');

    $(window).on('load', function() {
        $("#MMainData .all_link_box li").each(function() {
            var target = $(this).find('.d-btn');
            var _href = window.location.href.split('bank&type=', 2);
            var href = _href[1];
            if (target.attr("data-target") == href) {
                $('.d-btn').removeClass('btn_color');
                $('.d-btn[data-target="' + href + '"]').addClass('btn_color');
                $('.d-btn[data-target="' + href + '"]').parent('li').siblings().find('span').removeClass('down_icon');
                $('.d-btn[data-target="' + href + '"]').siblings().addClass('down_icon');

            } else {}
        })
    })
</script>