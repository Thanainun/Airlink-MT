<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dashboard For User 
 *
 * Dashboard Controller
 *
 * @package		Dashboard
 * @author		Sarto
 * @version		1.0
 * @based on	Airlink WiFi
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Mobileview extends Mobile_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model(array('billingplanmodel','usermodel','topupmodel','statisticmodel','onlineusermodel'));
		$this->load->library('session');
		$this->load->library('globals');
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		
	}
	
	function index()
	{
		
		if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$this->load->helper('date');
		$this->load->helper('number');
		$data['user_r']=$this->usermodel->getAccountUsage(null,array('username'=>$this->session->userdata('user')));
		$data['user_h']=$this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')))->row();
		$data['exp']=$this->usermodel->expUser($this->session->userdata('user'));
        $data['profile']=$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')));	
		$data['datauser'] = $this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')));
		$data['annouced'] = $conf_data['mobile_editor'];
		$data['plan'] = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('no >'=>0));
		$data['true_setting'] = $conf_data['tmtopup_id'];	
		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/usertopups_view', $data)
						->render();
						
		}
		
	}
	function package()
	{	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
	if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
		$data['user_h']=$this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')))->row();
		$data['profile']=$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')));
		$data['plan'] = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('no >'=>0));
		$this->template	->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/package_view', $data)
						->render();
		}
		}
		
	function userdetail()
	{	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
			if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
			
		$data['exp']=$this->usermodel->expUser($this->session->userdata('user'));
		$data['user_m']=$this->usermodel->getAccountUsage('',array('username'=>$this->session->userdata('user')))->row();
		$data['user_r']=$this->usermodel->getAccountUsage(null,array('username'=>$this->session->userdata('user')));
		$data['user_h']=$this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')))->row();
		$data['profile']=$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')));	
		$data['datauser'] = $this->usermodel->getVoucher(null,array('username'=>$this->session->userdata('user')));
		$this->template	->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/userdetail_view', $data)
						->render();
		}
		
		}
	
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("mobileview","refresh");
		}
		
	function cardrefill()
	{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
		$this->template	->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/cardrefill_view')
						->render();
		}
	}
	function truerefill()
	{	
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if(!$this->session->userdata('user')){
			$this->loginuser();
			
		}else{
		$this->template	->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/truerefill_view')
						->render();
		}
	}
	function topupcard()
	
	{
		
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if($this->session->userdata('user')&&$this->input->post('user_card', TRUE)){
		$data=$this->topupmodel->topupcard($this->input->post('user_card', TRUE),$this->input->post('pass_card', TRUE),$this->session->userdata('user'));
		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/usertopup_view', $data)
						->render();
		
	}
	}
	function topuptrue()
	{
		redirect('mobileview','location');
	}
	function topupplan()
	{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		if( $this->uri->segment(3) and  $this->session->userdata('user'))
		{		
		$plan = $this->billingplanmodel->getBillingPlan(NULL,NULL,array('groupname'=>$this->uri->segment(3)))->row();
        $user =$this->usermodel->getdataVoucher(null, array('username'=>$this->session->userdata('user')))->row();
		
		if($plan->price <= $user->money)
		{		//เติมเงิน 
				$this->billingplanmodel->changeGroup($this->session->userdata('user'),$this->uri->segment(3));
				//ตัดยอดเงินออกตามราคาเพ็คเก็ต
				$user_money = array('money'=>($user->money-$plan->price));
				$this->db->where('username',$this->session->userdata('user'))
						 ->delete('radacct');
				$this->db->where('username',$this->session->userdata('user'))
						 ->update('voucher',$user_money);
				//บันทึกการชื้อเพ็คเก็ต 
				$datetime=date("Y-m-d H:i:s");
				$topup = array(
								'username'=>$this->session->userdata('user'),
								'cashcard'=>'true',
								'billingplan'=>$plan->name,
								'date'=> $datetime,
								'price' =>$plan->price,
								'detail'=>'user'
								);
				$this->db->insert('topup_queue',$topup);
					//Message to admin
					$datetime=date("Y-m-d H:i:s");
					$data = array(
							'username'=>$this->session->userdata('user'),
							'subject'=>$this->lang->line('user_message_subject'),
							'message'=>sprintf($this->lang->line('user_message_detail'),
											$this->session->userdata('user'),
											$plan->name,
											$plan->price,
											$datetime),
							'date'=>date('Y-m-d H:i:s')
							);
					$this->db->insert('message',$data);
				redirect('mobileview','location');
		}else
		{ $this->template	
						->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/userplan_view')
						->render();
		}

		}
	}
 function loginuser()
	{		
			$config = $this->siteconfigmodel->getConfig('global_config');
			$conf_data = $this->session->_unserialize($config->value);
			$data['annouced'] = $conf_data['mobile_editor'];
			$data['user'] = $this->input->post('user', TRUE);
			$data['pass'] = $this->input->post('pass', TRUE);
			$data['error'] = 'ชื่อผู้ไช้รหัสผ่านไม่ถูกต้อง';
		if($this->input->post('login', TRUE)){
		if ($this->topupmodel->UserAndPassExist($data['user'],$data['pass'])) 
		{
					$this->session->set_userdata(array(	'user'	=> $data['user']));
					redirect('mobileview','location');	
		}}
		
		$this->template	->write_view('content', 'mobileview/'.$conf_data['thememobileview'].'/userlogin_view', $data)
							->render();
	}
 function logoutuser()
	{
		$this->session->set_userdata(array( 'user' => ''));
		$this->session->sess_destroy();
		redirect('mobileview','location');	
	}
function progress_bar()
	{
		$uid = $this->usermodel->getdataVoucher('id');
		$progress['num'] = count($uid->result());
		$progress['rep'] = TRUE;
		print json_encode($progress);
	}
}
/* End of file database.php */
/* Location: ./system/nostradius/controllers/admin/database.php */