<form name="form1" id="form1" method="post" action="#/finance/default/do-huikuan">

    <div class="pro_title pd10">汇款管理：查看用户汇款信息</div>
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
                        <td align="right">汇款流水号：</td>
                        <td align="left"><?= $data["order_num"] ?></td>
                    </tr>
                    <tr align="center">
                        <td width="22%" align="right">汇款用户：</td>
                        <td width="78%" align="left"><?= $data["user_name"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款前余额：</td>
                        <td align="left"><span style="color:#999999;"><?= $data["assets"] ?></span></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款金额：</td>
                        <td align="left"><?= $data["order_value"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款后余额：</td>
                        <td align="left"><span style="color:#999999;"><?= $data["balance"] ?></span></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款日期：</td>
                        <td align="left"><?= $data["date"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款银行：</td>
                        <td align="left"><?= $data["pay_card"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款方式：</td>
                        <td align="left"><?= $data["manner"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">汇款地点：</td>
                        <td align="left"><?= $data["pay_address"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">提交时间：</td>
                        <td align="left"><?= $data["update_time"] ?></td>
                    </tr>
                    <tr align="center">
                        <td align="right">当前状态：</td>
                        <td align="left"><?php
                            if ($data["status"] == '成功')
                                echo "汇款成功";
                            else if ($data["status"] == '失败')
                                echo "汇款失败";
                            else
                                echo "审核中";
                            ?></td>
                    </tr>
                    <?php if ($update) { ?>
                        <tr align="center">
                            <td align="right">赠送手续费：</td>
                            <td align="left"><?php
                                if ($data['status'] == '成功') {
                                    echo $data['zsjr'] . ' 元';
                                } else {
                                    ?>
                                    <label>
                                        <input name="is_zsjr" type="checkbox" id="is_zsjr" value="1" checked>
                                        勾选则赠送，不勾则不赠送。同城同行汇款不赠送。</label>
                                    <br/>手续费比例：<input name="sxf_bl" type="text" id="sxf_bl" value="<?= $zsbl > 0 ? $zsbl : 0.00 ?>" size="3"/>说明：如果用户充值100，比例为0.02。用户得到手续费2=100*0.02
                                <?php } ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2" align="right">&nbsp;</td>
                        </tr>
                        <tr align="center" class="trinput inputct huikuanmange">
                            <td colspan="2" align="center">
                                <?php
                                if ($data['status'] == '未结算' && !in_array($data["user_name"], $hacker_list)) {
                                    ?>
                                    <input type="button" name="Submit2" value="充值成功" onClick="check('1');">
                                    <input type="button" name="Submit3" value="充值失败" onClick="check('2');">　
                                    <input type="button" name="Submit4" value="待审核" onClick="check('3');">　
                                    <?php
                                } else {
                                    if (in_array($data["user_name"], $hacker_list)) {
                                        echo '该用户在黑客、不诚信、恶意用户名单中，请谨慎提交该提款';
                                    }
                                    ?>
                                    <input type="button" name="Submit2" value="继续提交(后果自负)" onClick="check('1');">
                                    <input type="button" name="Submit3" value="充值失败" onClick="check('2');">　
                                    <?php
                                }
                                ?>
                                <input type="button" name="Submit" value="返回" onClick="javascript:window.location.href = '#/finance/default/huikuan&t=' + new Date().getTime();">
                                <a href="#/member/hacker/index&id=1">查看非法用户</a>
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
            var a = '确认收到款项？';
            var status_log = '汇款成功';
        }
        if ($v === "2") {
            var a = '确认充值失败？';
            var status_log = '充值失败';
        }
        if ($v === "3") {
            var a = '确认待审核？';
            var status_log = '待审核';
        }
        layer.confirm(a, {btn: ['确定', '取消']}, function () {
            $("#hf_status").val($v);
            $("#status_log").val(status_log);
            $.ajax({
                type: "POST",
                url: '/?r=finance/default/do-huikuan',
                data: $('#form1').serialize(),
                error: function () {
                    layer.alert('出错了，请稍后再试');
                    window.location.reload();
                },
                success: function (data) {
                    layer.alert(data, function (index) {
                        layer.closeAll();
                        window.location.href = '#/finance/default/huikuan-detail&id=' + id + '&update=1&t=' + new Date().getTime();
                    })
                }
            })
        })
    }
</script>
