<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css">
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content">
            <h2>
                <b></b>
                <span style="color: white">赔率设置</span>
            </h2>
            <div id="content_inner">
                <div>
                    <div id="wager_groups" class="CQ">
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="N1"><b><?= $data['title'] ?> : 兩方比賽</b></span></li>
                </ul>
            </div>
            <div id="game">
                <form method="post" action="/?r=event/odds/twopkall">
                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>期數</label></td>
                                <td style="width:30px"><label>賽事名稱</label></td>
                                <td style="width:30px"><label>主方賠率</label></td>
                                <td style="width:30px"><label>客方賠率</label></td>
                                <td style="width:30px"><label>調整基值</label></td>
                                <td style="width:30px"><label>啟動額</label></td>
                                <td style="width:30px"><label>修改</label></td>
                            </tr>
                        <?php
                            foreach ($twopk as $key => $val) {
                        ?>
                                <tr class="title_line" id="here<?= $val['id'] ?>">
                                    <td>
                                        <?= $val['qishu'] ?>
                                    </td>
                                    <td>
                                        <?= $player[$val['player1']] ?> VS <?= $player[$val['player2']] ?>
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-player1_odds" id="<?= $val['id'] ?>-player1_odds" value="<?= $val['player1_odds'] ?>">
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-player2_odds" id="<?= $val['id'] ?>-player2_odds" value="<?= $val['player2_odds'] ?>">
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-adj_basic" id="<?= $val['id'] ?>-adj_basic" value="<?= $val['adj_basic'] ?>">
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-start_amount" id="<?= $val['id'] ?>-start_amount" value="<?= $val['start_amount'] ?>">
                                    </td>
                                    <td>
                                        <button type="button" class="order" onclick="ajaxTwopkone(<?= $val['id'] ?>)">單筆送出</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                        </table>
                    </div>
                    <div id="SendB5">
                        <button type="submit" class="order">全部送出</button>
                        <button type="button" class="order" onclick="javascript:location.href='#/event/official'">取消</button>
                    </div>
                </form>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="N1"><b><?= $data['title'] ?> : 多項目</b></span></li>
                </ul>
            </div>
            <div id="game">
                <form method="post" action="/?r=event/odds/multipleall">
                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>期數</label></td>
                                <td style="width:30px"><label>狀態</label></td>
                                <td style="width:30px"><label>名稱</label></td>
                                <td style="width:30px"><label>勝率</label></td>
                                <td style="width:30px"><label>賠率</label></td>
                                <td style="width:30px"><label>修改</label></td>
                            </tr>
                        <?php
                            foreach ($multiple as $key => $val) {
                        ?>
                                <tr class="title_line" id="here<?= $val['id'] ?>">
                                    <td>
                                        <?= $val['qishu'] ?>
                                        <input type="hidden" id="fs" value="<?= $val['fs'] ?>">
                                    </td>
                                    <td>
                                    <?php
                                        if ($val['status'] == 1) {
                                            echo '啟用';
                                        } else {
                                            echo '停用';
                                        }
                                    ?>
                                    </td>
                                    <td>
                                        <?= $val['title'] ?>
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-win_rate" id="<?= $val['id'] ?>-win_rate" value="<?= $val['win_rate'] ?>" class="setOdds" data-id="<?= $val['id'] ?>"> %
                                    </td>
                                    <td class="odds">
                                        <input type="text" name="<?= $val['id'] ?>-odds" id="<?= $val['id'] ?>-odds" value="<?= $val['odds'] ?>" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="order" onclick="ajaxMultipleone(<?= $val['id'] ?>)">單筆送出</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                        </table>
                    </div>
                    <div id="SendB5">
                        <button type="submit" class="order">全部送出</button>
                        <button type="button" class="order" onclick="javascript:location.href='#/event/official'">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function ajaxTwopkone(id)
    {
        var player1_odds = $('#' + id + '-player1_odds').val();
        var player2_odds = $('#' + id + '-player2_odds').val();
        var adj_basic = $('#' + id + '-adj_basic').val();
        var start_amount = $('#' + id + '-start_amount').val();
        $.ajax({
            url: '?r=event/odds/twopkone',
            type: 'post',
            data: {
                editId: id,
                player1_odds: player1_odds,
                player2_odds: player2_odds,
                adj_basic: adj_basic,
                start_amount: start_amount
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    function ajaxMultipleone(id)
    {
        var win_rate = $('#' + id + '-win_rate').val();
        var odds = $('#' + id + '-odds').val();
        $.ajax({
            url: '?r=event/odds/multipleone',
            type: 'post',
            data: {
                editId: id,
                win_rate: win_rate,
                odds: odds
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    $('.setOdds').blur(function() {
        var id = $(this).attr('data-id');
        var fs = $(this).closest("tr").find('input[id="fs"]').val();
        var win_rate = $(this).val() * 0.01;
        var odds = (1 / win_rate) * (1 - fs);
        odds = odds.toFixed(2);
        $('#' + id + '-odds').val(odds);
    });
</script>
