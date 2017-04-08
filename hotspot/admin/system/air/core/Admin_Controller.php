<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Admin extends Main_controller
{

    function __construct()
    {
        parent::__construct();

		$this->active_menu = $this->uri->segment(2);
		$this->load->model(array('messagemodel','siteconfigmodel'));
		
		(!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "on") ? redirect('https://'.$_SERVER['HTTP_HOST'].'index.php/admin/login') : '';
		
		$this	->_add_assets()
				->_add_head()
				->_add_header();
    } 

	function _add_header()
	{
	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		$img_mail = array('src'=>other_asset_url('mail_alert.gif','','images'),'height'=>'11px');
		
		$add_header = array('site-name'	=>	$conf_data['admin_header'],
							'admin'		=>	$this->lang->line('util-nav_wellcom').' '.$this->session->userdata('username'),
							'message'	=>  anchor('admin/message','('.$this->messagemodel->check_new().') ข้อความใหม่','class="medium twitter button radius" style="text-decoration:none;" title="กล่องข้อความ"'),
							'profile'	=>	anchor('admin/changepass',$this->lang->line('util-nav_admin'),'id="iframe_fancybox" class="medium twitter button radius" style="text-decoration:none;" title="เปลี่ยนรหัสผ่าน"'),
							'logout'	=>	'<a href="logout" class="medium twitter button radius" style="text-decoration:none;"><i style="font-size:16px; padding-top:3px; padding-right:5px;" class="icon-off"></i> ออกจากระบบ</a> ',
							'login-page'	=>	'<a target="_self" href="Knowledgebase" class="medium btn-danger button radius" style="text-decoration:none;"><i style="font-size:16px; padding-top:3px; padding-right:5px;" class="icon-book"></i> เรียนรู้เพิ่มเติม</a> ',
							'action'	=>	$this->lang->line('action_head_'.$this->active_menu),
							'main-nav'	=>	$this->globals->build_menu($this->active_menu), 
						);
		
		$this->template->parse_view('header', 'themes/nostx/header', $add_header);
		$this->template->write('site-name', $conf_data['admin_header']);
		
		return $this; 
		
	}
	
	function _add_assets()
	{
	
		$this->load->model('billingplanmodel');
		
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		$query = $this->billingplanmodel->getBillingPlan();	

		$script_header  = " jQuery.globalEval(\"   var base_url = '".base_url()."'; ";
		$script_header .= "	var ASSETS ='".ASSETS."'; "; 
		$script_header .= " var oTable; ";
		$script_header .= "	var numberofvoucher; ";
		$script_header .= "	var sDom_tool = '<\\\"columns\\\"<\\\"grid_6 first\\\"<\\\"tool\\\"<\\\"control_button\\\"r><\\\"search_user\\\"fl><\\\"generate_user\\\">>>><\\\"columns\\\"<\\\"grid_6 first\\\"<\\\"show_gen\\\">t>><\\\"columns leading\\\"<\\\"grid_6 first\\\"<\\\"panel\\\"pi>>>'; ";
		
		$lang_s = array('Search','LengthMenu','ZeroRecords',
						'Info','InfoEmpty','InfoFiltered',
						'First','Previous','Next','Last',
						'Processing','Placeholder');
		
		for($i=0;$i<count($lang_s);$i++) :
			$script_header .= " var lang_s".$lang_s[$i]." = '".  $this->lang->line('java_var_s'.$lang_s[$i])."'; ";
		endfor;
		
		$script_header .= "	\"); ";

		$script_header .= " function fnCreateSelect(ids) { ";
		$script_header .= " var r='<d>&nbsp;</d><select name=\"groups\" style=\"width:150px;\" id=\"'+ids+'\"> ";
		$script_header .= " <option value=\"\">------</option>'; ";

		foreach ( $query->result() as $row ) {
			$script_header .= " r += '<option value=\"".$row->name."\">".$row->name."</option>'; ";
		}

		$script_header .= " return r+'</select>'; } ";
		
		$script_header .= " function numbergen() { ";
		$script_header .= " return ' ".form_input(array('name'=>'numberofvoucher','type'=>'number'),'','maxlength="4" title="จำนวนที่ต้องการสร้าง"')." '; ";
		$script_header .= " } ";
		
		if($this->session->userdata('debug')=='on')
		{
			$script_header .= " jQuery(document).ready(function($) {  $('<div id=\"flashMessage\" style=\"display:none;\" class=\"message info\" align=\"center\"><em> \"Debuging mode\"</em></div>').appendTo('body'); $('#flashMessage').slideDown(500); }); ";
		}
		
		$script_header .= " function select_fonts() {";
		$script_header .= " var r='<select style=\"width:94px; font-size:10px;\" id=\"fonts_select\">'; ";
		$script_header .= "  r += '<option value=\"AngsanaNew\">AngsanaNew</option>'; ";
		$script_header .= "  r += '<option value=\"CordiaNew\">CordiaNew</option>'; ";
		$script_header .= "  r += '<option value=\"Tahoma\">Tahoma</option>'; ";
		$script_header .= "  r += '<option value=\"BrowalliaNew\">BrowalliaNew</option>'; ";
		$script_header .= "  r += '<option value=\"KoHmu\">KoHmu</option>'; ";
		$script_header .= "  r += '<option value=\"KoHmu2\">KoHmu2</option>'; ";
		$script_header .= "  r += '<option value=\"KoHmu3\">KoHmu3</option>'; ";
		$script_header .= "  r += '<option value=\"MicrosoftSansSerif\">MicrosoftSansSerif</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_Cara\">PLE_Cara</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_Care\">PLE_Care</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_Joy\">PLE_Joy</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_Tom\">PLE_Tom</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_TomOutline\">PLE_TomOutline</option>'; ";
		$script_header .= "  r += '<option value=\"PLE_TomWide\">PLE_TomWide</option>'; ";
		$script_header .= "  r += '<option value=\"DilleniaUPC\">DilleniaUPC</option>'; ";
		$script_header .= "  r += '<option value=\"EucrosiaUPC\">EucrosiaUPC</option>'; ";
		$script_header .= "  r += '<option value=\"FreesiaUPC\">FreesiaUPC</option>'; ";
		$script_header .= "  r += '<option value=\"IrisUPC\">IrisUPC</option>'; ";
		$script_header .= "  r += '<option value=\"JasmineUPC\">JasmineUPC</option>'; ";
		$script_header .= "  r += '<option value=\"KodchiangUPC\">KodchiangUPC</option>'; ";
		$script_header .= "  r += '<option value=\"LilyUPC\">LilyUPC</option>'; ";

		$script_header .= " return r+'</select>'; } ";

		/**********************************************************/

		$this->template	->add_css('air/css/font-awesome.css?_='._DATETIME)
						->add_css('air/css/dashboard.css?_='._DATETIME)
						->add_css('air/css/bootstrap.css?_='._DATETIME)
						->add_css('air/css/bootstrap-responsive.css?_='._DATETIME)
						->add_css('jquery-ui/air/jquery-ui.css?_='._DATETIME)
						->add_css('jquery.fancybox-1.3.4.css?_='._DATETIME)
						->add_css('style.css?_='._DATETIME)
						->add_css('forms.css?_='._DATETIME);

		$script = " var controller = 'admin/".$this->uri->segment(2)."'; ";
		$script .= " var msg_show = true; ";

		$this->template->add_js($script, 'embed');

		$this->template	->add_js('jquery.js?_='._DATETIME)
						->add_js('jquery-ui.js?_='._DATETIME)
						->add_js('jquery.cookie.js?_='._DATETIME)
						->add_js('jquery.fancybox-1.3.4.pack.js?_='._DATETIME)
						->add_js('jquery.tooltip.pack.js?_='._DATETIME)
						->add_js($script_header, 'embed')
						->add_js('common.js?_='._DATETIME)
						->add_js('jquery.easy-confirm-dialog.js');
						
					
		return $this;

	}
	function _add_head()
	{
	
		$this->load->helper('number');
		$this->load->helper('serverinfo');
		$this->load->helper('server');
		$_mem = get_memory();
		$uptime = uptime();
		$hostname = get_hostname();
		$date = get_datetime();
		$load = get_system_load();
		$iflist = get_interface_list();
		
		$this->load->helper('mikrotik');
		$this->load->model('siteconfigmodel');
		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);
		$API = new routeros_api();

		$API->debug = false;

		$API->connect($data['ipaddress'], $data['username'], $data['password']);

		$API = $API->comm("/system/resource/print");	
		$first = $API['0'];
		
		$data = array(
						'momory_total'=>byte_format($_mem['MemTotal']*1024),
						'hdd_total_space'=>byte_format(disk_total_space("/")),
						'serverinfo'=>$hostname,
						'datetime'=>$date,
						'loadavg'=>$load,
						'serverup'=>$uptime,
						'ifinfo'=>$iflist,
						'mtmomory_total'=>byte_format($first['total-memory']),
						'mthdd_total_space'=>byte_format($first['total-hdd-space']),
					);

		$this->template->write_view('right-content', 'admin/head', $data);
		return $this;
		$API->disconnect();
	}
	
}
