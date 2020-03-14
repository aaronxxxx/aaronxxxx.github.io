<?php use yii\widgets\LinkPager;?>
 <form id="gridSearchForm" name="form1" method="GET" action="#/agent/default/huikuan">
     
     <div class="pro_title">匯款管理：查看所有總代理匯款信息</div>

                <div class=" pd10  mgauto middle" >
            
                <div class="trinput ">
                       <span>日期：
                        <input name="start_time" type="text" id="start_time" value="<?=$s_time;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 00:00:00'})"  size="20" maxlength="10" readonly="readonly">
                        ~
                        <input name="end_time" type="text" id="end_time" value="<?=$e_time;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 23:59:59'})"  size="20" maxlength="10" readonly="readonly">

                        <span class="name">请选择總代理</span>
                        <select class="agent_level" id="agent_level" name="agent_level">
                            <option value=''>请选择</option>
                            <?php foreach($agent_level as $key => $top_agents){
                                ?>
                                <option value='<?php echo $top_agents['id']; ?>'><?php echo $top_agents['agents_name'];?></option>

                            <?php } ?>
                        </select>

                         <input name="find" id="gridSearchBtn" type="button" name="Submit" value="查找">
                   </span>
               
                </div>
                </div>
    </form>

<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tbody>
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
        </td>
    </tr>
    </tbody>
</table>