<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * topup
 *
 * topup Controller
 *
 * @package		topup
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
 
class topup extends Common_action
{

	function __construct()
	{
		parent::__construct();
		
		//load the models and library
		$this->load->model('usermodel');
		$this->load->model('topupmodel');
		$this->load->model('billingplanmodel');
		$this->load->model('gologinmodel');

		$this->load->library('form_validation');
		$this->load->library('hotspot_validation');
		$this->load->model('siteconfigmodel');
		$this->load->helper('randomuser');
		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();
	}
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("topup","refresh");
		}
	
	function index()
	{	$data['error2'] = "";
		$data['error'] = "";
		$data['complate'] = FALSE;
		$data['user'] = '';
		$data['pass'] = '';
		$data['user_card'] = '';
		$data['pass_card'] = '';
		$data['plan'] = '';
		
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
	

		if($this->input->post('user', True) == '')
		{$data['logo'] = '<img src='.base_url().'templates/common/images/logo.png>';
			$data['img'] = ''.base_url().'templates/common/images';
			$this->template	->write_view('content', 'user/topup_view', $data)
							->render();

		}
		else
		{

			
			
			$data['user'] = $this->input->post('user', TRUE);
			$data['pass'] = $this->input->post('pass', TRUE);
			$data['user_card'] = $this->input->post('user_card', TRUE);
			$data['pass_card'] = $this->input->post('pass_card', TRUE);
			
		if($this->topupmodel->UserAndPassExist($data['user'],$data['pass']))
		{   
			if($this->topupmodel->UserAndPassExist($data['user_card'],$data['pass_card'])){//ตรวจสอบ user และพาสเวิดร์  บัตรว่ามีอยู่ในระบบหรือไม่
				if($data['user'] != $data['user_card']){
				
				$exp = $this->usermodel->expUser($data['user_card']);
				if($exp == 'exp')
				{
					$data['error'] = "บัตรที่ท่านจะไช้เติมได้หมดอายุไปแล้วไม่สามารถนำมาเติมได้";
				}else if($exp == 'lock'){
				    $data['error'] = "บัตรที่ท่านจะไช้เติมถูก บล็อค ไม่สามารถสามารถนำมาเติมได้ กรุณาติดต่อ ผู้ดูแลระบบ";
				}else{
				$this->gologinmodel->checkOnlinedie( $data['user_card']);
				$this->gologinmodel->checkOnlinedie( $data['user']);
				//เรียกดูผู้ไช้ที่มีชื่อเดิมและเอาข้อมูลชื่อ กลุ่มออกมา
				$billingplan = $this->topupmodel->getRadUserGroup(null,null,array('username'=>$data['user_card']))->row();
				$groupname=$billingplan->groupname;
				//ส่งชื่อกลุ่มไปเรียกไนฐานข้อมูลกลุ่มเพิ่มเอารหัสกลุ่มมาไช้
				
				$bplan = $this->billingplanmodel->getBillingPlan(null,null,array('groupname'=>$groupname))->row();
				$price=$bplan->price;
				$billingplan=$bplan->groupname;
				$data['plan'] = $bplan->name;

				
			
				
				//เปลี่ยนกลุ่มโดยส่ง ชื่อเดิม และ รหัสกลุ่ม  
				$this->billingplanmodel->changeGroup($data['user'],$billingplan);
			   //ร้างประวัติการไช้  รอการอับเดช รหัสการไช้ไนบัตร
				$this->db->where('username',$data['user']);
				$this->db->delete('radacct');
				//ทำการอัปเดท การไช้งานจากบัตร มา ไส่ ไห้ user เดิม radacc
				$this->db->where('username',$data['user_card']);
				$this->db->update('radacct',array('username'=>$data['user']));
				//ทำไห้บัตรหมดอายุ
				//$this->db->where('username',$data['user_card']);
				//$this->db->update('radreply',array('value'=>''));
				//$this->db->where('username',$data['user_card']);
				//$this->db->update('radcheck',array('value'=>''));
                $datetime=date("Y-m-d H:i:s");
				/*$exp = array(	'username'=>$data['user_card'],
								'acctstarttime'=>'1000-01-01 00:00:00',
								'acctstoptime'=>$datetime,
								'acctsessiontime'=>'600'
								);
								
				$this->db->insert('radacct',$exp);*/
				//ทำลายทิ้ง 
				$this->usermodel->multidelete($data['user_card']);
				//ทำการเก็บประวัติการเติมเงินลงฐานข้อมูล topup
				$topup = array(
								'username'=>$data['user'],
								'cashcard'=>$data['user_card'],
								'billingplan'=>$data['plan'],
								'date'=> $datetime,
								'price'=>$price,
								'detail'=>'card'
								);
								
				$this->db->insert('topup_queue',$topup);
				//สำเร็จ
			
						
			$data['complate'] = TRUE;
					}
				}else $data['error2']="ชื่อผู้ไช้ต้องไม่ซ่ำกัน";
			}else $data['error2']="ชื่อผู้ไช้และรหัสที่ใช้เติมไม่ถูกต้อง";
		}else $data['error']="ชื่อผู้ไช้และรหัสเดิมไม่ถูกต้อง";
		
		
			
				
				
				
		$this->template	->write_view('content', 'user/topup_view', $data)
							->render();	

	}

	}

}
/* End of file topup.php */
/* Location: ./system/nostradius/controllers/topup.php */