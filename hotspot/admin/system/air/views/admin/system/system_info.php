<?
	$this->load->helper('serverinfo');
	$meminfo = get_memory();


?>

<div class="span6">
<div class="widget_heading">
 <h4>รายละเอียดทั่วไป</h4>
</div>
<div class="widget_container">
<ul class="helptip">
<li><span class="btn btn-small btn-primary disable">Hostname</span> :  <?php echo get_hostname(); ?></li>
<li><span class="btn btn-small btn-primary disable">Server Uptime</span> :<?php echo uptime(); ?></li>
<li><span class="btn btn-small btn-primary disable">Server Load Avg.</span> :<?php echo get_system_load(); ?></li>
<li><span class="btn btn-small btn-primary disable">Date Time</span> :<?php echo get_datetime(); ?></li>
<li><span class="btn btn-small btn-primary disable">Kernel V.</span> :<?php $kv = shell_exec('uname -a'); echo $kv ?></li>
</ul>
</div>
</div>

<? 

$chillii = shell_exec('/usr/sbin/chilli -V');

$freeradiusv =shell_exec('/usr/sbin/freeradius -v'); 
   $v = substr($freeradiusv,16 ,21);
   $freeradius = str_replace('Version','',$v);
							  
$squidv =shell_exec('/usr/sbin/squid3 -v'); 
		$v = substr($squidv,11 ,17);
		$squid = str_replace('Version','Squid&nbsp;',$v);
	
$web = apache_get_version(); 

?> 

<div class="span6">
<div class="widget_heading">
 <h4>การ์ดแลนอินเทอร์เฟส</h4>
</div>
<div class="widget_container">
<?php
	$iflist = get_interface_list();

	foreach ($iflist as $ifname) {
			echo "\t<table>\n";
			echo "\t<tr>\n";
			echo "\t\t<td width=\"50%\">Lan Interface</td>\n";
			echo "\t\t<td>\n";
			echo "\t\t\t$ifname\n";
			echo "\t\t</td>\n";
			echo "\t</tr>\n";
			echo "\t<tr>\n";
			echo "\t<tr>\n";
			echo "\t\t<td>\n";
			echo "\t\t\tIP Address\n";
			echo "\t\t</td>\n";
			echo "\t\t<td>\n";
			echo "\t\t\t".get_ip_addr($ifname)."\n";
			echo "\t\t</td>\n";
			echo "\t</tr>\n";
			echo "\t<tr>\n";
			echo "\t\t<td>\n";
			echo "\t\t\tNetMask\n";
			echo "\t\t</td>\n";
			echo "\t\t<td>\n";
			echo "\t\t\t".get_mask_addr($ifname)."\n";
			echo "\t\t</td>\n";
			echo "\t</tr>\n";
			echo "\t<tr>\n";
			echo "\t\t<td>\n";
			echo "\t\t\tMAC address\n";
			echo "\t\t<td>\n";
			echo "\t\t\t".get_mac_addr($ifname)."\n";
			echo "\t\t</td>\n";
			echo "\t</tr>\n";
		}
		
	echo "\t</table>\n";
?>
</div>
</div>
