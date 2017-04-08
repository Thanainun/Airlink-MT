<?php
/**
 * Class signupmodel
 * handles controller Class Billing Plan requests dealing with user table in DB
 * 
 *
 * @package     EasyHotspot
 * @subpackage  Models
 * @category    Signup
 * @author      Rafeequl Rahman Awan
 * @copyright   Copyright (c) 2008, easyhotspot.sf.net
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link 		http://easyhotspot.sourceforge.net
 * @version 	1.0
 */


class topupmodel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
	//table name
	$this->_table_voucher = 'voucher';
	$this->_table_radcheck = 'radcheck';
	$this->_table_radreply = 'radreply';
	$this->_table_usergroup = 'radusergroup';
	$this->_table='voucher_list';
	$this->_table_radacct = 'radacct';
	$this->load->model(array('billingplanmodel','siteconfigmodel','jsonmodel'));
	$this->load->helper(array('randomuser','number'));
	$this->load->library('globals');
	$this->load->model('billingplanmodel');
	$this->load->model('usermodel');
	$this->load->model('siteconfigmodel');
		
	}
	
		function getRadUserGroup($fields = null, $limit = null, $where = null)
	{
		
		($fields != null) ? $this->db-select($fields) :'';
		
		($where != null) ? $this->db->where($where) : '';
		
		($limit !=null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		//return the query string
		return $this->db->get($this->_table_usergroup);

	}
	function UserAndPassExist($username,$password)//เช็คว่ามีอยู่ไนระบบหรือไม่
	{
		$query=$this->usermodel->getVoucher(null,array('username'=>$username,'password'=>$password));
		
		if($query->num_rows > 0)
			return true;
		else 
			return false;
	}
	
	function topupcard($user_card,$pass_card,$user)
	{
		$data['error'] = "";
		$data['complate'] = FALSE;
		$data['user'] = $user;
		$data['user_card'] = $user_card;
		$data['pass_card'] = $pass_card;
		$data['plan'] = '';
					
			
			
			
		   
			if($this->topupmodel->UserAndPassExist($data['user_card'],$data['pass_card'])){//ตรวจสอบ user และพาสเวิดร์  บัตรว่ามีอยู่ในระบบหรือไม่
				if($data['user'] != $data['user_card']){
				
				$exp = $this->usermodel->expUser($data['user_card']);
				if($exp == 'exp')
				{
					$data['error'] = "บัตรที่ท่านจะไช้เติมได้หมดอายุไปแล้วไม่สามารถนำมาเติมได้";
				}else if($exp == 'lock'){
				    $data['error'] = "บัตรที่ท่านจะไช้เติมยังไม่อนุญาติให้ไช้งาน ไม่สามารถสามารถนำมาเติมได้ กรุณาติดต่อ 0871694680";
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
				
                $datetime=date("Y-m-d H:i:s");
				
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
				}else $data['error']="คุณกำลังไส่  user ของคุณเอง กรุณาไส่รหัส บนบัตร wifi และรหัสบนบัตรที่จะเอามาเติม";
			}else $data['error']="ชื่อผู้ไช้และรหัสที่ใช้เติมไม่ถูกต้อง";

 return array('error'=>$data['error'],'complate'=>$data['complate'],'plan'=>$data['plan']);
	}
		

		
	

}