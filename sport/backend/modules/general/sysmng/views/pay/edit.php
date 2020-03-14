<div class="pro_title pd10">支付管理 &nbsp;&nbsp;编辑支付信息</div>
<form id="form1" name="form1" method="post" action="payset.php?action=save">
	<table width="100%" class="settable" cellspacing="0" cellpadding="0" id=editProduct >
		<input name="id" type="hidden" id="id" value="<?= $data['id'];?>"/>
		<tr align="center">
			<td width="13%" align="right">排序ID：</td>
			<td width="87%" align="left">
				<input name="order_id" type="text" id="order_id" value="<?= $data['order_id'];?>" size="10" readonly="readonly" />只读不可修改（可删除重新添加）
			</td>
		</tr>
        <tr align="center">
            <td width="13%" align="right">支付名称：</td>
            <td width="87%" align="left">
                <input name="platform_name" type="text" id="platform_name" value="<?= $data['platform_name'];?>" size="10" />
            </td>
        </tr>
		<tr align="center">
			<td width="13%" align="right">支付平台类别：</td>
			<td width="87%" align="left">
				<input name="pay_type" type="text" id="pay_type" value="<?= $data['pay_type'];?>" size="10" />
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">支付类型：</td>
			<td width="87%" align="left">
				<input name="submit_type" type="text" id="submit_type" value="<?= $data['submit_type'];?>" size="10" />0-通用 1-网银 2-微信 3-支付宝
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
			<td width="13%" align="right">商户号ID：</td>
			<td width="87%" align="left">
				<input name="merchant_id" type="text" id="merchant_id" value="<?= $data['merchant_id'];?>" size="30" />
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">账户号：</td>
			<td width="87%" align="left">
				<input name="merchant_userNO" type="text" id="merchant_userNO" value="<?= $data['merchant_userNO'];?>" size="30" />
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">商户名：</td>
			<td width="87%" align="left">
				<input name="merchant_username" type="text" id="merchant_username" value="<?= $data['merchant_username'];?>" size="30" />
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">支付限额：</td>
			<td width="87%" align="left">
				<input name="money_limits" type="text" id="money_limits" value="<?= $data['money_limits'];?>" size="20" />
				当此帐户充值达到限额时，自动切换到其他帐户(按照排序，由小到大)
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">最低充值：</td>
			<td width="87%" align="left">
				<input name="money_Lowest" type="text" id="money_Lowest" value="<?= $data['money_Lowest'];?>" size="20" />
				允许用户最低充值限额
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">密钥：</td>
			<td width="87%" align="left">
                <textarea name="pay_key" type="text" id="pay_key" value="" cols="50" rows="10"><?= $data['pay_key'];?></textarea>
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">公钥：</td>
			<td width="87%" align="left">
				<textarea name="public_key" type="text" id="public_key" value="" cols="50" rows="10"><?= $data['public_key'];?></textarea>
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">首码：</td>
			<td width="87%" align="left">
				<input name="first_code" type="text" id="first_code" value="<?= $data['first_code'];?>" size="20" />
			</td>
		</tr>
		<tr align="center">
			<td width="13%" align="right">回调域名：</td>
			<td width="87%" align="left">
				<input name="f_url" type="text" id="f_url" value="<?= $data['f_url'];?>" size="20" />
			</td>
		</tr>
		<tr>
            <td align="right" class="pdr10">分組设置</td>
            <td>
                <?php
                $temp_i=0;
                foreach($group as $key => $t)
                {
					$temp_i++;
                ?>
                    <input type="checkbox" name="group_set[]"  <?php if(in_array($t['group_id'],$hasGroup)){?> checked  <?php }?>  value="<?=$t['group_id']?>"> <?=$t['group_name']?>
                <?php
                    if($temp_i%5==0) echo "<br />";
                }
                ?>
            </td>
        </tr>
		<tr align="center">
			<td colspan="2" align="left">&nbsp;</td>
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
            url: "/?r=sysmng/pay/updedit",
            data: $('#form1').serialize(),
            dataType: "json",
            success: function (data) {
                if (data.code == 0) {
                    alert('编辑更新成功');
                    window.location.href="#/sysmng/pay";
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