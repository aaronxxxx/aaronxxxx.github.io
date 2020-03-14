<div id="historyData">
    <div class="round-table">
        <table class="ListTr">
            <tbody>
            <tr class="title_tr">
                <td style="width:20%">游戏名称</td>
                <td style="width:20%">下注金额</td>
                <td style="width:20%">结果</td>
                <!--td>余额</td-->
            </tr>
            <tr style="text-align:right;">
                <td><a class="slide-sub" title="六合彩"
                       href="/?r=six/sixtop/historydate&gtype=LT&amp;gamedate=<?=$date_select?>">六合彩</a>
                </td>
                <td><?=$lhc_result["bet_money"]?></td>
                <td><?=$lhc_win?></td>
            </tr>

            <tr style="text-align:right;">
                <td class="title_td2" style="text-align:center;">总计</td>
                <td><?=$total_bet_money?></td>
                <td><?=$total_win_money?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>