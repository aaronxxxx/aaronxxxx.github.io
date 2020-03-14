<table width="100%" cellspacing="0" cellpadding="0"
               id=editProduct >
            <tr>
                <td ><font><span class="pro_title">用户管理：黑名单管理</span></font>
                </td>
            </tr>
            <tr>
                <td  align="center" >
                    <form action="/?r=member/hacker/add" method="post" name="form1" id="form1">
                        <table width="661" align="center" class="settable bordercolor">
                            <tr>
                                <td class="pdrgt15">备注：：</td>
                                <td>提款时，先验证下如下危险用户</td>
                            </tr>

                            <tr>
                                <td class="pdrgt15">用户列表</td>
                                <td>
									<textarea rows="30" cols="30" name="userarea" placeholder="一行一个用户名"></textarea>
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
	function saveinfo(){
		$.ajax({
			url:"/?r=member/hacker/add",
			type:'POST',
			data:$('#form1').serialize(),
			error: function($e){
				alert('服务器未响应！');
			},
			success:function($html){
				alert("操作成功了！");
			}
		});
	}
</script>