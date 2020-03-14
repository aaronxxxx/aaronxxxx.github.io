<table align="center" width="100%">
    <tbody><tr >
        <td  class="pd10"><font class="pro_title">&nbsp;用户余额手工结算</font></td>
    </tr>
    <tr>
        <?php if($user){?>
            <td  align="center" nowrap="" >
                <form name="form1" method="post" action="" id="form1">
                    <table border="1"  cellspacing="0" cellpadding="0" class="settable bordercolor" id="editProduct"  style="width: 1092px">
                        <tbody><tr>
                            <td width="16%"  align="right">用户名：</td>
                            <td width="84%" align="left">
                                <font color="Red"><?=$user['user_name'];?></font>
                                <input type="hidden" name="user_id" value="<?=$user['user_id'];?>">
                                <input type="hidden" name="save" value="ok">
                                <input name="user_name" type="hidden" id="user_name" value="<?=$user['user_name'];?>"></td>
                        </tr>
                        <tr>
                            <td  align="right">类型：</td>
                            <td align="left">
                                <input name="type" type="radio" value="add" <?= $type=='add' ? 'checked':''?>><span style="color:#009900">加钱</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="type" type="radio" value="tixian" <?= $type=='tixian' ? 'checked':''?>><span style="color:#FF0000">扣钱</span>
                                <input name="type_str" type="hidden" value="<?= $type=='add' ? '增加':'扣除'?>"></td>
                        </tr>
                        <tr>
                            <td  align="right">金额：</td>
                            <td align="left">
                                <input type="text" id="defaultmoney" name="money" size="10" maxlength="10" onchange="if(isNaN(this.value)){alert('只能输入数字');this.value='';}$('#streamflow').val(this.value);">
                                <span class="STYLE3">*</span><span class="STYLE5">必须为数字</span>
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">打码量：</td>
                            <td align="left">
                            <input id="multi" type="text" size="10" maxlength="10" placeholder="输入倍数">
                            <input type="button" value="產生" onclick="$('#streamflow').val( $('#defaultmoney').val() * $('#multi').val() );">
                            <hr>
                            <input id="streamflow" name="streamflow" type="text" size="10" maxlength="10" onchange="if(isNaN(this.value)){alert('只能输入数字');this.value='';}">
                                <span class="STYLE3">*</span><span class="STYLE5">用户 [后台充值] 打码量改为由此输入，默认一倍，如需调整可自行输入或是填入倍数产生。</span></td>
                        </tr>
                        <tr>
                            <td  align="right">理由：</td>
                            <td align="left"> <input name="about" type="text" size="40" maxlength="255"> 注释：理由如果包含 "用于活动" 字眼，则此次加/扣钱的金额不会在'代理存取报表'中体现。</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">&nbsp;</td>
                            <td align="left">
                                <input name="submit" type="submit" style="width:100px;" value="确定"></td>
                        </tr>
                        </tbody></table>
                </form>
            </td>
        <?php }else{?>
            <td>找不到您要操作的用户</td>
        <?php }?>
    </tr>
    </tbody>
</table>
<script>
    $(function () {
        $("input[name=submit]").click(function (e) {
            e.preventDefault();
            layer.confirm('确定要提交吗？', {icon: 3, title:'提示'}, function(index){
                layer.close(index);
                var money = $("input[name=money]").val();
                var reason = $("input[name=about]").val();
                if(money=='' || money=='undefined' || money==0){
                    layer.alert('金额不能为空且不能为0');
                    return false;
                }
                if(money<0){
                    layer.alert('金额不能为空且不能小于0');
                    return false;
                }
                if(reason=='' || reason=='undefined'){
                    layer.alert('理由不能为空');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "/?r=finance/default/do-money-set",
                    data: $("#form1").serialize(),
                    error:function () {
                        layer.alert('出错了，请稍后再试');
                    },
                    success: function(data){
                        layer.alert(data,function (index) {
                            layer.closeAll();
                            window.location.href = '#/finance/default/index&user_name=<?=$user['user_name'];?>';
                        });
                    }
                })
            });
        })
    })
</script>