<?php
use yii\widgets\LinkPager;
?>
<body>
    <div class="pro_title pd10">
        代理管理：代理存取款报表信息
    </div>
    <div id="pageMain">
        <div class="pd10">
            <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/cqk/child-list" onsubmit="return check();">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="name" value="<?= $agent_name; ?>">
                <br>日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly"> 
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
                <br><br>
                代理名：<input name="user_group" value="<?= $user_group; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                忽略代理名：<input name="user_ignore_group" value="<?= $user_ignore_group; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="gtype" type="hidden" id="gtype" value="">
                <input id="gridSearchBtn" type="button" name="Submit" value="搜索">
                <br><br>
                <span style="color: red;font-size: 14px;margin-left: 10px;">活动金额：在加款扣款界面，如果理由包含'用于活动'这四个字，那此次金额就属于活动金额，不算在盈利范围内。</span>
            </form></div>
        <table width="100%" border="1" bgcolor="#FFFFFF" class="font13n dailis skintable" id="editProduct" idth="100%">       
            <tbody>
                <tr  class="t-title dailitr" align="center">
                    <td style="width: 13%" align="center"><strong>代理用户名</strong></td>
                    <td style="width: 13%" align="center" height="25"><strong>下属会员名</strong></td>
                    <td style="width: 13%" align="center"><strong>汇款金额</strong></td>
                    <td style="width: 13%" align="center"><strong>存款金额(排除活动金额)</strong></td>
                    <td style="width: 12%" align="center"><strong>取款金额(排除活动金额)</strong></td>
                    <td style="width: 12%" align="center"><strong>合计盈利(排除活动金额)</strong></td>
                    <td style="width: 12%" align="center"><strong>后台加钱(用于活动)</strong></td>
                    <td style="width: 12%" align="center"><strong>后台扣钱(用于活动)</strong></td>
                </tr>
                <?php
                if ($user_list) {
                    foreach ($user_list as $key => $value) {
                        ?>
                        <tr align="center" onmouseover="this.style.backgroundColor = '#EBEBEB'" onmouseout="this.style.backgroundColor = '#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                            <td height="40" align="center" valign="middle"><?= $value['agents_name'] ?></td>
                            <td height="40" align="center" valign="middle"><?= $value['user_name'] ?></td>
                            <td align="center" valign="middle"><?= $value['hk_money'] ?></td>
                            <td align="center" valign="middle"><?= $value['ck_money'] ?></td>
                            <td align="center" valign="middle"><?= -$value['qk_money'] ?></td>
                            <td align="center" valign="middle"><?= $value['win_money'] ?></td>
                            <td align="center" valign="middle"><?= $value['ck_money_hd'] ?></td>
                            <td align="center" valign="middle"><?= -$value['qk_money_hd'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td colspan="8"> <?php
                        if ($user_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?></td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>