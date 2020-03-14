<?php

use yii\widgets\LinkPager;
?>
<script>
    function del(id) {
        $.ajax({
            async: true,
            type: "get",
            url: '?r=sysmng/account/del&id=' + id,
            dataType: "json",
            success: function (data) {
                if (data.code == 0) {
                    alert('删除成功！！');
                    window.location.href = "#/sysmng/account&t=" + new Date().getTime();
                } else {
                    alert(data.msg);
                }
            },
            error: function (error) {
                alert(error.responseText);
            }
        })
    }
    function upd(id){
        var code = 1;
        $.ajax({
            async:true,
            tyoe:'get',
            url:'?r=sysmng/account/upd&id=' + id +'&code=1',
            dataType:'json',
            success: function(res){
                if(res.code == 0){
                    alert('操作成功！！');
                    window.location.href="#/sysmng/account&t="+new Date().getTime();
                }else{
                    alert(data.msg);
                }
            }
        })
    }
</script>

<div class="pro_title  font14">系统设置：查看汇款信息列表</div>
<form name="form2" method="post" action=""  style="margin:0 0 0 0;">

    <div align="right" class="font14"><a href="#/sysmng/account/add">新增汇款信息&nbsp;&nbsp;&nbsp;&nbsp;</a></div>

                <table width="100%"idth="100%" border="1"  cellspacing="0" cellpadding="0" class="font14 skintable line35"  id=editProduct>
                    <tr class="t-title dailitr" class="t-title"  align="center">
                        <td width="20%" ><strong>银行名称</strong></td>
                        <td width="25%" height="20" ><strong>银行账号</strong></td>
                        <td width="10%" ><strong>开户名</strong></td>
                        <td width="10%" ><strong>开户城市</strong></td>
                        <td width="15%" ><strong>类型</strong>（1-网银 2-微信 <br>3-支付宝 4-財付通）</td>
                        <td width="20%" ><strong>操作</strong></td>
                    </tr>
                    <?php
                    foreach ($rs as $key => $rows) {
                        ?>
                        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#ffffff">
                            <td><?php echo $rows["bank_name"] ?></td>
                            <td><?php echo $rows["bank_number"] ?></td>
                            <td><?php echo $rows["bank_xm"] ?></td>
                            <td><?php echo $rows["bank_city"] ?></td>
                            <td><?php echo $rows["bank_type"] ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="upd(<?php echo $rows["id"] ?>)">
                                    <?php
                                        if($rows["bank_status"] == 0){
                                            ?>
                                            <span style="color:#337ab7;">启用</span>
                                            <?php
                                        }else{
                                            ?>
                                            <span style="color:#FF0000;">停用</span>
                                            <?php
                                        }
                                    ?>
                                </a>
                                |<a href="#/sysmng/account/detail&id=<?php echo $rows["id"] ?>"><span style="color:#F37605;">修改</span></a>
                                |<a href="javascript:del('<?php echo $rows["id"] ?>')"><span style="color:#F37605;">删除</span></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
          
                    <?php
                    echo LinkPager::widget(['pagination' => $pagination]);
                    ?>
              
    
</form>