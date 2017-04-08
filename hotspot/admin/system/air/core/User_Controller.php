<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('siteconfigmodel');
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		$template_url = str_replace('','',base_url());
		$themes = ($reg['usertheme']); 
		$data['footer'] = $reg['copy_right'];
		$data['title'] = $reg['title_register'];
		$data['cssfiles'] = $template_url.'templates/hotspotlogin/'.$themes.'/';
		$data['jsfiles'] = $template_url.'templates/hotspotlogin/'.$themes.'/';
		$login_header = $reg['hotspot'];
		$data['logo'] = '<img src='.base_url().'templates/logo/'.$login_header.'>';
		$this->template->set_template('user');
		$this->template	->write_view('header','dashboard/'.$themes.'/header',$data);
		$this->template	->write_view('footer','dashboard/'.$themes.'/footer',$data);
	}
}