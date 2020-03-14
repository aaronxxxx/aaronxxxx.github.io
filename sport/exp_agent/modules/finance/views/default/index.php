<form id="gridSearchForm" method="get" action="?r=finance/default/index">

    <div class="pro_title pd10">加款扣款：對用戶財務進行加款扣款</div>

    <div class="trinput inputct pd10">
            <span>用戶名：
                <input name="username" type="text" size="20" maxlength="20" value="<?=$user?$user['user_name']:'';?>">
                <input name="find" type="button" id="gridSearchBtn" value="查找" onclick="location.href = $('#gridSearchForm').attr('action') + '&' + $('#gridSearchForm').serialize();">
            </span>
    </div>
 
</form>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tbody>
        <tr>
            <td height="24" nowrap="" >
                <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable line35" id="editProduct" width="100%">
                    <tbody>
                    <tr  align="center">
                        <td width="20%" height="20" align="center"><strong>用戶名</strong></td>
                        <td width="20%"><strong>賬戶餘額</strong></td>
                        <td colspan="2"><strong>操作</strong></td>
                    </tr>
                    <?php if($user){?>
                        <tr align="center">
                            <td height="20"><?=$user?$user['user_name']:'';?></td>
                            <td><font color="#FF0000"><?=$user?$user['money']:'';?></font></td>
<!--                            --><?php //if ($user['account_type'] == 0 ) { ?>
<!--                                <td width="60%" align="center">儲值卡會員無法手動加扣款</td>-->
<!--                            --><?php //} else { ?>
                            <td width="31%" align="center"><a href="?r=finance/default/money-set&uid=<?=$user['user_id'];?>&type=add">加錢</a></td>
                            <td width="29%" align="center"><a href="?r=finance/default/money-set&uid=<?=$user['user_id'];?>&type=tixian">扣錢</a></td>
<!--                            --><?php //} ?>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>
<br>
<span class="pro_title">今日加款扣款記錄</span>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
        <td height="24" >
            <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" id=editProduct   width="100%" >
                <tr class="t-title dailitr" align="center">
                    <td width="10%" height="24" ><strong>用戶名</strong></td>
                    <td width="10%" ><strong>類型</strong></td>
                    <td width="30%" ><strong>系統訂單號</strong></td>
                    <td width="10%" ><strong>匯款銀行</strong></td>
                    <td width="25%"><strong>金額</strong></td>
                    <td width="15%" ><strong>提交時間</strong></td>
                </tr>
                <?php if($addMinus){foreach($addMinus as $v){?>
                    <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
                        <td  height="35" align="center" ><?=$v['user_name']?></td>
                        <td><?=$v["type"]?></td>
                        <td>
                            <?=$v["order_num"]?>
                            <?php if($v["about"]){?>
                                <br/><span style="color:#FF0000;"><?=$v["about"]?></span>
                            <?php }?>
                        </td>
                        <td><?=isset($v["bank"])?$v["bank"]:""?></td>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="33%" style="color:#999999;" class="bder0"><?=$v["assets"]?></td>
                                    <td width="34%" align="center" style="color:#225d9c;" class="bder0"><?=$v['order_value']?></td>
                                    <td width="33%" align="right" style="color:#999999;" class="bder0 bderr0"><?=$v["balance"]?></td>
                                </tr>
                            </table>
                        </td>
                        <td><?=$v['update_time']?></td>
                    </tr>
                <?php }}?>
            </table>
