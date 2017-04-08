<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotspotlogin_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		
		header("Last-Modified: " . gmdate( "D, j M Y H:i:s" ) . " GMT"); // Date in the past 
		header("Expires: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT"); // always modified 
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
		header("Cache-Control: post-check=0, pre-check=0", FALSE); 
		header("Pragma: no-cache"); 

		$this->load->model(array('gologinmodel','siteconfigmodel','remotemodel'));
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		$this->load->library('user_agent');
		$this->load->library('encrypt');

		if($this->agent->browser()=='Internet Explorer' && $this->agent->version()<7) $ie6 = TRUE;
		
		if(!$this->agent->is_mobile() && !isset($ie6))
		{
		
			$product_key = $this->config->item('product');
			$submask_key = $this->config->item('submask');

			if(isset($_GET['res']) && isset($_GET['uamip']) && isset($_GET['uamport']))
			{
				if(!$this->gologinmodel->getMacdeny($_GET['mac']))
				{ 
					redirect('gologin/macdeny');
				} else {
					redirect('gologin');
				}
			}

			$this->template->set_template('hotspotlogin');
			
			define('TEMPLATES', $conf_data['themes']); 
			
			$d_regex='/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/';
			
			$ipaddr_ = (preg_match($d_regex, $_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '10.1.0.1';
			
			$js_var  = " jQuery.globalEval(\" ";
			$js_var .= "var base_url = '".base_url()."'; ";
			$js_var .= "var time_label_countdown = '".$this->lang->line('time_label_countdown')."'; ";
			$js_var .= "var time_label_countup = '".$this->lang->line('time_label_countup')."'; ";
			$js_var .= "var checkbox_label = '".$this->lang->line('checkbox_label')."'; ";
			$js_var .= "var checkbox_tooltip = '".$this->lang->line('checkbox_tooltip')."'; ";
			$js_var .= "var compact_dis = '".$conf_data['time_style']."'; ";
			$js_var .= "var time_counter_style = '".$conf_data['time_number']."'; ";
			$js_var .= "var uamservice = '".site_url('/gologin/auth')."'; ";
			$js_var .= "var uamip = '$ipaddr_'; ";
			$js_var .= "var check_url = '".site_url('gologin/check_user')."'; ";
			$js_var .= "var popup_status = '".site_url('/gologin/popup')."'; ";
			$js_var .= "var user_agent = '".( $this->agent->is_mobile() ? 'mobile' : '' )."'; ";
			$js_var .= "var login_check_failed = '".$this->lang->line('login_check_failed')."'; ";
			$js_var .= "var msg_ck_limit = '".$this->lang->line('msg_ck')."'; ";
			$js_var .= "var change_pass_ok = '".$this->lang->line('popup_change_pass')."'; ";
			$js_var .= "var logout_complete = '".$this->lang->line('logout_complete')."'; ";
			
			$js_var .= "var _key_ = '".$this->encrypt->encode($product_key, $submask_key)."'; ";

			$js_var .= "	\"); ";

			$this->template	->add_css('gologin/csslogin.css?v='._DATETIME)
							->add_css('jquery-ui/'.$conf_data['color_themes'].'/jquery-ui.css?v='._DATETIME)
							->add_css('gologin/jquery.countdown.css?v='._DATETIME)
							->add_js('jquery.js?v='._DATETIME)
							->add_js('jquery-ui.js?'._DATETIME)
							->add_js($js_var,'embed')
							->add_js('jquery.cookie.js?v='._DATETIME)
							->add_js('gologin/jquery.countdown.min.js?v='._DATETIME)
							->add_js('gologin/jquery.countdown-th.js?v='._DATETIME)
							->add_js('gologin/ChilliLibrary.js?v='._DATETIME)
							->add_js('gologin/jslogin.js?v2='._DATETIME);
		}
		else
		{
			$this->template->set_template('mobilelogin');
			define('TEMPLATES','../mobilelogin/'.$conf_data['themesmobile'].'/');
		}
    }

}