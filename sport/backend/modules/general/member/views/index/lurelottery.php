<?php
use yii\widgets\LinkPager;
$money=0.00;
?>

<div width="100%" border="0" >
    <div class="mgb10">&nbsp;<span class="pro_title">自开彩诱彩设定管理</span>
    </div>
    <div class="trinput inputct font14 pd10">
        <form name="form1" id="key_search" >
                &nbsp;&nbsp;会员组：
                <select name="user_group" id="user_group">
                    <option value="0" >所有会员</option>
                   
                    <?php foreach($userUroup as $v){?>
						<option value="<?= $v['group_id']?>" <?= $user_group==$v['group_id']?'selected="selected"':''?>><?= $v['group_name']?></option>
                    <?php }?>
                </select>
                 <input type="hidden" id="current_page" name="cpage" value="1"/>
                &nbsp;&nbsp;综合类型：
                <select name="type" id="selecttype">
					<option value="user_name" <?= $type=="user_name"?'selected="selected"':'' ?>>用户名</option>
					<option value="pay_name" <?= $type=="pay_name"?'selected="selected"':'' ?>>真实姓名</option>
					<option value="loginaddress" <?= $type=="loginaddress"?'selected="selected"':'' ?>>登入地址</option>
					<option value="tel" <?= $type=="tel"?'selected="selected"':'' ?>>手机号码</option>
					<option value="top_id" <?= $type=="top_id"?'selected="selected"':'' ?>>上级代理ID</option>
					<option value="regip" <?= $type=="regip"?'selected="selected"':'' ?>>注册IP</option>
					<option value="loginip" <?= $type=="loginip"?'selected="selected"':'' ?>>登录IP</option>
					<option value="regurl" <?= $type=="regurl"?'selected="selected"':'' ?>>注册网址</option>
					<option value="loginurl" <?= $type=="loginurl"?'selected="selected"':'' ?>>登录网址</option>
                </select>
                &nbsp;&nbsp;内容：
                <input type="text" name="key" id="key" value="<?=$key ?>" placeholder="关键字"/>
                &nbsp;
                <input type="button" onclick="search()" value="查找"/>
                <input type="hidden" value="" name="online" id="online"/>
                <input type="hidden" value="" name="status" id="status"/>
                <input type="hidden" value="" name="havepay" id="havepay" />
                <input type="hidden" value="" name="overage" id="overage" />
         </form>
    </div>
</div>
<form name="form2" method="post" action="" style="margin:0 0 0 0;">
<div  class="trinput inputct  pd10" >
    <table width="100%">
        <tr>
            <td width="104" align="center"><a href="javascript:online()">在线会员</a></td>
            <td width="104" align="center"><a href="javascript:change('异常')">异常会员</a></td>
            <td width="104" align="center"><a href="javascript:change('停用')">停用会员</a></td>
            <td width="104" align="center"><a href="javascript:search()">全部会员</a></td>
            <td width="104" align="center"><a href="/#/member/mobile">危险手机号</a></td>
            <td width="104" align="center"><a href="javascript:havepay()">有充值过的</a></td>
			<td width="104" align="center"><a href="javascript:nopay()">未充值的</a></td>
            <td width="365" align="right" style="text-align:right;"><span class="STYLE4"></span>
        </tr>
    </table>
</div>
<div id="disp">
<div style="height:auto;">
    <table width="100%" border="0" cellpadding="3" cellspacing="1" >
        <tr><td height="24" >
                <table width="100%" cellspacing="0" cellpadding="0" id="xwTable" class="font13 skintable line35" >
                <tr>
                        <td width="9%" height="20" ><strong>用户名</strong></td>
                        <td width="10%" ><strong>姓名/注册时间</strong></td>
                        <td width="6%" ><strong>财务/<a href="javascript:orderbyoverage()">余额</a></strong></td>
                        <td width="12%" ><strong>注册/登陆 ip</strong></td>
						<td width="10%" ><strong>累計儲值</strong></td>
						<td width="10%" ><strong>總投注</strong></td>
						<td width="10%" ><strong>總贏分</strong></td>
						<td width="10%" ><strong>總輸贏</strong></td>
						<td width="8%" ><strong>极速赛车<br>(SSRC)</strong></td>
						<td width="8%" ><strong>老PK拾<br>(ORPK)</strong></td>
						<td width="8%" ><strong>极速时时彩<br>(TJ)</strong></td>
						<td width="8%" ><strong>极速六合彩<br>(SPLHC)</strong></td>
                        </td>
               </tr>
			   <?php
				foreach($users as $rows){
				   $total_bet_money = $rows["ssrc_bet_money"]+$rows["spsix_bet_money"]+$rows["tj_bet_money"]+$rows["orpk_bet_money"];
				   $total_win = $rows["ssrc_win"]+$rows["spsix_win"]+$rows["tj_win"]+$rows["orpk_win"];
				?>
				<tr align="center">
					<td>
						<a href="/#/member/user&uid=<?= $rows["user_id"]?>">
							<span style="color:#F37605;" class="uname"><?= $rows["user_name"]?></span>
						</a>
					</td>
					<td>
						<a href="javascript:payname('<?= $rows["pay_name"]?>')"><span style="color:#F37605;"><?= $rows["pay_name"]?></span></a><br/><?= $rows["regtime"]?>
					</td>
					<td>
						<a href="/#/finance/fund/look-money&status=所有状态&username=<?= $rows["user_name"]?>" target="_blank"><span style="color:#F37605;">查看财务</span></a><br /><?= $rows["money"]?>
					</td>
					<td>
						<a href="javascript:regip('<?= $rows["regip"];?>')" ><?= str_replace("http://","",$rows["regip"])?></a><br/>
						<a href="javascript:loginip('<?= $rows["loginip"];?>')" ><?= str_replace("http://","",$rows["loginip"])?></a>
					</td>
					<td>
						<?= $rows["total_deposit"];?>
					</td>
					<td>
						<?= $total_bet_money;?>
					</td>
					<td>
						<?= $total_win;?>
					</td>
					<td>
						<?= ($total_win - $total_bet_money);?>
					</td>
					<td>
						<input name="ssrc" type="checkbox" id="ssrc<?=$rows['user_id']?>" <?php if(isset($rows["ssrc_flag"]) && (int)$rows["ssrc_flag"] == 1){ echo 'checked'; }?> onchange="changecheckbox('ssrc','<?=$rows['user_id']?>')"/>
					</td>
					<td>
						<input name="orpk" type="checkbox" id="orpk<?=$rows['user_id']?>" <?php if(isset($rows["orpk_flag"]) && (int)$rows["orpk_flag"] == 1){ echo 'checked'; }?> onchange="changecheckbox('orpk','<?=$rows['user_id']?>')"/>
					</td>
					<td>
						<input name="tjssc" type="checkbox" id="tjssc<?=$rows['user_id']?>" <?php if(isset($rows["tj_flag"]) && (int)$rows["tj_flag"] == 1){ echo 'checked'; }?> onchange="changecheckbox('tjssc','<?=$rows['user_id']?>')"/>
					</td>
					<td>
						<input name="splhc" type="checkbox" id="spsix<?=$rows['user_id']?>" <?php if(isset($rows["spsix_flag"]) && (int)$rows["spsix_flag"] == 1){ echo 'checked'; }?> onchange="changecheckbox('spsix','<?=$rows['user_id']?>')"/>
					</td>
				</tr>
			   <?php }?>
				<?php if(count($users)==0){?>
				<tr><td colspan="12" align="center"><span style="color:red;">无符合条件结果</span></td></tr>
				<?php }?>
                </table>
            </td>
        </tr>
    </table>
</div>
    <!-- <div style="text-align:center;"><?php // echo $link;?></div> -->
        <div style="text-align:center;"> 
        <?php
            echo LinkPager::widget(['pagination' => $pagination,]);

        ?>
       </div>
</div>
</form>
<script>
	function changecheckbox(lotterytype,userid)
	{
		layer.load(1);
		if($('#'+lotterytype+userid).prop('checked'))	//勾選
		{
			var check = 1;
		}
		else
		{
			var check = 0;
		}
		$.ajax({
			url:"/?r=member/index/update-lure-lottery",
			type:'post',
			data:{
				'user_id' :　userid,
				'lottery_type' : lotterytype,
				'check' : check,
			},
			error: function($e){
				layer.closeAll('loading');
				alert('服务器未响应！');
			},
			success:function($html){
				layer.closeAll('loading');
				$html = JSON.parse($html);
				layer.msg($html[1]);
				if($html[0] == 1)	//操作失敗 將紀錄返回原本狀態
				{
					$('#'+lotterytype+userid).prop('checked', !check);
				}

			}
		});
	}
	function showMoneyDialog(name) {
		layer.open({
			type: 2,
			title: '查询真人实时余额',
			area: ['600px', '340px'],
			content: '/?r=live/order/money&name='+name
		});
	}
    function ckall(){
        for (var i=0;i<document.form2.elements.length;i++){
            var e = document.form2.elements[i];
            if (e.name != 'checkall') e.checked = document.form2.checkall.checked;
        }
    }
	function page($page){
		if($page!==""){
			$('#current_page').val($page);
		}
		location.href = "#/member/index/lure-lottery" + "&" + $('#key_search').serialize()+"&t="+new Date().getTime();
		//		$.ajax({
		//			url:"/?r=member/index/page",
		//			type:'get',
		//			data:$('#key_search').serialize(),
		//			error: function($e){
		//				alert('服务器未响应！');
		//			},
		//			success:function($html){
		//				$(".rights .rightsct").html($html);
		//			}
		//		});
	}
	function search(){
		$('#havepay').val('');
		$('#online').val('');
		$('#status').val('');
		$('#overage').val('');
		page(1);
	}
	function havepay(){
		$('#online').val('');
		$('#status').val('');
		$('#havepay').val(1);
		$('#overage').val('');
		page(1);
	}
	function nopay(){
		$('#online').val('');
		$('#status').val('');
		$('#havepay').val(0);
		$('#overage').val('');
		page(1);
	}
	function online(){
		$('#havepay').val('');
		$('#status').val('');
		$('#online').val(1);
		$('#overage').val('');
		page(1);
	}

	function change(status){
		$('#havepay').val('');
		$('#online').val('');
		$('#status').val(status);
		$('#overage').val('');
		page(1);
	}
	function orderbyoverage(){
		$('#overage').val('desc');
		page(1);
	}
	function payname(payname){
		$('#selecttype').val('pay_name');
		$('#key').val(payname);
		page(1);
	}
	function regip(regip){
		window.location.href="/#/member/loginlog&ip="+regip;
	}
	function loginip(loginip){
		window.location.href="/#/member/loginlog&ip="+loginip;
	}
	function regurl(regurl){
		$('#selecttype').val('regurl');
		$('#key').val(regurl);
		page(1);
	}
	function loginurl(loginurl){
		$('#selecttype').val('loginurl');
		$('#key').val(loginurl);
		page(1);
	}
	function tel(tel){
		$('#selecttype').val('tel');
		$('#key').val(tel);
		page(1);
	}
	function topid(topid){
		$('#selecttype').val('top_id');
		$('#key').val(topid);
		page(1);
	}
</script>