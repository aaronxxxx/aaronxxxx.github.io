<table width="100%" cellspacing="0" cellpadding="0"
               id=editProduct >
            <tr>
                <td ><font><span class="pro_title">用户管理：设置会员组</span></font>
                </td>
            </tr>
            <tr>
                <td  align="center" >
                    <form action="/?r=member/user/savegroup" method="post" name="form1" id="form1">
                    	<input type="hidden" value="<?php echo $rs["user_id"] ?>" name="uid" id="uid"/>
                        <input type="hidden" value="<?php echo $rs["user_name"] ?>" name="uname" id="uid"/>
                        <input type='hidden' value='未修改会员组' name='gname' id='gname' />
                        <p>&nbsp;</p>
                        <table width="661" align="center" class="settable bordercolor">
                            <tr>
                                <td class="pdrgt15">用户名</td>
                                <td><?php echo  $rs["user_name"] ?></td>
                            </tr>
                            <tr>
                                <td width="172" class="pdrgt15">当前会员组</td>
                                <td width="473"><?php echo  $rs["group_name"] ?></td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">设置会员组</td>
                                <td>
                                    <select name="group_select" id="group_select">
                                    <?php
                                       foreach ($usergroup as $key => $value) {
									        if ($value['group_name'] == $rs["group_name"]) {
									           echo "<option value='".$value['group_id']."' selected='selected'>".$value['group_name']."</option>";
									        } else {
									            echo "<option value='".$value['group_id']."'>".$value['group_name']."</option>";
									        }
									    }
									  ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">操作</td>
                                <td><input type="button" value="提交" onclick="saveinfo()"/> <input type="button" value="返回列表" onclick="javascript:window.history.back();"/></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>



<script>
//    $(function(){
//        var a = $("#group_select").find("option:selected").text();
//        console.log(a);
//    })
	function saveinfo(){
        $("#gname").val($("#group_select").find("option:selected").text());
		$.ajax({
			url:"/?r=member/user/savegroup",
			type:'POST',
			data:$('#form1').serialize(),
			error: function($e){
				alert('服务器未响应！');
			},
			success:function($html){
				alert("操作成功了！！！");
			}
		});
	}
	</script>