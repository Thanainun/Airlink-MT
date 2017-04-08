<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Onlineuser
 *
 * Onlineuser Controller
 *
 * @package		onlineuser
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Onlineuser extends MY_Admin
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('onlineusermodel','jsonmodel','siteconfigmodel'));
		$this->load->helper(array('freeradius','number'));
	}

	function index()
	{
		
	    $this->template	->add_css('datatable/table_jui.css?'._DATETIME)
						->add_js('datatable/jquery.dataTables.min.js?'._DATETIME)
						->add_js('datatable/onlineuser.js?'._DATETIME)
						->write_view('left-content', 'admin/onlineusers_view')
						->render();
		
	}
	
	function json()
	{
		$this->output->enable_profiler(FALSE);
		print $this->onlineusermodel->data_table();
	}

	function disconnect()
	{
		
		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);
		
		$user = $this->uri->segment(4);

		$gip = $data['ipaddress'];
		$gport = $data['incoming_port'];
 
		$rep['rep'] = TRUE;
		$rep['msg'] = freeradius_disconnectuser($user , $this->config->item('radiuscommand'),$gip.':'.$gport, $this->config->item('radiussecret'));

		print json_encode($rep);
		
	}
		
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ผู้ใช้ออนไลน์</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
		
}
		
/* End of file onlineuser.php */
/* Location: ./system/nostradius/controllers/admin/onlineuser.php */
