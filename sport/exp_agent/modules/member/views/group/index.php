
&nbsp;<span class="pro_title flg">用戶管理：查看會員組的信息</span></font><font color="#FF0000"  class="font15 frg">&nbsp;<span style="cursor:pointer;" onclick="addGroup()">新增會員組</span></font>

<form name="form2" method="post" action="" style="margin:0 0 0 0;">
   

                <table width="100%"  cellspacing="0" cellpadding="0" id=editProduct style="margin-top: 20px;"  class="font12 skintable line35" >     
                    <tr  class="t-title dailitr"  align="center">
                        <td width="14%" height="20" ><strong>會員組名稱</strong></td>
                        <td width="15%" ><strong>是否默認</strong></td>
                        <td width="14%" ><strong>查看明細</strong></td>
                        <td width="13%" ><strong>修改會員組名稱</strong></td>
                    </tr>
                    <?php
                        foreach($usergroup as $key => $rows){
                            $over	= "#EBEBEB";
                            $out	= "#ffffff";
                            $color	= "#FFFFFF";
                            ?>
                            <tr align="center" onMouseOver="this.style.backgroundColor='<?php echo $over?>'" onMouseOut="this.style.backgroundColor='<?php echo $out?>'" style="background-color:<?php echo $color?>">
                                <td><?php echo $rows["group_name"]?></td>
                                <td><?php echo $rows["default_group"]?></td>
                                <td><a href="?r=lotteryodds/default/money-set&group_id=<?php echo $rows["group_id"]?>"><span style="color:#F37605;">查看明細</span></a></td>
                                <td><input type="button" id="<?php echo $rows["group_id"]?>" value="修改名稱" onclick="editName(this.id,'<?php echo $rows['group_name']?>')" class="groupninput"></td>
                            </tr>
                        <?php
                        }
                    ?>
                </table>
        
</form>
    <script type="text/javascript">
        function editName(id,name){
            var sResult=prompt("請在下面輸入更改的內容", name);
            if(sResult!=null){
                $.ajax({
                    type: "POST",
                    url: "/?r=member/group/save",
                    data: {group_id:id, group_name:sResult}
                }).done(function( msg ) {
                        document.location.href='?r=member/group&n_time=<?= time();?>';
                    }).fail(function(error){
                        alert("修改失敗");
                    });
            }
        }
        function addGroup(){
            $.ajax({
                url: "/?r=member/group/addgroup",
            }).done(function( msg ) {
                $.dialog.alert('添加成功！')
                    document.location.href='?r=member/group&n_time=<?= time();?>';
                }).fail(function(error){
                    alert("修改失敗");
                });
		}
    </script>