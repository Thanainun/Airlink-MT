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
 
class Signup extends Register
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
		$this->load->helper('coova');
		$this->load->library('user_agent'); 
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
	foreach(get_dhcplist() as $datas)
	{	
		if($datas['ip']==$_SERVER['REMOTE_ADDR']){
		   $data['mac'] = $datas['mac'];}
	}
		if($data['mac']='') {
		$data['error']='คุณขาดคุณสมบัติบางประการเพื่อใช้ในการสมัครสมาชิกเข้าใช้งานนั่นอาจะเป็นเพราะการเรียกหน้าเว็บของคุณไม่ถูกต้อง หรือคุณอาจจะเชื่อมต่อนอกเครือข่ายของเรา';
		$data['tel'] = $reg['tel_text'];
		$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signups_error', $data)
					   ->render();
}
		else{
		
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
		
	foreach(get_dhcplist() as $datas)
	{	
		if($datas['ip']=$_SERVER['REMOTE_ADDR']){
		$data['ip'] = $datas['ip'];}
	}
		if($reg['reg_on_off']==0) { $data['invalid'] = 1; }
		if($this->form_validation->run() == FALSE)
		{	
			$login_header = $reg['hotspot'];
			$data['header'] = '<img src='.base_url().'templates/logo/'.$login_header.'>';
			$this->template	->write_view('content', 'user/'.$reg['registertheme'].'/signup_view', $data)
							->render();
		}
		else
		{
			$data['user'] = $_POST['username'] ;
			$data['pass'] = $_POST['password'] ; 
			$_POST['password'] = $_POST['password'];
			if($this->usermodel->VoucherExist($_POST['username']))//check username for duplication 
			{
				$data['error'] = sprintf($this->lang->line('user_message_add_exist'),$_POST['username']);
				$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signup_error', $data);
			}
			else if(preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']) != 1 or preg_match("/^[a-zA-Z0-9]+$/",$_POST['password']) != 1)
{
$data['error']='เนื่องจาก การตั้ง Username และ Password ของท่านไม่ถูกต้อง รหัสที่ตั้งได้จะต้องประกอบด้วย ภาษาอังกฤษ a-z หรือ ตัวเลข 0-9 เท่านั้น ห้ามเว้นวรรคหรือช่องว่าง';
$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signups_error', $data);
}
			else if(strlen($_POST['personal_id']) != 13) 
{
$data['error']='</br>รหัสประจำตัวประชาชนต้องมีความยาว 13 ตัวอักษรเท่านั้น</br>หากมีปัญหาสมัครไม่ได้ต้องการสมัครใช้งานกรุณาติดต่อ'.$data['hotspot_tel'].'เท่านั้น';
$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signups_error', $data);
}else if(!is_numeric($_POST['personal_id'])) 
{
$data['error']='</br>รหัสประจำตัวประชาชนต้องเป็นตัวเลขเท่านั้น</br>หากมีปัญหาสมัครไม่ได้ต้องการสมัครใช้งานกรุณาติดต่อ'.$data['hotspot_tel'].'เท่านั้น';
$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signups_error', $data);
}
			else if(!$this->hotspot_validation->perid_ck($_POST['personal_id']))
			{
				//ถ้ารหัสประจำตัวประชาชนไม่ถูกต้อง
				$this->template->write_view('content', 'user/'.$reg['registertheme'].'/pid_invalid', $data);
			}
			else if($this->usermodel->getfieldExist($_POST['personal_id']))
			{
				//ถ้ารหัสประจำตัวประชาชนนี้ เคยลงทะเบียนแล้ว
				$this->template->write_view('content', 'user/'.$reg['registertheme'].'/pid_exist', $data);
			}
			else if(!$this->signupmodel->addVoucher($_POST))
			{
				//ถ้าการไม่ทะเบียนเกิดข้อผิดพลาด
				redirect('signup','location');
				$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signup_error', $data);
			}
			else
			{
				//การลงทะเบียนสำเร็จ
				$data['complate'] = TRUE;
				$this->template->write_view('content', 'user/'.$reg['registertheme'].'/signup_view', $data);
			}

			$this->template->render();

		}

	}

}
}
/* End of file signup.php */
/* Location: ./system/nostradius/controllers/signup.php */