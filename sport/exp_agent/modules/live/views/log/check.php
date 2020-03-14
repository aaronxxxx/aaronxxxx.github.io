<?php 
use yii\widgets\LinkPager;

?>

<form id="gridSearchForm" name="gridSearchForm" method="get" onsubmit="javascript:return false;" action="/#/live/log/check" class="trinput font14 mgb10">
请输入会员名称：
<label>
<input name="username" type="text" id="username" value="<?php echo $username;?>" size="20" maxlength="20" />
</label>
&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input type="button" name="Submit" id="gridSearchBtn" value="核查" />
  </label>
</form>
  <span>注意：该用户所有金额记录，如果背景色为<span style="color: red;">红色</span>，说明该条记录的 '交易前余额' 与前一条记录的 '交易后金额' 不相等，说明出现差错，请及时排查。</span>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="font12 skintable line35 mgt10" >
    <tr>
        <td width="12%" align="center"  height="28"><strong>日期</strong></td>
        <td width="12%" align="center" ><strong>订单号</strong></td>
        <td width="11%" align="center" ><strong>交易类型</strong></td>
        <td width="11%" align="center" ><strong>交易前余额</strong></td>
        <td width="11%" align="center" ><strong>交易金额</strong></td>
        <td width="11%" align="center" ><strong>交易后余额</strong></td>
        <td width="19%" align="center" ><strong>备注</strong></td>
        <td width="11%" align="center" ><strong>操作</strong></td>
    </tr>
    <?php 
    if(empty($rs)){
	?>
	<tr  onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
            <td align="center" height="25" colspan="8">暂时没有交易记录。</td>
    </tr>
	<?php
    }else{

		foreach ($rs as $key=>$rows){
			$type = trim($rows['type']);
			$bgColor = "#FFFFFF";
			$overColor = "#EBEBEB";
			$number1 = floatval($rows["assets"]) - floatval($rows["order_value"]);
			$number2 = floatval($rows["assets"]) + floatval($rows["order_value"]);
			$number3 = floatval($rows["balance"]);

			if($key<(count($rs)-1)){
				if($rs[$key+1] && ($rs[$key+1]["balance"]!=$rows["assets"]) || ((abs($number1-$number3)>0.0001) && abs($number2-$number3)>0.0001)){

					$bgColor = "#FFE1E1";
					$overColor="#FFE1E1";
				}
			}
			$link_detail = "";
			if($rows["about"]=="六合彩"){
				$link_detail = '<a href="/#/six/index/order-byid&user_id='.$rows["user_id"].'&order_num='.$rows["order_num"].'&type='.urlencode($type).'&about='.urlencode($rows["about"]).'" target="_blank"><span style="color:#F37605;">查看明细</span></a>';
			}elseif($rows["about"]=="极速六合彩"){
				$link_detail = '<a href="/#/spsix/index/order-byid&user_id='.$rows["user_id"].'&order_num='.$rows["order_num"].'&type='.urlencode($type).'&about='.urlencode($rows["about"]).'" target="_blank"><span style="color:#F37605;">查看明细</span></a>';
			}/*elseif(strpos($rows["type"],"彩票")!==false){*/
			elseif($rows["type"] == '彩票下注'){
				$link_detail = '<a href="#/lotteryorder/index/orderdetail&user_id='.$rows["user_id"].'&order_num='.$rows["order_num"].'&type='.urlencode($type).'&about='.urlencode($rows["about"]).'" target="_blank"><span style="color:#F37605;">查看明细</span></a>';
			}else if(trim($rows["type"]) == '彩票自动结算-彩票中奖' || trim($rows["type"]) == '彩票自动结算-彩票反水'){
				$link_detail = '<a href="#/lotteryorder/index/order-sub&order_num='.$rows["order_num"].'&about='.urlencode($rows["about"]).'" target="_blank"><span style="color:#F37605;">查看明细</span></a>';
			}
		?>
		<tr style="background-color:<?php echo $bgColor;?>" bgcolor="<?php echo $bgColor;?>" onMouseOver="this.style.backgroundColor='<?php echo $overColor;?>'" onMouseOut="this.style.backgroundColor='<?php echo $bgColor;?>'">
	            <td align="center" height="25"><?php echo $rows["update_time"]; ?></td>
	            <td align="center" ><?php echo $rows["order_num"]; ?></td>
	            <td align="center" ><?php echo $rows["type"]; ?></td>
	            <td align="center" ><?php echo $rows["assets"]; ?></td>
	            <td align="center" ><?php echo $rows["order_value"]; ?></td>
	            <td align="center" ><?php echo $rows["balance"]; ?></td>
	            <td align="center" ><?php echo $rows["about"]; ?></td>
	            <td align="center" ><?php echo $link_detail; ?></td>
	    </tr>
	    <?php	
	    }
    }
    ?>
    <tr >
        <td colspan="8" align="center" valign="middle" style="padding: 5px 0;">
           <?php 
              echo LinkPager::widget(['pagination' => $pagination,]);
           ?>
        </td>
    </tr>
</table>