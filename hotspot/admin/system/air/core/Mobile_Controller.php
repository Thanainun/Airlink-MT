<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('siteconfigmodel');
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		
		$data['footer'] = $reg['copy_right'];
		$data['title'] = $reg['mobile_title'];
		$data['tel']   = $reg['tel_text'];
		$data['style'] = base_url().'templates/mobileview/'.$reg['thememobileview'].'/';
		$data['media'] = base_url().'templates/mobileview/'.$reg['thememobileview'].'/';
		$data['date'] = date( "D, j M Y H:i:s" );
		$login_header = $reg['hotspot'];
		$this->template->set_template('mobile');
		$data['logo'] = '<img src='.base_url().'templates/logos/'.$reg['mobilelogo'].'>';
		$this->template	->write_view('header','mobileview/'.$reg['thememobileview'].'/header',$data);
		$this->template	->write_view('footer','mobileview/'.$reg['thememobileview'].'/footer',$data);
	}
}