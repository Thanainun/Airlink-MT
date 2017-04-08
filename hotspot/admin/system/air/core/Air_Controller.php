<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Air_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
			
		$this->load->model('siteconfigmodel');
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$this->template->set_template('air');
		
		
    }
}