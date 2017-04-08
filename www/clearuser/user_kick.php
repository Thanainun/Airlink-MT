<?
	include("include/class.mysqldb.php");
	include("include/config.inc.php");

$pathchmod = "/etc/raddb/*";
@chmod($pathchmod, 755);

//disconnect user using radclient
if (isset($_POST['submit2'])){
}
	if(isset($_POST['submit'])) {
		$sql = "select username , password from voucher where voucher.username = '".$_POST['keyuser']."' and voucher.password = '".$_POST['keypasswd']."' order by voucher.username";
		$result = mysql_query($sql);
		$datasql = mysql_fetch_object($result);

		if($datasql->password == $_POST['keypasswd']) {
		$_REQUEST['user'] = $_POST['keyuser'];
	}
			else {
		echo "<fieldset><legend><b> <h3><strong><strong>username หรือ  password ของท่านไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง</strong></strong></h3></b></legend>";
		}
	}

if($_REQUEST['user']) {
	$sql1 = "SELECT * FROM radacct WHERE username='".$_REQUEST['user']."' AND AcctStopTime IS NULL OR AcctStopTime='0000-00-00 00:00:00'";
	$link = mysql_query($sql1);
	$totals = mysql_num_rows($link);
	if($totals==0){
		  $clearoutput="<h3>ไม่มีผู้ใช้ งานค้างในระบบ</h3>";
		  $updatesqloutput="<h3>Clear user Complete</h3>";
	} else {	
	$kill_users = mysql_fetch_object($link);
	$command = '/bin/echo User-Name='.$_REQUEST['user'].',Framed-IP-Address='.$kill_users->framedipaddress.' | /usr/bin/radclient -x '.$_IP_NAT.':'.$_incoming_port.' disconnect '.$_radius_sc.'';
	//echo $command;
	$shell_command=$command;
	$clearoutput="<h3>ทำการ Clear user เรียบร้อยแล้ว</h3>";
	$updatesqloutput="<h3>Update Database Complete</h3>";
	$output = shell_exec($command);
	#$output = substr(shell_exec($command), 0, -1);
	//fix mysql database: update radacct set AcctTerminateCause='Admin-Reset', AcctStopTime=now() where username=$username and acctStopTime is null
	$updateSQL = sprintf("UPDATE radacct SET AcctTerminateCause='%s', AcctStopTime=NOW() WHERE UserName='%s' and AcctStopTime IS NULL","Admin-Reset", $_REQUEST['user']);
	mysql_query($updateSQL);
    }
	echo "<fieldset><legend>Result shell command :</legend>";
	echo $clearoutput;
	echo "<br>";
	echo "</fieldset>";
	if($totals!=0){
	echo "<fieldset><legend>Mysql database: update radacct :</legend>";
	echo $updatesqloutput;
	echo "</fieldset>";
	}
}
?>
				
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abyszosoft" />
	<meta name="keywords" content="Abyszosoft" />
	<meta name="description" content="Abyszosoft" />	
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
	<title>-: Wifi Clear User :-</title>
<style type="text/css">
<!--
body {
	background-image: url(/clearuser/images/BG.jpg);
	background-repeat: repeat;
}
.style8 {font-size: 18px}
.style11 {font-weight: bold; font-size: 24px;}
.style12 {
	font-size: 20px;
	color: #CCCCCC;
}
.style13 {
	color: #FFFFFF
}
-->
</style></head>
<body>
<div class="style8" id="content">
<form id="form1" name="form1" method="post" action="">
		<table width="40%" border="0" align="left" cellpadding="0" cellspacing="5">
        <tr><td colspan="2" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="10" >
          <tr>
            <td align="center"><img src="images/logo.png" alt="" width="155" height="29" /></td>
            <td><a href="/clearuser/user_kick.php" class="style11">Clear Login user</a><br />
            <table width="156" border="0" cellpadding="0" cellspacing="0">
              </table></td>
          </tr>
        </table></td></tr>
<tr>
			<td width="136" align="right">&nbsp;</td>
  <td width="281">
				ใส่ username และ password <br>
	    ให้ครบถ้วนในช่องที่มีเครื่องหมาย (*) </td>
		</tr>
		<tr>
			<td width="136" align="right">ชื่อผู้ใช้ :</td>
		  <td>
	      <input name="keyuser" type="text" class="inputbox-normal" id="keyuser">			*			</td>
		</tr>

		<tr>
			<td width="136" align="right">รหัสผ่าน :</td>
<td>
				<input name="keypasswd" type="password" class="inputbox-normal" id="keypasswd">		  *			</td>
		</tr>

		<tr>
			<td width="136" align="right">&nbsp;</td>
	  <td>
				<input type="submit" name="submit" id="submit" value="Clear Login"/>				</td>
		</tr>
		</table>
  </form>
</div>
</body>
</html>