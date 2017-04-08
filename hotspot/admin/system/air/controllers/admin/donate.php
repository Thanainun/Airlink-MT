<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Accesspoint
 *
 * Accesspoint Controller
 *
 * @package		accesspoint
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Donate extends Admin_Fancybox
{
	function __construct()
	{
		parent::__construct();
		
		
		
	}

	function index()
	{
		
	
		$this->template	->write_view('content', 'admin/donate/donate_view')
						->render();

	}
	
	
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน จุดเชื่อมต่อ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
}
/* End of file accesspoint.php */
/* Location: ./system/nostradius/controllers/admin/accesspoint.php */