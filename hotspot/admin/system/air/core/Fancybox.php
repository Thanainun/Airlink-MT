<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fancybox_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

		$this->template->set_template('fancybox');
		
		$this->template	->add_css('reset.css')
						->add_css('style_light.css')
						->add_css('forms.css');
		
    }

}