<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

Class Usermodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
		//table name
		$this->_table='voucher_list';
		$this->_table_voucher = 'voucher';
		$this->_table_radcheck = 'radcheck';
		$this->_table_radreply = 'radreply';
		$this->_table_usergroup = 'radusergroup';
		$this->_table_radacct = 'radacct';
		$this->_table_admin = 'admin_users';
		
		$this->load->model(array('billingplanmodel','siteconfigmodel','jsonmodel','gologinmodel'));
		$this->load->helper(array('randomuser','number'));

		$this->load->library('globals');
		
		// Ajax
		$this->sTable = "voucher_list";
		$this->aColumns = array('username', 'billingplan', 'valid_until', 'time_used', 'time_remain', 'packet_used', 'packet_remain', 'valid','userprofile','start_time','money');

	}
	function getAdmin($fields = NULL, $where = NULL)
    {
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		return $this->db->get($this->_table_admin);
		}
	function getVoucher($fields = NULL, $where = NULL, $limit = NULL, $order = NULL)
	{
		($fields != NULL) ? $this->db->select($fields) :'';
		
		($where != NULL) ? $this->db->where($where) :'';
		
		($limit != NULL) ? $this->db->limit($limit['start'],$limit['end']) :'';

		($order != NULL) ? $this->db->order_by($order['field'],$order['dir']) : $this->db->order_by('id','desc');
		
		return $this->db->get($this->_table);
	}

	function getdataVoucher($fields = null, $where = null, $limit = null, $order = null)
	{
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null) ? $this->db->limit($limit['start'],$limit['end']) :'';

		($order != null) ? $this->db->order_by($order['field'],$order['dir']) : $this->db->order_by('id','desc');
		
		return $this->db->get($this->_table_voucher);
	}
	
	function getUser_attr($username, $att_type)
	{
		$where = array('username'=>$username);
		return $this->db->select('*')
				->where($where)
				->get($att_type)
				->result_array();
	}
	
	function deleteExpireVoucher()
	{
		
	}
	
	function multidelete($udata)
	{  

		for($i=0;$i<count($udata);$i++)
		{
			
			if(trim($udata) != "")
				{
				 $this->gologinmodel->checkOnlinedie($udata);
				//Start transaction
				$this->db->trans_start();
				
				//Voucher table
				$this->db->where('username',$udata);
				$this->db->delete($this->_table_voucher);
				
				//usergroup table
				$this->db->where('username',$udata);
				$this->db->delete($this->_table_usergroup);
					
				//radcheck table
				$this->db->where('username',$udata);
				$this->db->delete($this->_table_radcheck);
				
				//radreply table
				$this->db->where('username',$udata);
				$this->db->delete($this->_table_radreply);
				
				//radacct table
				$this->db->where('username',$udata);
				$this->db->delete($this->_table_radacct);

				//OK stops here
				$this->db->trans_complete();
				
				}
				
			//Delete user folder
			$dirname = set_realpath(UPLOAD.$this->config->item('user_folder').$udata, FALSE);
			if (file_exists($dirname)) delete_files($dirname, TRUE, 1);

		}

	}
	
	function editVoucher($post_data)
	{   $this->gologinmodel->checkOnlinedie($post_data['username']);
		$voucher_change['billingplan']	= $post_data['billingplan'];
		$billingplan_detail = $this->billingplanmodel->getBillingPlan(null,null,array('name'=>$post_data['billingplan']));
		$billingplan=$billingplan_detail->row();
			
		//รูปแบบการเข้ารหัส
		$global = $this->usermodel->getdataVoucher('encryption',array('username'=>$post_data['username']));
		$val = $global->row();

		//Start transaction
		$this->db->trans_start();

		$pic = (isset($post_data['pic'])) ? $post_data['pic'] : '';

		(isset($post_data['file_name'])) ? $post_data['pic_upload'] = UPLOAD.$this->config->item('user_folder').$post_data['username'].'/'.$post_data['file_name'] : $pic;

		//Radcheck table
		$radcheck_change = array('value'=>encryption($post_data['password'],$val->encryption));
		$this->db->where('username',$post_data['username'])
					->where('attribute', 'Password')
					->update($this->_table_radcheck,$radcheck_change);


		/**********************************/
		/*		กำหนดคุณสมบัตรของผู้ใช้			  */
		/**********************************/

		foreach($post_data AS $key=>$val)
		{
				
			/* UPDATE TABLE */
			if(substr($key,0,17)=='attr_radcheck_id_' && $val!='')
			{
				$len = strlen($key)-17;
				$attr_id = substr($key,-($len));
						
				$radcheck_update = array(
					'attribute '=>$post_data['attr_radcheck_id_'.$attr_id],
					'op'=>$post_data['op_radcheck_'.$attr_id],
					'value'=>$post_data['value_radcheck_id_'.$attr_id]
				);
						
				$where_update = array('id'=>$attr_id,'username'=>$post_data['username']);
						
				$this->db->where($where_update);
				$this->db->update($this->_table_radcheck,$radcheck_update);

			}
					
			if(substr($key,0,17)=='attr_radreply_id_' && $val!='')
			{
				$len = strlen($key)-17;
				$attr_id = substr($key,-($len));
						
				$radreply_update = array(
					'attribute '=>$post_data['attr_radreply_id_'.$attr_id],
					'op'=>$post_data['op_radreply_'.$attr_id],
					'value'=>$post_data['value_radreply_id_'.$attr_id]
				);
						
				$where_update = array('id'=>$attr_id,'username'=>$post_data['username']);
						
				$this->db->where($where_update);
				$this->db->update($this->_table_radreply,$radreply_update);

			}
					
		}
				
		/* INSERT TABLE RADCHECK */
		if(isset($_POST['attr_radcheck']))
		{   
			for($i=0;$i<count($_POST['attr_radcheck']);$i++)
			{

				$radreply = array(
								'username' => $post_data['username'],
								'attribute' => $_POST['attr_radcheck'][$i],
								'op' => $_POST['op_radcheck'][$i],
								'value' => $_POST['value_radcheck'][$i]
								);
				if($_POST['value_radcheck'][$i]!='') $this->db->insert($this->_table_radcheck, $radreply);
						
			}
		}
				
		/* INSERT TABLE RADREPLY */
		if(isset($_POST['attr_radreply']))
		{
			for($i=0;$i<count($_POST['attr_radreply']);$i++)
			{

				$radreply = array(
								'username' => $post_data['username'],
								'attribute' => $_POST['attr_radreply'][$i],
								'op' => $_POST['op_radreply'][$i],
								'value' => $_POST['value_radreply'][$i]
								);
				if($_POST['value_radreply'][$i]!='') $this->db->insert($this->_table_radreply, $radreply);
						
			}
		}
				
		/* DELETE DATA */
		if(isset($_POST['record_del_reply']))
		{
			foreach($_POST['record_del_reply'] AS $id)
			{
				$this->db->where('id', $id);
				$this->db->delete($this->_table_radreply); 
			}
		}
				
		if(isset($_POST['record_del_check']))
		{
			foreach($_POST['record_del_check'] AS $id)
			{
				$this->db->where('id', $id);
				$this->db->delete($this->_table_radcheck); 
			}
		}


		/**********************************/
		/*		 						  */
		/**********************************/

		//Voucher table
		//***********************************
		$voucher_change['personal_id'] = $post_data['personal_id'];
		$voucher_change['email'] = $post_data['email'];
		//***********************************
		$voucher_change['money'] = $post_data['money'];
		$voucher_change['password'] = $post_data['password'];
		$voucher_change['profile'] = $this->session->_serialize($post_data);

		if(isset($post_data['billingplan']))
		{
			//Usergroup table
			$usergroup_change = array('groupname' => $billingplan->groupname);
			$this->db->where('username',$post_data['username'])
						->update($this->_table_usergroup,$usergroup_change);
		}

		$this->db->where('username',$post_data['username'])
					->update($this->_table_voucher,$voucher_change);
		
		$this->db->trans_complete();
		
		$rep['rep'] = true;
		$rep['msg'] = sprintf($this->lang->line('user_message_edit_success'), $post_data['username']);
		
		return $rep;

	}
 //สร้าผู้ไช้แบบซุ่ม
	function generateVoucher()
	{
		$billingplan_name = $_POST['billingplan'];
		$numberofvoucher = $_POST['numberofvoucher'];
		$billingplan_detail = $this->billingplanmodel->getBillingPlan(null,null,array('groupname'=>$billingplan_name));

		//โหลดค่า ทั่วไป
		$global = $this->siteconfigmodel->getConfig('global_config');
		$val = $this->session->_unserialize($global->value);

		if($billingplan_detail->num_rows()>0)
		{
			$billingplan=$billingplan_detail->row();
		
			//insert to database
			for($i=0;$i<$numberofvoucher;$i++){
				if(isset($_POST['gentype'])) {
					$user = generate_random_pincode();
				}
				if(!isset($_POST['gentype'])) {
					$user = generate_random_user($val['encryption']);
				}
				$groupname = $billingplan->groupname;
				$name = $billingplan->name;
				$value = $billingplan->amount;
				$valid_for = $billingplan->valid_for; //วันหมดอายุ
				$IdleTimeout = $billingplan->IdleTimeout;//timeout
				
				$profile['pic_upload'] = 'assets/images/noicon.jpg';
				$profile['billingplan'] = $name;

				if($this->usermodel->VoucherExist($user['username'])){			//เช็คว่าซ้ำกับ Username ที่มีอยู่หรือไม่
				
					$i--; //หากซ้ำ ให้ทำรอบนี้ใหม่
					continue;
				}else {
					//ไม่ซ้ำ เริ่มสร้าง User
					$this->db->trans_start();

					//Voucher table ฐานข้อมูล โปรไฟล์ User
					$voucher = array(
									'username'=>$user['username'],
									'password'=>$user['no_encryp'],
									//'personal_id'=>$user['username'],
									//'email'=>$user['username'],
									'billingplan'=>$name,
									'created_by'=>$this->session->userdata('username'),									
									'IdleTimeout'=>$IdleTimeout,
									'profile'=>$this->session->_serialize($profile),
									'encryption'=>$val['encryption']
									);
					$this->db->insert($this->_table_voucher,$voucher);

					//usergroup table
					$usergroup = array(
									'username'=>$user['username'],
									'groupname'=>$groupname,
									'priority'=>'1'
									);
					$this->db->insert($this->_table_usergroup,$usergroup);
					
					//radcheck table
					$radcheck = array(
									'username'=>$user['username'],
									'attribute'=>'Password',
									'op'=>':=',
									'value'=>$user['password']
									);
					$this->db->insert($this->_table_radcheck,$radcheck);
					
					//radcheck table
					$radcheck = array(
									'username'=>$user['username'],
									'attribute'=>'Auth-Type',
									'op'=>':=',
									'value'=>'Local'
									);
					$this->db->insert($this->_table_radcheck,$radcheck);
					
					$valid = $this->globals->conv_date($valid_for);

					$radcheck = array(
									'username'=>$user['username'],
									'attribute'=>'Expiration',
									'op'=>':=',
									'value'=>$valid['radcheck']
									);
					$this->db->insert($this->_table_radcheck,$radcheck);

					$radreply = array(
									'username'=>$user['username'],
									'attribute'=>'WISPr-Session-Terminate-Time',
									'op'=>':=',
									'value'=>$valid['radreply']
									);
					$this->db->insert($this->_table_radreply, $radreply);
					
					/**********************************/
					/*		กำหนดคุณสมบัตรของผู้ใช้			  */
					/**********************************/
					// กำหนดอัตราดาวน์โหลด
					$radreply_down = array(
									'username'=>$user['username'],
									'attribute'=>'WISPr-Bandwidth-Max-Down',
									'op'=>':=',
									'value'=>$billingplan->bw_download
								);
					$this->db->insert($this->_table_radreply,$radreply_down);

					// กำหนดอัตราอัพโหลด
					$radreply_up = array(
									'username'=>$user['username'],
									'attribute'=>'WISPr-Bandwidth-Max-Up',
									'op'=>':=',
									'value'=>$billingplan->bw_upload
								);
					$this->db->insert($this->_table_radreply,$radreply_up);
					
					// กำหนดอัตราอัพโหลด
					$radreply_re = array(
									'username'=>$user['username'],
									'attribute'=>'WISPr-Redirection-URL',
									'op'=>':=',
									'value'=>$billingplan->redirect_url
								);
					$this->db->insert($this->_table_radreply,$radreply_re);


					// กำหนดโปรไฟล์ชั่วโมงใช้งาน
					if($billingplan->profile=='time')
					{	
						$time_data = array(
									'username'=>$user['username'],
									'attribute'=>'Max-All-Session',
									'op'=>':=',
									'value'=>$billingplan->amount*3600
								);
						$this->db->insert($this->_table_radcheck,$time_data);
						$this->db->insert($this->_table_radreply,$time_data);

						// กำหนด วัน เริมจากการไช้งานวันแรก  วันหมดอายุ 365 ชวันนับจากเริ่มไช้งงาน 1 วัน สำหรับกลุ่มชั่วโมง ลงใน Check
						$time_data['attribute']='Expire-After';
						$time_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$time_data);
					}
					
					// กำนหดโปรไฟล์จำนวนวันใช้งาน นับจากวันเริ่มใช้
					if($billingplan->profile=='timetofinish')
					{
						$timetofinish_data = array(
									'username'=>$user['username'],
									'attribute'=>'Expire-After',
									'op'=>':=',
									'value'=>$billingplan->amount*3600*24
								);

						$this->db->insert($this->_table_radcheck,$timetofinish_data);

						$timetofinish_data['attribute']='Max-All-Session';

						$this->db->insert($this->_table_radcheck,$timetofinish_data);
						$this->db->insert($this->_table_radreply,$timetofinish_data);
					
					//if(($groupname!='bypass')&&($groupname!='teacher'))
					//if(($groupname!='20150817000433')&&($groupname!='20150817000434'))
						//{
						//$timetofinish_data = array(
						//			'username'=>$user['username'],
						//			'attribute'=>'Session-Timeout',
						//			'op'=>':=',
						//			'value'=>'7200'
						//		);
						//$this->db->insert($this->_table_radreply,$timetofinish_data);
						//}					
				
					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อครั้ง
					if($billingplan->profile=='timeout')
					{
					
						$timeout_data = array(
									'username'=>$user['username'],
									'attribute'=>'Session-Timeout',
									'op'=>':=',
									'value'=>$billingplan->amount*3600
								);
						$this->db->insert($this->_table_radcheck,$timeout_data);
						$this->db->insert($this->_table_radreply,$timeout_data);
						$timeout_data['attribute']='Expire-After';
						$timeout_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$timeout_data);
					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อวัน
					if($billingplan->profile=='daily')
					{
					
						$daily_data = array(
									'username'=>$user['username'],
									'attribute'=>'Max-Daily-Session',
									'op'=>':=',
									'value'=>$billingplan->amount*3600
								);
						$this->db->insert($this->_table_radcheck,$daily_data);
						$this->db->insert($this->_table_radreply,$daily_data);
						$daily_data['attribute']='Expire-After';
						$daily_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$daily_data);
					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อเดือน
					if($billingplan->profile=='monthly')
					{
					
						$monthly_data = array(
									'username'=>$user['username'],
									'attribute'=>'Max-Monthly-Session',
									'op'=>':=',
									'value'=>$billingplan->amount*3600
								);
						$this->db->insert($this->_table_radcheck,$monthly_data);
						$this->db->insert($this->_table_radreply,$monthly_data);
						$monthly_data['attribute']='Expire-After';
						$monthly_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$monthly_data);
					}
					
					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้
					if($billingplan->profile=='packets')
					{
					
						$packets_data = array(
									'username'=>$user['username'],
									'attribute'=>'Max-All-MB',
									'op'=>':=',
									'value'=>$billingplan->amount*1024*1024
								);
						$this->db->insert($this->_table_radcheck,$packets_data);
						$packets_data['attribute']='Expire-After';
						$packets_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$packets_data);
					}
					
					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อวัน
					if($billingplan->profile=='packets_day')
					{
					
						$packets_day_data = array(
									'username'=>$user['username'],
									'attribute'=>'Mb-Per-Days',
									'op'=>':=',
									'value'=>$billingplan->amount*1024*1024
								);
						$this->db->insert($this->_table_radcheck,$packets_day_data);
						$packets_day_data['attribute']='Expire-After';
						$packets_day_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$packets_day_data);
					}

					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อเดือน
					if($billingplan->profile=='packets_month')
					{
					
						$packets_month_data = array(
									'username'=>$user['username'],
									'attribute'=>'Mb-Per-Month',
									'op'=>':=',
									'value'=>$billingplan->amount*1024*1024
								);
						$this->db->insert($this->_table_radcheck,$packets_month_data);
						$packets_month_data['attribute']='Expire-After';
						$packets_month_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$packets_month_data);
					}

					/**********************************/
					/*		 						  */
					/**********************************/

					//จบกระบวนการสร้าง
					$this->db->trans_complete();
					
				}

				$stack[] = array(
								'username' => $user['username'],
								'password' => $user['no_encryp'],
								'price'=>$billingplan->price,
								'group' => $name,
								'created_by'	=>$this->session->userdata('username'), //สร้างการ์ด์เอาไปคำนาน ยอดถ้าไช้เติมจะถูกลบ
								'expir' => $valid['radcheck'],
								'gname'=>$groupname
								);

			}
		}
		
		return $stack;
		
	}
	
	
	function setPrintedVoucher()
	{
		$this->db->where('username',$this->uri->segment(4));
		$this->db->update($this->_table_voucher,array('isprinted'=>'1'));
	}
	
	function VoucherExist($username)
	{
		$query=$this->usermodel->getVoucher(null,array('username'=>$username));
		
		if($query->num_rows > 0)
			return true;
		else 
			return false;
	}
	
	function getfieldExist($pid,$time_action=1)
	{	
		
		$query=$this->db->like('profile', $pid)
						->get($this->_table_voucher); 
		
		if($query->num_rows >= $time_action)
			return true;
		else 
			return false;
	}

	function getVoucherStatistics()
	{
		//get voucher list
		$vouchers = $this->usermodel->getVoucher();
		$data['created'] = $vouchers->num_rows;
		
		//get used voucer
		$voucher_used = $this->db->query('select * from voucher_list where time_used is not NULL');
		$data['used'] = $voucher_used->num_rows();
		
		//get expired user
		$expired = $this->usermodel->getVoucher(null,array('valid'=>'exp'));
		$data['expired'] = $expired->num_rows();
		
		
		return $data;
	}
	
	//สร้างผู้ไช้แบบกำหนดเอง
	function addVoucher($post_data)
	{

		$billingplan_name = $post_data['billingplan'];
		$billingplan_detail = $this->billingplanmodel->getBillingPlan(null,null,array('name'=>$billingplan_name));

		if($billingplan_detail->num_rows()>0){
			$billingplan=$billingplan_detail->row();

			//โหลดค่า ทั่วไป
			$global = $this->siteconfigmodel->getConfig('global_config');
			$val = $this->session->_unserialize($global->value);

			//insert to database
			$groupname = $billingplan->groupname;
			$name = $billingplan->name;
			$value = $billingplan->amount;
			$valid_for = $billingplan->valid_for;
			$IdleTimeout = $billingplan->IdleTimeout;
			
			if($this->usermodel->VoucherExist($post_data['username']))//check username for duplication 
			{
			
				$rep['rep'] = false;
				$rep['msg'] = sprintf($this->lang->line('user_message_add_exist'),$post_data['username']);

				return $rep;

			}
			else
			{
			
				//We want everything O.K
				$this->db->trans_start();

				//radusergroup table
				$usergroup = array(
									'username'=>$post_data['username'],
									'groupname'=>$groupname,
									'priority'=>'1'
									);
				$this->db->insert($this->_table_usergroup,$usergroup);
				
				//radcheck table
				$radcheck = array(
								'username'=>$post_data['username'],
								'attribute'=>'Password',
								'op'=>':=',
								'value'=>encryption($post_data['password'],$val['encryption'])
								);
				$this->db->insert($this->_table_radcheck,$radcheck);

				//radcheck table
				$radcheck = array(
								'username'=>$post_data['username'],
								'attribute'=>'Auth-Type',
								'op'=>':=',
								'value'=>'Local'
								);
				$this->db->insert($this->_table_radcheck,$radcheck);

			if(isset($post_data['valid_until']))
			{
			
				$valid = $this->globals->conv_date($post_data['valid_until']);
			
				$radcheck = array(
								'username'=>$post_data['username'],
								'attribute'=>'Expiration',
								'op'=>':=',
								'value'=>$valid['radcheck']
								);
				$this->db->insert($this->_table_radcheck,$radcheck);

				$radreply = array(
								'username' => $data['username'],
								'attribute' => 'WISPr-Session-Terminate-Time',
								'op' => ':=',
								'value' =>  $valid['radreply']
								);
				$this->db->insert($this->_table_radreply, $radreply);
					
					
			}
			else
			{
				$valid = $this->globals->conv_date($valid_for);

				$radcheck = array(
								'username'=>$post_data['username'],
								'attribute'=>'Expiration',
								'op'=>':=',
								'value'=>$valid['radcheck']
								);
				$this->db->insert($this->_table_radcheck,$radcheck);

				$radreply = array(
								'username' => $post_data['username'],
								'attribute' => 'WISPr-Session-Terminate-Time',
								'op' => ':=',
								'value' => $valid['radreply']
								);
				$this->db->insert($this->_table_radreply, $radreply);
			}

			if((!isset($post_data['attr_radcheck'])) && (!isset($post_data['attr_radreply'])))
			{
			
				/**********************************/
				/*		กำหนดคุณสมบัตรของผู้ใช้			  */
				/**********************************/

				// กำหนดอัตราดาวน์โหลด
				$radreply_down = array(
								'username'=>$post_data['username'],
								'attribute'=>'WISPr-Bandwidth-Max-Down',
								'op'=>':=',
								'value'=>(isset($post_data['bw_download'])) ? $post_data['bw_download'] : $billingplan->bw_download
							);
				$this->db->insert($this->_table_radreply,$radreply_down);
							
				// กำหนดอัตราอัพโหลด
				$radreply_up = array(
								'username'=>$post_data['username'],
								'attribute'=>'WISPr-Bandwidth-Max-Up',
								'op'=>':=',
								'value'=>(isset($post_data['bw_upload'])) ? $post_data['bw_upload'] : $billingplan->bw_upload
							);
				$this->db->insert($this->_table_radreply,$radreply_up);
				
				$radreply_re = array(
									'username'=>$post_data['username'],
									'attribute'=>'WISPr-Redirection-URL',
									'op'=>':=',
									'value'=>$billingplan->redirect_url
								);
					$this->db->insert($this->_table_radreply,$radreply_re);


				// กำหนดโปรไฟล์ชั่วโมงใช้งาน
				if($billingplan->profile=='time')
				{	
					$time_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Max-All-Session',
								'op'=>':=',
								'value'=>$billingplan->amount*3600
							);
					$this->db->insert($this->_table_radcheck,$time_data);
					$this->db->insert($this->_table_radreply,$time_data);

					// กำหนดเวลา 60 วัน สำหรับกลุ่มชั่วโมง ลงใน Check
					$time_data['attribute']='Expire-After';
					$time_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$time_data);
				}
				
				// กำนหดโปรไฟล์จำนวนวันใช้งาน นับจากวันเริ่มใช้
				if($billingplan->profile=='timetofinish')
				{
					$timetofinish_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Expire-After',
								'op'=>':=',
								'value'=>$billingplan->amount*3600*24
							);
					$this->db->insert($this->_table_radcheck,$timetofinish_data);

					$timetofinish_data['attribute']='Max-All-Session';

					$this->db->insert($this->_table_radcheck,$timetofinish_data);
					$this->db->insert($this->_table_radreply,$timetofinish_data);

				//if(($groupname!='bypass')&&($groupname!='teacher'))
				//if(($groupname!='20150817000433')&&($groupname!='20150817000434'))
						//{
						//$timetofinish_data = array(
						//			'username'=>$post_data['username'],
						//			'attribute'=>'Session-Timeout',
						//			'op'=>':=',
						//			'value'=>'7200'
						//		);
						//$this->db->insert($this->_table_radreply,$timetofinish_data);
						//}
				}
				
				// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อครั้ง
				if($billingplan->profile=='timeout')
				{
				
					$timeout_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Session-Timeout',
								'op'=>':=',
								'value'=>$billingplan->amount*3600
							);
					$this->db->insert($this->_table_radcheck,$timeout_data);
					$this->db->insert($this->_table_radreply,$timeout_data);
					$timeout_data['attribute']='Expire-After';
					$timeout_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$timeout_data);
				}
				
				// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อวัน
				if($billingplan->profile=='daily')
				{
				
					$daily_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Max-Daily-Session',
								'op'=>':=',
								'value'=>$billingplan->amount*3600
							);
					$this->db->insert($this->_table_radcheck,$daily_data);
					$this->db->insert($this->_table_radreply,$daily_data);
					$daily_data['attribute']='Expire-After';
					$daily_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$daily_data);
				}
				
				// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อเดือน
				if($billingplan->profile=='monthly')
				{
				
					$monthly_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Max-Monthly-Session',
								'op'=>':=',
								'value'=>$billingplan->amount*3600
							);
					$this->db->insert($this->_table_radcheck,$monthly_data);
					$this->db->insert($this->_table_radreply,$monthly_data);
					$monthly_data['attribute']='Expire-After';
					$monthly_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$monthly_data);
				}
				
				// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้
				if($billingplan->profile=='packets')
				{
					$packets_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Max-All-MB',
								'op'=>':=',
								'value'=>$billingplan->amount*1024*1024
							);
					$this->db->insert($this->_table_radcheck,$packets_data);
					$packets_data['attribute']='Expire-After';
					$packets_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$packets_data);
				}
				
				// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อวัน
				if($billingplan->profile=='packets_day')
				{
				
					$packets_day_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Mb-Per-Days',
								'op'=>':=',
								'value'=>$billingplan->amount*1024*1024
							);
					$this->db->insert($this->_table_radcheck,$packets_day_data);
					$packets_day_data['attribute']='Expire-After';
					$packets_day_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$packets_day_data);
				}

				// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อเดือน
				if($billingplan->profile=='packets_month')
				{
				
					$packets_month_data = array(
								'username'=>$post_data['username'],
								'attribute'=>'Mb-Per-Month',
								'op'=>':=',
								'value'=>$billingplan->amount*1024*1024
							);
					$this->db->insert($this->_table_radcheck,$packets_month_data);
					$packets_month_data['attribute']='Expire-After';
					$packets_month_data['value'] = $billingplan->valid_for*3600*24/1000;

					$this->db->insert($this->_table_radcheck,$packets_month_data);
				}
			
				/**********************************/
				/*		 						  */
				/**********************************/

			}
			else
			{
				
				/* INSERT TABLE RADCHECK */
				if(isset($_POST['attr_radcheck']))
				{
					for($i=0;$i<count($_POST['attr_radcheck']);$i++)
					{

						$radreply = array(
										'username' => $post_data['username'],
										'attribute' => $_POST['attr_radcheck'][$i],
										'op' => $_POST['op_radcheck'][$i],
										'value' => $_POST['value_radcheck'][$i]
										);
						$this->db->insert($this->_table_radcheck, $radreply);
						
					}
				}
				
				/* INSERT TABLE RADREPLY */
				if(isset($_POST['attr_radreply']))
				{
					for($i=0;$i<count($_POST['attr_radreply']);$i++)
					{

						$radreply = array(
										'username' => $post_data['username'],
										'attribute' => $_POST['attr_radreply'][$i],
										'op' => $_POST['op_radreply'][$i],
										'value' => $_POST['value_radreply'][$i]
										);
						$this->db->insert($this->_table_radcheck, $radreply);
						
					}
				}
				
			}
			
			$user_data['firstname'] 	= (isset($post_data['firstname']) ? $post_data['firstname'] : '');
			$user_data['lastname'] 		= (isset($post_data['lastname']) ? $post_data['lastname'] : '');
			$user_data['surename'] 		= (isset($post_data['surename']) ? $post_data['surename'] : '');
			$user_data['gender'] 		= (isset($post_data['gender']) ? $post_data['gender'] : '');
			$user_data['billingplan'] 	= (isset($post_data['billingplan']) ? $post_data['billingplan'] : '');
			$user_data['money'] 		= (isset($post_data['money']) ? $post_data['money'] : 0);
			$user_data['ip'] 			= (isset($post_data['ip']) ? $post_data['ip'] : '');
			$user_data['mac'] 			= (isset($post_data['mac']) ? $post_data['mac'] : '');
			$user_data['web'] 			= (isset($post_data['web']) ? $post_data['web'] : '');
			$user_data['personal_id'] 	= (isset($post_data['personal_id']) ? $post_data['personal_id'] : '');
			$user_data['phone'] 		= (isset($post_data['phone']) ? $post_data['phone'] : '');
			$user_data['email'] 		= (isset($post_data['email']) ? $post_data['email'] : '');
			$user_data['address1'] 		= (isset($post_data['address1']) ? $post_data['address1'] : '');
			$user_data['address2'] 		= (isset($post_data['address2']) ? $post_data['address2'] : '');
			$user_data['district'] 		= (isset($post_data['district']) ? $post_data['district'] : '');
			$user_data['amphur'] 		= (isset($post_data['amphur']) ? $post_data['amphur'] : '');
			$user_data['province'] 		= (isset($post_data['province']) ? $post_data['province'] : '');
			$user_data['note'] 			= (isset($post_data['note']) ? $post_data['note'] : '');
			$user_data['pic_upload'] 	= (isset($post_data['file_name'])) ? UPLOAD.$this->config->item('user_folder').$post_data['username'].'/'.$post_data['file_name'] : 'assets/images/noicon.jpg';
			
			$profile = $this->session->_serialize($user_data);
			$datetime=date("Y-m-d H:i:s");
				$topup = array(
								'username'=>$post_data['username'],
								'cashcard'=>'money',
								'billingplan'=>$post_data['billingplan'],
								'date'=> $datetime,
								'price' =>$billingplan->price,
								'detail'=>'Admin'
								);
				$this->db->insert('topup_queue',$topup);
				//Voucher table
				$voucher = array(
				
					'username'		=>		$post_data['username'],
					'money'			=>		$post_data['money'],
					'password'		=>		encryption($post_data['password'],$$val['encryption']),
					//**********************************
					'personal_id'	=>		$post_data['personal_id'],
					'email'			=>		$post_data['email'],
					//**********************************
					'billingplan'	=>		$billingplan_name,
					'created_by'	=>		$this->session->userdata('username'),
					'valid_until'	=>		$valid['radreply'],
					'profile'		=>		$profile,
					'IdleTimeout'	=>		$IdleTimeout,
					'encryption'	=>		$val['encryption']
					
				);
				$this->db->insert($this->_table_voucher,$voucher);
			
				//OK stops here
				$this->db->trans_complete();
			}

		}
			
		$rep['rep'] = true;
		$rep['msg'] = sprintf($this->lang->line('user_message_add_success'),$post_data['username']);
		
		return $rep;
	}
	
	function getAccountUsage($fields = null, $where = null, $limit = null, $order = null)
	{

		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null) ? $this->db->limit($limit['start'],$limit['end']) :'';

		($order != null) ? $this->db->order_by($order['field'],$order['dir']) : $this->db->order_by('radacctid','desc');
		
		
		return $this->db->get($this->_table_radacct);
	
	}

	function data_table()
	{

		$jdata = $this->jsonmodel->data_table($this->sTable, $this->aColumns);
				
		$output = $jdata['output'];
	
		foreach ($jdata['rResult']->result() as $aRow)
		{	
			$userprofile = $this->session->_unserialize($aRow->userprofile);

			$exp_days = strtotime(date('Y-m-d H:i:s', strtotime($aRow->start_time)) . ' + '.$aRow->amount.' day');
			if($aRow->profile=='time'||$aRow->profile=='timeout'||$aRow->profile=='daily'||$aRow->profile=='monthly'||$aRow->profile=='packets'||$aRow->profile=='packets_day'||$aRow->profile=='packets_month')
			{
			$valid_for = $this->usermodel->getValidfor($aRow->username);
			
			$exp_days = strtotime(date('Y-m-d H:i:s', strtotime($aRow->start_time)) . ' + '.($valid_for/1000).' day');
			}
			$publish = $this->usermodel->getPublish($aRow->username);
			$fname=(isset($userprofile['firstname']) ? $userprofile['firstname'] : '---');
			$lname=(isset($userprofile['lastname']) ? $userprofile['lastname'] : '---');
			$row = array();
			$row[] = $aRow->username;
			$row[] =($fname != NULL ? $fname : '---');
			$row[] =($lname != NULL ? $lname : '---');
			$row[] = $this->globals->get_action_table($aRow->username, 'admin/'.$this->uri->segment(2)).$aRow->billingplan;
			$row[] = $this->globals->get_expir( $aRow->profile , $aRow->start_time , $aRow->valid_until , $exp_days);
			$row[] = $this->globals->get_used($aRow->time_used, 'time');
			$row[] = $this->globals->get_used($aRow->time_remain, 'time');
			$row[] = $this->globals->get_used($aRow->packet_used, 'byte');
			$row[] = $this->globals->get_packet_remain(  $aRow->packet_remain ,$aRow->start_time , $aRow->profile);
			$row[] = $aRow->money;  
			$row[] = form_checkbox(array("name"=>"check_del", "checked"=>false,'style'=>'display:none;'), $aRow->username).$this->globals->get_status($aRow->profile, $aRow->valid, $aRow->start_time, $exp_days, $publish, $aRow->valid_until);
			
			$output['aaData'][] = $row;
		}

		return json_encode( $output );

	}
	
	
	function expUser($user)//เช็คยูส หมดเวลา ถ้าหมดรีเทอนร์ทรู
	{
		$exp = $this->usermodel->getVoucher(null,array('username'=>$user));
		$aRow=$exp->row();
			$exp_days = strtotime(date('Y-m-d H:i:s', strtotime($aRow->start_time)) . ' + '.$aRow->amount.' day');
			if($aRow->profile=='time'||$aRow->profile=='timeout'||$aRow->profile=='daily'||$aRow->profile=='monthly'||$aRow->profile=='packets'||$aRow->profile=='packets_day'||$aRow->profile=='packets_month')
			{
			$valid_for = $this->usermodel->getValidfor($aRow->username);
			$exp_days = strtotime(date('Y-m-d H:i:s', strtotime($aRow->start_time)) . ' + '.($valid_for/1000).' day');
			}
			$publish = $this->usermodel->getPublish($aRow->username);
			$output = '';
		if($publish!='Reject') 
		{
			 $output = 'ok';
				if(strtotime(date('Y-m-d H:i:s'))>=$exp_days && $aRow->start_time!=null) 
				{
					$output = 'exp';
				}
				 if($aRow->valid == 'exp'&& $aRow->profile != 'timetofinish') 
				{
					$output = 'exp';
				}
				 if( date('Y-m-d H:i:s')>= date( "Y-m-d H:i:s", strtotime( $aRow->valid_until ) )  ) 
				{
					$output = 'exp';
				}
			
		} 
		else 
		{ 
			$output = 'lock' ; 
		}
		
		return $output;
	}
	
	function getPublish($username)
	{
		return $this->db->select('value')
						->where(array('username'=>$username,'attribute'=>'Auth-Type'))
						->get($this->_table_radcheck)
						->row()
						->value;
	}
	
	function getValidfor($username)
	{
		return $this->db->select('valid_for')
						->where(array('username'=>$username))
						->get($this->_table)
						->row()
						->valid_for;
	}
	
	function updatePublish($data)
	{
		$data_update = ($data['status']=='lock') ? 'Reject' : 'Local';
		$this->db->where(array('username'=>$data['username'],'attribute'=>'Auth-Type'));
		$this->db->update($this->_table_radcheck, array('value'=>$data_update));
	}
	
}
