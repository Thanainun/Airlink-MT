<?php

function convto_ascii($str)
{

	$test['string'] = $str;
	
	$str = json_encode($test);

	return strtoupper (str_replace('\u', '', $str));

}

function convto_utf8($cou, $str)
{
	$str = strtolower ($str);

	if((strlen($str) % 4)==0 && (substr($str, 0, 1)=="00" || substr($str, 0, 1)=="0E"))
	{
		$c = strlen($str)/4;

		$t = 0;
		for($i=0;$i<$c;$i++)
		{
			$str = substr_replace($str, '\u', $t, 0);
			$t+=6;
		}
		
		return json_decode('{"sms":'.($cou--).',"msg":"'.$str.'"}', true);
		
	}
	else
	{
		$output['sms'] = ($cou--);
		$output['msg'] = $str;
	}
	
	return $output;

}
