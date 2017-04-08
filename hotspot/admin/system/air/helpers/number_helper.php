<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Number Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/number_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
 *
 * @access	public
 * @param	mixed	// will be cast as int
 * @return	string
 */
if ( ! function_exists('byte_format'))
{
	function byte_format($num)
	{
		$CI =& get_instance();
		$CI->lang->load('number');
	
		if ($num >= 1000000000000) 
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000) 
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000) 
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000) 
		{
			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}

		return number_format($num, 1).' '.$unit;
	}	

	function time_data($time,$fnc)
	{
		$CI =& get_instance();
		$CI->lang->load('date');
	
		if($fnc=='dhm') { $days = ($time - ($time % 86400)) / 86400 .' '.$CI->lang->line('date_day').'&nbsp;';
		$time = $time - ($days * 86400); } else { $days = ''; }
		
		if($fnc=='hm' || $fnc=='dhm') { $hours = ($time - ($time % 3600)) / 3600 .':';
		$time = $time - ($hours * 3600); } else { $hours = ''; }
		
		if($fnc=='m' || $fnc=='hm' || $fnc=='dhm') { $mins = ($time - ($time % 60)) / 60 .':'; } else { $mins = ''; }
		$secs = $time - ($mins * 60);
		
		($hours<10 && $hours>=0) ? $hours = "0".$hours : "";
		($mins<10  && $mins>=0)  ? $mins  = "0".$mins  : "";
		($secs<10  && $secs>=0)  ? $secs  = "0".$secs  : "";
		
		return $days.''.$hours.''.$mins.''.$secs;
	}	
}

/* End of file number_helper.php */
/* Location: ./system/helpers/number_helper.php */