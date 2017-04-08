<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
 include ('AES.php');
 include ('db.php');

mysql_connect($db['hostname'],$db['username'],$db['password']);
mysql_select_db($db['database']);
mysql_query("SET NAMES UTF8");
		
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

		$config = mysql_query("SELECT value FROM config  WHERE name ='global_config'");
		$config_db=mysql_fetch_array($config);
		$conf_data = unserialize($config_db['value']); 
//ตั้งค่า

define('API_PASSKEY', $conf_data['api_pass_key']);
//จบการตั้งค่า
$date=date("Y-m-d H:i:s");
//หากมีตัวแปล ถูกส่งมาจาก ip และ มีตัวแปล อาเรย์ส่งมาไห้
if($_SERVER['REMOTE_ADDR'] == '203.146.127.115' && isset($_GET['request']))
{	
$aes = new Crypt_AES();//สร้าง ออฟเจ็คต้นแบบ api
$aes->setKey(API_PASSKEY); //รหัสตรวจสอบ 
$_GET['request'] = base64_decode(strtr($_GET['request'], '-_,', '+/=')); //ถอดรหัสข้อมูลที่ถูกส่งมา
$_GET['request'] = $aes->decrypt($_GET['request']);//เรียกไช้เม็ตตอด จากออฟเจ็คที่สร้าง
	if($_GET['request'] != false) //ข้อมูลถูกต้องส่ง true ไม่ถูกต้อง false
	{	parse_str($_GET['request'],$request);//สลับคุณสมบัติตัวแปล
		$request['Ref1'] = base64_decode($request['Ref1']);//ถอดรหัส
		
		//อับเดชยอดเงินใน ตาราง voucher ฟิล money = money+ จำนวนเงิน
		$result = mysql_query("SELECT * FROM true_topup  WHERE username ='".$request['Ref1']."' and code ='".$request['cardcard_password']."'");
		if(mysql_num_rows($result) == 0)
		{ 
			mysql_query("UPDATE voucher SET money=money+". $request['cardcard_amount']." WHERE username= '".$request['Ref1']."'");
			//เก็บประวัติการเติมเงิน
			mysql_query("INSERT INTO true_topup VALUES (NULL ,'".$request['Ref1']."', '".$request['cardcard_password']."', '".$date."', '". $request['cardcard_amount']."')");
		}
			
		echo 'SUCCEED';
	}
	else
	{echo 'ERROR|INVALID_PASSKEY';
	}
}else
{
	echo "ERROR|ACCESS_DENIED";
;
}
?>