<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Gologin
 *
 * Glologin Controller
 *
 * @package		gologin
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
Class Mobile extends Hotspotlogin_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('gologinmodel'));
		$this->load->helper('jslogin');
		$this->load->helper('security');
		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();
		
		$this->username = $this->input->post('UserName', TRUE);
		$this->password = $this->input->post('Password', TRUE);
		$this->uamport = $this->input->post('uamport', TRUE);
		$this->uamip = $this->input->post('uamip', TRUE);
		$this->userurl = $this->input->post('userurl', TRUE);
		$this->challenge = $this->input->post('challenge', TRUE);

	}
	
	function index()
	{
	
		if($this->input->post('button', TRUE)!="")
		{
			$uamsecret = $this->config->item('uamsecret');
			$userpassword = 1;
			$user = $this->gologinmodel->getEncryption($this->username);

			$hexchal = @pack ("H32", $this->challenge);
			if ($uamsecret) {
				$newchal = pack ("H*", md5($hexchal . $uamsecret));
			} else {
				$newchal = $hexchal;
			}

			$encryption = (isset($user->encryption) ? $user->encryption : '' );

			switch($encryption) {
				case 'md5' :  $pass_decode = substr(md5($this->password),0,15);
							  break;
				case 'crypt' : $pass_decode = crypt($this->password,"BL");
							  break;
				case 'md5ums' : $pass_decode = substr(md5("O]O" . $this->password . "O[O"),0,15);
							  break;
				default : $pass_decode = $this->password;
			}
			
			$response = md5("\0" . $pass_decode . $newchal);
			$newpwd = pack("a32", $pass_decode);
			$pappassword = implode ("", unpack("H32", ($newpwd ^ $newchal)));
			if (isset($uamsecret) && isset($userpassword)) {
				$url_refresh = "http://".$this->uamip.":".$this->uamport."/logon?username=".$this->username."&password=$pappassword&userurl=".$this->userurl."";
			} else
			 {
				$url_refresh = "http://".$this->uamip.":".$this->uamport."/logon?username=".$this->username."&response=$response&userurl=".$this->userurl."";
			}
			$data['meta_refresh'] = $url_refresh;
			$this->template->write('meta_refresh', meta('refresh', '0;url='.$url_refresh, 'equiv'))
							->write_view('body', 'public/mobile/attemp_view', $data)
							->render();
		}
	}
}