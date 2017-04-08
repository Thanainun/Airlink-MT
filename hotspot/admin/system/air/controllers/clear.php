<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clear User
 *
 * Clear user Controller
 *
 * @package		Clear
 * @author		Sarto nice
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
class Clear extends Common_action
{

	function __construct()
	{
		parent::__construct();
		
		//load the models and library
		$this->load->model('usermodel');
		$this->load->model('topupmodel');
		$this->load->model('billingplanmodel');
		$this->load->model('gologinmodel');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('hotspot_validation');
		$this->load->model('siteconfigmodel');
		$this->load->helper('randomuser');
		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();
	}
	
	function index()
	{	$data['error2'] = "";
		$data['error'] = "";
		$data['complete'] = FALSE;
		$data['user'] = '';
		$data['pass'] = '';
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		if($this->input->post('user', True) == '')
		{
			$data['logo'] = '<img src='.base_url().'templates/common/images/logo.png>';
			$data['img'] = ''.base_url().'templates/common/images';
			$this->template->write_view('content', 'user/clear_view', $data)
					   	   ->render();
		}
		else
		{
			$data['user'] = $this->input->post('user', TRUE);
			$data['pass'] = $this->input->post('pass', TRUE);

		if($this->topupmodel->UserAndPassExist($data['user'],$data['pass']))
		{   
				
				$this->gologinmodel->checkOnlinedie( $data['user']);
						$data['complete'] = TRUE;
				$this->template->write_view('content', 'user/clear_complete', $data)
					   	   ->render();

				
		}
		else
		
		{ $data['error']= $this->lang->line('clear_user_error');}
		$this->template	->write_view('content', 'user/clear_view_error', $data)
							->render();	

	}

	}

	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("clear","refresh");
		}

}
/* End of file clear.php */
/* Location: ./system/nostradius/controllers/clear.php */