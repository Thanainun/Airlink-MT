<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Developer extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		
	}
	
	function index()
	{
		$this->template	
						->write_view('left-content', 'admin/developer')
						->render();

	}
	

	
	
}
