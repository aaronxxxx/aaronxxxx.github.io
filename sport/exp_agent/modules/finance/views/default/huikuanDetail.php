<form name="form1" id="form1" method="post" action="?r=finance/default/do-huikuan">

    <div class="pro_title pd10">匯款管理：查看用戶匯款信息</div>
    <div>
        <input name="status" type="hidden" id="hf_status" value="">
        <input name="id" type="hidden" id="hf_id" value="<?= $data["id"] ?>">
        <input name="money" type="hidden" id="hf_money" value="<?= $data["order_value"] ?>">
        <input name="order_num" type="hidden" id="order_num" value="<?= $data["order_num"] ?>">
        <input name="status_log" type="hidden" id="status_log" value="">
    </div>

    <table width="100%" border="0" cellpadding="3" cellspacing="1"  style="    width: 1088px;
           margin: 0 auto;">
        <tr>
            <td  valign="top" >

                <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font14 skintable line35" id=editProduct   width="100%" >
                    <tr align="center">
                        <td align="right">匯款流水號：</td>
                        <td align="left"><?= $data["order_num"] ?></td>
                    </tr>
                    <tr align="center">
                        <td width="22%" align="right">匯款用戶：</td>
                        <td width="78%" align="left"><?= $data["user_name"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款前餘額：</td>
                        <td align="left"><span style="color:#999999;"><?= $data["assets"] ?></span></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款金額：</td>
                        <td align="left"><?= $data["order_value"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款後餘額：</td>
                        <td align="left"><span style="color:#999999;"><?= $data["balance"] ?></span></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款日期：</td>
                        <td align="left"><?= $data["date"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款銀行：</td>
                        <td align="left"><?= $data["pay_card"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款方式：</td>
                        <td align="left"><?= $data["manner"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">匯款地點：</td>
                        <td align="left"><?= $data["pay_address"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">提交時間：</td>
                        <td align="left"><?= $data["update_time"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">當前狀態：</td>
                        <td align="left"><?php
                            if ($data["status"] == '成功')
                                echo "匯款成功";
                            else if ($data["status"] == '失敗')
                                echo "匯款失敗";
                            else
                                echo "審核中";
                            ?></td>
                    </tr>
                    <?php if ($update) { ?>
                        <tr align="center">
                            <td align="right">贈送手續費：</td>
                            <td align="left"><?php
                                if ($data['status'] == '成功') {
                                    echo $data['zsjr'] . ' 元';
                                } else {
                                    ?>
                                    <label>
                                        <input name="is_zsjr" type="checkbox" id="is_zsjr" value="1" checked>
                                        勾選則贈送，不勾則不贈送。同城同行匯款不贈送。</label>
                                    <br/>手續費比例：<input name="sxf_bl" type="text" id="sxf_bl" value="<?= $zsbl > 0 ? $zsbl : 0.00 ?>" size="3"/>說明：如果用戶充值100，比例為0.02。用戶得到手續費2=100*0.02
                                <?php } ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2" align="right">&nbsp;</td>
                        </tr>
                        <tr align="center" class="trinput inputct huikuanmange">
                            <td colspan="2" align="center">
                                <?php
                                if ($data['status'] == '未結算' && !in_array($data["user_name"], $hacker_list)) {
                                    ?>
                                    <input type="button" name="Submit2" value="充值成功" onClick="check('1');">
                                    <input type="button" name="Submit3" value="充值失敗" onClick="check('2');">　
                                    <input type="button" name="Submit4" value="待審核" onClick="check('3');">　
                                    <?php
                                } else {
                                    if (in_array($data["user_name"], $hacker_list)) {
                                        echo '該用戶在黑客、不誠信、惡意用戶名單中，請謹慎提交該提款';
                                    }
                                    ?>
                                    <input type="button" name="Submit2" value="繼續提交(後果自負)" onClick="check('1');">
                                    <input type="button" name="Submit3" value="充值失敗" onClick="check('2');">　
                                    <?php
                                }
                                ?>
                                <input type="button" name="Submit" value="返回" onClick="javascript:window.location.href = '?r=finance/default/huikuan&t=' + new Date().getTime();">
                                <a href="?r=member/hacker/index&id=1">查看非法用戶</a>
                            </td>

                        </tr>
<?php } ?>
                </table>
            </td>
        </tr>
    </table>
</form>
<script>
    function check($v) {
        var id = $("#hf_id").val();
        if ($v === "1") {
            var a = '確認收到款項？';
            var status_log = '匯款成功';
        }
        if ($v === "2") {
            var a = '確認充值失敗？';
            var status_log = '充值失敗';
        }
        if ($v === "3") {
            var a = '確認待審核？';
            var status_log = '待審核';
        }
        layer.confirm(a, {btn: ['確定', '取消']}, function () {
            $("#hf_status").val($v);
            $("#status_log").val(status_log);
            $.ajax({
                type: "POST",
                url: '/?r=finance/default/do-huikuan',
                data: $('#form1').serialize(),
                error: function () {
                    layer.alert('出錯了，請稍後再試');
                    window.location.reload();
                },
                success: function (data) {
                    layer.alert(data, function (index) {
                        layer.closeAll();
                        window.location.href = '?r=finance/default/huikuan-detail&id=' + id + '&update=1&t=' + new Date().getTime();
                    })
                }
            })
        })
    }
</script>
