<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Fancybox extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

		(!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "on") ? redirect('https://'.$_SERVER['HTTP_HOST'].'/admin/login') : '';

		$this->template->set_template('fancybox');
		
		(!$this->tank_auth->is_logged_in()) ? redirect('admin/login/') : '';

		$controller = " var controller = 'admin/".$this->uri->segment(2)."'; ";
		$controller .= " var msg_show = false; ";
		
		
		/**********************************************************/
	
		$this->load->model(array('billingplanmodel','siteconfigmodel'));
		
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

		$this->template->add_js($controller, 'embed');

		$this->template	->add_css('reset.css?'._DATETIME)
						->add_css('style_light.css?'._DATETIME)
						->add_css('forms.css?'._DATETIME)
						->add_css('jquery-ui/'.$conf_data['color_themes'].'/jquery-ui.css?'._DATETIME)
						->add_js('jquery.js?'._DATETIME)
						->add_js($script_header, 'embed')
						->add_js('jquery-ui.js?'._DATETIME)
						->add_js('common.js?'._DATETIME);
		
    }

}