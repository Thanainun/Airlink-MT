<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class BandwidthModel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
	}
	
	function getCmdOutput($command) {
		$fd = popen($command, "r");
		$buffer = shell_exec("vnstat --dumpdb -i tun0");
		while (!feof($fd)) $buffer .= fgets($fd);
		pclose($fd);
		$data['vnstat'] = $buffer;
		return $data;
	}
	
	function getGraphTable($array2d, $name, $dateformat, $unit, $precision, $offset = 0) {
		$class = '';
		$out = '
		<div id="'.$name.'_table">
			<table class="graph">
				<thead><tr><th>Time</th><th>TX</th><th>RX</th><th>Ratio</th><th>Total</th></tr></thead><tbody>';
					for ($i = 0; $i < sizeof($array2d); ++$i) {
						if (($i % 2) == 1) {$class = "odd";} else {$class="even";}
						$out .= '
						<tr id="'.$name.'_'.($i + $offset).'" class="'.$class.'">';
							if ($array2d[$i][2] != 0) {
								$out .= '<td class="time">'.date($dateformat, $array2d[$i][2]).'</td>';
							} else {
								$out .= '<td class="time">-</td>';
							}
						$out .=	'<td>'.sprintf('%.'.$precision.'f', $array2d[$i][4] / 1024).' '.$unit.'</td>
							<td>'.sprintf('%.'.$precision.'f', $array2d[$i][3] / 1024).' '.$unit.'</td>
							<td>'.sprintf('%.'.$precision.'f', $array2d[$i][4] / ($array2d[$i][3] + 0.001)).'</td>
							<td>'.sprintf('%.'.$precision.'f', ($array2d[$i][3] + $array2d[$i][4]) / 1024).' '.$unit.'</td>
						</tr>';
					}
		$out .= '</tbody>
			</table>
		</div>';
		return $out;
	}
	
	function getFlotArray($array2D, $index, $offset = 0) {
		$out = "[";
	    for ($i = 0; $i < sizeof($array2D); ++$i) {
			$out .= "[".($i+$offset).",".$array2D[$i][$index]."],";
		}
		return substr($out, 0, -1)."]";
	}
	
	function getAvailableInterfaces() {
		$interfaces = explode(": ", $this->getCmdOutput("vnstat --iflist"));
		$interfaces = explode(" ", trim(str_replace('lo', '', $interfaces[1])));
		natsort($interfaces);
		return $interfaces;
	}

	function getFromArgOrCookie($name, $current_value, $acceptable_values) {
		if ($_GET[$name] && in_array($_GET[$name], $acceptable_values)) $value = $_GET[$name];
		else if ($_COOKIE[$name] && in_array($_COOKIE[$name], $acceptable_values)) $value = $_COOKIE[$name];
		else $value = $current_value?$current_value:$acceptable_values[0];
		setcookie($name, $value);
		return $value;
	}
}

?>
