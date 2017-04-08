<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@enginx.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 * Description:
 * 		this script process some important server information and displays it
 *
 * Authors:	Liran Tal <liran@enginx.com>
 *		Carlos Cesario <carloscesario@gmail.com>
 *
 *********************************************************************************************************
 */
			

// Display uptime system
// @return string Return uptime system
function uptime() {
$uptime = shell_exec("cut -d. -f1 /proc/uptime");
$days = floor($uptime/60/60/24);
$hours = $uptime/60/60%24;
$mins = $uptime/60%60;
$secs = $uptime%60;
$result = "$days Day(s). $hours H. $mins M.";


	return $result;
}

// Display hostname system
// @return string System hostname or none
function get_hostname() {
	$file_name = "/proc/sys/kernel/hostname";

	if ($fopen_file = fopen($file_name, 'r')) {
		$result = trim(fgets($fopen_file, 4096));
		fclose($fopen_file);
	} else {
		$result = "(none)";
	}
	
	return $result;
}


// Display currenty date/time
// @return string Current system date/time or none
function get_datetime() {
	if ($today = date("F j, Y")) {
		$result = $today;
	} else {
		$result = "(none)";
	}
	
	return $result;
}



// Get System Load Average
// @return array System Load Average
function get_system_load() {
	$file_name = "/proc/loadavg";
	$result = "";
	$output = "";
	
	// get the /proc/loadavg information
	if ($fopen_file = fopen($file_name, 'r')) {
		$result = trim(fgets($fopen_file, 256));
		fclose($fopen_file);
	} else {
		$result = "(none)";
	}
	
	$loadavg = explode(" ", $result);
	$output .= $loadavg[0] . " " . $loadavg[1] . " " . $loadavg[2] . "<br/>";
	

	// get information the 'top' program
	$file_name = "top -b -n1 | grep \"Tasks:\" -A1";
	$result = "";
	
	if ($popen_file = popen($file_name, 'r')) {
		$result = trim(fread($popen_file, 2048));
		pclose($popen_file);
	} else {
		$result = "(none)";
	}
	
	$result = str_replace("\n", "<br/>", $result);
	$output .= $result;
	
	return $output;
}
		
		
// Get Memory System MemTotal|MemFree
// @return array Memory System MemTotal|MemFree
function get_memory() {
	$file_name = "/proc/meminfo";
	$mem_array = array();

	$buffer = file($file_name);

	while (list($key, $value) = each($buffer)) {
		if (strpos($value, ':') !== false) {
			$match_line = explode(':', $value);
			$match_value = explode(' ', trim($match_line[1]));
			if (is_numeric($match_value[0])) {
				$mem_array[trim($match_line[0])] = trim($match_value[0]);
			}
		}
	}
	
	return $mem_array;
}


//Get FreeDiskSpace
function get_hdd_freespace() {
$df = disk_free_space("/");
return $df;
}


// Convert value to MB
// @param decimal $value
// @return int Memory MB
function convert_ToMB($value) {
	return round($value / 1024) . " MB\n";
}



// Get all network names devices (eth[0-9])
// @return array Get list network name interfaces
function get_interface_list() {
	$devices = array();
	$file_name = "/proc/net/dev";

	if ($fopen_file = fopen($file_name, 'r')) {
		while ($buffer = fgets($fopen_file, 4096)) {
			if (preg_match("/eth[0-9][0-9]*/i", trim($buffer), $match)) {
				$devices[] = $match[0];
			}
		}
		$devices = array_unique($devices);
		sort($devices);
		fclose ($fopen_file);
	}
	return $devices;
}



// Get ip address
// @param string $ifname
// @return string Ip address or (none)
function get_ip_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifip = "";

	exec($command_name , $command_result);

	$ifip = implode($command_result, "\n");
	if (preg_match("/inet addr:[0-9\.]*/i", $ifip, $match)) {
		$match = explode(":", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}

// Get mac address
// @param string $ifname
// @return string Mac address or (none)
function get_mac_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifip = "";

	exec($command_name , $command_result);

	$ifmac = implode($command_result, "\n");
	if (preg_match("/hwaddr [0-9A-F:]*/i", $ifmac, $match)) {
		$match = explode(" ", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}


// Get netmask address
// @param string $ifname
// @return string Netmask address or (none)
function get_mask_addr($ifname) {
	$command_name = "/sbin/ifconfig $ifname";
	$ifmask = "";

	exec($command_name , $command_result);

	$ifmask = implode($command_result, "\n");
	if (preg_match("/mask:[0-9\.]*/i", $ifmask, $match)) {
		$match = explode(":", $match[0]);
		return $match[1];
	} else {
		return "(none)";
	}
}

?>
