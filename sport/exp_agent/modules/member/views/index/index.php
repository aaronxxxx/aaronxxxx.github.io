<?php
use yii\widgets\LinkPager;
$money=0.00;
?>
<div width="100%" border="0" >
    <div class="mgb10">&nbsp;<span class="pro_title">用戶管理：查看用戶的信息</span>
    </div>
    <div class="trinput inputct font14 pd10">
        <form name="form1" id="key_search" >
                &nbsp;&nbsp;會員組：
                <select name="user_group" id="user_group">
                    <option value="0" >所有會員</option>
                   
                    <?php foreach($userUroup as $v){?>
						<option value="<?= $v['group_id']?>" <?= $user_group==$v['group_id']?'selected="selected"':''?>><?= $v['group_name']?></option>
                    <?php }?>
                </select>
                 <input type="hidden" id="current_page" name="cpage" value="1"/>
                &nbsp;&nbsp;綜合類型：
                <select name="type" id="selecttype">
					<option value="user_name" <?= $type=="user_name"?'selected="selected"':'' ?>>用戶名</option>
					<option value="pay_name" <?= $type=="pay_name"?'selected="selected"':'' ?>>真實姓名</option>
					<option value="loginaddress" <?= $type=="loginaddress"?'selected="selected"':'' ?>>登入地址</option>
					<option value="tel" <?= $type=="tel"?'selected="selected"':'' ?>>手機號碼</option>
					<option value="top_id" <?= $type=="top_id"?'selected="selected"':'' ?>>上級代理ID</option>
					<option value="regip" <?= $type=="regip"?'selected="selected"':'' ?>>註冊IP</option>
					<option value="loginip" <?= $type=="loginip"?'selected="selected"':'' ?>>登錄IP</option>
					<option value="regurl" <?= $type=="regurl"?'selected="selected"':'' ?>>註冊網址</option>
					<option value="loginurl" <?= $type=="loginurl"?'selected="selected"':'' ?>>登錄網址</option>
                </select>
                &nbsp;&nbsp;內容：
                <input type="text" name="key" id="key" value="<?=$key ?>" placeholder="關鍵字"/>
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
            <td width="104" align="center"><a href="javascript:online()">在線會員</a></td>
            <td width="104" align="center"><a href="javascript:change('異常')">異常會員</a></td>
            <td width="104" align="center"><a href="javascript:change('停用')">停用會員</a></td>
            <td width="104" align="center"><a href="javascript:search()">全部會員</a></td>
            <td width="104" align="center"><a href="?r=member/mobile">危險手機號</a></td>
            <td width="104" align="center"><a href="javascript:havepay()">有充值過的</a></td>
			<td width="104" align="center"><a href="?r=member/index/add-user&code=1">新增會員</a></td>
            <td width="365" align="right" style="text-align:right;"><span class="STYLE4"></td>
        </tr>
    </table>
</div>
<div id="disp">
<div style="height:auto;">
    <table width="100%" border="0" cellpadding="3" cellspacing="1" >
        <tr><td height="24" >
                <table width="100%" cellspacing="0" cellpadding="0" id="xwTable" class="font13 skintable line35" >
                <tr>
                        <td width="9%" height="20" ><strong>用戶名</strong></td>
                        <td width="10%" ><strong>姓名/註冊時間</strong></td>
                        <td width="6%" ><strong>財務/<a href="javascript:orderbyoverage()">餘額</a></strong></td>
                        <td width="12%" ><strong>註冊/登陸 ip</strong></td>
                        <td width="12%" ><strong>註冊/登陸 網址</strong></td>
                        <td width="8%" ><strong>手機號碼/郵箱</strong></td>
                        <td width="10%" ><strong>核查/會員組</strong></td>
                        <td width="5%" ><strong><a href="javascript:online()">狀態</a></strong></td>
                        <!-- <td width="4%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
                        </td> -->
               </tr>
<?php foreach($users as $rows){?>
<?php $money+=$rows['money'];?>
<tr align="center"> 
<td>
	 <span style="color:#F37605;" class="uname"><?= $rows["user_name"]?></span>
</td>
<td>
      <a href="javascript:payname('<?= $rows["pay_name"]?>')"><span style="color:#F37605;"><?= $rows["pay_name"]?></span></a><br/><?= $rows["regtime"]?>
</td>
<td>
     <a href="?r=finance/fund/look-money&status=所有狀態&username=<?= $rows["user_name"]?>" target="_blank"><span style="color:#F37605;">查看財務</span></a><br /><?= $rows["money"]?>
</td>
<td>
      <a href="javascript:regip('<?= $rows["regip"];?>')" ><?= str_replace("http://","",$rows["regip"])?></a><br/>
      <a href="javascript:loginip('<?= $rows["loginip"];?>')" ><?= str_replace("http://","",$rows["loginip"])?></a>
</td>
<td>
      <a href="javascript:regurl('<?= $rows["regurl"];?>')" ><?= str_replace("http://","",$rows["regurl"])?></a><br/>
      <a href="javascript:loginurl('<?= $rows["loginurl"];?>')"><?= str_replace("http://","",$rows["loginurl"])?></a>
</td>
<td><a href="javascript:tel('<?= $rows["tel"]?>')"><span style="color:#F37605;"><?= $rows["tel"]?></span></a><br /><?= $rows["email"]?>
</td>
<td>
<a href="?r=live/log/check&username=<?= $rows["user_name"];?>" target="_blank"><span style="color:#F37605;">核查會員</span></a><br /><?= $rows["group_name"]?>
</td>
<td>
      <?= $rows["online"]!='0' ? "<span style=\"color:#FF00FF;\">在線</span>" : "<span style=\"color:#999999;\">離線</span>" ?><br/>
      <?= $rows["status"]=="停用" ? "<span style=\"color: #FF0000;\">停用</span>" : ($rows["status"]=="異常" ? "<span style=\"color: #FF0000;\">異常</span>" : "<span style=\"color:#006600;\">正常</span>")?>
</td>
<!-- <td>
      <input name="uid[]" type="checkbox" id="uid[]" value="<?= $rows["user_id"]?>" />
</td> -->
</tr>
<?php }?>
<?php if(count($users)==0){?>
<tr><td colspan="12" align="center"><span style="color:red;">無符合筆件結果</span></td></tr>
<?php }?>
                </table>
            </td>
        </tr>
        <tr><td ><div style="float:left;">本頁會員總餘額：<span class="golden"><?= number_format(round($money,2),2,'.','')?></span>。 所有會員總餘額：<span class="golden"><?= $total[0]?></span>。 所有正常會員總餘額：
        <span class="golden"><?= $total[1]?></span>。 所有停用會員總餘額：<span class="golden"><?= $total[2]?></span>。 所有異常會員總餘額：<span class="golden"><?= $total[3]?></span>。</div></td></tr>
        <tr><td ></td></tr>
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
	function showMoneyDialog(name) {
		layer.open({
			type: 2,
			title: '查詢真人實時餘額',
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
		location.href = "?r=member/index" + "&" + $('#key_search').serialize()+"&t="+new Date().getTime();
//		$.ajax({
//			url:"/?r=member/index/page",
//			type:'get',
//			data:$('#key_search').serialize(),
//			error: function($e){
//				alert('服務器未響應！');
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
		window.location.href="?r=member/loginlog&ip="+regip;
	}
	function loginip(loginip){
		window.location.href="?r=member/loginlog&ip="+loginip;
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