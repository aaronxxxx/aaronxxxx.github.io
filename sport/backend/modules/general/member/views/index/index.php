<?php
use yii\widgets\LinkPager;
$money=0.00;
?>
<div width="100%" border="0" >
    <div class="mgb10">&nbsp;<span class="pro_title">用户管理：查看用户的信息</span>
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
                    <option value="sum_top_id" <?= $type=="sum_top_id"?'selected="selected"':'' ?>>總代理ID</option>
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
            <td width="365" align="right" style="text-align:right;"><span class="STYLE4">相关操作：</span>
                <select name="s_action" id="s_action">
                    <option value="0" selected="selected">选择确认</option>
                    <option value="2">启用会员</option>
                    <option value="1">停用会员</option>
                    <option value="3">踢线</option>
                    <option value="5">修改密码</option>
                    <option value="7">设置会员组</option>
                    <option value="8">设置所属代理</option>
                    <option value="12">清空会员投注额</option>
                    <option value="11">设置当期下注最大金额</option>
                    <option value="9">允许转账到真人</option>
                    <option value="10">不允许转账到真人</option>
					<option value="13">清空打码量</option>
                    <option value="6">删除会员</option>
                </select>
                <input type="button" name="Submit2" value="执行" onclick="execute()"/></td>
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
                        <td width="8%" ><strong>真人财务</strong></td>
                        <td width="12%" ><strong>注册/登陆 ip</strong></td>
                        <td width="12%" ><strong>注册/登陆 网址</strong></td>
						<td width="8%" ><strong>手机号码/邮箱</strong></td>
                        <!-- <td width="8%" ><strong>会员等级/提款数</strong></td> -->
                        <td width="6%" ><strong>所属代理ID</strong></td>
                        <td width="6%" ><strong>所属總代理ID</strong></td>
                        <td width="8%" ><strong>转账到真人</strong></td>
                        <td width="10%" ><strong>核查/会员组</strong></td>
                        <td width="5%" ><strong><a href="javascript:online()">状态</a></strong></td>
                        <td width="4%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
                        </td>
               </tr>
<?php foreach($users as $rows){?>
<?php $money+=$rows['money'];?>
<tr align="center">
<td>
 <a href="/#/member/user&uid=<?= $rows["user_id"]?>">
	 <span style="color:#F37605;" class="uname"><?= $rows["user_name"]?></span></a>
</td>
<td>
      <a href="javascript:payname('<?= $rows["pay_name"]?>')"><span style="color:#F37605;"><?= $rows["pay_name"]?></span></a><br/><?= $rows["regtime"]?>
</td>
<td>
     <a href="/#/finance/fund/look-money&status=所有状态&username=<?= $rows["user_name"]?>" target="_blank"><span style="color:#F37605;">查看财务</span></a>
	 <br /><?= $rows["money"]?>
	 <br /><a href="javascript:showDama('<?= $rows["user_id"] ?>')"><span style="color:#F37605;">查看打码量</span></a>
</td>
<td>
      <a href="javascript:showMoneyDialog('<?= $rows["user_name"]?>')" title='点击查看当前真人账户余额'>查看真人</a>
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
<!--20190108
	 <td><span style="color:#F37605;"><?= !empty($rows["level_name"])?  $rows["level_name"] :''?></span><br />提款数:<?= empty($rows["withdraw"]) ? 0 : $rows["withdraw"]?></td> -->
<td>
      <?php if($rows["top_id"]>0){?>
       <a title="单击查看該代理的所有会员" href="javascript:topid('<?= $rows["top_id"]?>')"><span style="color:#F37605;"><?= $rows["top_id"]?></span></a>
     <?php }else{?>
            无上级
     <?php }?>
</td>
<td>
    <?php if($rows["sum_top_id"]>0){?>
        <a title="单击查看該總代理的所有会员" href="javascript:sumtopid('<?= $rows["sum_top_id"]?>')"><span style="color:#F37605;"><?= $rows["sum_top_id"]?></span></a>
    <?php }else{?>
        无總代
    <?php }?>
</td>
<td>
       <?php if($rows["is_allow_live"]=="1"){?>允许<?php }else{?>不允许<?php }?>
</td>
<td>
<!-- <a href="/#/live/log/check&username=<?= $rows["user_name"];?>" target="_blank"><span style="color:#F37605;">核查会员</span></a><br /> -->
<?= $rows["group_name"]?>
</td>
<td>
      <?= $rows["online"]!='0' ? "<span style=\"color:#FF00FF;\">在线</span>" : "<span style=\"color:#999999;\">离线</span>" ?><br/>
      <?= $rows["status"]=="停用" ? "<span style=\"color: #FF0000;\">停用</span>" : ($rows["status"]=="异常" ? "<span style=\"color: #FF0000;\">异常</span>" : "<span style=\"color:#006600;\">正常</span>")?>
</td>
<td>
      <input name="uid[]" type="checkbox" id="uid[]" value="<?= $rows["user_id"]?>" />
</td>
</tr>
<?php }?>
<?php if(count($users)==0){?>
<tr><td colspan="12" align="center"><span style="color:red;">无符合条件结果</span></td></tr>
<?php }?>
                </table>
            </td>
        </tr>
        <tr><td ><div style="float:left;">本页会员总余额：<span class="golden"><?= number_format(round($money,2),2,'.','')?></span>。 所有会员总余额：<span class="golden"><?= $total[0]?></span>。 所有正常会员总余额：
        <span class="golden"><?= $total[1]?></span>。 所有停用会员总余额：<span class="golden"><?= $total[2]?></span>。 所有异常会员总余额：<span class="golden"><?= $total[3]?></span>。</div></td></tr>
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
	function showDama(id) {
		$.ajax({
			url:"/?r=member/index/show-dama",
			type:'POST',
			data:{
				id: id
			},
			error: function() {
				layer.msg('服务器未响应！', {icon: 2});
			},
			success: function(result) {
				if (result) {
					result = JSON.parse(result);

					layer.open({
						content: '会员当前已打码量: ' + result['r'] + '</br>会员提款打码量条件: ' + result['dama']
					});
				} else {
					layer.msg('服务器未响应！', {icon: 2});
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

    function execute(){
        var len = document.form2.elements.length;
        var num = false,uidstr="",uname="";
        for(var i=0;i<len;i++){
            var e = document.form2.elements[i];
            if(e.checked && e.name=='uid[]'){
//            	console.log($(e).parent().parent().find('.uname').text());
				uname +=$(e).parent().parent().find('.uname').text()+',';
            	uidstr+=e.value+",";
                num = true;
            }
        }
        if(num){
            var action = document.getElementById("s_action").value;
            if(action=="0"){
                alert("请您选择要执行的相关操作！");
                return false;
            }else{
                if(action=="1"){

            		$.ajax({
            			url:"/?r=member/index/stop",
            			type:'POST',
            			data:{uidstr:uidstr,uname:uname},
            			error: function($e){
            				alert('服务器未响应！');
            			},
            			success:function($html){
							window.location.reload();
							alert("操作成功了！");
            			}
            		});
                }

                if(action=="2"){
            		$.ajax({
            			url:"/?r=member/index/active",
            			type:'POST',
            			data:{uidstr:uidstr,uname:uname},
            			error: function($e){
            				alert('服务器未响应！');
            			},
            			success:function($html){
							window.location.reload();
            				alert("操作成功了！");
            			}
            		});
            	 }

                if(action=="3"){
            		$.ajax({
            			url:"/?r=member/index/outline",
            			type:'POST',
            			data:{uidstr:uidstr,uname:uname},
            			error: function($e){
            				alert('服务器未响应！');
            			},
            			success:function($html){
							window.location.reload();
            				alert("操作成功了！");
            			}
            		});
                }
                if(action=="5"){
                	uidstr=uidstr.substring(0,uidstr.length-1);
                	window.location.href="/#/member/user/setpwd&uid="+uidstr;
                	return false;
                }
                if(action=="6"){
                    if(confirm('确认选中会员！')){
                		$.ajax({
                			url:"/?r=member/index/del",
                			type:'POST',
                			data:{uidstr:uidstr,uname:uname},
                			error: function($e){
                				alert('服务器未响应！');
                			},
                			success:function($html){
								window.location.reload();
                				alert("删除用户操作成功了！");
                			}
                		});
                    }else{
						return false;
                    }

                }
                if(action=="7"){
                	uidstr=uidstr.substring(0,uidstr.length-1);
                	window.location.href="/#/member/user/setgroup&uid="+uidstr;
                	return false;
                }
                if(action=="8"){
                	var agentid=prompt("请输入代理ID的名字（0代表无上级）");
                	if(agentid==""||agentid==null){

                    }else{
                		$.ajax({
                			url:"/?r=member/index/set-agentid",
                			type:'POST',
                			data:{uidstr:uidstr,agentid:agentid,uname:uname},
                			error: function($e){
                				alert('服务器未响应！');
                			},
                			success:function($html){
								window.location.reload();
                				alert($html);
//                 				alert("操作成功了！！！");
                			}
                		});
					}
                }

                if(action=="9"){
            		$.ajax({
            			url:"/?r=member/index/abletransfertolive",
            			type:'POST',
            			data:{uidstr:uidstr,uname:uname},
            			error: function($e){
            				alert('服务器未响应！');
            			},
            			success:function($html){
							window.location.reload();
            				//alert($html);
            				alert("操作成功了！");
            			}
            		});
                }
                if(action=="10"){
            		$.ajax({
            			url:"/?r=member/index/disabletransfertolive",
            			type:'POST',
            			data:{uidstr:uidstr,uname:uname},
            			error: function($e){
            				alert('服务器未响应！');
            			},
            			success:function($html){
							window.location.reload();
            				//alert($html);
            				alert("操作成功了！");
            			}
            		});
                }

                if(action=="11"){
                	var money=prompt("请输入设置选中用户当期最大下注金额：");
                	if(money==""||money==null){

                    }else{
                		$.ajax({
                			url:"/?r=member/index/set-bet-maxmoney",
                			type:'POST',
                			data:{uidstr:uidstr,money:money,uname:uname},
                			error: function($e){
                				alert('服务器未响应！');
                			},
                			success:function($html){
                				//alert($html);
                				alert("操作成功了！");
                			}
                		});
                    }

                }
                if(action=="12"){
                    if(confirm('确认清空所选会员。清空会员会把该会员所有未结算的、异常的订单都清空。')){
                		$.ajax({
                			url:"/?r=member/index/clear-betorders",
                			type:'POST',
                			data:{uidstr:uidstr,uname:uname},
                			error: function($e){
                				alert('服务器未响应！');
                			},
                			success:function($html){
                				//alert($html);
                				alert("操作成功了！");
                			}
                		});
                    }else{
                        return false;
                    }
				}

                if (action == '13') {
					layer.confirm(
						'确认清空所选会员打码量。清空会员打码量之后，会以清空时间为起始时间重新计算打码量，' +
						'在这之前的充值纪录与下注纪录都不列入计算，如果需要再变更打码量可于加扣款人工替会员补上。' +
						'</br></br>※可以用極小的金额改变(0.01)去更新打码量',
						{
							btn: ['确定', '取消']
						}, function() {
							$.ajax({
								url:"/?r=member/index/clear-dama",
								type:'POST',
								data:{
									uidstr: uidstr,
									uname: uname
								},
								error: function() {
									layer.msg('服务器未响应！', {icon: 2});
								},
								success: function(result) {
									if (result) {
										layer.msg('操作成功了！', {icon: 1});
									}
								}
							});
						}
					);
				}

                page();
            }
        }else{
            alert("您未选中任何复选框");
            return false;
        }
	}

	function page($page){
		if($page!==""){
			$('#current_page').val($page);
		}

		location.href = "#/member/index" + "&" + $('#key_search').serialize()+"&t="+new Date().getTime();
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
    function sumtopid(sum_top_id){
        $('#selecttype').val('sum_top_id');
        $('#key').val(sum_top_id);
        page(1);
    }
</script>