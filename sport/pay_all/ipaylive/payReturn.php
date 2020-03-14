<!DOCTYPE html>
<html>
<head>
<title>支付完成</title>
</head>
<body>

<?php
	header("Content-type: text/html; charset=utf-8");
	$parameters = $_GET;
	//header("Location:" . $parameters['paymentinfo']);
	var_dump($parameters);exit;
	//echo "已支付成功，请关闭此页面！";

?>

</body>
</html>