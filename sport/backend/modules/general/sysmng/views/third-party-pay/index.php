<div class="pro_title pd10" xmlns="http://www.w3.org/1999/html">支付管理</div>
<table width="100%" class="font14 skintable line35 mgb10"
       cellspacing="0" cellpadding="0"
       id=editProduct
       >
    <tr class="t-title dailitr" class="t-title" align="center">

        <td><strong>支付名称</strong></td>


        <td><strong>支付域名</strong></td>
        <td><strong>支付代号</strong></td>
        <td><strong>账户号</strong></td>

        <td width="15%" ><strong>操作</strong></td>
    </tr>
<?php
    foreach ($data as $k =>$val) {
?>
    <tr onMouseOver="this.style.backgroundColor = '#C0E0F8'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color: #FFFFFF;">

        <td><?= $val['platform_name']?></td>

        <td><?= $val['pay_domain']?></td>
        <td><?= $val['pay_type']?></td>
        <td><?= $val['merchant_id']?></td>

        <td align="center">
            <?php if ($val['b_start'] == 0) { ?>
                <a href="javascript:void(0)" onclick="enableData('<?=$val['id'] ?>')" title="未开启">启用</a>
            <?php } else { ?>
                <a href="javascript:void(0)" onclick="enableData('<?=$val['id'] ?>')" title="正在使用中"><font color="#FF0000"><b>停用</b></font></a>
            <?php } ?>
            &nbsp;|&nbsp;<a href="#/sysmng/third-party-pay/edit&id=<?=$val['id'] ?>">编辑</a>
            &nbsp;|&nbsp;<a href="javascript:void(0)" onclick="delData('<?=$val['id'] ?>')">删除</a>
        </td>
    </tr>
<?php
}
?>
</table>
<div class="pro_title pd10">添加支付信息</div>
<form id="form1" name="form1" method="post" action="payset.php?action=save">
    <table width="100%" class="settable" cellspacing="0" cellpadding="0" id=editProduct >

        <tr align="center">
            <td width="13%" align="right">支付名称：</td>
            <td width="87%" align="left">
                <input name="platform_name" type="text" id="platform_name" value="" size="10" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付代號：</td>
            <td width="87%" align="left">
                <input name="pay_type" type="text" id="pay_type" value="" size="10" />
                辨识支付功能使用，请勿重复
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付域名：</td>
            <td width="87%" align="left">
                <input name="pay_domain" type="text" id="pay_domain" value="" size="50" />
                完整的URL地址,如http://www.baidu.com/
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">账户号：</td>
            <td width="87%" align="left">
                <input name="merchant_id" type="text" id="merchant_id" value="" size="30" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">商户名：</td>
            <td width="87%" align="left">
                <input name="merchant_username" type="text" id="merchant_username" value="" size="30" />
            </td>
        </tr>

        <tr align="center">
            <td width="13%" align="right">支付key：</td>
            <td width="87%" align="left">
                <textarea name="pay_key" type="text" id="pay_key" value="" cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">对口rsa公钥：</td>
            <td width="87%" align="left">
                <textarea name="public_key" type="text" id="public_key" value=""  cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付密钥：</td>
            <td width="87%" align="left">
                <textarea name="pay_secret" type="text" id="pay_secret" value=""  cols="50" rows="10"></textarea>
            </td>
        </tr>

        <tr align="center">
            <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr align="center">
            <td align="right">操作：</td>
            <td align="left"><label> <input type="button" name="Submit" value="提交" onClick="savepay()" />
                </label></td>
        </tr>
    </table>
</form>
<script>
    function enableData(id) {
        $.ajax({
            type: "GEY",
            url: "?r=sysmng/third-party-pay/upd&id="+id,
            dataType: "json",
            success: function (data) {
                if(data.status) {
                    window.location.href='#/sysmng/third-party-pay&t='+new Date().getTime();
                }
                $.dialog.notify(data.msg);
            },
            error: function (error) {
                $.dialog.notify(error.responseText);
            }
        })
    }

    function delData(id) {
        $.ajax({
            type: "GEY",
            url: "?r=sysmng/third-party-pay/del&id="+id,
            dataType: "json",
            success: function (data) {
                if(data.status) {
                    window.location.href='#/sysmng/third-party-pay&t='+new Date().getTime();
                }
                $.dialog.notify(data.msg);
            },
            error: function (error) {
                $.dialog.notify(error.responseText);
            }
        })
    }
    function savepay() {
        $.ajax({
            async: true,
            type: "POST",
            url: "/?r=sysmng/third-party-pay/save",
            data: $('#form1').serialize(),
            dataType: "json",
            success: function (data) {
                if (data.status) {
                    window.location.href='#/sysmng/third-party-pay&t='+new Date().getTime();
                }
                $.dialog.notify(data.msg);
            },
            error: function (error) {
                $.dialog.notify(error.responseText);
            }
        })
    }
</script>