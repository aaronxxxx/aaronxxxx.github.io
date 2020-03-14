<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css">
<link href="/public/chart/morris.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/chart/morris.js"></script>
<script type="text/javascript" src="/public/chart/raphael.js"></script>
<script type="text/javascript" language="javascript" src="public/common/js/jquery.blockUI.js"></script>

<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content">
            <form id="chartForm" method="post" action="/#/event/report/index">
                <input type="hidden" name="oid" value="<?= $data['id'] ?>">
                <h2>
                    <b></b>
                    <span style="color: white">赛事 - <?= $data['title'] ?> 結算試算设置</span>
                </h2>
                <div id="content_inner">
                    <div>
                        <div id="wager_groups" class="CQ"></div>
                    </div>
                </div>
                <div id="tab" class="tab_type">
                    <ul>
                        <li class="onTagClick"><span class="N1"><b>两方比赛队伍得分</b></span></li>
                    </ul>
                </div>
                <div id="game">
                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>图片</label></td>
                                <td style="width:30px"><label>姓名</label></td>
                                <td style="width:30px"><label>得分</label></td>
                            </tr>
                            <?php
                                foreach ($player as $key => $val) {
                            ?>
                                <tr class="title_line" id="here<?= $val['id'] ?>">
                                    <td>
                                        <img src="timthumb.php?src=<?= $val['img_url'] ?>&w=150&h=150&zc=1">
                                    </td>
                                    <td>
                                        <?= $val['title'] ?>
                                    </td>
                                    <td class="odds">
                                        <input type="number" name="<?= $val['id'] ?>-player_score" id="<?= $val['id'] ?>-player_score" value="<?php
                                            if (isset($postData[$val['id'] . '-player_score'])) { echo $postData[$val['id'] . '-player_score']; } ?>"
                                            onchange="if (/\D/.test(this.value)) {alert('得分只能输入数字');this.value='';}" required>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            <?php
                foreach ($multiple as $key => $val) {
            ?>
                <div id="tab" class="tab_type">
                    <ul>
                        <li class="onTagClick"><span class="N1"><b>多項目 - <?= $val['title'] ?></b></span></li>
                    </ul>
                </div>
                <div id="game">
                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>項目</label></td>
                                <td style="width:30px"><label>中獎</label></td>
                            </tr>
                            <?php
                                foreach ($multiple[$key]['items'] as $key2 => $val2) {
                            ?>
                                <tr class="title_line">
                                    <td>
                                        <?= $val2['title'] ?>
                                    </td>
                                    <td>
                                        <input type="radio" name='<?= $val['id'] ?>-multiple' value="<?= $val2['id'] ?>" value="<?php
                                            if (isset($postData[$val['id'] . '-multiple'])) { echo 'selected'; } ?>" required>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            <?php
                }
            ?>
                <div id="SendB5">
                    <button type="submit" class="order">送出</button>
                    <button type="button" class="order" onclick="javascript:location.href='#/event/official/index'">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>

<div id="chartReport">
    <div >
        <button type="button" onclick="$('#chartForm').show();" class="order">展开試算设置</button>
    </div>
    <br>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body table-responsive no-padding" style="font-size: 18px;">
                <table class="table table-hover">
                    <tr>
                        <th>总投注额</th>
                        <th>总玩家胜额</th>
                        <th>获利</th>
                        <th>营利率</th>
                    </tr>
                    <tr>
                        <td id="bet_total"></td>
                        <td id="win_total"></td>
                        <td id="profit"></td>
                        <td id="profit_rate"></td>
                    </tr>
                </table>
                <div class="box-header with-border">
                    <h3 class="box-title">PK比较表</h3>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th>赛事內容</th>
                        <th>选手</th>
                        <th>投注金额</th>
                        <th>玩家胜额</th>
                        <th>获利</th>
                        <th>营利率</th>
                    </tr>
                    <tbody id="pkDetail"></tbody>
                </table>
                <div class="box-header with-border">
                    <h3 class="box-title">多项目比较表</h3>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th>赛事內容</th>
                        <th>项目</th>
                        <th>投注金额</th>
                        <th>玩家胜额</th>
                        <th>获利</th>
                        <th>营利率</th>
                    </tr>
                    <tbody id="multiDetail"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box-header with-border">
        <h3 class="box-title">PK比较图</h3>
    </div>
    <div id="pk-bar-chart" style="position: relative; height: 300px;"></div>
    <div class="box-header with-border">
        <h3 class="box-title">多项目比较图</h3>
    </div>
    <div id="mul-bar-chart" style="position: relative; height: 300px;"></div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">订单数量比较</h3>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="order-count-donut" style="height: 300px;"></div>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">暫放</h3>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">投注额比较</h3>
        </div>
        <div class="box-body chart-responsive">
            <div class="chart" id="order-amount-donut" style="height: 300px;"></div>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">暫放</h3>
        </div>
        <div class="box-body chart-responsive">
            <div class="chart" id="sales-chart" style="height: 300px;"></div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#chartForm').submit(function() {
            $.blockUI({message:'<h1>请稍候...</h1>如等待过久，请重新刷新后再试'});
            $('#chartForm').hide();
            var appendTwopk = "";
            var appendMulti = "";
            var count = 0;

            $.ajax({
                type: "POST",
                url: '/?r=event/report/checkout-result',
                data: $('#chartForm').serialize(),
                dataType: "json",

                error: function () {
                    $.unblockUI();
                    layer.alert('出错了，请稍后再试');
                },
                success: function(data) {
                    $.unblockUI();

                    $('#bet_total').html(data.bet_total);
                    $('#win_total').html(data.win_total);
                    $('#profit').html(data.profit);
                    $('#profit_rate').html(data.profit_rate);

                    // PK比較表
					$.each(data.detail.twopk, function(k, v) {
                        $.each(v, function(k1, v1) {
                            appendTwopk += '<tr>';

                            if (k1 == 0) {
                                appendTwopk += '<td rowspan="'+v.length+'" align="center" valign="middle">'+v1['title']+'</td>';
                            }

                            appendTwopk +=
                                    '<td>'+v1['player']+'</td>'+
                                    '<td>'+v1['bet_money']+'</td>'+
                                    '<td>'+v1['win']+'</td>'+
                                    '<td>'+v1['profit']+'</td>'+
                                    '<td>'+v1['profitRate']+' %</td>'+
                                '</tr>';
                        });
                    });
                    $('#pkDetail').html(appendTwopk);

                    // 多項目比較表
					$.each(data.detail.multi, function(k, v) {
                        $.each(v, function(k1, v1) {
                            appendMulti += '<tr>';

                            if (k1 == 0) {
                                appendMulti += '<td rowspan="'+v.length+'" align="center" valign="middle">'+v1['title']+'</td>';
                            }

                            appendMulti +=
                                    '<td>'+v1['item']+'</td>'+
                                    '<td>'+v1['bet_money']+'</td>'+
                                    '<td>'+v1['win']+'</td>'+
                                    '<td>'+v1['profit']+'</td>'+
                                    '<td>'+v1['profitRate']+' %</td>'+
                                '</tr>';
                        });
                    });
                    $('#multiDetail').html(appendMulti);

                    pkbar.setData(data.pkCompare);
                    mulbar.setData(data.multiCompare);

                    ordercount.setData(data.orderCompare);
                    orderamount.setData(data.amountCompare);
                }
            });

            return false;
        });
    });

    //訂單比較圓餅圖
    var ordercount = new Morris.Donut({
        element: 'order-count-donut',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [{"value":"","label":""}],
        hideHover: 'auto'
    });

    //注額圓餅圖
    var orderamount = new Morris.Donut({
        element: 'order-amount-donut',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [{"value":"","label":""}],
        hideHover: 'auto'
    });

    //PK項目比較圖
    var pkbar = new Morris.Bar({
        element   : 'pk-bar-chart',
        resize    : true,
        data      : [],
        xkey      : 'y',
        ykeys     : ['item1', 'item2'],
        labels    : ['投注額', '玩家勝額'],
        lineColors: ['#3c8dbc', '#a0d0e0'],
        hideHover : 'auto'
    });

    //多項目比較圖
    var mulbar = new Morris.Bar({
        element   : 'mul-bar-chart',
        resize    : true,
        data      : [],
        xkey      : 'y',
        ykeys     : ['item1', 'item2'],
        labels    : ['投注額', '玩家勝額'],
        lineColors: ['#3c8dbc', '#a0d0e0'],
        hideHover : 'auto'
    });

    // //下單狀況
    // var line = new Morris.Line({
    //     element          : 'line-chart2',
    //     resize           : true,
    //     data             : [
    //     // { y: '2011 Q1', item1: 2666 },
    //     // { y: '2011 Q2', item1: 2778 },
    //     // { y: '2011 Q3', item1: 4912 },
    //     // { y: '2011 Q4', item1: 3767 },
    //     // { y: '2012 Q1', item1: 6810 },
    //     // { y: '2012 Q2', item1: 5670 },
    //     // { y: '2012 Q3', item1: 4820 },
    //     // { y: '2012 Q4', item1: 15073 },
    //     // { y: '2013 Q1', item1: 10687 },
    //     // { y: '2013 Q2', item1: 8432 }
    //     ],
    //     xkey             : 'y',
    //     ykeys            : ['item1'],
    //     labels           : ['Item 1'],
    //     lineColors       : ['#000000'],
    //     lineWidth        : 2,
    //     hideHover        : 'auto',
    //     gridTextColor    : '#000000',
    //     gridStrokeWidth  : 0.4,
    //     pointSize        : 4,
    //     pointStrokeColors: ['#000000'],
    //     gridLineColor    : '#000000',
    //     gridTextFamily   : 'Open Sans',
    //     gridTextSize     : 10
    // });


    function checkResult()
    {

    }
</script>
