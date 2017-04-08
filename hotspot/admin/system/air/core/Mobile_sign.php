<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_sign extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		
		$template_url = str_replace('','',base_url());
		$css['style'] = $template_url.'templates/mobilesignup/';
		$this->template->set_template('mobilesign');
		$this->template	->write_view('header','user/mobile/header',$css);
		$this->template	->write_view('footer','user/mobile/footer',$css);
 }
}