<?php use yii\widgets\LinkPager; ?>

<form name="form1" method="get" action="/#/event/result/add" id="form1">
    <div class="font12 trinput resulttable zudan">
        <p>
            <span>赛事期数：</span>
            <span>
                <input type="text" name="qishu" id="qishu" value="<?php echo isset($saveData['qishu']) && $saveData['qishu'] ? $saveData['qishu'] : ''; ?>" size="20" maxlength="16">
            </span>
        </p>
        <p>
            <span>
                <input type="button" class="mgl61" data-targetid="form1" name="submit" value="设置开奖" id="modifyQishu">
            </span>
        </p>
    </div>
</form>
<hr>
<form name="form2" method="get" id="gridSearchForm" action="#/event/result/index">
    <div class="font12 mgb10">
        <p class="trinput ">
            赛事期数：
            <input type="text" name="qishu" id="qishu" value="<?= $qishu ? $qishu : ''; ?>" size="20" maxlength="11">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" id="gridSearchBtn" class="submit80" name="submit" value="搜索">
        </p>
    </div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tbody>
        <tr class="namecolor">
            <td align="center"><strong>期数</strong></td>
            <td align="center"><strong>赛事名称</strong></td>
            <td align="center"><strong>开奖时间</strong></td>
            <td align="center" style="width:30%;"><strong>PK比</strong></td>
            <td align="center" style="width:30%;"><strong>多項目</strong></td>
            <td align="center">结算</td>
            <td align="center"><strong>重算</strong></td>
            <td align="center"><strong>操作</strong></td>
        </tr>
        <?php
            if ($list) {
                foreach ($list as $key => $val) {
        ?>
                <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                    <td align="center" valign="middle"><?= $val['official_qishu']; ?></td>
                    <td align="center" valign="middle"><?= $val['title']; ?></td>
                    <td align="center" valign="middle"><?= $val['datetime'] ?></td>
                    <td align="center" valign="middle">
                    <?php
                        foreach ($showPK[$key] as $key2 => $val2) {
                            if ($key2 > 0) {
                                echo '<br>';
                            }

                            echo $val2['title'] . ' : 得分为 ' . $val2['score'];
                        }
                    ?>
                    </td>
                    <td align="center" valign="middle">
                    <?php
                        foreach ($showMulti[$key] as $key2 => $val2) {
                            if ($key2 > 0) {
                                echo '<br>';
                            }

                            echo $val2['m_title'] . ' : 中奖为 ' . $val2['i_title'];
                        }
                    ?>
                    </td>
                    <td>
                        <button class="settle" status="<?= $val['state'] == 0 ? 0 : 1; ?>" official_id="<?= $val['official_id'] ?>">
                            <font color="#FF0000"><?= $val['state'] == 0 ? '未结算' : "已结算"; ?> </font>
                        </button>
                    </td>
                    <td>
                    <?php if ($val['state'] == 2) { ?>
                        <font color="#FF0000" style="font-size:18px" status="<?= $val['state']; ?>"> √ </font>
                    <?php } else { ?>
                        <font color="#0000FF" style="font-size:20px" status="<?= $val['state']; ?>"> × </font>
                    <?php } ?>
                    </td>
                    <td>
                        <!-- <a href="#/event/index/result-edit&qishu=<?= $val['official_id'] ?>">编辑</a>
                        <a onclick="queryResult_lhc(<?= $val['id'] ?>)" title="查看修改记录"><font>查看记录</font></a> -->
                        <a class="btn btn-default btn-xs" onclick="deleteResult(<?= $val['id'] ?>)">
                            <font>删除</font>
                        </a>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>

<script>
    $(function() {
        $("#modifyQishu").click(function(e) {
            $qishu = $("#qishu").val();
            if ($qishu.length <= 0) {
                alert('请输入正确的期号');
            } else {
                window.location.href = '/#/event/result/add&qishu=' + $qishu;
            }
        });

        //订单结算
        $(".settle").click(function(e) {
            var formData = $("#gridSearchForm").serialize();
            e.preventDefault();
            var status = $(this).attr('status');
            var official_id = $(this).attr('official_id');
            $(".settle").attr("disabled", "true");
            $.ajax({
                type: "post",
                url: "/?r=event/report/do-state",
                data: {
                    jsType: status,
                    official_id: official_id
                },
                error: function() {
                    layer.alert('出错了，请稍后再试');
                    $(".settle").removeAttr("disabled");
                },
                success: function(data) {
                    layer.alert(data);
                    $(".settle").removeAttr("disabled");
                    window.location.href = '/#/event/result/index&t=' + formData + "&t=" + new Date().getTime();;
                }
            })
        })
    })

    // 删除开奖记录
    function deleteResult(id) {
        if (confirm('确定要刪除吗?') == true) {
            $.ajax({
                url: '?r=event/result/delete',
                type: 'post',
                data: {id: id},
                success: function(data) {
                    if (data) {
                        alert(data);
                        window.location.reload();
                    }
                }
            });
        }
    }

    //查看修改记录
    function queryResult_lhc(id) {
        $.ajax({
            type: "POST",
            url: "/?r=event/index/result-log",
            data: {
                id: id
            },
            error: function() {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data) {
                layer.alert(data);
                window.location.href = '/#/event/result/index' + "&t=" + new Date().getTime();;
            }
        })
    }
</script>
