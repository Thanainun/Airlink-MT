<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Proxy
 *
 * Proxy Controller
 *
 * @package		proxy
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Proxy extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('siteconfigmodel');
	}

	function index()
	{
		
		$config_data = $this->siteconfigmodel->getProxyconfig();
		
		$this->template ->write_view('left-content','admin/proxy/proxy_view',$config_data)
						->render();
	}
	
	function saveconfig()
	{

		$rep['rep'] = TRUE;
		$rep['msg'] = '';

		$ck = $this->siteconfigmodel->writeProxyconfig($_POST);
		if($ck)
		{
			$service_ck = $this->siteconfigmodel->serviceRestart('squid');
			if( ! $service_ck) { $rep['rep'] = FALSE; $rep['msg'] = 'Service error'; } else { $rep['msg'] = 'Complete'; }
		}

		//print json_encode($rep);
		redirect('admin/proxy');
	}
	
}

/* End of file proxy.php */
/* Location: ./system/nostradius/controllers/admin/proxy.php */