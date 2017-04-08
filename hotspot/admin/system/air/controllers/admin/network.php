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

class Network extends My_Admin
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('siteconfigmodel');
		$this->_user_id = $this->session->userdata('user_id');
		
	}

	function index()
	{
		
		$this->output->enable_profiler(FALSE);

		$rules = array(
						array(
							'field'=>'ipaddress',
							'label'=>'IP Address',
							'rules'=>'required'
							),
						array(
							'field'=>'incoming_port',
							'label'=>'Incoming Port',
							'rules'=>'required'
							),
						array(
							'field'=>'radius_sc',
							'label'=>'Radius Secret',
							'rules'=>'required'
							),
						array(
							'field'=>'username',
							'label'=>'Username',
							'rules'=>'required'
							)
							
					);
					
		$this->form_validation->set_rules($rules);
		
		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);

		if($this->form_validation->run() == FALSE){
		
		$this->template ->write_view('left-content','admin/network/network_view',$data)
						->render();
		}else{
			 
		if($this->_user_id==1)
				{
					$data_p = array('value'=>$this->session->_serialize($_POST));
					$this->siteconfigmodel->updateConfig('mikrotik_config',$data_p);

					if($_POST['debuging']=='on') { $this->session->set_userdata('debug', 'on'); } else { $this->session->unset_userdata('debug', 'off'); }
				}
				
				redirect('admin/network', 'location');
				
			}
	}
}

/* End of file network.php */
/* Location: ./system/nostradius/controllers/admin/network.php */