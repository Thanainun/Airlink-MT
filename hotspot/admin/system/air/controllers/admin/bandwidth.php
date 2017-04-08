<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bandwidth
 *
 * bandwidth Controller
 *
 * @package		Bandwidth
 * @author		Sarto nice
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Bandwidth extends MY_Admin
{
	function __construct() 
	{
		parent::__construct();
		
		$this->load->model('bandwidthmodel');
		
		}

    function index()
	{	
		
		$data['lines'] = $this->bandwidthmodel->getCmdOutput('vnstat');
		
		$this->template->add_css('analyse.css')
						->write_view('left-content', 'admin/bandwidth/bandwidth_view',$data)
						->render();
	}
		
	
		
		
		
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ส่วนแสดงการทำงานระบบ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
	
	
}
/* End of file bandwidth.php */
/* Location: ./system/nostradius/controllers/admin/bandwidth.php */