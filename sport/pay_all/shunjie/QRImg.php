<?php
	require_once('phpqrcode.php');
	$errorCorrectionLevel = "L";
	$matrixPointSize = "8";
	$margin = "4";
	QRcode::png($_POST['url'], false, $errorCorrectionLevel, $matrixPointSize, $margin);
?>