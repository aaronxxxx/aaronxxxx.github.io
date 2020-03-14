<div class="round-table" id="table" >
	<table class="GameTable" style="border: 1;">
		<tr>
			<td class="num" style="width:30px">
				<select id = "aOtype" name="aOtype" style="width:150px" onchange="hide_rate()">
					<option value="random" <?php if($aOtype == 0 ){echo 'selected';} ?>>随机开彩</option>
					<option value="cheat" <?php if($aOtype == 1 ){echo 'selected';} ?>>会员诱彩</option>
					<option value="rtp" <?php if($aOtype == 2 ){echo 'selected';} ?>>庄家胜率 RTP</option>
				</select>
			</td>
			<td class="odds" id = "odds">
				<select name="aOdds">
					<option value="0.25" <?php if($rows['h1'] == 0.25){echo 'selected';} ?>>25%</option>
					<option value="0.20" <?php if($rows['h1'] == 0.20){echo 'selected';} ?>>20%</option>
					<option value="0.15" <?php if($rows['h1'] == 0.15){echo 'selected';} ?>>15%</option>
					<option value="0.10" <?php if($rows['h1'] == 0.10){echo 'selected';} ?>>10%</option>
					<option value="0.05" <?php if($rows['h1'] == 0.05){echo 'selected';} ?>>5%</option>
					<option value="0.00" <?php if($rows['h1'] == 0.00){echo 'selected';} ?>>0%</option>
					<option value="-0.05" <?php if($rows['h1'] == -0.05){echo 'selected';} ?>>-5%</option>
					<option value="-0.10" <?php if($rows['h1'] == -0.10){echo 'selected';} ?>>-10%</option>
					<option value="-0.15" <?php if($rows['h1'] == -0.15){echo 'selected';} ?>>-15%</option>
					<option value="-0.20" <?php if($rows['h1'] == -0.20){echo 'selected';} ?>>-20%</option>
					<option value="-0.25" <?php if($rows['h1'] == -0.25){echo 'selected';} ?>>-25%</option>
				</select>
			</td>
		</tr>
	</table>
</div>
<script>
	function hide_rate(){
		if($('#aOtype').val() == 'rtp')
		{
			$('#odds').show();
		}else{
			$('#odds').hide();
		}
	}
	hide_rate();
</script>