<head>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<link href="/public/member/css/standard.css" rel="stylesheet" type="text/css">
        <link href="/public/member/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css">
		<link href="/public/member/css/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/public/member/css/web_transport.css" rel="stylesheet" type="text/css">
        <script src="/public/js/jquery-1.7.2.min.js"></script>
        <script src="/public/member/js/jquery.blockUI.min.js"></script>
        <script src="/public/member/js/jquery.cookie.js"></script>
        <script src="/public/member/js/web.js"></script>
        <title>快速额度转换</title>
</head>
<body>
<script src="/public/aomen/js/live_exchange_transport.js"></script>
<div id="MACenterContent">
    <div id="MMainData" >
		<div class="tableTitle" style="display: none;">
			<h2 class="MSubTitle">目前额度</h2>
			<h2 class="MSubRemind">
				<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
				<font>►BB体育需额度转转入AG_BBIN娱乐场</font><br>
				<font>►AG体育、AG捕鱼、AG电子及YOPLAY街机额度转入AG国际厅</font>
			</h2>
		</div>
        <table class="MMain" border="1">
            <thead style="display: none;">
                <tr>
                    <th nowrap >类型</th>
                    <th class="phoneNone" nowrap >帐户</th>
                    <th nowrap >余额</th>
					<th nowrap >一键操作</th>
                <!--<th style="width: 20%;" nowrap>更新时间</th> -->
                </tr>
            </thead>
            <tbody>
				<?php
				if($user['type']=='all'){
				?>
                <tr>
                    <td width="20%" style="text-align: center;">ALL主账户</td>
                    <td class="phoneNone" width="20%" style="text-align: center;display: none;"><?= $user['name']; ?></td>
                    <td class="bgTab">
                        <span class="credit" id="credit">
                            <?= $user['money']; ?>
                        </span>
                    </td>
					<!--
					<td width="20%" style="text-align: center;">
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','3','credit','2')">转入AG国际娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','1','credit','2')">转入AG极速娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','5','credit','2')">转入AG_BBIN娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','11','credit','2')">转入AG_MG娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','7','credit','2')">转入DS娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','13','credit')">转入OG娱乐场</button>	
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','15','credit','2')">转入KG娱乐场</button>
						<button class="btnIn" onclick="return confirmChangeAllMoney('in','19','credit','2')">转入VR娱乐场</button>
                    </td>-->
                    <!--<td width="20%" style="text-align: center;">
                        <?= date("Y-m-d H:i:s", time()) ?>
                    </td>-->
                </tr>
				<?php
				}else{
				?>
				<tr>
                    <td class="test" >主账户：</td>
                    <td class="phoneNone" width="20%" style="text-align: center;display: none;"><?= $user['name']; ?></td>
                    <td class="colorOrange">
                        <span class="credit" id="credit">
                            <?= $user['money']; ?>
                        </span>
                    </td>
                    <!--<td width="20%" style="text-align: center;">
                        <?= date("Y-m-d H:i:s", time()) ?>
                    </td>-->
                </tr>
				<?php
				}
				?>
				<?php
				if($user['type']=='agin' || $user['type']=='all' ||$user['type']=='agSport' ||$user['type']=='agGameYo'||$user['type']=='agGame' ){
				?>
                <tr>
                    <td class="test">AG国际厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_agin">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab" >
                        <span class="credit" id="credit_agin">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
					  <!--<button class="btnOut" onclick="return confirmChangeAllMoney('out','4','credit_agin','2')">转出</button>-->
                    </td>
                   <!--<td style="text-align: center;">
                        <span id="time_agin">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='ag' || $user['type']=='all'){
				?>
                <tr>
                    <td class="test">AG极速厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_ag">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab">
                        <span class="credit" id="credit_ag">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                    <!--  <button onclick="return confirmChangeAllMoney('in','1','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','2','credit_ag','2')">转出</button>-->
                    </td>
                   <!-- <td style="text-align: center;">
                        <span id="time_ag">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='ag_bbin' || $user['type']=='all' || $user['type']=='ag_bbinSport'){
				?>
                <tr>
                    <td class="test">BBIN波音厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_ag_bbin">
                            正在同步中...
                        </span>
                    </td>
                    <td class="bgTab">
                        <span class="credit" id="credit_ag_bbin">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                      <!--<button onclick="return confirmChangeAllMoney('in','5','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','6','credit_ag_bbin','2')">转出</button>-->
                    </td>
                  <!--  <td style="text-align: center;">
                        <span id="time_ag_bbin">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='ag_mg' || $user['type']=='all'){
				?>
                <tr>
                    <td class="test">MG旗靓厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_ag_mg">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab">
                        <span class="credit" id="credit_ag_mg">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                     <!-- <button onclick="return confirmChangeAllMoney('in','11','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','12','credit_ag_mg','2')">转出</button>-->
                   </td>
                    <!--<td style="text-align: center;">
                        <span id="time_ag_mg">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='ds' || $user['type']=='all'){
				?>
                <tr>
                    <td class="test">DS贵宾厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_ds">
                            正在同步中...
                        </span>
                    </td>
                    <td class="bgTab" >
                        <span class="credit" id="credit_ds">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                    <!--  <button onclick="return confirmChangeAllMoney('in','7','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','8','credit_ds','2')">转出</button>-->
                   </td>
                  <!--  <td style="text-align: center;">
                        <span id="time_ds">
                            正在同步中...
                        </span>-->
                    </td>
                </tr>
				<?php
				}
				if($user['type']=='og' || $user['type']=='all'){
				?>
                <tr>
                    <td class="test">OG东方厅：</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_og">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab" >
                        <span class="credit" id="credit_og">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                    <!--  <button onclick="return confirmChangeAllMoney('in','13','credit')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','14','credit_og')">转出</button>-->
                   </td>
                 <!--   <td style="text-align: center;">
                        <span id="time_og">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='kg' || $user['type']=='all'){
				?>
                <tr>
                    <td class="test">VG娱乐场</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_kg">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab" >
                        <span class="credit" id="credit_kg">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                    <!--  <button onclick="return confirmChangeAllMoney('in','15','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','16','credit_kg','2')">转出</button>-->
                   </td>
                  <!--  <td style="text-align: center;">
                        <span id="time_kg">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='vr' || $user['type']=='all'){
				?>
				<tr>
                    <td class="test">VR彩票</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_vr">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab">
                        <span class="credit" id="credit_vr">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                     <!-- <button onclick="return confirmChangeAllMoney('in','19','credit','2')">转入</button> 
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','20','credit_vr','2')">转出</button>-->
                   </td>
                   <!-- <td style="text-align: center;">
                        <span id="time_vr">
                            正在同步中...
                        </span>
                    </td>-->
                </tr>
				<?php
				}
				if($user['type']=='pt' || $user['type']=='all'){
				?>
				<tr>
                    <td class="test">PT</td>
                    <td class="phoneNone" style="text-align: center;display: none;">
                        <span id="name_pt">
                            正在同步中...
                        </span>
                    </td>
                    <td class="colorOrange bgTab">
                        <span class="credit" id="credit_pt">
                            正在同步中...
                        </span>
                    </td>
					<td style="text-align: center;">
                   </td>
                </tr>
				<?php
				}
				?>
            </tbody>
        </table>
<!--        <h2 class="MSubTitle">额度转换</h2>
        <table class="MMain MNoBorder" style="width: auto;">
            <tr>
                <td nowrap>我的钱包&nbsp;&nbsp;&nbsp;&nbsp;-></td>
                <td>
                    <select name="zz_type_in" id="zz_type_in">
                        <option value="3">AG国际厅</option>
                        <option value="7">DS厅</option>
                        <option value="1">AG极速厅</option>
                        <!--<option value="9">AG_OG厅</option>
                        <option value="13">OG厅</option>
                        <option value="5">AG_BBIN厅</option>
                        <option value="11">AG_MG厅</option>
                        <option value="15">KG厅</option>
						<option value="19">VR厅</option>
                    </select>
                </td>
                <td nowrap>
                    转账金额：
                </td>
                <td>
                    <input type="text" name="zz_money_in" id="zz_money_in" onkeyup="if (isNaN(this.value))
                                execCommand('undo')" />
                    &nbsp;<span style="color: #ff0000;">最低转账金额:<?= $min_limit ?></span>
                </td>
                <td>
                    <input type="button" id="btn_int" onclick="return confirmChangeMoney('in');" 
                           value="确认转账" />
                </td>
            </tr>
            <tr>
                <td>
                    <select name="zz_type_out" id="zz_type_out">
                        <option value="4">AG国际厅</option>
                        <option value="8">DS厅</option>
						<option value="2">AG极速厅</option>
                        <!--<option value="10">AG_OG厅</option>
						<option value="14">OG厅</option>
                        <option value="6">AG_BBIN厅</option>
                        <option value="12">AG_MG厅</option>
                        <option value="16">KG厅</option>
						<option value="20">VR厅</option>
                    </select>
                </td>
                <td nowrap>->&nbsp;&nbsp;&nbsp;&nbsp;我的钱包</td>
                <td nowrap>
                    转账金额：
                </td>
                <td>
                    <input type="text" name="zz_money_out" id="zz_money_out" onkeyup="if (isNaN(this.value))
                                execCommand('undo')" />
                    &nbsp;<span style="color: #ff0000;">最低转账金额:<?= $min_limit ?></span>
                </td>
                <td>
                    <input type="button" id="btn_out" onclick="return confirmChangeMoney('out');" 
                           value="确认转账" />
                </td>
            </tr>
        </table>-->
    </div>
</div>
<script>
/**
 * 提交真人登录表单
 * @param {int} live_id 真人操作编号
 * @param {int} uid     用户id
 * @returns {Boolean}   true: 通过 false: 未通过
 */
function submitLive(live_id, uid) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('参数类型错误');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('请先登录！');
        return false;
    }
    
    window.open("/?r=live/login/index&type=" + live_id, "_blank");
    return true;
}
</script>
<div class="functionBox">
	<?php
					if($user['type']=='agin' || $user['type']=='all' ||$user['type']=='agSport' ||$user['type']=='agGameYo'||$user['type']=='agGame' ){
					?>
					<button class="btnIn" onclick="return confirmChangeAllMoney('in','3','credit','2')">转入</button>
					 <button class="btnOut" onclick="return confirmChangeAllMoney('out','4','credit_agin','2')">转出</button>
					<?php
					}
					if($user['type']=='ag'){
					?>
					  <button class="btnIn" onclick="return confirmChangeAllMoney('in','1','credit','2')">转入</button>
					  	<button class="btnOut" onclick="return confirmChangeAllMoney('out','2','credit_ag','2')">转出</button>
					 <?php
					}
					if($user['type']=='ag_bbin' || $user['type']=='all' || $user['type']=='ag_bbinSport'){
					?> 
					<button class="btnIn" onclick="return confirmChangeAllMoney('in','5','credit','2')">转入</button>
					<button class="btnOut" onclick="return confirmChangeAllMoney('out','6','credit_ag_bbin','2')">转出</button>
					<?php
					}
					if($user['type']=='ag_mg'){
					?>
					 <button class="btnIn" onclick="return confirmChangeAllMoney('in','11','credit','2')">转入</button>	
					 <button class="btnOut" onclick="return confirmChangeAllMoney('out','12','credit_ag_mg','2')">转出</button>
					<?php
					}
					if($user['type']=='ds'){
					?>
					 <button class="btnIn" onclick="return confirmChangeAllMoney('in','7','credit','2')">转入</button>
					 <button class="btnOut" onclick="return confirmChangeAllMoney('out','8','credit_ds','2')">转出</button>
					<?php
					}
					if($user['type']=='og'){
					?>
					 <button class="btnIn" onclick="return confirmChangeAllMoney('in','13','credit')">转入</button>	
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','14','credit_og')">转出</button>
					<?php
					}
					if($user['type']=='kg'){
					?>
					  <button class="btnIn" onclick="return confirmChangeAllMoney('in','15','credit','2')">转入</button>
					  <button class="btnOut" onclick="return confirmChangeAllMoney('out','16','credit_kg','2')">转出</button>
					<?php
					}
					if($user['type']=='vr'){
					?>
					<button class="btnIn" onclick="return confirmChangeAllMoney('in','19','credit','2')">转入</button>
					<button class="btnOut" onclick="return confirmChangeAllMoney('out','20','credit_vr','2')">转出</button>
					
					<?php
					}
					if($user['type']=='pt'){
					?>
					<button class="btnIn" onclick="return confirmChangeAllMoney('in','17','credit','2')">转入</button>
					<button class="btnOut" onclick="return confirmChangeAllMoney('out','18','credit_pt','2')">转出</button>
					
					<?php
					}
					?>
        </div>
<div class="functionbtns">
		<?php if($user['type']=='agin' || $user['type']=='agGame' || $user['type']=='agGameYo')
		{
        ?>
		<input class="playBtn" onclick="return submitLive(2, 1492);" type="button" value="立即游戏">
		<?php 
		} if($user['type']=='agSport'){
		?> 
		<input class="playBtn" onclick="location.href='/?r=game/login/index&type=1002&game_id=TASSPTA'" type="button" value="立即游戏">
		<?php 
		} if($user['type']=='ag'){
		?>
		<input class="playBtn" onclick="return submitLive(1, 1492);" type="button" value="立即游戏">
		<?php 
		} if($user['type']=='ag_bbin'){
		?> 
		<input class="playBtn" onclick="return submitLive(3, 1492);" type="button" value="立即游戏">
		<?php 
		} if($user['type']=='ag_bbinSport'){
		?> 
		<input class="playBtn" onclick="location.href='/?r=game/login/index&type=1003&game_id=4'" type="button" value="立即游戏">
		<?php
		}if($user['type']=='ag_mg'){
        ?>
		<input class="playBtn" onclick="location.href='/public/buyugame/mobile/index-mg.html'"  type="button" value="立即游戏">
        <!--<a href="/public/buyugame/mobile/mobile_popular.html"><input class="playBtn" type="button" value="立即游戏"></a>-->
		<!-- <input class="playBtn" onclick="return submitLive(6, 1492);" type="button" value="立即游戏"> -->
		<?php
		} if($user['type']=='ds'){
		?>
		<input class="playBtn" onclick="return submitLive(4, 1492);" type="button" value="立即游戏">
		<?php
		} if($user['type']=='og'){
		?>
		<input class="playBtn" onclick="return submitLive(7, 1492);" type="button" value="立即游戏">
		<?php
		} if($user['type']=='kg'){
		?>
		<!--<input class="playBtn" onclick="return submitLive(2, 1492);" type="button" value="立即游戏">-->
		<input class="playBtn" onclick="location.href='/?r=game/login/index&amp;type=KG&amp;game=1000'" type="button" value="立即游戏">
		<?php
		} if($user['type']=='vr'){
		?>
		<input class="playBtn" onclick="location.href='/?r=lottery/login/index&type=10'" type="button" value="立即游戏">
		<?php
		} if($user['type']=='pt'){
		?>
		<input class="playBtn" onclick="window.open('/public/buyugame/mobile/index-pt.html', 'pt')" type="button" value="立即游戏">
		<?php
		}
		?>
		<!--	<input class="playBtn" onclick="return submitLive(2, 1492);" type="button" value="立即游戏">
	            <input class="closeBtn" onclick="window.close();" type="button" value="关　　闭">-->
	
	</div>
</body>
