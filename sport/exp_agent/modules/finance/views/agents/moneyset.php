<table align="center" width="100%">
    <tbody><tr >
        <td  class="pd10"><font class="pro_title">&nbsp;代理餘額手工結算</font></td>
    </tr>
    <tr>
        <?php if($user){?>
            <td  align="center" nowrap="" >
                <form name="form1" method="post" action="" id="form1">
                    <table border="1"  cellspacing="0" cellpadding="0" class="settable bordercolor" id="editProduct"  style="width: 1092px">
                        <tbody><tr>
                            <td width="16%"  align="right">代理名：</td>
                            <td width="84%" align="left">
                                <font color="Red"><?=$user['agents_name'];?></font>
                                <input type="hidden" name="id" value="<?=$user['id'];?>">
                                <input type="hidden" name="save" value="ok">
                                <input name="agents_name" type="hidden" id="agents_name" value="<?=$user['agents_name'];?>"></td>
                        </tr>
                        <tr>
                            <td  align="right">類型：</td>
                            <td align="left">
                                <input name="type" type="radio" value="add" <?= $type=='add' ? 'checked':''?>><span style="color:#009900">加錢</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="type" type="radio" value="tixian" <?= $type=='tixian' ? 'checked':''?>><span style="color:#FF0000">扣钱</span>
                                <input name="type_str" type="hidden" value="<?= $type=='add' ? '增加':'扣除'?>"></td>
                        </tr>
                        <tr>
                            <td  align="right">可用額度：</td>
                            <td align="left"><span name="parent_money" class="STYLE5"><?=$parent['money']?></span></td>
                        </tr>
                        <tr>
                            <td  align="right">代理當前額度：</td>
                            <td align="left"><span name="user_money" class="STYLE5"><?=$user['money']?></span></td>
                        </tr>
                        <tr>
                            <td  align="right">金額：</td>
                            <td align="left"><input name="money" type="text" size="10" maxlength="10"
                            onchange="if(isNaN(this.value)){alert('只能輸入數字');this.value='';}else if(this.value><?=$parent['money']?>&& $('input[name=type]:checked').val()=='add'){alert('請勿超過額度');this.value='';}else if(this.value><?=$user['money']?> &&$('input[name=type]:checked').val()=='tixian'){alert('扣款請勿超過代理額度');this.value='';}">
                                <span class="STYLE3">*</span><span class="STYLE5">必須為數字</span></td>
                        </tr>
                        <tr>
                            <td  align="right">備註：</td>
                            <td align="left"> <input name="about" type="text" size="40" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">&nbsp;</td>
                            <td align="left">
                                <input name="submit" type="submit" style="width:100px;" value="確定"></td>
                        </tr>
                        </tbody></table>
                </form>
            </td>
        <?php }else{?>
            <td>找不到您要操作的用戶</td>
        <?php }?>
    </tr>
    </tbody>
</table>
<script>
    type = $('input[name=type]:checked').val();
    $(function () {
        $("input[name=submit]").click(function (e) {
            e.preventDefault();
            layer.confirm('確定要提交嗎？', {icon: 3, title:'提示'}, function(index){
                layer.close(index);
                var money = $("input[name=money]").val();
                var reason = $("input[name=about]").val();
                if(money=='' || money=='undefined' || money==0){
                    layer.alert('金額不能為空且不能為0');
                    return false;
                }
                if(money<0){
                    layer.alert('金額不能為空且不能小於0');
                    return false;
                }
                if(reason=='' || reason=='undefined'){
                    layer.alert('理由不能為空');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "/?r=finance/agents/do-money-set",
                    data: $("#form1").serialize(),
                    error:function () {
                        layer.alert('出錯了，請稍後再試');
                    },
                    success: function(data){
                        layer.alert(data,function (index) {
                            layer.closeAll();
                            window.location.href = '?r=finance/agents/index&agents_name=<?=$user['agents_name'];?>';
                        });
                    }
                })
            });
        })
    })
</script>