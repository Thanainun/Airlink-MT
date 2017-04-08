<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Client
 *
 * Client Controller
 *
 * @package		client
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Client extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('siteconfigmodel');
		$this->load->helper('mikrotik');
		$this->_table_voucher = 'voucher_list'; 
		$this->_table_accesspoint = 'accesspoint';
	}

	function index()
	{
	
		$this->template	->add_css('datatable/table_jui.css?'._DATETIME)
						->add_js('datatable/jquery.dataTables.min.js?'._DATETIME)
						->add_js('datatable/dhcplist.js?'._DATETIME)
						->write_view('left-content', 'admin/client/client_view',$data)
						->render();
	}
	
	function json()
	{
		
		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);
		$API = new routeros_api();

		$API->debug = false;

		if ($API->connect($data['ipaddress'], $data['username'], $data['password'])) {

		$mt = $API->comm("/ip/hotspot/host/print");
		}
		$API->disconnect();
		$output = array("aaData" => array());
		$count = 1;
		
		foreach ($mt as $m)
		{
			$regtable = $m;
			$jdata = array();
			
			
			if ($regtable['DHCP']=='true')
         {
         $DHCP = 'DHCP';
		 $color = "btn btn-small btn-primary"; 
         }
		 else{
         $DHCP = 'STATIC'; 
		 $color = "btn btn-small btn-warning"; 
         }
		 
		 if ($regtable['authorized']=='true')
         {
         $authorized = 'ONLINE';
		 $color2 = "btn btn-small btn-primary"; 
         }
		 else{
         $authorized = 'OFFLINE'; 
		 $color2 = "btn btn-small btn-warning"; 
         }
		 
			$jdata[] .= $count++;
			$jdata[] .= $regtable['address'];
			$jdata[] .= $regtable['mac-address'];
			$jdata[] .= $regtable['server']; 
			$jdata[] .= $regtable['uptime'];
			$jdata[] .= '<div id="status" class="'.$color2.'">'.(isset($authorized) ? $authorized : 'ไม่ทราบข้อมูล');'</div>';
			$jdata[] .= '<div id="status" class="'.$color.'">'.(isset($DHCP) ? $DHCP : 'ไม่ทราบข้อมูล');'</div>';

			$output['aaData'][] = $jdata;

		}

		$this->output->enable_profiler(FALSE);
		

		print json_encode($output);

	}
	
	
	function getfrom()
	{

		//โหลดค่า
		$global = $this->siteconfigmodel->getConfig('chilli_query');
		$val = $this->session->_unserialize($global->value);

		if(!isset($_POST['bw_download'])) $this->load->view('admin/client/setup_from', $val);
		
		if(isset($_POST['bw_download']))
		{
			$conf_data = array('value'=>$this->session->_serialize($_POST));
			$this->siteconfigmodel->updateConfig('chilli_query', $conf_data);
			print "บันทึกการตั้งค่าแล้ว";
		}
	}
	
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>Dhcp list</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}

}
/* End of file client.php */
/* Location: ./system/nostradius/controllers/admin/client.php */