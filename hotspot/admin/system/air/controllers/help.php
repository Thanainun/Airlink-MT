<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Help
 *
 * Help Controller
 *
 * @package		help
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
Class Help extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		//$this->freakauth_light->check('admin');
		$this->load->model('remotemodel');

	}

	function index()
	{

			$msg = $this->remotemodel->getAccesspoint('help',array('name'=>$this->uri->segment(2)));
			echo $msg->row()->help;


	}

}
/* End of file help.php */
/* Location: ./system/nostradius/controllers/help.php */