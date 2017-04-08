<?php

$CI =& get_instance();
			$CI->load->model('siteconfigmodel');
			$global = $CI->siteconfigmodel->getConfig('mikrotik_config');
			$val = $CI->session->_unserialize($global->value);
			
$config['mikrotik']['host']         = $val['ipaddress'];
$config['mikrotik']['port']         = '8728';
$config['mikrotik']['username']     = $val['username'];
$config['mikrotik']['password']     = $val['password'];
$config['mikrotik']['debug']        = FALSE;
$config['mikrotik']['attempts']     = 5;
$config['mikrotik']['delay']        = 2;
$config['mikrotik']['timeout']      = 2;

