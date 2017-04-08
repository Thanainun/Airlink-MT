<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	function generate_random_user($encryption='')
	{
			$CI =& get_instance();
			$CI->load->helper('string');
			$CI->load->model('siteconfigmodel');
			$global = $CI->siteconfigmodel->getConfig('global_config');
			$val = $CI->session->_unserialize($global->value);
			$user['username'] = ($val['g_userstart'] . random_string($val['g_userpass'], 6));
			//$user['no_encryp'] = random_string('alnum', 6);
			$user['no_encryp'] = random_string($val['g_pass'], 6);
			$user['password'] = encryption($user['no_encryp'],$encryption);

			return $user;
	}
	
	function encryption($data,$type)
	{
		switch($type) {
			case 'md5' :  $pass_decode = substr(md5($data),0,15);
						break;
			case 'crypt' : $pass_decode = crypt($data,"BL");
						break;
			case 'md5ums' : $pass_decode = substr(md5("O]O" . $data . "O[O"),0,15);
						break;
			default : $pass_decode = $data;
		}
		return $pass_decode;
	}

?>