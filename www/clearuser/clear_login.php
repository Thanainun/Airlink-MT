 <?php  // header('Content-Type: text/html; charset=utf-8'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874 />
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
 

$hostname_mysql = "127.0.0.1";
$database_mysql = "air_db";
$username_mysql = "root";
$password_mysql= "duydui190930";
$connect_radius= @mysql_connect ($hostname_mysql, $username_mysql, $password_mysql);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");



$date2=date('Y-m-d H:i:s',strtotime("-2 days"));
//$date1=date('Y-m-d H:i:s',strtotime("-1 days"));
$date1=date("Y-m-d H:i:s");
mysql_select_db("$database_mysql", $connect_radius)  ;
 
$date=date('Y-m-d H:i:s');
 $query_Recordset2 = "update    radacct  set acctstoptime='$date'  where   acctstartTime BETWEEN      '$date2' and '$date1'   and  acctstoptime is NULL  ";
 mysql_query($query_Recordset2, $connect_radius) or die(mysql_error());
 

   ?>



