<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Userform
 *
 * Userform Controller
 *
 * @package		userform
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Userform extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		
		//load models
		$this->load->model(array('billingplanmodel','usermodel','siteconfigmodel'));
		//load libraries
		$this->load->library(array('form_validation','table'));
		
	}
	
	function action()
	{

		$username = '';
		$password = '';
		$acct_user = $this->uri->segment(5);
		$opt = $this->uri->segment(4);

		if($opt=='edit')
		{
			//get current data
			$where = array('username'=>$acct_user);
			$account = $this->usermodel->getdataVoucher('',$where,'');
			$user = $account->row();
			$username = $user->username;
			$password = $user->password;
			$money = $user->money;
			$profile = $this->session->_unserialize($user->profile);
		}
		
		$radreply = ($opt=='add') ? array() : $this->usermodel->getUser_attr($acct_user, 'radreply');
		$radcheck = ($opt=='add') ? array() : $this->usermodel->getUser_attr($acct_user, 'radcheck');

		
		//get billingplan
		$billingplans = $this->billingplanmodel->getBillingPlan('id,name,groupname','');
		foreach($billingplans->result() as $key => $value)
		{
			$plan[$value->name] = $value->name;
		}
		
		if(count($plan)<1) exit('<center>ท่านยังไม่ได้สร้างกลุ่มผู้ใช้<br/>กรุณาสร้างกลุ่มผู้ใช้ ในเมนูจัดการกลุ่ม </center>');

		$data = array(
				'money'=>(isset($money)) ? $money : '',
				'username'=>$username,
				'password'=>$password,
				'email'=>(isset($profile['email'])) ? $profile['email'] : '',
				'billingplan'=>(isset($profile['billingplan'])) ? $profile['billingplan'] : '',
				'surename'=>(isset($profile['surename'])) ? $profile['surename'] : '',
				'gender'=>(isset($profile['gender'])) ? $profile['gender'] : '',
				'web'=>(isset($profile['web'])) ? $profile['web'] : '',
				'ip'=>(isset($profile['ip'])) ? $profile['ip'] : '',
				'mac'=>(isset($profile['mac'])) ? $profile['mac'] : '',
				'phone'=>(isset($profile['phone'])) ? $profile['phone'] : '',
				'note'=>(isset($profile['note'])) ? $profile['note'] : '',
				'firstname'=>(isset($profile['firstname'])) ? $profile['firstname'] : '',
				'lastname'=>(isset($profile['lastname'])) ? $profile['lastname'] : '',
				'personal_id'=>(isset($profile['personal_id'])) ? $profile['personal_id'] : '',
				'address1'=>(isset($profile['address1'])) ? $profile['address1'] : '',
				'address2'=>(isset($profile['address2'])) ? $profile['address2'] : '',
				'district'=>(isset($profile['district'])) ? $profile['district'] : '',
				'amphur'=>(isset($profile['amphur'])) ? $profile['amphur'] : '',
				'province'=>(isset($profile['province'])) ? $profile['province'] : '',
				'plan'=>$plan,
				'radreply'=>$radreply,
				'radcheck'=>$radcheck,
				'opt'=>array('check'=>($opt=='add' ? 'checked="checked"' : ''),
							'disable'=>($opt=='add' ? 'disabled="disabled"' : '')
							)
			);

		$this->load->view('admin/user/user_form',$data);

	}
	
	function submit()
	{
		$config = array(
					   array(
							 'field'   => 'username',
							 'label'   => 'Username',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'password',
							 'label'   => 'Password',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'billingplan',
							 'label'   => 'Groups',
							 'rules'   => 'required'
						  )
					);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE)
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('globals_message_formerror');
		}
		else
		{
			$rep = ($this->uri->segment(4)=='add') ? $this->usermodel->addVoucher($_POST) : $this->usermodel->editVoucher($_POST);
		}

		print json_encode($rep);

	}
	
	function gform()
	{
		$this->output->enable_profiler(FALSE);
		$val = $this->siteconfigmodel->getConfig('global_config');
		$global_config = $this->session->_unserialize($val->value);
		
		//get billingplan
		$billingplans = $this->billingplanmodel->getBillingPlan('id,name,groupname','');

		$data['plan'] = array();
		foreach($billingplans->result() as $value)
		{
			$data['plan'][$value->groupname] = $value->name;
		}
		
		$data['max'] = $global_config['create_amount'];
		
		
		$this->load->view('admin/user/user_generate', $data);
		
	}
	
	function gen()
	{
	
		$this->output->enable_profiler(FALSE);
		$val = $this->siteconfigmodel->getConfig('global_config');
		$global_config = $this->session->_unserialize($val->value);
		
		$config = array(
					   array(
							 'field'   => 'numberofvoucher',
							 'label'   => 'Number of vocher',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'billingplan',
							 'label'   => 'Billingplan',
							 'rules'   => 'required'
						  ));
						

		$this->form_validation->set_rules($config);
		

		if(isset($_POST['numberofvoucher']) && $_POST['numberofvoucher']>$global_config['create_amount']) 
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = sprintf($this->lang->line('user_message_gen_limit'),$global_config['create_amount']);

		}
		else
		{
			if($this->form_validation->run() == FALSE)
			{

				$rep['rep'] = FALSE;
				$rep['msg'] = $this->lang->line('globals_message_formerror');
					
			} else {

				$data['stack'] = $this->usermodel->generateVoucher();
				$rep['rep'] = TRUE;
				$rep['msg'] = $this->load->view('admin/user/user_gen', $data , TRUE);
				$rep['gname'] = $data['stack'][0]['gname'];

				if(isset($_POST['exp_pdf']))
				{
							
					$this->load->model('card');
					$this->load->library('thaipdf');
					$this->load->library('pdf');
					$this->pdf->add_header();
					$this->card->write_data($data['stack']);
					$this->card->create('tmp/'.$data['stack'][0]['gname'].'.pdf','F');
								
				}

			}
			
		}
		
		print json_encode($rep);
		
	}
	
	function pdffile()
	{
	
		$this->load->helper('download');
		$name = $this->uri->segment(4).'.pdf';
		$dirname = set_realpath('tmp/', TRUE);
		$dir_backup = set_realpath('upload/user_cards/');
		$rep = array();
		
		if($this->uri->segment(5)=='download') {
			$data = file_get_contents("tmp/".$name);
			force_download($name, $data); 
		}
		else if($this->uri->segment(5)=='delete')
		{	
			$this->load->helper('string');
			$randname = random_string('alnum', 6);
			$date= date('Y-m-d-H:i:s');
			if (file_exists($dirname.$name)) { copy($dirname.$name, $dir_backup.$name ); }
				rename($dir_backup.$name, $dir_backup.$date.$randname.'.pdf');
			if (file_exists($dirname.$name)) {unlink ($dirname.$name);}
			$rep = array('rep'=>TRUE,'msg'=>$this->lang->line('user_message_gen_success'));
		}
		else if($this->uri->segment(5)=='exist')
		{
			if (file_exists($dirname.$name)) { $rep = array('rep'=>TRUE,'msg'=>''); }
			else { $rep = array('rep'=>FALSE,'msg'=>$this->lang->line('user_message_gen_noexport')); }
		}
		
		print json_encode($rep);
		
	}
	
}
/* End of file userfrom.php */
/* Location: ./system/nostradius/controllers/admin/userfrom.php */