<?php
header("Content-type: text/html; charset=utf-8");
$data = array();
//键对应数据库的pay_type,值对应文件名
$data = [
	1=>'ipaylive',
	2=>'fabi_ipaylive',
	3=>'cbs'
];
if(empty($data[$_GET['pay_type']])){exit("<script language=javascript>alert('非法访问!请联系客服');history.back();</script>");}
header('location:http://'.$_SERVER['HTTP_HOST'].'/'.$data[$_GET['pay_type']].'/index.php?user_id='.$_GET['user_id'].'&user_name='.$_GET['user_name']);
