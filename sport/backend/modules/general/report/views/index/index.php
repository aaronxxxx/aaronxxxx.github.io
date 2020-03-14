<body>
    <div class="pro_title pd10"> 报表明细</div>


    <form name="gridSearchForm" id="gridSearchForm" class="trinput inputct font14" method="get" action="#/report/index/index" onSubmit="return check();">

        日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?=$time['s_time']?>" onFocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly>
                ~
                <input class="laydate-icon" name="e_time" id="e_time" value="<?=$time['e_time']?>" onFocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly>
        <input type="button" value="今日" onClick="setDate('today')">
        <input type="button" value="昨日" onClick="setDate('yesterday')">
        <input type="button" value="本周" onClick="setDate('thisWeek')">
        <input type="button" value="上周" onClick="setDate('lastWeek')">
        <input type="button" value="本月" onClick="setDate('thisMonth')">
        <input type="button" value="上月" onClick="setDate('lastMonth')">
        <input type="button" value="最近7天" onClick="setDate('lastSeven')">
        <input type="button" value="最近30天" onClick="setDate('lastThirty')">
        <select name="date_month" id="date_month" onChange="onChangeMonth(this.value)">
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
        <br> <br>

        用户名：<input name="user_group" value="<?= $user_group; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        忽略用户名：<input name="user_ignore_group" value="<?= $user_ignore_group; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="gtype" type="hidden" id="gtype" value="">
        <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
        <br><br>
    </form>

    <table width="100%"   cellspacing="0" cellpadding="0"  id=editProduct  class="font14 skintable line35"  >
        <tbody>
            <tr >
                <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
                <td style="width: 21%" align="center"><strong>下注金额</strong></td>
                <td style="width: 21%" align="center"><strong>下注结果</strong></td>
                <td style="width: 21%" align="center"><strong>赢取金额</strong></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="彩票游戏" style="color: #F37605;" href="#/report/lottery/index&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_group=<?= $user_group; ?>&user_ignore_group=<?= $user_ignore_group; ?>">彩票游戏</a>
                </td>
                <td align="center" valign="middle"><?= $lottery_list['bet_count']; ?></td>
                <td align="center" valign="middle"><?= $lottery_list['bet_money']; ?></td>
                <td align="center" valign="middle"><?= $lottery_list['win_money']; ?></td>
                <td align="center" valign="middle"><?= $lottery_list['result']; ?></td>     <!-- 20180301@robin add -->
            </tr>
            <!-- <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="六合彩" style="color: #F37605;" href="#/report/statement/six-detail&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_in=<?= $user_group; ?>&user_nin=<?= $user_ignore_group; ?>">六合彩</a>
                </td>
                <td align="center" valign="middle"><?= $six_list['bet_count']; ?></td>
                <td align="center" valign="middle"><?= $six_list['bet_money']; ?></td>
                <td align="center" valign="middle"><?= $six_list['win_money']; ?></td>
                <td align="center" valign="middle"><?= $six_list['result']; ?></td>
            </tr> -->
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="极速六合彩" style="color: #F37605;" href="#/report/spsix/six-detail&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_in=<?= $user_group; ?>&user_nin=<?= $user_ignore_group; ?>">极速六合彩</a>
                </td>
                <td align="center" valign="middle"><?= $spsix_list['bet_count']; ?></td>
                <td align="center" valign="middle"><?= $spsix_list['bet_money']; ?></td>
                <td align="center" valign="middle"><?= $spsix_list['win_money']; ?></td>
                <td align="center" valign="middle"><?= $spsix_list['result']; ?></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">总计</td>
                <td align="center" valign="middle"><?= $all1['bet_count']; ?></td>
                <td align="center" valign="middle"><?= $all1['bet_money']; ?></td>
                <td align="center" valign="middle"><?= $all1['win_money']; ?></td>
                <td align="center" valign="middle"><?= $all1['result']; ?></td>
            </tr>
            <?php /*
            <tr align="center">
                <td height="40" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。输赢结果：如果是正数，说明<font color="#FF0000">(会员)</font>输钱，如果是负数，则为<font color="#FF0000">(会员)</font>赢钱。</td>
            </tr>
            <tr >
                <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
                <td style="width: 21%" align="center"><strong>下注金额</strong></td>
                <td style="width: 21%" align="center"><strong>有效投注额</strong></td>
                <td style="width: 21%" align="center"><strong>输赢结果</strong></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="视讯真人" style="color: #F37605;" href="#/live/order/index&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_str=<?= $user_group; ?>">视讯真人</a>
                </td>
                <td align="center" valign="middle"><?= $sxzr_result['bet_count']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['bet_money']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['valid_bet_amount']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['live_win']?></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="电子游艺" style="color: #F37605;" href="#/live/egame/index&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_str=<?= $user_group; ?>">电子游艺</a>
                </td>
                <td align="center" valign="middle"><?= $dzyy_result['bet_count']?></td>
                <td align="center" valign="middle"><?= $dzyy_result['bet_money']?></td>
                <td align="center" valign="middle"><?= $dzyy_result['valid_bet_amount']?></td>
                <td align="center" valign="middle"><?= $dzyy_result['live_win']?></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="体育" style="color: #F37605;" href="#/live/pe/index&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_str=<?= $user_group; ?>">体育</a>
                </td>
                <td align="center" valign="middle"><?= $pe_result['bet_count']?></td>
                <td align="center" valign="middle"><?= $pe_result['bet_money']?></td>
                <td align="center" valign="middle"><?= $pe_result['valid_bet_amount']?></td>
                <td align="center" valign="middle"><?= $pe_result['live_win']?></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">总计</td>
                <td align="center" valign="middle"><?= $sxzr_result['bet_count']+$dzyy_result['bet_count']+$pe_result['bet_count']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['bet_money']+$dzyy_result['bet_money']+$pe_result['bet_money']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['valid_bet_amount']+$dzyy_result['valid_bet_amount']+$pe_result['valid_bet_amount']?></td>
                <td align="center" valign="middle"><?= $sxzr_result['live_win']+$dzyy_result['live_win']+$pe_result['live_win']?></td>
            </tr>
            */ ?>
            <tr align="center"  style="background-color:#FFFFFF; line-height:20px;">
                <td height="40" align="center" valign="middle" colspan="5">输赢结果：如果是正数，说明<font color="#FF0000">(会员)</font>赢钱，如果是负数，则为<font color="#FF0000">(会员)</font>输钱。</td>
            </tr>
            <tr >
                <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                <td style="width: 21%" align="center"><strong>成功总笔数</strong></td>
                <td style="width: 21%" align="center"><strong>成功转入总金额</strong></td>
                <td style="width: 21%" align="center"><strong>成功转出总金额</strong></td>
                <td style="width: 21%" align="center"><strong>盈利金额(转入-转出)</strong></td>
            </tr>
            <tr align="center">
                <td height="25" align="center" valign="middle">
                    <a title="视讯真人" style="color: #F37605;" href="#/report/live-history/index&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_group=<?= $user_group; ?>&user_ignore_group=<?= $user_ignore_group; ?>">真人娱乐</a>
                </td>
                <td align="center" valign="middle"><?= $zz_result['bet_count']?></td>
                <td align="center" valign="middle"><?= $zz_result['zr']?></td>
                <td align="center" valign="middle"><?= $zz_result['zc']?></td>
                <td align="center" valign="middle"><?= $zz_result['win']?></td>
            </tr>
            <tr align="center"  style="background-color:#FFFFFF; line-height:20px;">
                <td height="40" align="center" valign="middle" colspan="5">盈利金额=成功转入总金额-成功转出总金额。如果是正数，说明<font color="#FF0000">(会员)</font>输钱，如果是负数，则为<font color="#FF0000">(会员)</font>赢钱。</td>
            </tr>
        </tbody>
    </table>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>
