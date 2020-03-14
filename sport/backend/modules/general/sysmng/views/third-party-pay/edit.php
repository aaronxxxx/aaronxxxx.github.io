<div class="pro_title pd10">支付管理 &nbsp;&nbsp;编辑支付信息</div>
<form id="form1" name="form1" method="post" action="payset.php?action=save">
	<table width="100%" class="settable" cellspacing="0" cellpadding="0" id=editProduct >
		<input name="id" type="hidden" id="id" value="<?= $data['id'];?>"/>
		<tr align="center">
            <td width="13%" align="right">支付名称：</td>
            <td width="87%" align="left">
                <input name="platform_name" type="text" id="platform_name" value="<?= $data['platform_name'];?>" size="10" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付代號：</td>
            <td width="87%" align="left">
                <input name="pay_type" type="text" id="pay_type" value="<?= $data['pay_type'];?>" size="10" />
                辨识支付功能使用，请勿重复
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付域名：</td>
            <td width="87%" align="left">
                <input name="pay_domain" type="text" id="pay_domain" value="<?= $data['pay_domain'];?>" size="50" />
                完整的URL地址,如http://www.baidu.com/
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">账户号：</td>
            <td width="87%" align="left">
                <input name="merchant_id" type="text" id="merchant_id" value="<?= $data['merchant_id'];?>" size="30" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">商户名：</td>
            <td width="87%" align="left">
                <input name="merchant_username" type="text" id="merchant_username" value="<?= $data['merchant_username'];?>" size="30" />
            </td>
        </tr>

        <tr align="center">
            <td width="13%" align="right">支付key：</td>
            <td width="87%" align="left">
                <textarea name="pay_key" type="text" id="pay_key" value="" cols="50" rows="10"><?= $data['pay_key'];?></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">对口rsa公钥：</td>
            <td width="87%" align="left">
                <textarea name="public_key" type="text" id="public_key" value=""  cols="50" rows="10"><?= $data['public_key'];?></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付密钥：</td>
            <td width="87%" align="left">
                <textarea name="pay_secret" type="text" id="pay_secret" value=""  cols="50" rows="10"><?= $data['pay_secret'];?></textarea>
            </td>
        </tr>
		<tr align="center">
			<td align="right">操作：</td>
			<td align="left"><label> <input type="button" name="Submit" value="提交" onClick="savechange()" />
				</label></td>
		</tr>
	</table>
</form>
<script>
    function savechange(){
        $.ajax({
            async: true,
            type: "POST",
            url: "/?r=sysmng/third-party-pay/updedit",
            data: $('#form1').serialize(),
            dataType: "json",
            success: function (data) {
                if (data.code == 0) {
                    alert('编辑更新成功');
                    window.location.href="#/sysmng/third-party-pay";
                } else {
                    alert(data.msg);
                }
            },
            error: function (error) {
                alert(error.responseText);
            }
        })
    }
</script>