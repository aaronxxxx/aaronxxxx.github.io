<?php use yii\widgets\LinkPager;
$false_admin =$true_admin=$true =$false = $cl = 0;
?>
<form name="form1" id="gridSearchForm" method="get" action="?r=finance/fund/money-save" >
    <div class="pro_title">存款管理：查看所有的用戶存款信息</div>
            <div class="w850 mgauto middle">
                    <div class="trinput inputct pd10">
                        <span  align="center">
                            <select name="status" id="status">
                                <option value="未結算" <?= $status == '未結算' ? 'selected' : '' ?> style="color:#FF9900;">未處理</option>
                                <option value="失敗" <?= $status == '失敗' ? 'selected' : '' ?> style="color:#FF0000;">存款失敗</option>
                                <option value="成功" <?= $status == '成功' ? 'selected' : '' ?> style="color:#006600;">存款成功</option>
                                <option value="在線支付" <?= $status == '在線支付' ? 'selected' : '' ?> style="color:#006600;">在線支付</option>
                                <option value="後台充值" <?= $status == '後台充值' ? 'selected' : '' ?> style="color:#006600;">後台充值</option>
                                <option value="全部存款" <?= $status == '全部存款' ? 'selected' : '' ?>>全部存款</option>
                            </select>
                        </span>
                        <span  align="center"><select name="order" id="order">
                                <option value="id" <?= $order == 'id' ? 'selected' : '' ?>>默認排序</option>
                                <option value="order_value" <?= $order == 'order_value' ? 'selected' : '' ?>>存款金額</option>
                                <option value="update_time" <?= $order == 'update_time' ? 'selected' : '' ?>>申請時間</option>
                            </select></span>
                       <span  align="center" style="display: none;"><label>
                                <select name="time" id="time">
                                    <option value="CN" <?= $time == 'CN' ? 'selected' : '' ?>>中國時間</option>
                                    <option value="EN" <?= $time == 'EN' ? 'selected' : '' ?>>美東時間</option>
                                </select>
                            </label>  </span>
                        <span  align="left">日期：
                            <input name="time_start" type="text" id="time_start" value="<?= $time_start ?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 00:00:00'})" size="20" maxlength="10" readonly="readonly" />
                            ~
                            <input name="time_end" type="text" id="time_end" value="<?= $time_end ?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 23:59:59'})" size="20" maxlength="10" readonly="readonly" />
                            &nbsp;&nbsp;會員名稱：
                            <input name="username" type="text" id="username" value="<?= $username ?>" size="15" maxlength="20"/>          &nbsp;&nbsp;
                            <input name="find" type="button" id="gridSearchBtn" value="查找"/>
                         </span>
                    </div>
            </div>
  </form>
<div id="tableInfo">
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
        <td height="24" >
            <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" id=editProduct   width="100%" >
                <tr class="t-title dailitr" align="center">
                    <td width="10%" ><strong>編號</strong></td>
                    <td width="10%" ><strong>會員名</strong></td>
                    <td width="30%" ><strong>系統訂單號</strong></td>
                    <td width="10%"><strong>存款金額</strong></td>
                    <td width="10%"><strong>手續費</strong></td>
                    <td width="10%"><strong>查看財務</strong></td>
                    <td width="15%" ><strong>申請時間</strong></td>
                    <td width="15%" ><strong>操作</strong></td>
                </tr>
                <?php if($data){foreach($data as $rows){?>
                <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" >
                    <td  height="35" align="center"  ><?= $rows["id"] ?></td>
                    <td  height="35" align="center"  ><?= $rows["username"] ?></td>
                    <td><?= $rows["order_num"] ?>
                        <?php if ($rows["type"] == "後台充值" ) {
                         echo "<br/>後台充值，理由：" . $rows["about"];
                            } elseif($rows["type"] == "在線支付"){
                            echo "<br/>" . $rows["about"];
                        }
                        ?>
                    </td>
                    <td><span style="color:#999999;"><?= $rows["assets"] ?></span><br /><?= abs($rows["order_value"]) ?><br /><span style="color:#999999;"><?= $rows["balance"] ?></span></td>
                    <td><?= $rows["sxf"] ?></td>
                    <td><a href="?r=finance/fund/look-money&username=<?= $rows["username"] ?>&status=所有狀態&time_start=<?=urlencode($time_start)?>&time_end=<?=urlencode($time_end)?>">查看財務</a></td>
                    <td><?= $rows["update_time"] ?></td>
                    <td>
                    <?php if($rows["status"]=="失敗"){?>
                    <span style="color:#FF0000;">存款失敗</span>
                    <?php if($rows["type"]=="後台充值"){ $false_admin += abs($rows["order_value"]);?>
                    <?php }elseif($rows["type"]=="在線支付"){ $false += abs($rows["order_value"]);}?>
                    <?php }else if($rows["status"]=="成功"){?>
                     <span style='color:#009900;'>存款成功</span><br/><a href="?r=finance/fund/tixian-detail&id=<?=$rows['id']?>">詳細</a>
                    <?php if($rows["type"]=="後台充值"){ $true_admin += abs($rows["order_value"]);?>
                    <?php }elseif($rows["type"]=="在線支付"){ $true += abs($rows["order_value"]);}?>
                    <?php }else{?>
                    <div style="float:left;"><a onclick="ck(1,<?=$rows["id"]?>,'是否確定存款成功？');" href="javascript:void(0);">存款成功</a></div>
                    <div style="float:right;"><a onclick="ck(0,<?=$rows["id"]?>,'是否確認存款失敗？');" href="javascript:void(0);">存款失敗</a></div>
                    <?php $cl += abs($rows["order_value"]); }?>
                    </td>
                </tr>
                <?php }}?>
            </table>  
        </td>
    </tr>
    <tr>
        <td ><div class="cksum">總金額：<span style="color:#0000FF"><?= $sum ?></span>，
                在線充值成功：<span style="color:#006600;"><?= $true ?></span>，
                後台充值成功：<span style="color:#006600;"><?= $true_admin ?></span>，
                手續費：<span style="color:#FF00FF;"><?= $sxf_sum ?></span>，
                在線充值失敗：<span style="color:#FF0000;"><?= $false ?></span>，
                後台充值失敗：<span style="color:#FF0000;"><?= $false_admin ?></span>，
                處理中：<span style="color:#FF9900;"><?= $cl ?></span></div>
            <div><?= LinkPager::widget(['pagination' => $pages]); ?></div>
        </td>
    </tr>
</table>
</div>
<script>
    function ck($ok,$id,$msg) {
        if (confirm($msg)){
            $.ajax({
                type: "POST",
                url: "/?r=finance/fund/ck-set&ok="+$ok+"&id="+$id,
                data: $('#gridSearchForm').serialize(),
                error:function () {
                    layer.alert('出錯了，請稍後再試');
                },
                success: function(data){
                    layer.alert(data,function(index) {
                        window.location.reload();
                    })
                }
            })
        }
  }
</script>

