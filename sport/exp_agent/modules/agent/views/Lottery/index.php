<?php

use yii\widgets\LinkPager;
?>
<body>
    <div class="pro_title pd10">
        代理管理：下屬會員lottery報表信息
        <a href="?r=agent/report/report-type&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一頁</span></a>

    </div>

    <div id="pageMain">
        <div class="flg pd10">
            <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="?r=agent/lottery/index" onsubmit="return check();">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">

                日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly"> 
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
                    <option value="" selected="">選擇月份</option>
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
                <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
            </form>
        </div>
        <table width="100%"  cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct>
            <tbody>
                <tr>
                    <td style="width: 16%" align="center" height="25"><strong>遊戲名稱</strong></td>
                    <td style="width: 21%" align="center"><strong>下注筆數</strong></td>
                    <td style="width: 21%" align="center"><strong>下注金額</strong></td>
                    <td style="width: 21%" align="center"><strong>下注結果</strong></td>
                    <td style="width: 21%" align="center"><strong>贏取金額</strong></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="3D彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=d3&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">3D彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['d3_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['d3_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['d3_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['d3_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="排列三" style="color: #F37605;" href="?r=agent/lottery/detail&type=p3&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">排列三</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['p3_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['p3_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['p3_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['p3_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="上海時時樂" style="color: #F37605;" href="?r=agent/lottery/detail&type=t3&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">上海時時樂</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['t3_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['t3_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['t3_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['t3_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="重慶時時彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=cq&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">重慶時時彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['cq_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cq_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cq_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cq_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="江西時時彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=jx&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">江西時時彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['jx_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['jx_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['jx_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['jx_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="天津時時彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=tj&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">天津時時彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['tj_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tj_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tj_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tj_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="廣西十分彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=gxsf&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">廣西十分彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['gxsf_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gxsf_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gxsf_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gxsf_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="廣東十分彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=gdsf&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">廣東十分彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['gdsf_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gdsf_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gdsf_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gdsf_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="天津十分彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=tjsf&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">天津十分彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['tjsf_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tjsf_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tjsf_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['tjsf_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="重慶十分彩" style="color: #F37605;" href="?r=agent/lottery/detail&type=cqsf&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">重慶十分彩</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['cqsf_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cqsf_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cqsf_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['cqsf_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="北京快樂8" style="color: #F37605;" href="?r=agent/lottery/detail&type=bjkn&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">北京快樂8</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['bjkn_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjkn_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjkn_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjkn_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="廣東十一選五" style="color: #F37605;" href="?r=agent/lottery/detail&type=gd11&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">廣東十一選五</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['gd11_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gd11_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gd11_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['gd11_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="北京PK拾" style="color: #F37605;" href="?r=agent/lottery/detail&type=bjpk&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">北京PK拾</a>
                    </td>
                    <td align="center" valign="middle"><?= $lottery_list['bjpk_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjpk_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjpk_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['bjpk_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">總計</td>
                    <td align="center" valign="middle"><?= $lottery_list['all_count']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['all_money']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['all_win']; ?></td>
                    <td align="center" valign="middle"><?= $lottery_list['all_result']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle" colspan="5">贏取金額=下注金額-下注結果。如果是正數，說明贏錢，如果是負數，則為輸錢。</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>