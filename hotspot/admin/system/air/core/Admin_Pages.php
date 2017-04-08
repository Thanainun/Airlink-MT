<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Pages extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

		$this->template->set_template('admin_pages');
		
		
		
    }

}