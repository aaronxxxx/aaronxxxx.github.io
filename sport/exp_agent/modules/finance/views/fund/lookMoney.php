<?php

use yii\widgets\LinkPager; ?>
<form id="gridSearchForm" name="form1" method="GET" action="?r=finance/fund/look-money" >
    <span class="pro_title">財務核查</span>

    <div class="w1000 mgauto pd10">
        <div class="trinput inputct tabft13">
            <span>狀態：
                <select name="status" id="status">
                    <option value="成功" <?= $status == "成功" ? 'selected' : '' ?>>成功</option>
                    <option value="失敗" <?= $status == "失敗" ? 'selected' : '' ?>>失敗</option>
                    <option value="未結算" <?= $status == "未結算" ? 'selected' : '' ?>>未結算</option>
                    <option value="所有狀態" <?= $status == "所有狀態" ? 'selected' : '' ?>>所有狀態</option>
                </select></span>
            <span>日期：
                <input name="time_start" type="text" id="time_start" value="<?= $time_start ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd 00:00:00'})" size="20" maxlength="10" readonly="readonly" />
                ~
                <input name="time_end" type="text" id="time_end" value="<?= $time_end ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd 23:59:59'})"  size="20" maxlength="10" readonly="readonly" />
            </span>
            <span>會員名稱：
                <input name="username" type="text" id="username" value="<?= $username ?>" size="20" maxlength="20"/></span>
            <span><input id="gridSearchBtn" name="find" type="button"  value="查找" onclick="location.href = $('#gridSearchForm').attr('action') + '&' + $('#gridSearchForm').serialize();"></span>
              <!--<td >-->
      <!--            <input name="find" onclick="cleanAll()" type="submit" id="find" value="查看全部"/>-->
            <!--</td>-->
            <span> <a href="/#/member/historybank/list">歷史銀行卡信息</a></span>
        </div>
    </div>
</form>

<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
        <td height="24" >  
            <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" id=editProduct   width="100%" >
                <tr class="t-title dailitr" align="center">
                    <td width="10%" height="24" ><strong>編號</strong></td>
                    <td width="10%" ><strong>類型</strong></td>
                    <td width="30%" ><strong>系統訂單號</strong></td>
                    <td width="10%" ><strong>匯款銀行</strong></td>
                    <td width="25%"><strong>金額</strong></td>
                    <td width="15%" ><strong>提交時間</strong></td>
                </tr>
                <?php
                $all = $qukuanQ = $huikuan = $qukuanH = $cunkuanQ = $cunkuanH = 0;
                if ($arr) {
                    $i = 1;
                    foreach ($arr as $v) {
                        ?>
                        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" >
                            <td  height="35" align="center" ><?= $i++ ?></td>
                            <td><span style="color:<?= $v["type"] == '後台充值' ? '#006600' : ($v['type'] == '銀行匯款' ? '#FF9900' : ($v['type'] == '用戶提款' ? '#FF0000':'#9933FF')); ?>"><?= $v["type"] ?></span>(<?= $v['status']; ?>)</td>
                            <td><a href="<?= $v['type'] == '銀行匯款' ? '?r=finance/default/huikuan-detail&update=1&id=' . $v['id'] : '?r=finance/fund/tixian-detail&id=' . $v['id']; ?>"><?= $v["order_num"] ?></a>
        <?php if ($v["about"]) { ?>
                                    <br/><span style="color:#FF0000;"><?= $v["about"] ?></span>
        <?php } ?>
                            </td>
                            <td><?= isset($v["bank"]) ? $v["bank"] : "" ?></td>
                            <td>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="33%" style="color:#999999;" class="bder0"><?= $v["assets"] ?></td>
                                        <td width="34%" align="center" style="color:#225d9c;" class="bder0"><?= $v["order_value"] ?></td>
                                        <td width="33%" align="right" style="color:#999999;" class="bder0 bderr0"><?= $v["balance"] ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?= $v["update_time"] ?></td>
                        </tr>
                        <?php
                        if($v['status'] == '成功'){
                            $all += $v['order_value'];
                            $huikuan += $v['type'] == '銀行匯款' ? $v['order_value'] : 0;
                            $qukuanQ += $v['type'] == '在線支付' ? $v['order_value'] : 0;
                            $qukuanH += $v['type'] == '後台充值' ? $v['order_value'] : 0;
                            $cunkuanQ += $v['type'] == '用戶提款' ? $v['order_value'] : 0;
                            $cunkuanH += $v['type'] == '後台扣款' ? $v['order_value'] : 0;
                        }
                    }
                }
                ?>
            </table>
<?= LinkPager::widget(['pagination' => $pages]); ?>
        </td>
    </tr>
    <tr>
        <td class="cksum">總金額：<span style="color:#0000FF"><?= $all ?></span>，
            存款(在線+後台)：<span style="color:#006600;"><?= $qukuanQ + $qukuanH ?><?php echo "($qukuanQ+$qukuanH)"; ?></span>，
            取款(在線+後台)：<span style="color:#FF0000;"><?= $cunkuanQ + $cunkuanH ?><?php echo "($cunkuanQ+$cunkuanH)"; ?></span>，
            匯款：<span style="color:#CC9900;"><?= $huikuan ?></span>
        </td>
    </tr>
</table>
