
			<div id="placeholder"></div>
			<br />
			<div id="tables">
			<?=getGraphTable($hour, 'hours', $date_format['hours'], "MB",$precision);?>
			<?=getGraphTable($day, 'days', $date_format['days'], "GB", $precision);?>
			<?=getGraphTable($month, 'months', $date_format['months'], "GB", $precision);?>
			<?=getGraphTable($top10, 'top10', $date_format['top10'], "GB", $precision, 1);?>
			</div>
		</div>
		

<?php
	// Turns a php array into a flot-readable array. This new array has only two columns -> index  denotes 2. column
	function getFlotArray($array2D, $index, $offset = 0) {
		$out = "[";
	    for ($i = 0; $i < sizeof($array2D); ++$i) {
			$out .= "[".($i+$offset).",".$array2D[$i][$index]."],";
		}
		return substr($out, 0, -1)."]";
	}

	// generate a TX/RX table for display below the graph
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

	
?>
