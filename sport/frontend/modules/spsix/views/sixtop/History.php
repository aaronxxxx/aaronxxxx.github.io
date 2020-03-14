<div id="historyCount">
    <div class="round-table">
        <table id="HistoryTab" class="ListTr">
            <tbody>
            <tr class="title_tr">
                <td style="width:20%;text-align:center;">日期</td>
                <td style="width:20%;text-align:center;">下注金额</td>
                <td style="width:20%;text-align:center;">结果</td>
                <td style="display: none;width:20%;text-align:center;">有效投注金额</td>

                <!--td>余额</td-->
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?= date('Y-m-d')?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?=date('Y-m-d')?>"><?=date('Y-m-d')?></a>
                </td>
                <td> <?=($lhc_today_result["bet_money"] )?></td>
                <td> <?=($lhc_today_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?=date('Y-m-d', strtotime('-1 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?=date('Y-m-d', strtotime('-1 day'))?>"><?= date('Y-m-d', strtotime('-1 day'))?></a>
                </td>
                <td> <?=($lhc_day1_result["bet_money"] )?></td>
                <td> <?=($lhc_day1_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?= date('Y-m-d', strtotime('-2 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?= date('Y-m-d', strtotime('-2 day'))?>"><?=date('Y-m-d', strtotime('-2 day'))?></a>
                </td>
                <td> <?=($lhc_day2_result["bet_money"] )?></td>
                <td> <?=($lhc_day2_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?=date('Y-m-d', strtotime('-3 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?= date('Y-m-d', strtotime('-3 day'))?>"><?= date('Y-m-d', strtotime('-3 day')) ?></a>
                </td>
                <td> <?=($lhc_day3_result["bet_money"] ) ?></td>
                <td> <?=($lhc_day3_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?=date('Y-m-d', strtotime('-4 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?=date('Y-m-d', strtotime('-4 day'))?>"><?=date('Y-m-d', strtotime('-4 day'))?></a>
                </td>
                <td> <?=($lhc_day4_result["bet_money"] )?></td>
                <td> <?=($lhc_day4_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?=date('Y-m-d', strtotime('-5 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?=date('Y-m-d', strtotime('-5 day'))?>"><?=date('Y-m-d', strtotime('-5 day'))?></a>
                </td>
                <td> <?=($lhc_day5_result["bet_money"] )?></td>
                <td> <?=($lhc_day5_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center"><a title="<?= date('Y-m-d', strtotime('-6 day'))?>
                " href="/?r=spsix/sixtop/datecount&gamedate=<?=date('Y-m-d', strtotime('-6 day'))?>"><?=date('Y-m-d', strtotime('-6 day'))?></a>
                </td>
                <td> <?=($lhc_day6_result["bet_money"] ) ?></td>
                <td><?=($lhc_day6_win )?></td>
            </tr>
            <tr style="text-align:right;">
                <td style="text-align:center">总计</td>
                <td><?=$bet_money_total ?></td>
                <td><?= $bet_win_total ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
