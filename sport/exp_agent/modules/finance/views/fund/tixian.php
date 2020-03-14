<?php use yii\widgets\LinkPager;?>
<form id="gridSearchForm" name="form1" method="GET" action="?r=finance/fund/tixian" >

    <div class="pro_title">提現管理：查看所有的用戶提款申請</div>
            
                <div class="w900 mgauto middle">
                        <div class="trinput inputct pd10">
                            <span  align="center"><select name="status" id="status">
                                    <option value="未結算" <?= $status == '未結算' ? 'selected' : '' ?> style="color:#FF9900;">未處理</option>
                                    <option value="失敗" <?= $status == '失敗' ? 'selected' : '' ?> style="color:#FF0000;">提款失敗</option>
                                    <option value="成功" <?= $status == '成功' ? 'selected' : '' ?> style="color:#006600;">提款成功</option>
                                    <option value="全部提款" <?= $status == '全部提款' ? 'selected' : '' ?>>全部提款</option>
                                </select>
                            </span>
                            <span  align="center"><select name="order" id="order">
                                    <option value="id" <?= $order == 'id' ? 'selected' : '' ?>>默認排序</option>
                                    <option value="order_value" <?= $order == 'order_value' ? 'selected' : '' ?>>提款金額</option>
                                    <option value="sxf" <?= $order == 'sxf' ? 'selected' : '' ?>>手續費</option>
                                    <option value="update_time" <?= $order == 'update_time' ? 'selected' : '' ?>>申請時間</option>
                                </select></span>
                            <span align="center" style="display: none;"><select name="time" id="time">
                                    <option value="CN" <?= $time == 'CN' ? 'selected' : '' ?>>中國時間</option>
                                    <option value="EN" <?= $time == 'EN' ? 'selected' : '' ?>>美東時間</option>
                                </select></span>
                            <span  align="left">日期：
                                <input name="time_start" type="text" id="time_start" value="<?= $time_start ?>"onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 00:00:00'})" size="20" maxlength="10" readonly="readonly" />
                                ~
                                <input name="time_end" type="text" id="time_end" value="<?= $time_end ?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 23:59:59'})" size="20" maxlength="10" readonly="readonly" />
                                &nbsp;&nbsp;會員名稱：
                                <input name="username" type="text" id="username" value="<?= $username ?>" size="20" maxlength="20"/>
                                &nbsp;&nbsp;
                                <input name="find" type="button" id="gridSearchBtn" value="查找"/>
<!--                                <input name="find" onclick="cleanAll()" type="submit" id="find" value="查看全部"/>-->
                            </span>
                        </div>
                </div>
     </form>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" >
        <tr>
            <td height="24" >
                <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" id=editProduct   width="100%" >
                    <tr class="t-title dailitr" align="center">
                        <td width="5%" ><strong>編號</strong></td>
                        <td width="8%" ><strong>會員名</strong></td>
                        <td width="18%" ><strong>訂單號</strong></td>
                        <td width="8%"><strong>提款金額</strong></td>
                        <td width="8%"><strong>手續費</strong></td>
                        <td width="5%"><strong>查看財務</strong></td>
                        <td width="15%" ><strong>開戶行/卡號</strong></td>
                        <td width="18%" ><strong>開戶人/開戶地址</strong></td>
                        <td width="9%" ><strong>申請時間</strong></td>
                        <td width="6%" ><strong>操作</strong></td>
                    </tr>
                    <?php if($data){foreach($data as $rows){  $money = abs($rows["order_value"]);
                        $name = $str=substr($rows["order_num"],15);
                        ?>
                            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'">
                                <td height="20" align="center"  ><?= $rows["id"] ?></td>
                                <td height="20" align="center"  ><?= $name ?></td>
                                <td><A href="?r=finance/fund/tixian-detail&id=<?= $rows["id"] ?>" style="color: #F37605;"><?= $rows["order_num"] ?></A><?php if($rows["type"]=="後台扣款"){echo "<br/>後台扣款，理由：".$rows["about"];} ?></td>
                                <td><span style="color:#999999;"><?= $rows["assets"] ?></span><br /><?= $money ?><br /><span style="color:#999999;"><?= $rows["balance"] ?></span></td>
                                <td><?= $rows["sxf"] ?></td>
                                <td><a href="?r=finance/fund/look-money&username=<?=$name?>&status=<?=$status=='全部提款'?'所有狀態':$status;?>&time_start=<?=  urlencode($time_start)?>&time_end=<?=  urlencode($time_end)?>"  style="color: #F37605;">查看財務</a></td>
                                <td><?= $rows["pay_card"] ?><br/><?= $rows["pay_num"] ?></td>
                                <td><?= $rows["pay_name"] ?><br/><?= $rows["pay_address"] ?></td>
                                <td><?= $rows["update_time"] ?></td>
                                <td>
                                    <?php if ($rows["status"] == "失敗") {?>
                                    <span style="color:#FF0000;">提款失敗</span>
                                    <?php } else if ($rows["status"] == "成功") {?>
                                    <span style="color:#006600;">提款成功</span>
                                    <?php } else {if ($rows["status"] == "未結算") {?>
                                    <a href="?r=finance/fund/tixian-detail&id=<?=$rows["id"]?>">結算</a>
                                    <?php }if ($rows["status"] == "審核中") {?>
                                       處理<a href="?r=finance/fund/tixian-detail&id=<?=$rows["id"]?>">審核中</a>
                                    <?php }}?>
                                </td>
                            </tr>
                    <?php }}?>
                </table>
            </td>
        </tr>
        <tr>
            <td ><div class="cksum">總金額：<span style="color:#0000FF"><?= $m_sum ?></span>，成功：<span style="color:#006600"><?= $t_sum ?></span>，手續費：<span style="color:#FF00FF"><?= $sxf_sum ?></span>，失敗：<span style="color:#FF0000"><?= $f_sum ?></span>，審核：<span style="color:#FF9900"><?= $c_sum ?></span>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div><?= LinkPager::widget(['pagination' => $pages]); ?></div>
            </td>
        </tr>
    </table>
    <?php
    if ($username) {
        ?>
        <br /><?= $username ?> 歷史銀行卡信息：<br />
        <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct   width="100%" >    
            <tr  class="t-title"  align="center">
                <td width="15%"><strong>開戶人</strong></td>
                <td width="15%"><strong>開戶行</strong></td>
                <td width="20%"><strong>銀行卡號</strong></td>
                <td width="35%"><strong>開戶地址</strong></td>
                <td width="15%"><strong>添加日期</strong></td>
            </tr>
            <?php foreach($historybank as $row){?>
                <tr onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color:#FFFFFF;">
                    <td height="30" align="center"><?= $row['pay_name'] ?></td>
                    <td align="center"><?= $row['pay_card'] ?></td>
                    <td align="center"><?= $row['pay_num'] ?></td>
                    <td align="center"><?= $row['pay_address'] ?></td>
                    <td align="center"><?= $row['addtime'] ?></td>
                </tr>
                <?php }}?>
    </table>
</body>
</html>