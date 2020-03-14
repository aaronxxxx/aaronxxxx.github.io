<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用戶詳細信息展示</TITLE>


<script>
    function getMoneyAdmin(userName,password){
        $("input[name=getMoney]").attr("disabled","disabled"); //按鈕失效
        $.post("getUpdateMoney.php",{username:userName,password:password} ,function (data) {
                $("input[name=getMoney]").attr("disabled",false); //按鈕失效
                if(parseInt(data)>-1){
                    $("#ag_credit").text(data);
                }else{
                    alert(data);
                }
            }
        );
    }
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" ><font >&nbsp;<span class="pro_title">用戶管理：查看用戶詳細信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>

<form action="user_update.php" method="post" name="form1" id="form1">
<table width="90%" align="center"  cellspacing="0" cellpadding="0" class="settable" >
  <tr>
    <td class="pdrgt15">用戶名</td>
    <td><?= $userAG["user_name"]?>
      <input name="hf_username" type="hidden" id="hf_username" value="<?= $userAG["user_name"]?>"></td>
  </tr>
  <tr>
    <td width="172" class="pdrgt15">賬戶餘額</td>
    <td width="473"><?= $userAG["money"]?></td>
  </tr>
  <tr>
    <td class="pdrgt15">性別</td>
    <td><?= $userAG["sex"]?></td>
  </tr>
  <tr>
    <td class="pdrgt15">註冊所在地</td>
    <td><?= $userAG["regaddress"]?></td>
  </tr>
  <tr>
    <td class="pdrgt15">生日</td>
    <td><input name="birthday" value="<?= $userAG["birthday"]?>" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">密碼問答</td>
    <td>
	<select name="ask" id="ask">
    	  <option value="" >---請選擇密碼問題---</option>
          <option value="您的車牌號碼是多少？" <?php if($userAG["ask"] == "您的車牌號碼是多少？") echo "selected";?>>您的車牌號碼是多少？</option>
          <option value="您初中同桌的名字？" <?php if($userAG["ask"] == "您初中同桌的名字？") echo "selected";?>>您初中同桌的名字？</option>
          <option value="您就讀的第一所學校的名稱？" <?php if($userAG["ask"] == "您就讀的第一所學校的名稱？") echo "selected";?>>您就讀的第一所學校的名稱？</option>
          <option value="您第一次親吻的對象是誰？" <?php if($userAG["ask"] == "您第一次親吻的對象是誰？") echo "selected";?>>您第一次親吻的對象是誰？</option>
          <option value="少年時代心目中的英雄是誰？" <?php if($userAG["ask"] == "少年時代心目中的英雄是誰？") echo "selected";?>>少年時代心目中的英雄是誰？</option>
          <option value="您最喜歡的休閒運動是什麼？" <?php if($userAG["ask"] == "您最喜歡的休閒運動是什麼？") echo "selected";?>>您最喜歡的休閒運動是什麼？</option>
          <option value="您最喜歡哪支運動隊？" <?php if($userAG["ask"] == "您最喜歡哪支運動隊？") echo "selected";?>>您最喜歡哪支運動隊？</option>
          <option value="您最喜歡的運動員是誰？" <?php if($userAG["ask"] == "您最喜歡的運動員是誰？") echo "selected";?>>您最喜歡的運動員是誰？</option>
		  
          <option value="您的第一輛車是什麼牌子？" <?php if($userAG["ask"] == "您的第一輛車是什麼牌子？") echo "selected";?>>您的第一輛車是什麼牌子？</option>
    </select></td>
  </tr>
  <tr>
    <td class="pdrgt15">密碼答案</td>
    <td><input type="text" name="answer" id="answer" value="<?= $userAG["answer"]?>" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">手機</td>
    <td><input type="text" name="mobile" value="<?= $userAG["tel"]?>" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">email</td>
    <td><input type="text" name="email" value="<?= $userAG["email"]?>" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">QQ</td>
    <td><input type="text" name="QQ" value="<?= $userAG["qq"]?>" ></td>
  </tr>  
  <tr>
    <td class="pdrgt15">真實姓名</td>
    <td><input type="text" name="pay_name" value="<?= $userAG["pay_name"]?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td class="pdrgt15">開戶行</td>
    <td><input type="text" name="pay_card" value="<?= $userAG["pay_bank"]?>" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">卡號</td>
    <td><input type="text" name="pay_num" value="<?= $userAG["pay_num"]?>" ><input name="hf_pay_num" type="hidden" id="hf_pay_num" value="<?= $userAG["pay_num"]?>"></td>
  </tr>
    <tr>
    <td class="pdrgt15">開戶地址</td>
    <td>
	    <input type="text" name="pay_address" value="<?= $userAG["pay_address"]?>" >
	    <input type="hidden" name="uid" id="uid" value="<?= $userAG["user_id"]?>">
    </td>
  </tr>
    <tr>
    <td class="pdrgt15">所屬會員組</td>
    <td><label>
      <select name="gid" id="gid">
<?php
foreach($usergroup as $key=>$value){
?>
        <option value="<?= $value['group_id']?>" <?= $value['group_id']==$userAG["group_id"] ? 'selected' : ''?>><?= $value['group_name']?></option>
<?php
}
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td class="pdrgt15">註冊時間</td>
    <td><?= $userAG["regtime"]?></td>
  </tr>
  <tr>
    <td class="pdrgt15">註冊IP</td>
    <td><?= $userAG["regip"]?></td>
  </tr>
   <tr>
    <td class="pdrgt15">最後登錄時間</td>
    <td><?= $userAG["logintime"]?></td>
  </tr>
   <tr>
    <td class="pdrgt15">最後登錄IP</td>
    <td><?= $userAG["loginip"]?></td>
  </tr>
   <tr>
    <td class="pdrgt15">最後在線時間</td>
    <td><?= $userAG["logouttime"]?></td>
  </tr>
   <tr>
    <td class="pdrgt15">總登錄次數</td>
    <td><?= $userAG["lognum"]?></td>
  </tr>

    <td class="pdrgt15">備註：</td>
    <td><textarea name="why" cols="80" rows="5" id="why"><?= $userAG["remark"]?></textarea></td>
  </tr>
    <tr>
    <td class="pdrgt15">更多信息</td>
    <td>
	<a href="?r=sport/order/single-order&type=單式&status=all&username=<?= $userAG["user_name"]?>">查看單式信息</a>，
	<a href="?r=sport/order/cg&status=all&username=<?= $userAG["user_name"]?>">查看串關信息</a>，
	<A href="?r=message/user/index&username=<?= $userAG["user_name"]?>">發佈短消息</A>，
	<A href="?r=finance/fund/look-money&status=所有狀態&username=<?= $userAG["user_name"]?>">查看財務</A>，
    <A href="?r=live/log/check&username=<?= $userAG["user_name"]?>">核查會員</A>，
    <A href="?r=member/historybank/list&username=<?= $userAG["user_name"]?>">歷史銀行記錄</A>
	</td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
  	  <input type="button" value="確認提交" onClick="javascript:saveinfo()"> 　 
  	  <input type="button" value="返回列表" onClick="javascript:history.go(-1)"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>
<script>
function saveinfo(){
	$.ajax({
		url:"/?r=member/user/saveinfo",
		type:'POST',
		data:$('#form1').serialize(),
		error: function($e){
			alert('服務器未響應！');
		},
		success:function($html){
			alert("信息更新成功~~~！");
		}
	});
}
</script>