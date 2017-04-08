<?php
include("include/class.mysqldb.php");
include("include/config.inc.php");
//kill users on Textmode Command line.
$sql = "SELECT * FROM radacct WHERE AcctStopTime IS NULL OR AcctStopTime='0000-00-00 00:00:00'";
$link->query($sql);
while($kill_users = $link->getnext()) {
	//$command = '/bin/echo User-Name='test',Framed-IP-Address='172.0.3.253' | /usr/bin/radclient -x '192.168.50.1:3799' disconnect '00c1d0a5a49919afd243af8837adcde3'';
	$command = '/bin/echo User-Name='.$kill_users->UserName.',Framed-IP-Address='.$kill_users->framedipaddress.' | /usr/bin/radclient -x '.$_IP_NAT.':'.$_incoming_port.' disconnect '.$_radius_sc.'';
	$output = shell_exec($command);

	$updateSQL = sprintf("UPDATE radacct SET AcctTerminateCause='%s', AcctStopTime=NOW() WHERE UserName='%s' and (AcctStopTime IS NULL OR AcctStopTime='0000-00-00 00:00:00')","User-Reset", $kill_users->UserName);
	mysql_query($updateSQL);
}
?>