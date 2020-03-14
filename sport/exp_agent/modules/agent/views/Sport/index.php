<?php

use yii\widgets\LinkPager;
?>
<body>


    <div class="pro_title pd10">
        代理管理：下屬會員sport報表信息
        <a href="?r=agent/report/report-type&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">
            <span style="color:#ff9966;margin-left: 30px;">返回上一頁</span></a>
    </div>


    <div id="pageMain" align="center">
        <div class="flg pd10">
            <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="?r=agent/sport/index" onsubmit="return check();">
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

        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct   idth="100%" >
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
                        <a title="足球" style="color: #F37605;" href="?r=agent/sport/detail&type=ft&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">足球</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['ft_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['ft_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['ft_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['ft_win'] - $sport_list['ft_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="籃球" style="color: #F37605;" href="?r=agent/sport/detail&type=bk&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">籃球</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['bk_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bk_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bk_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bk_win'] - $sport_list['bk_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="網球" style="color: #F37605;" href="?r=agent/sport/detail&type=tn&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">網球</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['tn_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['tn_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['tn_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['tn_win'] - $sport_list['tn_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="排球" style="color: #F37605;" href="?r=agent/sport/detail&type=vl&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">排球</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['vl_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['vl_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['vl_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['vl_win'] - $sport_list['vl_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="棒球" style="color: #F37605;" href="?r=agent/sport/detail&type=bs&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">棒球</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['bs_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bs_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bs_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['bs_win'] - $sport_list['bs_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="冠軍" style="color: #F37605;" href="?r=agent/sport/detail&type=gj&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">冠軍</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['gj_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['gj_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['gj_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['gj_win'] - $sport_list['gj_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="串關" style="color: #F37605;" href="?r=agent/sport/detail-cg&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">串關</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['cg_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['cg_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['cg_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['cg_win'] - $sport_list['cg_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">
                        <a title="其他" style="color: #F37605;" href="?r=agent/sport/detail&type=other&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $user_id; ?>">其他</a>
                    </td>
                    <td align="center" valign="middle"><?= $sport_list['other_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['other_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['other_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['other_win'] - $sport_list['other_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle">總計</td>
                    <td align="center" valign="middle"><?= $sport_list['all_count']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['all_money']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['all_win']; ?></td>
                    <td align="center" valign="middle"><?= $sport_list['all_win'] - $sport_list['all_money']; ?></td>
                </tr>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle" colspan="5">贏取金額=下注金額-下注結果。如果是正數，說明贏錢，如果是負數，則為輸錢。</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>