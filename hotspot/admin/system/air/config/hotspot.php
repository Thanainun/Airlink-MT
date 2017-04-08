<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['access_controller'] = 'coovachilli';

$config['company_name'] = 'DUYDUI Server Hotspot';
$config['company_address_line1'] = 'Linuxthai.org';
$config['company_address_line2'] = 'Linuxthai.org';
$config['company_address_line3'] = '--';
$config['company_phone'] = '';

$config['currency_symbol'] = ' บาท ';
$config['currency_symbol_pdf'] = ' บาท ';
$conifg['company_tax_code'] = '';
$config['admin_price_input'] = 'converted';
$config['thousands_separator'] = ',';
$config['decimal_separator'] = '.';
$config['decimal_places'] = '2';

$config['voucher_acct_interim_interval'] = '60';
//Freeradius
$config['coaport'] = '3779';
$config['radiusserver_auth'] = '127.0.0.1:1812';
$config['radiuscommand'] = '/usr/bin/radclient -x';
$config['rootcommand'] = '/usr/bin/sudo';
$config['chilli_query'] = '/usr/sbin/chilli_query';
$config['radiussecret'] = '00c1d0a5a49919afd243af8837adcde3';
$config['uamsecret'] = '6018a823ab56548ab37a0370f18939e3';

$config['backup_folder'] =  'backup/';
$config['user_folder'] =  'userfiles/';
$config['themes_folder'] =  'templates/';


/*
| -------------------------------------------------------------------
|  เปลี่ยนเทมเพลตตรงนี้ครับ ชื่อเทมเพลต = ชื่อโฟล์เดอร์  ตามตัวอย่างครับ
| -------------------------------------------------------------------
|
| $config['template'] = 'ชื่อเทมเพลต';
| $config['template'] = 'default';
|
*/

$config['template'] = 'nostx';
//$config['template'] = 'default';

/*
| -------------------------------------------------------------------
|  รูปแบบการแสดงเวลา
| -------------------------------------------------------------------
|

 $config['compact_dis'] = '0';
/*
| 0 = แสดงรูปแบบนาฬิกาขนาดใหญ่
| 1 = แสดงรูปแบบนาฬิกาขนาดเล็ก
| ** จะไม่มีผลกับการแสดงแบบ ดิจิตอล
|

$config['time_counter_style'] = '2';

| 0 = ค่าเริ่มต้น แสดงแบบปกติ
| 1 = ตัวเลขดิจิตอล
| 2 = ตัวเลขดิจิตอลแบบที่ 2 (ตัวใหญ่)
|
*/


$config['compact_dis'] = '0';
$config['time_counter_style'] = '1';

/*
| -------------------------------------------------------------------
|  รูปแบบการแสดงเวลา
| -------------------------------------------------------------------
|
| $config['product'] = '0';
|
| $config['submask'] = '0';
|
*/

$config['submask'] = '33draPHaNaVu37thaCr6tHemeSathE@rUweyeFaDaCruQesW_StECHA2aca2ucru';
$config['product'] = 'thuthamebreve5remuXutrepresuspekefucreswupruwewra2ap2achajenudra';

/*
| -------------------------------------------------------------------
|  ตั้งค่า การบล๊อค MAC Address ที่ไม่อนุญาติให้เข้าสู่หน้าล๊อกอิน
| -------------------------------------------------------------------
|
| $config['mac_verify'] = 0;
| 0 = อ่านจากไฟล์ในโฟล์เดอร์ opt (ดูตัวอย่างไฟล์ได้ opt/macdeny)
| 1 = อ่านจากฐานข้อมูล  (ยังไม่ใช้งานฐานข้อมูลครับ)
|
*/

$config['mac_verify'] = 1;

/*
| -------------------------------------------------------------------
|  ไฟล์ตั้งค่าสำหรับเซิฟเวอร์
| -------------------------------------------------------------------
|
*/

$config['CHILLISPOT_COFIG_FILE']='/etc/chilli/config';
$config['QOS_COFIG_FILE']='/etc/chilli/control.sh';
$config['SITE_SSL_COFIG_FILE']='/etc/apache2/sites-available/hotspot';
$config['APACHE2_COFIG_FILE']='/etc/apache2/apache2.conf';
$config['HOST_NAME_COFIG_FILE']='/etc/hosts';
$config['RADIUS_COFIG_FILE']='/etc/freeradius/clients.conf';
$config['SQUID_LOCALNET']='/etc/squid3/localnet.txt';
$config['SQUID_COFIG_FILE']='/etc/squid3/squid.conf';
$config['BLOCK_FILES']='/etc/squid3/block-files.txt';
$config['BLOCK_BITS']='/etc/squid3/block-bit.txt';
$config['BLOCK_WEB']='/etc/squid3/block-web.txt';
$config['BLOCK_IP']='/etc/squid3/block_ip.txt';
$config['LIMIT_DOWNLOAD']='/etc/squid3/download.txt'; 
$config['STORE_URL_REWRITE']='/etc/squid3/store_url_rewrite.pl';
$config['POTOCAL_REWRITE']='/etc/squid3/potocal_rewrite.pl';

/* End of file hotspot.php */
/* Location: ../system/nostradius/config/hotspot.php */
?>
