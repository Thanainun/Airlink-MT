<?php
	# configuration for database
	$_config['database']['hostname'] = "127.0.0.1";
	$_config['database']['username'] = "root";
	$_config['database']['password'] = "duydui190930";
	$_config['database']['database'] = "air_db";
	
	$_radius_sc="00c1d0a5a49919afd243af8837adcde3";
	$_IP_NAT="192.168.50.1";
	$_incoming_port="3799";
	
	# connect the database server
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	@session_start();
?>
