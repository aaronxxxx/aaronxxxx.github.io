<?php

use yii\widgets\LinkPager;
?>
<body>
    <div class="pro_title pd10">
        代理管理：代理存取款报表信息
    </div>
    <div id="pageMain" >
        <div class="pd10">
            <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/cqk/index">日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
                ~
                <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
                &nbsp;&nbsp;
                <input type="button" value="今日" onclick="setDate('today')">
                <input type="button" value="昨日" onclick="setDate('yesterday')">
                <input type="button" value="本周" onclick="setDate('thisWeek')">
                <input type="button" value="上周" onclick="setDate('lastWeek')">
                <input type="button" value="本月" onclick="setDate('thisMonth')">
                <input type="button" value="上月" onclick="setDate('lastMonth')">
                <input type="button" value="最近7天" onclick="setDate('lastSeven')">
                <input type="button" value="最近30天" onclick="setDate('lastThirty')">
                <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                    <option value="" selected="">选择月份</option>
                    <option value="1">1月</option>
                    <option value="2">2月</option>
                    <option value="3">3月</option>
                    <option value="4">4月</option>
                    <option value="5">5月</option>
                    <option value="6">6月</option>
                    <option value="7">7月</option>
                    <option value="8">8月</option>
                    <option value="9">9月</option>
                    <option value="10">10月</option>
                    <option value="11">11月</option>
                    <option value="12">12月</option>
                </select>
                <br>  <br>
                代理名：<input name="user_group" value="<?= $user_group; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                忽略代理名：<input name="user_ignore_group" value="<?= $user_ignore_group; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="gtype" type="hidden" id="gtype" value="">
                <input id="gridSearchBtn" type="button" name="Submit" value="搜索">
                <br><br>
                <span style="color: red;font-size: 14px;margin-left: 10px;">活动金额：在加款扣款界面，如果理由包含'用于活动'这四个字，那此次金额就属于活动金额，不算在盈利范围内。</span>
                <input id="sort_data" name="sort" type="hidden" size="15" value="<?=$sort?>" >
            </form>
        </div>
        <table width="100%" border="1" bgcolor="#FFFFFF" class="font13n dailis skintable" id=editProduct   idth="100%" >
            <tbody>
                <tr class="dailitr">
                    <td style="width: 15%" align="center" height="25"><strong>代理用户名</strong></td>
                    <td style="width: 15%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'hk_money;')){ ?>
                        <strong title="点击排序" onclick="setSort('hk_money;desc')">汇款金额</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'hk_money;desc') { ?>
                        <strong title="点击排序" onclick="setSort('hk_money;asc')">汇款金额</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'hk_money;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">汇款金额</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                    <td style="width: 15%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'ck_money;')){ ?>
                        <strong title="点击排序" onclick="setSort('ck_money;desc')">存款金额(排除活动金额)</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'ck_money;desc') { ?>
                        <strong title="点击排序" onclick="setSort('ck_money;asc')">存款金额(排除活动金额)</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'ck_money;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">存款金额(排除活动金额)</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                    <td style="width: 15%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'tk_money;')){ ?>
                        <strong title="点击排序" onclick="setSort('tk_money;desc')">取款金额(排除活动金额)</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'tk_money;desc') { ?>
                        <strong title="点击排序" onclick="setSort('tk_money;asc')">取款金额(排除活动金额)</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'tk_money;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">取款金额(排除活动金额)</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                    <td style="width: 14%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'win_money;')){ ?>
                        <strong title="点击排序" onclick="setSort('win_money;desc')">合计盈利(排除活动金额)</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'win_money;desc') { ?>
                        <strong title="点击排序" onclick="setSort('win_money;asc')">合计盈利(排除活动金额)</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'win_money;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">合计盈利(排除活动金额)</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                    <td style="width: 13%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'ck_money_ht;')){ ?>
                        <strong title="点击排序" onclick="setSort('ck_money_ht;desc')">后台加钱(用于活动)</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'ck_money_ht;desc') { ?>
                        <strong title="点击排序" onclick="setSort('ck_money_ht;asc')">后台加钱(用于活动)</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'ck_money_ht;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">后台加钱(用于活动)</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                    <td style="width: 13%" align="center">
                    <?php if(empty($sort) || !strstr($sort,'tk_money_ht;')){ ?>
                        <strong title="点击排序" onclick="setSort('tk_money_ht;desc')">后台扣钱(用于活动)</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'tk_money_ht;desc') { ?>
                        <strong title="点击排序" onclick="setSort('tk_money_ht;asc')">后台扣钱(用于活动)</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'tk_money_ht;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">后台扣钱(用于活动)</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?></td>
                </tr>
                <?php
                if ($agents_list) {
                    foreach ($agents_list as $key => $value) {
                        ?>
                        <tr align="center" onmouseover="this.style.backgroundColor = '#EBEBEB'" onmouseout="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                            <td height="40" align="center" valign="middle">
                                <a title="" style="color: #F37605;" href="#/agent/cqk/child-list&id=<?= $value['id'] ?>&name=<?= $value['agents_name'] ?>&user_group=<?= $user_group?>&user_ignore_group=<?= $user_ignore_group?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><?= $value['agents_name'] ?></a>
                            </td>
                            <td align="center" valign="middle"><?= $value['hk_money'] ? $value['hk_money'] : 0 ?></td>
                            <td align="center" valign="middle"><?= $value['ck_money'] ? $value['ck_money'] : 0  ?></td>
                            <td align="center" valign="middle"><?= $value['tk_money']!=0.00 ? $value['tk_money'] : 0  ?></td>
                            <td align="center" valign="middle"><?= $value['win_money'] ? $value['win_money'] : 0  ?></td>
                            <td align="center" valign="middle"><?= $value['ck_money_ht'] ? $value['ck_money_ht'] : 0  ?></td>
                            <td align="center" valign="middle"><?= $value['tk_money_ht']!=0.00 ? $value['tk_money_ht'] : 0  ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                        <tr class="dailitr">
                            <td style="width: 15%" align="center" height="25"><strong>本页总计</strong></td>
                            <td style="width: 15%" align="center"><strong><?= $sumTotal['hk_money'] ?></strong></td>
                            <td style="width: 15%" align="center"><strong><?= $sumTotal['ck_money'] ?></strong></td>
                            <td style="width: 15%" align="center"><strong><?= $sumTotal['tk_money'] ?></strong></td>
                            <td style="width: 14%" align="center"><strong><?= $sumTotal['win_money'] ?></strong></td>
                            <td style="width: 13%" align="center"><strong><?= $sumTotal['ck_money_ht'] ?></strong></td>
                            <td style="width: 13%" align="center"><strong><?= $sumTotal['tk_money_ht'] ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="7"><?php
if ($agents_list) {
echo LinkPager::widget(['pagination' => $pages]);
}
?></td>
                        </tr>
            </tbody>
        </table>


    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>
<script>
                    function setSort(sortdata) {

                        $("#sort_data").val(sortdata);

                        location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
                    }
</script>