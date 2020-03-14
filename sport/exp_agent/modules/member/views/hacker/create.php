<table width="100%" cellspacing="0" cellpadding="0"
               id=editProduct >
            <tr>
                <td ><font><span class="pro_title">用戶管理：黑名單管理</span></font>
                </td>
            </tr>
            <tr>
                <td  align="center" >
                    <form action="/?r=member/hacker/add" method="post" name="form1" id="form1">
                        <table width="661" align="center" class="settable bordercolor">
                            <tr>
                                <td class="pdrgt15">備註：：</td>
                                <td>提款時，先驗證下如下危險用戶</td>
                            </tr>

                            <tr>
                                <td class="pdrgt15">用戶列表</td>
                                <td>
									<textarea rows="30" cols="30" name="userarea" placeholder="一行一個用戶名"></textarea>
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
				alert('服務器未響應！');
			},
			success:function($html){
				alert("操作成功了！");
			}
		});
	}
</script>