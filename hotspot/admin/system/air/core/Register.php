<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('siteconfigmodel');
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		$template_url = str_replace('','',base_url());
		$themes = ($reg['registertheme']); 
		$css['cssfiles'] = $template_url.'templates/hotspotlogin/'.$themes.'/';
		$this->template->set_template('register');
		$this->template	->write_view('header','user/'.$reg['registertheme'].'/header',$css);
						
						}
	
	

}