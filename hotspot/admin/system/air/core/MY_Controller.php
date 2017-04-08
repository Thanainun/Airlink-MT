<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		
		// สำหรับ ดีบัก
		if($this->session->userdata('debug')=='on')
		{
			$this->output->enable_profiler(TRUE);
		}
		
		(!$this->tank_auth->is_logged_in()) ? redirect('admin/login/') : '';
		
    }

}

include_once("Admin_Controller.php");
include_once("Public_Controller.php");
include_once("Admin_Fancybox.php");
include_once("Admin_Pages.php");
include_once("Fancybox.php");
include_once("User_Controller.php");
include_once("Mobile_Controller.php");
include_once("Mobile_sign.php");
include_once("Common_action.php");
include_once("Register.php");
include_once("Air_Controller.php");
include_once("Hotspotlogin.php");

