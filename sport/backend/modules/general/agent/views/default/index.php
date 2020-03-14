<form id="gridSearchForm" method="get" action="#/agent/default/index">

    <div class="pro_title pd10">總代理匯款：總代理匯款回公司，匯款後將補回信用額度</div>

    <div class="trinput inputct pd10">
            <span>總代理名稱：
                <input name="username" type="text" size="20" maxlength="20" value="<?=$userName?$userName:'';?>">
                <input name="find" type="button" id="gridSearchBtn" value="查詢">
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
                        <td width="20%" height="20" align="center"><strong>總代理名稱</strong></td>
                        <td width="20%"><strong>信用額度</strong></td>
                        <td width="20%"><strong>可用餘額</strong></td>
                        <td width="20%"><strong>應繳金額</strong></td>
                        <td colspan="1"><strong>操作</strong></td>
                    </tr>
                    <?php if(count($user) > 0){foreach($user as $user){?>
                        <tr align="center">
                            <td height="20"><?=$user?$user['agents_name']:'';?></td>
                            <td><font color="#FF0000"><?=$user?$user['limit_money']:'';?></font></td>
                            <td><font color="#FF0000"><?=$user?$user['money']:'';?></font></td>
                            <td><font color="#FF0000"><?=(float)$user['limit_money']-(float)$user['money'];?></font></td>
                            <td width="20%" align="center"><a href="#/agent/default/money-set&uid=<?=$user['id'];?>&type=add">匯款</a></td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>
<br>
<div class="pro_title">今日匯款記錄</div>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
        <td height="24" >
            <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" id=editProduct   width="100%" >
                <tr class="t-title dailitr" align="center">
                    <td width="10%" height="24" ><strong>總代理名稱</strong></td>
                    <td width="10%" ><strong>類型</strong></td>
                    <td width="30%" ><strong>匯款單號</strong></td>
                    <td width="10%" ><strong>匯款銀行</strong></td>
                    <td width="25%"><strong>金額</strong></td>
                    <td width="15%" ><strong>操作時間</strong></td>
                </tr>
                <?php if($addMinus){foreach($addMinus as $v){?>
                    <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
                        <td  height="35" align="center" ><?=$v['agents_name']?></td>
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
