<?php
include("config.php");

$db['hostname'] = 'localhost';
$db['username'] = 'root';
$db['password'] = '';
$db['database'] = 'radius';

if($_POST[apipasword]==$apipassword&&$_POST[user]==$username){
	$amount=$_POST['amount'];
	$ref=$_POST['ref'];
	$payid=$_POST['payid'];
	$ip=$_POST['ip'];
	//------------------------------------------------------------------------------
		
			
	//------------------------------------------------------------------------------
}else{
	exit();
}
?>