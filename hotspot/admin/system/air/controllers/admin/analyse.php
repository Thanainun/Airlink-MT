<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dashboard
 *
 * Dashboard Controller
 *
 * @package		dashboard
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Analyse extends MY_Admin
{
	function __construct() 
	{
		parent::__construct();
		
		$this->load->model('bandwidthmodel');
		
		}

    /**
     * Displays home page of Admin Console
     *
     */
    function index()
	{	
		$this->template
		 				
						->add_css('analyse.css')
						->write_view('left-content', 'admin/analyse_view')
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
/* End of file dashboard.php */
/* Location: ./system/nostradius/controllers/admin/dashboard.php */