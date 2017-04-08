<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dictionary
 *
 * Dictionary Controller
 *
 * @package		Dictionary
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Dictionary extends MY_Admin
{
	function __construct()
	{
		parent::__construct();

	}
	
	function index()
	{
		echo "TEST";
	}
	
	function autocom()
	{
	
		$qdata = $_GET['query'];
		$dic = $this->db->select('Attribute')->like('Attribute',$qdata)->get('dictionary')->result_array();
		$data = "[";
		
		foreach($dic AS $d=>$out)
		{
			$data .= "'".$out['Attribute']."',";
		}

		$data .= "]";
		
		print "
		{
		 query:'$qdata',
		 suggestions:$data,
		 data:['LR','LY','LI','LT']
		}";

	}
	
}