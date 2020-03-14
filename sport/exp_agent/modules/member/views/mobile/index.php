<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>危險手機號碼</title>
</head>

<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0"  id=editProduct  class="font14 skintable line35" >
  <tr  class="t-title"  align="center">
    <td><strong>手機號碼</strong></td>
    <td><strong>會員個數</strong></td>
  </tr>
<?php
foreach($rs as $key=>$value){
	if($value['count'] > 1){
?>
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td align="center"><a href="?r=member/index&tel=<?=$value['tel']?>"><?=$value['tel']?></a></td>
    <td align="center"><?=$value['count']?></td>
  </tr>
<?php
	}
}
?>
</table>
</body>
</html>