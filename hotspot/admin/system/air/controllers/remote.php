<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Remote
 *
 * Remote Controller
 *
 * @package		remote
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
class Remote extends Fancybox_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('remotemodel');
	}
	function index() {
		redirect('accesspoint');
	}
	
	function address() {
	
		$ip = $this->input->ip_address();
		$ap_name = $this->uri->segment(3);
		
		$this->load->helper('date');
		$date = $this->remotemodel->getAccesspoint('date',array('name'=>$ap_name));
		$last_update = $date->row();
		
		if ( ! $this->input->valid_ip($ip))
			{
				echo 'No detect ip';
			}
			else 
			{
				if((human_to_unix($last_update->date)+310) < time()) 
				{
					print "Last update : ".$last_update->date;
				}
				else
				{
					print "Update";
				}
				
				$this->remotemodel->upDateip($ip,$ap_name);
			}

	}

	function ajax_pop()
	{
		$data = $this->remotemodel->getAccesspoint('popup_page',array('name'=>$this->uri->segment(3)));
		$data = $data->row();
		echo (isset($data->popup_page)) ? $data->popup_page : '';
	}
	
	function test_time()
	{
		$this->load->helper('date');
		$data = $this->remotemodel->getAccesspoint('date',array('name'=>'NanoM2'));
		$unix = time();
		$human = human_to_unix($data->row()->date)+300;
		
		echo unix_to_human($unix).'='.$unix.'<br/>'.unix_to_human($human).'='.$human;
	}
	
}
/* End of file home.php */
/* Location: ./system/nostradius/controllers/home.php */