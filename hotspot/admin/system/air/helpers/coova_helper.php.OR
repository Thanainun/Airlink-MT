<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_dhcplist()
{
	$CI =& get_instance();
	$strFileName = set_realpath('').'tmp/dhcp';

	$file = shell_exec('/usr/bin/sudo '.$CI->config->item('chilli_query').' list > '.$strFileName.' 2>&1');

	$data = array();
	
	$objFopen = fopen($strFileName, 'r');
	if ($objFopen)
	{
		$ic = 0;
		while (!feof($objFopen))
		{
			$ic++;
			$str = fgets($objFopen, 4096);
			if($str!='') $data[] = explode(' ', $str);
		}
		fclose($objFopen);
	}
	
	$output = array();
	
	if(isset($data))
	{
		foreach($data AS $value)
		{
			$d_name = array();

			$d_name['mac'] = $value[0];
			$d_name['ip'] = $value[1];
			$d_name['status'] = $value[2];
			$d_name['sessionid'] = $value[3];
			$d_name['username'] = $value[5];
			$d_name['timeusage'] = $value[6];
			$d_name['idletimeout'] = $value[7];
			$d_name['download'] = $value[8];
			$d_name['upload'] = $value[9];
			$d_name['maxpacket'] = $value[10];
			$d_name['bandwidth_up'] = substr($value[12],0,strpos($value[12],'/'));
			$d_name['bandwidth_down'] = substr($value[13],0,strpos($value[13],'/'));

			$output[] = $d_name;
		}
	}
	
	return $output;

}

function operation($opt, $target, $user = 'bypass', $bwup = '256000', $bwdown = '512000', $acct = 'noacct')
{
	$CI =& get_instance();
	$command = $CI->config->item('rootcommand').' ' .$CI->config->item('chilli_query');

	switch($opt)
	{
		//ปล่อยผ่าน
		case 'authorize' :
			$result = exec($command. ' authorize sessionid '.$target.' maxbwup '.$bwup.' maxbwdown '.$bwdown.' username '.$user.' interiminterval 60 '.$acct.' 2>&1');
		break;
		//ตัดการเชื่อมต่อ
		case 'disconnect' :
			$result = exec($command.' logout '.$target.' 2>&1');
		break;
		//บล๊อคแมค
		case 'block' :
			$result = exec($command.' block '.$target.' 2>&1');
		break;
		//ให้รับ ไอพีใหม่
		case 'release' :
			$result = exec($command. ' dhcp-release '.$target.' 2>&1');
		break;
		default: $result = 'Error';
	}
	
	if($result=="") return TRUE;
	return FALSE;
}