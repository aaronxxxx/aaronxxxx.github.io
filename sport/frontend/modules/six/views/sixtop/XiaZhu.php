<div id="historyData">
    <div class="round-table">
        <table id="HistoryTab" class="ListTr">
            <tbody>
            <tr class="title_tr">
                <td colspan="3" style="width:100%;text-align:center;">&nbsp;今天下注状况</td>
            </tr>
            <tr class="title_tr">
                <td style="width:33%;text-align:center;">游戏名称</td>
                <td style="width:33%;text-align:center;">笔数</td>
                <td style="width:33%;text-align:center;">下注金额</td>
            </tr>
            <tr>
                <td style="text-align:center;">
                    <a title="六合彩"
                       href="/?r=six/sixtop/historydate&gtype=LT&amp;gamedate=<?=date("Y-m-d")?>">六合彩</a>
                </td>
                <td>
                    <?=$lhc_today_result["bet_count"]?>
                </td>
                <td>
                    <?=$lhc_today_result["bet_money"]?>
                </td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center;">总计</td>
                <td><?=$total_today_count?></td>
                <td><?=$total_today_money?>.00</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>