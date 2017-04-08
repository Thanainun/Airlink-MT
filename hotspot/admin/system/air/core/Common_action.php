<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_action extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->template->set_template('common');
		$this->load->model('siteconfigmodel');
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		$template_url = str_replace('','',base_url());
		$data['footer'] = $reg['copy_right'];
		$data['title'] = $reg['hotspot_small'];
		$login_header = $reg['hotspot'];
		$data['style'] = $template_url.'templates/common/';
		$data['logo'] = '<img src='.base_url().'templates/commonact/images/'.$login_header.'>';
		
		$this->template	->write_view('header','themes/common/header',$data);
		$this->template	->write_view('footer','themes/common/footer',$data);
	}
}