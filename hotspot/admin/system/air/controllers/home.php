<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Home
 *
 * Home Controller
 *
 * @package		home
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
Class Home extends Frontend
{
	function __construct()
	{
		parent::__construct();

		

	}

	function index()
	{
		//$this->template->render();
		redirect('admin/login');
	}
	
	function page()
	{
		$this->template->render();
	}

}
/* End of file home.php */
/* Location: ./system/nostradius/controllers/home.php */