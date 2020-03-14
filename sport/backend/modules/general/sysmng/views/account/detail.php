
<script>
    function updateinfo(){
        var id=document.getElementById("id").value;
        var bankname=document.getElementById("bank_name").value;
        var banknum=document.getElementById("bank_number").value;
        var bankxm=document.getElementById("bank_xm").value;
        var bankcity=document.getElementById("bank_city").value;
		var bank_type =document.getElementById("bank_type").value;
		var img_url =document.getElementById("img_url").value;
		var group_set="|";
		$("input[name='group_set[]']:checked:enabled").each(function() {
			group_set+= $(this).val()+"|";
		});
        if(!bankname){
            alert("请输入银行名称");
            return false;
        }
        if(!banknum){
            alert("请输入银行账号");
            return false;
        }
        if(!bankxm){
            alert("请输入开户名");
            return false;
        }
        if(!bankcity){
            alert("请输入开户城市");
            return false;
        }
		if(!bank_type){
			alert("请输入类型");
			return false;
		}
		if(bank_type != 1 && bank_type != 2 && bank_type !=3 && bank_type !=4){
			alert("请输入正确的类型");
			return false;
		}
        $.ajax({
            async: true,
            type: "POST",
            url: "/?r=sysmng/account/upd",
            data: {
                id:id,
            	bankname:bankname,
            	banknum:banknum,
            	bankxm:bankxm,
            	bankcity:bankcity,
				bank_type:bank_type,
				img_url:img_url,
				group_set:group_set
            },
            dataType: "json",

            success: function (data) {
                if (data.code === 0) {
                    alert('账户更新成功');
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


<table width="100%" border="0" cellpadding="3" cellspacing="1" >
  <tr>
    <td height="24" ><font >&nbsp;<span class="pro_title">系统管理：编辑汇款信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" >
		<form action="/?r=sysmng/account/upd" method="post" name="form1" id="form1">
		<input type="hidden" name="r" value="sysmng/account/upd"/>
		<table width="100%" align="center" class="settable bank_edit" cellspacing="0" cellpadding="0"   >
		  <tr>
		    <td align="right">银行名称：</td>
		    <td><input name="bank_name" id="bank_name" value="w<?php echo $rs["bank_name"]?>"></td>
		  </tr>
		  <tr>
		    <td align="right">银行账号：</td>
		    <td><input name="bank_number" id="bank_number" value="<?php echo $rs["bank_number"]?>"></td>
		  </tr>
		  <tr>
		    <td align="right">开户名：</td>
		    <td><input name="bank_xm" id="bank_xm" value="<?php echo $rs["bank_xm"]?>"></td>
		  </tr>
			<tr>
				<td align="right">开户城市：</td>
				<td><input name="bank_city" id="bank_city" value="<?php echo $rs["bank_city"]?>"></td>
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
                    if($temp_i%1==0) echo "<br />";
                }
                ?>
            </td>
        </tr>
			<tr>
				<td align="right">类型：</td>
				<td><input name="bank_type" id="bank_type" value="<?php echo $rs["bank_type"]?>"></td>
			</tr>
			<tr>
				<td align="right">类型填写说明：</td>
				<td>网银:1 微信:2 <br> 支付宝:3 財付通:4</td>
			</tr>
		  <tr>
		  <tr>
				<td align="right">二维码链结：</td>
				<td><input name="img_url" id="img_url" value="<?php echo $rs["img_url"]?>"></td>
			</tr>
		  <tr>
		  	<td colspan="2" align="center">
		        <input id="id" type="hidden" value="<?php echo $rs["id"]?>">
		        <input type="button" value="确认提交" onClick="updateinfo()"> 　
		  	    <input type="button" value="取 消" onClick="javascript:history.go(-1)">&nbsp;&nbsp;&nbsp;
		  	    <input type="button" value="返回列表页" onClick="javascript:location.href='#/sysmng/account/'">
		    </td>
		  </tr>
		</table>
		</form>
	</td>
  </tr>
</table>