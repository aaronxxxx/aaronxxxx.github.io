<script src="/public/spsix/js/jquery.cookie.js" type="text/javascript"></script>
<?php use yii\widgets\LinkPager; ?>

<div class="pro_title">兩方比賽注单查询</div>
<form method="post" id="gridSearchForm" action="/?r=event/twopkorder/index">
    <div class="trinput inputct pd10">
        <div class="mgauto middle">
            <select name="status" id="status">
            <option selected>全部</option>
            <?php
                foreach ($status as $key => $val) {
            ?>
                <option value="<?= $key ?>" <?php if ($postStatus == $key) {echo 'selected';} ?>><?= $val ?></option>
            <?php
                }
            ?>
            </select>&nbsp;
            日期：
            <input type="text" name="startTime" id="startTime" value="<?= $startTime ?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})">
            ~
            <input type="text" name="endTime" id="endTime" value="<?= $endTime ?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})">&nbsp;
            期数：<input type="text" name="qishu" id="qishu" value="<?= $qishu ?>">&nbsp;
            订单号：<input type="text" name="orderNum" id="orderNum" value="<?= $orderNum ?>">&nbsp;
            会员：<input type="text" name="userName" id="userName" value="<?= $userName ?>">&nbsp;
            <input type="submit" value="搜索">
        </div>
    </div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tbody>
        <tr class="dailitr">
            <td><strong>订单号</strong></td>
            <td><strong>賽事名稱</strong></td>
            <td><strong>比賽類型</strong></td>
            <td><strong>期号</strong></td>
            <td><strong>讓分</strong></td>
            <td><strong>投注内容</strong></td>
            <td><strong>投注金额</strong></td>
            <td><strong>反水</strong></td>
            <td><strong>赔率</strong></td>
            <td><strong>可赢金额</strong></td>
            <td><strong>输赢结果</strong></td>
            <td><strong>投注时间</strong></td>
            <td><strong>投注账号</strong></td>
            <td><strong>状态</strong></td>
            <td><strong>操作</strong></td>
            <td><strong>查看记录</strong></td>
        </tr>
        <?php
            $betMoney = $winMoney = 0;
            foreach ($list as $key => $val) {
        ?>
            <tr align="center" <?php if ($val['status'] != 1 && $val['is_win'] == 2) { echo 'style="background:#f75050"';} ?>>
                <td><?= $val['order_num'] ?></td>
                <td><?= $val['title'] ?></td>
                <td><?= $gameType[$val['game_type']] ?></td>
                <td><?= $val['qishu'] ?></td>
                <td><?= $val['bet_handicap'] ?></td>
                <td><?= $val['game_item_id'] ?></td>
                <td><?= $val['bet_money']; $betMoney += $val['bet_money']; ?></td>
                <td><?= $val['fs'] ?></td>
                <td><?= $val['bet_rate'] ?></td>
                <td><?= $val['win'] ?></td>
                <td>
                    <?= $val['win_total'] ?>
                <?php
                    if ($val['status'] == 2 && $val['is_win'] == 2) {
                        $winMoney += $val['bet_money'] - $val['win_total'];
                    } elseif ($val['status'] == 1) {

                    } else {
                        $winMoney += $val['bet_money'];
                    }
                ?>
                </td>
                <td><?= $val['bet_time'] ?></td>
                <td><?= $val['user_name'] ?></td>
                <td>
                <?php
                    if ($val['status'] == 1) {
                ?>
                    <font color="#086913" data="<?= $val['status'] ?>"><?= $status[$val['status']] ?></font>--<br>
                <?php
                    } else {
                ?>
                    <font color="#0000FF" data="<?= $val['status'] ?>"><?= $status[$val['status']] ?></font>--<br>
                <?php
                    }

                    if ($val['status'] != 3) {
                ?>
                    <a onclick="orderCancel()">
                        <font color="#ffcccc">作废</font>
                    </a>
                <?php
                    }
                ?>
                </td>
                <td align="center" valign="middle">
                    <a style="color: #F37605;" onclick="subUpdate()" title="修改投注内容">
                        <font>修改投注内容</font>
                    </a>
                </td>
                <td align="center" valign="middle">
                    <a style="color: #F37605;" onclick="queryInfo_lhc()" title="查看修改记录">
                        <font>查看记录</font>
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
        <tr class="ctinfo">
            <td valign="middle" align="center" colspan="15">当前页总投注金额:<?= $betMoney; ?>元 当前页赢取金额:<?= $winMoney; ?>元</td>
        </tr>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pages]) ?>

<script>
    function reload_view() {
        window.location.reload();
    }

    function queryInfo_lhc(sub_id) {
        $.ajax({
            type: "POST",
            url: "/?r=spsix/index/order-log",
            data: {
                sub_id: sub_id
            },
            error: function() {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data) {
                layer.alert(data, {
                    offset: ['40%', '50%']
                })
            }
        });
    }

    function subUpdate(sub_id, sub_order_id) {
        var formData = $("#gridSearchForm").serialize();
        $.ajax({ //查询注单内容
            type: "POST",
            url: "/?r=spsix/index/order-sub-update",
            data: {
                sub_id: sub_id
            },
            error: function() {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data) {
                layer.alert(data, {
                    offset: ['40%', '50%']
                }, function(e) {
                    if (data.length > 20) {
                        var number = $("#number").val();
                        layer.confirm('确定要修改订单吗?', {
                                btn: ['确定', '取消'],
                                offset: ['40%', '50%']
                            },
                            function() {
                                if (!number) {
                                    layer.alert('请填写修改内容!', {
                                        offset: ['40%', '50%']
                                    });
                                    return false;
                                }
                                $.ajax({ //提交内容修改
                                    type: "POST",
                                    url: "/?r=spsix/index/order-sub-update-do",
                                    data: {
                                        sub_id: sub_id,
                                        number: number,
                                        update: 1,
                                        sub_order_id: sub_order_id
                                    },
                                    error: function() {
                                        layer.alert('出错了，请稍后再试', {
                                            offset: ['40%', '50%']
                                        });
                                    },
                                    success: function(data) {
                                        layer.alert(data, {
                                            offset: ['40%', '50%']
                                        }, function() {
                                            layer.closeAll();
                                            window.location.href = '/#/spsix/index/order&' + formData + "&t=" + new Date().getTime();
                                        });
                                    }
                                })
                            },
                            function(index) {
                                layer.close(index);
                            }
                        );
                    } else {
                        layer.close(e);
                    }
                })
            }
        });
    }

    function orderCancel(sub_id, sub_order_id) {
        var formData = $('#gridSearchForm').serialize();
        $.ajax({
            type: "POST",
            url: "/?r=spsix/index/order-cancel",
            data: {
                sub_id: sub_id
            },
            error: function() {
                layer.alert('出错了，请稍后再试', {
                    offset: ['40%', '50%']
                });
            },
            success: function(data) {
                layer.alert(data, {
                    offset: ['40%', '50%']
                }, function() {
                    if (data.length <= 20) {
                        layer.alert(data);
                    } else {
                        var reson = $("#reson").val();
                        layer.confirm('确定要作废该订单吗?', {
                                btn: ['确定', '取消'],
                                offset: ['40%', '50%']
                            },
                            function() {
                                if (!reson) {
                                    layer.alert('请填写作废原因!', {
                                        offset: ['40%', '50%']
                                    });
                                    return false;
                                }
                                $.ajax({
                                    type: "POST",
                                    url: "/?r=spsix/index/do-order-cancel",
                                    data: {
                                        sub_id: sub_id,
                                        reson: reson,
                                        update: 1,
                                        'sub_order_id': sub_order_id
                                    },
                                    error: function() {
                                        layer.alert('出错了，请稍后再试', {
                                            offset: ['40%', '50%']
                                        });
                                    },
                                    success: function(data) {
                                        layer.alert(data, {
                                            offset: ['40%', '50%']
                                        }, function() {
                                            //                                          window.location.reload();
                                            layer.closeAll();
                                            window.location.href = "#/spsix/index/order&" + formData + "&t=" + new Date().getTime();
                                        });
                                    }
                                })
                            },
                            function(index) {
                                layer.close(index);
                            });
                    }
                })
            }
        });
    }
    //读取cookie中的是否显示图片状态值
    if ($.cookie('img_show') == 'block') {
        $("#img_show").find("option[value='block']").attr("selected", true);
        $('.img-img').css('display', 'block');
    }
    //图片显示与隐藏切换 并把设置值保存到cookie中
    $(document).on('change', '#img_show', function() {
        var status = $('#img_show option:selected').val(); //选中的值
        $('.img-img').css('display', status);
        $.cookie('img_show', status);
    })
</script>