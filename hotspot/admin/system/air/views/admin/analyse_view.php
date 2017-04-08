<?php
	$interface = 'eth0';
	$graph_type = 'lines';
	$time_type = 'days';
	$tx_color = '#27B0F5';
	$rx_color = '#444';
	 
	$precision = 2;	
	
	$date_format = array(
		'hours' => 'H:00',
		'days'  => 'D, d.m.Y',
		'months'=> 'M Y',
		'top10' => 'd.m.Y',
		'uptime'=> 'd.m.Y, H:i'
	);
	
	$lines = explode("\n", getCmdOutput("vnstat --dumpdb -i $interface"));
	$info = array(); $hour = array(); $day = array(); $month = array(); $top10 = array();
	
	$current_hour = date("G");
	foreach ($lines as $line) {
		$line = explode(";", $line);
		switch ($line[0]) {
			case "d": $day[$line[1]] = $line; break;
			case "m": $month[$line[1]] =  $line; break;
			case "t": $top10[$line[1]] = $line; break;
			case "h": $hour[(24 - $line[1] + $current_hour)%24] = $line; break;
			default: $info[$line[0]] = $line[0];
		} 
	} 
	
		
?>
<div class="span12">   
 <div class="widget_heading">
	<h4>การใช้งานแบนด์วิด</h4></div>
    <div class="widget_container">

<div id="choices">
	<div class="left">

				<label class="hiddenJS" for="r1">
					<input class="hiddenJS" type="radio" name="group1" id="r1" value="hours" <?php if ($time_type == "hours") {echo "checked";} ?> />
					Hours</label>
				<label class="hiddenJS" for="r2">
					<input class="hiddenJS" type="radio" name="group1" id="r2" value="days" <?php if ($time_type == "days") {echo "checked";} ?> />
					Days&nbsp</label>
				<label class="hiddenJS" for="r3">
					<input class="hiddenJS" type="radio" name="group1" id="r3" value="months" <?php if ($time_type == "months") {echo "checked";} ?> />
					Months</label>
				<label class="hiddenJS" for="r4">
					<input class="hiddenJS" type="radio" name="group1" id="r4" value="top10" <?php if ($time_type == "top10") {echo "checked";} ?> />
					Top10</label>
					</div>
			</div>
			<p id="types">
				<label class="hiddenJS" for="g1">
					<input class="hiddenJS" type="radio" name="group2" id="g1" value="lines" <?php if ($graph_type == "lines") {echo "checked";} ?> />
					Lines</label>
				<label class="hiddenJS" for="g2">
					<input class="hiddenJS" type="radio" name="group2" id="g2" value="bars" <?php if ($graph_type == "bars") {echo "checked";} ?> />
					Bars&nbsp;</label>
			</p>
			
            
			
		
			
			
		
		<?php
		
		if (sizeof($hour) != 24 || sizeof($day) != 30 || sizeof($month) != 12 || sizeof($top10) != 10) { ?>
			<p class="warning">เหมือนว่าบางอย่างไม่สมบูรณ์ ให้ทำตามขั้นตอนต่อไปนี้!</p><br />
					<small>เข้าสู่ระบบด้วย root:<br />
					<ul style="margin-left: 30px;">
						<li>ใช้คำสั่ง <strong>apt-get install vnstat</strong></li>   
						<li>ตามด้วย vnstat -u -i tun0</li>
						<li>ข้อมูลเพิ่มเติม vnstat --longhelp</li>
					</ul></small>
		<?php } ?>
			<div id="placeholder"></div>
			<br />
			<div id="tables">
			<?=getGraphTable($hour, 'hours', $date_format['hours'], "MB",$precision);?>
			<?=getGraphTable($day, 'days', $date_format['days'], "GB", $precision);?>
			<?=getGraphTable($month, 'months', $date_format['months'], "GB", $precision);?>
			<?=getGraphTable($top10, 'top10', $date_format['top10'], "GB", $precision, 1);?>
		
		
		
	

<?php
	
	function getFlotArray($array2D, $index, $offset = 0) {
		$out = "[";
	    for ($i = 0; $i < sizeof($array2D); ++$i) {
			$out .= "[".($i+$offset).",".$array2D[$i][$index]."],";
		}
		return substr($out, 0, -1)."]";
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

	// executes a command and returns the output
	function getCmdOutput($command) {
		$fd = popen($command, "r");
		$buffer = '';
		while (!feof($fd)) $buffer .= fgets($fd);
		pclose($fd);
		return $buffer;
	}
	

?>
<!--[if IE]><script language="javascript" type="text/javascript" src="../../assets/js/excanvas.min.js"></script><![endif]-->
		
		
		<script language="javascript" type="text/javascript" src="../../assets/js/jquery.flot.min.js"></script>
		<script language="javascript" type="text/javascript" src="../../assets/js/radio.js"></script>
		<script language="javascript" type="text/javascript" src="../../assets/js/main.js"></script>
		<script language="javascript" type="text/javascript">
			datasets = {
				"hourstx": {label: "KB TX", color: "<?=$tx_color?>", shadowSize: 5,	data: <?=getFlotArray($hour, 4);?>},
				"hoursrx": {label: "KB RX", color: "<?=$rx_color?>", shadowSize: 5, data: <?=getFlotArray($hour, 3);?>},
				"daystx": {label: "MB TX", color: "<?=$tx_color?>", shadowSize: 5, data: <?=getFlotArray($day, 4);?>},
				"daysrx": {label: "MB RX", color: "<?=$rx_color?>", shadowSize: 5, data: <?=getFlotArray($day, 3);?>},
				"monthstx": {label: "MB TX", color: "<?=$tx_color?>", shadowSize: 5, data: <?=getFlotArray($month, 4);?>},
				"monthsrx": {label: "MB RX", color: "<?=$rx_color?>", shadowSize: 5, data: <?=getFlotArray($month, 3);?>},
				"top10tx": {label: "MB TX", color: "<?=$tx_color?>", shadowSize: 5, data: <?=getFlotArray($top10, 4, 1);?>},
				"top10rx": {label: "MB RX", color: "<?=$rx_color?>", shadowSize: 5, data: <?=getFlotArray($top10, 3, 1);?>}
			};
			graph_type = "<?=$graph_type?>";
			key = "<?=$time_type?>";
		</script>
        </div>
        </div>