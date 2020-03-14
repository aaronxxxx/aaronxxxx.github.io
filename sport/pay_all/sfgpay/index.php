<?php
	require_once('../PublicConf.class.php');
	require_once('config.php');
	//ini_set("display_errors", "On");
	header("Content-type: text/html; charset=utf-8");

	$config = new PublicConf('sfgpay');

	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	//echo var_dump($configext["config"]["request_gateway"]);
	$uid= $_GET['user_id'];
	$user_name = trim($_GET['user_name']);
	//$uid = 'jXAkkoXofM2CmbeIw8E9jr4';
	//$user_name ='dyy111';
	if(empty($uid) || empty($user_name)){echo "缺少参数";exit;}
?>
<!DOCTYPE html>
<html>
<head>
    <title>线上支付</title>
    <link type="text/css" rel="stylesheet" href="/static2/bootstrap-2.3.2/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static2/css/radio-banks.css"/>
    <link type="text/css" rel="stylesheet" href="/static2/css/simple-radius-border.css"/>
    <script type="text/javascript" src="/static2/jquery/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/static2/bootstrap-2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<form id="mainForm" class="form-horizontal" action="paySubmit.php" method="POST">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span10 offset1">
                <ul class="nav nav-pills nav-stacked" style="margin-top: 2px; margin-bottom: -1px;">
                    <li class="active">
                        <a href="#" style="font-size: 18px;">订单信息</a>
                    </li>
                </ul>
                <div class="low-half-radius-border" style="padding-top: 10px;">
                    <div class="control-group">
                        <label class="control-label" style=" font-size: 16px;"><strong>商品名称：</strong></label>
                        <div class="controls" style="margin-left: 110px; padding-top: 5px;">
                            <span><?=$user_name?>账户充值</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style=" font-size: 16px;"><strong>金额：</strong></label>
                        <div class="controls" style="margin-left: 110px; padding-top: 5px;">
                            <span><input type="text" id='totalAmount' name="totalAmount" style="width: 50px;;">最低支付金额<?php echo  $configdata['money_Lowest'];?>元。</span>
                        </div>
                    </div>。
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span10 offset1">
                <ul class="nav nav-tabs">
					
                    <!--<li class="active">
                        <a href="javascript:void(0);" onclick="show_bank(this)" name="GATEWAY" onmouseover="this.style.cursor='pointer'"><strong>网关支付</strong></a>
                    </li>-->			
					
					<li class="active">
                        <a href="javascript:void(0);" id = "QRcode" onclick="show_bank(this)" name="QRCODE" class="gray_color" onmouseover="this.style.cursor='pointer'"><strong>手机扫码</strong></a>
                    </li>
					
					<!--<li class="active">
                        <a href="javascript:void(0);" onclick="show_bank(this)" name="WAP" class="gray_color" onmouseover="this.style.cursor='pointer'"><strong>WAP</strong></a>
                    </li>-->
					
                </ul>
                <div style="border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: -20px;">
                    <div class="container-fluid" style="padding-top:20px;">
						
                        <div class="row-fluid" style="padding-left: 20px; margin-bottom: 10px;" id="GATEWAY">
							<?php
								if(count($configext['bankCode'] > 0)){
									foreach($configext['bankCode'] as $key1 => $value1){
										echo '<div class="span3">';
											echo '<label class="radio">';
												echo '<input type="radio" name="bankCode" class="radio-img-bank" title="'.$value1['name'].'" value="'.$key1.'">';
												if($value1['img'] != ''){
													echo '<div class="'.$value1['img'].'"></div>';
												}else{
													echo '<div>'.$value1['name'].'</div>';
												}
											echo '</label>';
										echo '</div>';
									}
								}else{
									echo '<div class="span2">';
										echo '<label class="radio">';
											echo '查無銀行列表';
										echo '</label>';
									echo '</div>';
								}
							?>
                        </div>
						
						
						<div class="row-fluid" style="padding-left: 20px; margin-bottom: 10px;display: none;" id="QRCODE">
                            <?php
								if(count($configext['type'] > 0)){
									foreach($configext['type'] as $key1 => $value1){
										if($value1['type'] == 'pc'){
											echo '<div class="span3">';
												echo '<label class="radio">';
													echo '<input type="radio" name="bankCode" class="radio-img-bank" title="'.$value1['name'].'" value="'.$key1.'">';
													if($value1['img'] != ''){
														echo '<div class="'.$value1['img'].'"></div>';
													}else{
														echo '<div>'.$value1['name'].'</div>';
													}
												echo '</label>';
											echo '</div>';
										}
									}
								}
							?>
                        </div>
						
						
						<div class="row-fluid" style="padding-left: 20px; margin-bottom: 10px;" id="WAP">
                            <?php
								if(count($configext['type'] > 0)){
									foreach($configext['type'] as $key1 => $value1){
										if($value1['type'] == 'mobile'){
											echo '<div class="span3">';
												echo '<label class="radio">';
													echo '<input type="radio" name="bankCode" class="radio-img-bank" title="'.$value1['name'].'" value="'.$key1.'">';
													if($value1['img'] != ''){
														echo '<div class="'.$value1['img'].'"></div>';
													}else{
														echo '<div>'.$value1['name'].'</div>';
													}
												echo '</label>';
											echo '</div>';
										}
									}
								}
							?>
                        </div>
                    </div>
                    <div class="row-fluid" style="padding-left: 20px; margin-bottom: 10px;">
                        <button id="submitBtn" class="btn btn-large btn-primary" type="button" onclick="check_suc(this)">确认支付</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<input type="hidden" name="user_name" value="<?=substr($user_name,0,10)?>"><!--用户名-->
        <input type="hidden" name="uid" value="<?=$uid?>"><!--回传参数-->
		<input type="hidden" id="payType" name="payType" value="QRcode"><!--支付類型(預設網關)-->
</form>
<script type="text/javascript">
	$("#QRcode").click();		//QRcode 為預設
	$(function () {
		$(document).keydown(function(event){ 
			if(event.keyCode==13){
				var money = $('#totalAmount').val();
				if(isNaN(money) || money == ""){
					alert('金额输入有误！');return false;
				}
				if(money < <?php echo  $configdata['money_Lowest'] ;?>){
					alert("充值最小金额"+<?php echo  $configdata['money_Lowest']?>+"元！");return false;
				}
				var checked = $('input[name="bankCode"]:checked').val();
				if (typeof (checked) == 'undefined') {
					alert('请选择支付方式');return
				}
				$(this).attr('disabled','true');
				$(this).text('正在提交，请稍后');
				$('#mainForm').submit();
			}
		});
	});
	
	function show_bank(ths){
		var tag_name = $(ths).attr("name");
		$('#payType').val(tag_name);
		$(ths).removeClass('gray_color');
		$(ths).parent().siblings().children('a').addClass('gray_color');
		$('#'+tag_name).siblings().hide();
		$('#'+tag_name).show();
	}

	function check_suc(obj){
		var money = $('#totalAmount').val();
		var str = /^[0-9]+(\.[0-9]{1,2})?$/;		//限制小数点只能有两位数
		//var result = (money.toString()).indexOf(".");		//限制小數點
		if (isNaN(money) || money == ""){
			alert('金额输入有误！');return false;
		}
		if (money < <?php echo  $configdata['money_Lowest'] ;?>){
			alert("支付宝充值最小金额"+<?php echo  $configdata['money_Lowest']?>+"元！");return false;
		}
		if (money > <?php echo  $configdata['money_limits'] ;?>){
			alert("单笔充值最高金额"+<?php echo  $configdata['money_limits']?>+"元！");return false;
		}
		if (! str .test(money)){
			alert('输入金额的小数点后只能保留两位！');return false;
		}/*
		if(result != -1) {
			alert("请勿输入带有小数点金额！");
			return false;
		}*/
		var checked = $('input[name="bankCode"]:checked').val();
		if (typeof (checked) == 'undefined') {
			alert('请选择支付方式');return
		}
		$(obj).attr('disabled','true');
		$(obj).text('正在提交，请稍后');
		$('#mainForm').submit();	
	}
</script>
</body>
</html> 