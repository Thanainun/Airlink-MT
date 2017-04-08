<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Advance Proxy
 *
 * Advance Proxy Controller
 *
 * @package		Advance Proxy
 * @author		Sarto nice
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Advproxy extends MY_Admin
{
	function __construct() 
	{
		parent::__construct();
		
		}

    
    function index()
	{	
	
		$data = $this->siteconfigmodel->advProxy();
		$this->template->write_view('left-content', 'admin/advproxy/advproxy_view',$data)
						->render();
	}
	function saveconfig()
	{

		$rep['rep'] = TRUE;
		$rep['msg'] = '';

		$ck = $this->siteconfigmodel->saveadvProxy($_POST);
		if($ck)
		{
			$service_ck = $this->siteconfigmodel->serviceRestart (array('squid','clearmemory'));
			if( ! $service_ck) { $rep['rep'] = FALSE; $rep['msg'] = 'Service error'; } else { $rep['msg'] = 'Complete'; }
		}

		
		redirect('admin/advproxy');
	}	
	
		
		
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ส่วนแสดงการทำงานระบบ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
	
	
}
/* End of file dashboard.php */
/* Location: ./system/nostradius/controllers/admin/dashboard.php */