<?php
#error_reporting(E_ALL ^ E_NOTICE);
$dbserver = 'localhost';
$dbuser = 'root';
$dbpass = "duydui190930";  #อย่าลืมเปลี่ยนรหัสผ่านตรงนี้ ให้ตรงกับของท่าน
$dbname = 'air_db';

$title = "LabCom WiFi Hotspot";


mysql_connect($dbserver, $dbuser, $dbpass) or die("เชื่อมต่อฐานข้อมูลไม่ได้ ");
mysql_select_db($dbname) or die("เลือกฐานข้อมูลไม่ได้"); // เลือกฐานข้อมูล
mysql_query("SET NAMES UTF8");
?>