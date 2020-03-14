<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>系统公告</title> 
<style type="text/css">
* {
    margin: 0;
    padding: 0;
}
body{font-size:12px; margin:0px; background: #E1F0F7;}
.td_2 {
    border-bottom: 1px solid #7CBDDC;
    border-right: 1px solid #B6DAEB;
    border-left: 1px solid #B6DAEB;
}
.td_3 {
    border-bottom: 1px solid #7CBDDC;
    border-right: 1px solid #B6DAEB;
    overflow: auto; 
    line-height:20px;
}
.td_1 {
    border-right: 1px solid #fff;
}

.se_1 {
    height: 30px;
    background: url(/public/rule/images/gg_2.jpg) no-repeat;
}


.se_2 {
    background: url(/public/rule/images/gg_3.jpg) repeat-x;
    text-align: right;
}
</style>
<script src="/public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	function typeChange(){
		var $type = $('#msg_type option:selected').val();
		if ($type == "all") {
			$('.msgtype').show();
		} else if($type == "xt"){
			$('.msgtype').hide();
			$('.msgtype[data-type=]').show();
		} else {
			$('.msgtype').hide();
			$('.msgtype[data-type=0]').show();
		}
		
	}
</script>
</head> 
<body> 
<table border="0" align="center" cellpadding="0" cellspacing="0" class="memberdiv">
    <tr class="se_2">
        <td class="se_1" width="91"></td>
        <td>
			<select id="msg_type" onchange="typeChange()" style="margin-right: 6px;">
				<option value="all">所有公告</option>
				<option value="xt">系统公告</option>
				<option value="ty">体育公告</option>
			</select>
		</td>
   </tr>
   <tr>
        <td valign="middle" height="20" bgcolor="#B6DAEB" align="center" class="td_1">时 间</td>
        <td valign="middle" bgcolor="#B6DAEB" align="center" class="font-blackmid">公告内容</td>
</tr>

<?php
foreach($msg as $key => $value){
    if($key>39){
        break;
    }
?>
    <tr class="msgtype" data-type="<?=$value["type"]?>">
        <td class="td_2" valign="middle" height="20" align="center"><?=date("Y-m-d",strtotime($value["create_date"]))?></td>
        <td class="td_3" valign="middle" height="20" align="left" width="507"><?=$value["content"]?></td>
    </tr>
<?php
}
?>

   </table>
</body>
</html>