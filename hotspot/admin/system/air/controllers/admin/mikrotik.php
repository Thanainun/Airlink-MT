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

class Mikrotik extends MY_Admin 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('mikrotik');
	
    }

    public function index(){
		$API = new routeros_api();
		$API->debug = false;

	if ($API->connect('192.168.10.2', 'sarto', 'mtrw1989')) {

	$data['trt'] = $API->comm("/system/resource/print");
	}
	
        $this->template->write_view('left-content', 'admin/mikrotik', $data)
						->render();
    }
	
}
/* End of file accesspoint.php */
/* Location: ./system/nostradius/controllers/admin/accesspoint.php */