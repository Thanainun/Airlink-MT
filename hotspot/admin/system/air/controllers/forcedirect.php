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
 
Class Forcedirect extends Frontend
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('siteconfigmodel');
		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();

	}

	function index()
	{	
	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$template_url = str_replace('','',base_url());
		$login_header = $conf_data['hotspot'];
		$data['redirect'] = $conf_data['force_redirect'];
		$data['redirecttime'] = $conf_data['force_redirect_time'];
		$data['phone'] = $conf_data['tel_text'];
		$data['footer'] = $conf_data['copy_right'];
		$data['title'] = $conf_data['force_redirect_title'];
		
		
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$this->template	->write_view('content','themes/homepage/main',$data)
						->write('template_path',$template_url.'templates/homepage/'.'/')
						->render();
		
		
	}
	
	
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("forcedirect","refresh");
		}

}
/* End of file home.php */
/* Location: ./system/nostradius/controllers/home.php */