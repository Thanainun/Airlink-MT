<?php if (!defined('BASEPATH')) exit('No direct script access permitted.');

class Hotspot_validation
{
	
	function __construct()
	{
		
	}
	
	function perid_ck($ck) {
		$rev = strrev($ck);
		$total = 0;
		
		for($i=1;$i<13;$i++)
			{
				 $mul = $i +1;
				 $count = $rev[$i]*$mul;
				 $total = $total + $count;
			}
			
		$mod = $total % 11;
		$sub = 11 - $mod;
		$check_digit = $sub % 10;

		return ($check_digit==$rev[0]) ? TRUE : FALSE;

	}

}

?>