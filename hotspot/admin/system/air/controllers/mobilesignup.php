<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Signup
 *
 * Signup Controller
 *
 * @package		signup
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
class Mobilesignup extends Mobile_sign
{

	function __construct()
	{
		parent::__construct();
		
		//load the models and library
		$this->load->model('usermodel');
		$this->load->model('signupmodel');
		$this->load->library('form_validation');
		$this->load->library('hotspot_validation');
		$this->load->model('siteconfigmodel');
		$this->load->helper('randomuser');
	
	}
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("signup","refresh");
		}
	function index()
	{ 
		
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		$data['mac']='';
	
	$config = array(
					   array(
							 'field'   => 'firstname',
							 'label'   => 'First name',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'lastname',
							 'label'   => 'Last name',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'personal_id',
							 'label'   => 'Personal ID',
							 'rules'   => 'required'
						  )
					);

		$this->form_validation->set_rules($config);
		$query = $this->siteconfigmodel->getConfig('global_config');
		$reg = $this->session->_unserialize($query->value);
		$data['invalid'] = FALSE;
		$data['complate'] = FALSE;
		$data['user'] = '';
		$data['pass'] = '';
		$data['plan'] = '';
		$data ['address'] = $reg['address_text'];
		$data ['tel'] = $reg['tel_text'];
		$data ['mail'] = $reg['mail_text'];
		$data ['header'] = $reg['title_register'];
		$langselect = $reg['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$data['plan'] = $reg['reg_group'];
		if($reg['reg_on_off']==0) { $data['invalid'] = 1; }
		if($this->form_validation->run() == FALSE)
		{	
			$login_header = $reg['hotspot'];
			$data['header'] = '<img src='.base_url().'templates/hotspotlogin/'.$reg['registertheme'].'/images/'.$login_header.'>';
			$this->template	->write_view('content', 'user/mobile/signup_view', $data)
							->render();
		}
		else
		{
			$data['user'] = $_POST['username'] ;
			$data['pass'] = $_POST['password'] ; 
			$_POST['password'] = $_POST['password'];
			if($this->usermodel->VoucherExist($_POST['username']))//check username for duplication 
			{
				$data['error'] = sprintf($this->lang->line('register_exist'),$_POST['username']);
				$this->template->write_view('content', 'user/mobile/signup_error', $data);
			}
			else if(preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']) != 1 or preg_match("/^[a-zA-Z0-9]+$/",$_POST['password']) != 1)
{
$data['error']= sprintf($this->lang->line('register_invalid_pid')."&nbsp;".$this->lang->line('register_recommand')."&nbsp;".$data['tel']);
$this->template->write_view('content', 'user/mobile/signups_error', $data);
}
			else if(strlen($_POST['personal_id']) != 13) 
{
$data['error']=sprintf($this->lang->line('register_invalid_numpid')."&nbsp;".$this->lang->line('register_recommand')."&nbsp;".$data['tel']);
$this->template->write_view('content', 'user/mobile/signups_error', $data);
}else if(!is_numeric($_POST['personal_id'])) 
{
$data['error']=sprintf($this->lang->line('register_invalid_notnum_pid')."&nbsp;".$this->lang->line('register_recommand')."&nbsp;".$data['tel']);
$this->template->write_view('content', 'user/mobile/signups_error', $data);
}
			else if(!$this->hotspot_validation->perid_ck($_POST['personal_id']))
			{
				//ถ้ารหัสประจำตัวประชาชนไม่ถูกต้อง
				$this->template->write_view('content', 'user/mobile/pid_invalid', $data);
			}
			else if($this->usermodel->getfieldExist($_POST['personal_id']))
			{
				//ถ้ารหัสประจำตัวประชาชนนี้ เคยลงทะเบียนแล้ว
				$this->template->write_view('content', 'user/mobile/pid_exist', $data);
			}
			else if(!$this->signupmodel->addVoucher($_POST))
			{
				//ถ้าการไม่ทะเบียนเกิดข้อผิดพลาด
				redirect('signup','location');
				$this->template->write_view('content', 'user/mobile/signup_error', $data);
			}
			else
			{
				//การลงทะเบียนสำเร็จ
				$data['complate'] = TRUE;
				$this->template->write_view('content', 'user/mobile/signup_view', $data);
			}

			$this->template->render();

		}

	}

}

/* End of file signup.php */
/* Location: ./system/nostradius/controllers/signup.php */