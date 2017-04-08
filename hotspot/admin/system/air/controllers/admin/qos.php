<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Network
 *
 * Network Controller
 *
 * @package		network
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Qos extends My_Admin
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('siteconfigmodel');
		
	}

	function index()
	{
		$squid = $this->siteconfigmodel->getConfig('qos_config');
		$data = $this->session->_unserialize($squid->value);
		$this->template ->add_js('network/qos.js') 
						->write_view('left-content','admin/qos/qos_view',$data)
						->render();
	}
	
	function saveconfig()
	{
		$rep['rep'] = TRUE;
		$rep['msg'] = $this->lang->line('network_config_start');
		
		$old = $this->siteconfigmodel->getConfig('qos_config');
		$data = $this->session->_unserialize($old->value);
		$qos = array('value'=>$this->session->_serialize($_POST));

			if( ! $this->siteconfigmodel->write_config_qos($_POST,$data))
			{
				$rep['rep'] = FALSE;
				$rep['msg'] = $this->lang->line('network_config_notwrite');
			}
		
		
		if($rep['rep']) $this->siteconfigmodel->updateConfig('qos_config',$qos);

		print json_encode($rep);
	}
	
	function configchange()
	{
		$operate = $this->uri->segment(4);
		$service = $this->uri->segment(5);
		if($operate=='reconfig')
		{
			$data = $this->siteconfigmodel->serviceRestart($service);
		}
		
		if($operate=='stop')
		{
			$data = $this->siteconfigmodel->serviceStop($service);
		}
		
		print json_encode($data);
	}
	
}

/* End of file network.php */
/* Location: ./system/nostradius/controllers/admin/network.php */