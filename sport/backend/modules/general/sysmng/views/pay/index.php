<div class="pro_title pd10" xmlns="http://www.w3.org/1999/html">支付管理</div>
<table width="100%" class="font14 skintable line35 mgb10"
       cellspacing="0" cellpadding="0"
       id=editProduct
       >
    <tr class="t-title dailitr" class="t-title" align="center">
        <td><strong>类型id</strong></td>
        <td><strong>支付名称</strong></td>
        <td><strong>支付平台</strong></td>
        <td><strong>支付类型</strong></td>
        <td><strong>支付域名</strong></td>
        <td><strong>商户号ID</strong></td>
        <td><strong>账户名</strong></td>
        <td><strong>支付限额</strong></td>
        <td><strong>已有金额</strong></td>
        <td><strong>最低充值</strong></td>
        <td width="15%" ><strong>操作</strong></td>
    </tr>
<?php
    foreach ($data as $k =>$val) {
?>
    <tr onMouseOver="this.style.backgroundColor = '#C0E0F8'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color: #FFFFFF;">
        <td><?= $val['order_id']?></td>
        <td><?= $val['platform_name']?></td>
        <td><?= $val['pay_type']?></td>
        <td><?= $val['submit_type']?></td>
        <td><?= $val['pay_domain']?></td>
        <td><?= $val['merchant_id']?></td>
        <td><?= $val['merchant_userNO']?></td>
        <td><?= $val['money_limits']?></td>
        <td><?= $val['money_Already']?></td>
        <td><?= $val['money_Lowest']?></td>
        <td align="center">
            <?php if ($val['b_start'] == 0) { ?>
                <a href="javascript:void(0)" onclick="enableData('<?=$val['id'] ?>')" title="未开启">启用</a>
            <?php } else { ?>
                <a href="javascript:void(0)" onclick="enableData('<?=$val['id'] ?>')" title="正在使用中"><font color="#FF0000"><b>停用</b></font></a>
            <?php } ?>
            &nbsp;|&nbsp;<a href="#/sysmng/pay/edit&id=<?=$val['id'] ?>">编辑</a>
            &nbsp;|&nbsp;<a href="javascript:void(0)" onclick="delData('<?=$val['id'] ?>')">删除</a>
            &nbsp;|&nbsp;<a href="javascript:void(0)" onclick="clearData('<?=$val['id'] ?>')">清零</a>
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
            <td width="13%" align="right">排序ID：</td>
            <td width="87%" align="left">
                <input name="order_id" type="text" id="order_id" value="" size="10" />
                数字越小越靠前
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付名称：</td>
            <td width="87%" align="left">
                <input name="platform_name" type="text" id="platform_name" value="" size="10" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付平台类别：</td>
            <td width="87%" align="left">
                <input name="pay_type" type="text" id="pay_type" value="" size="10" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付类型：</td>
            <td width="87%" align="left">
                <input name="submit_type" type="text" id="submit_type" value="" size="10" />0-通用 1-网银 2-微信 3-支付宝
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
            <td width="13%" align="right">商户号ID：</td>
            <td width="87%" align="left">
                <input name="merchant_id" type="text" id="merchant_id" value="" size="30" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">账户号：</td>
            <td width="87%" align="left">
                <input name="merchant_userNO" type="text" id="merchant_userNO" value="" size="30" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">商户名：</td>
            <td width="87%" align="left">
                <input name="merchant_username" type="text" id="merchant_username" value="" size="30" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">支付限额：</td>
            <td width="87%" align="left">
                <input name="money_limits" type="text" id="money_limits" value="9999999" size="20" />
                当此帐户充值达到限额时，自动切换到其他帐户(按照排序，由小到大)
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">最低充值：</td>
            <td width="87%" align="left">
                <input name="money_Lowest" type="text" id="money_Lowest" value="100" size="20" />
                允许用户最低充值限额
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">密钥：</td>
            <td width="87%" align="left">
                <textarea name="pay_key" type="text" id="pay_key" value="pay_key" cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">公钥：</td>
            <td width="87%" align="left">
                <textarea name="public_key" type="text" id="public_key" value="public_key"  cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">首码：</td>
            <td width="87%" align="left">
                <input name="first_code" type="text" id="first_code" value="first_code" size="20" />
            </td>
        </tr>
        <tr align="center">
            <td width="13%" align="right">回调域名：</td>
            <td width="87%" align="left">
                <input name="f_url" type="text" id="f_url" value="f_url" size="20" />
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
                    <input type="checkbox" name="group_set[]" value="<?=$t['group_id']?>"> <?=$t['group_name']?>
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
            <td align="left"><label> <input type="button" name="Submit" value="提交" onClick="savepay()" />
                </label></td>
        </tr>
    </table>
</form>
<script>
    function enableData(id) {
        $.ajax({
            type: "GEY",
            url: "?r=sysmng/pay/upd&id="+id,
            dataType: "json",
            success: function (data) {
                if(data.status) {
                    window.location.href='#/sysmng/pay&t='+new Date().getTime();
                }
                $.dialog.notify(data.msg);
            },
            error: function (error) {
                $.dialog.notify(error.responseText);
            }
        })
    }
    function clearData(id) {
        $.ajax({
            type: "GEY",
            url: "?r=sysmng/pay/clear&id="+id,
            dataType: "json",
            success: function (data) {
                if(data.status) {
                    window.location.href='#/sysmng/pay&t='+new Date().getTime();
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
            url: "?r=sysmng/pay/del&id="+id,
            dataType: "json",
            success: function (data) {
                if(data.status) {
                    window.location.href='#/sysmng/pay&t='+new Date().getTime();
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
            url: "/?r=sysmng/pay/save",
            data: $('#form1').serialize(),
            dataType: "json",
            success: function (data) {
                if (data.status) {
                    window.location.href='#/sysmng/pay&t='+new Date().getTime();
                }
                $.dialog.notify(data.msg);
            },
            error: function (error) {
                $.dialog.notify(error.responseText);
            }
        })
    }
</script>