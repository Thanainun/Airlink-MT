<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Readfile extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		

	}

	function index()
	{
		$data = get_dir_file_info('assets/css/jquery-ui/', $top_level_only = TRUE);
		foreach($data AS $d=>$b)
		{
			echo $d.'<br/>';
		}
	}
	
}