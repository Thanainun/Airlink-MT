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


class Signupmodel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
	//table name
	$this->_table_voucher = 'voucher';
	$this->_table_radcheck = 'radcheck';
	$this->_table_radreply = 'radreply';
	$this->_table_usergroup = 'radusergroup';
	$this->load->library('globals');
	$this->load->model('billingplanmodel');
	$this->load->model('usermodel');
	$this->load->model('siteconfigmodel');
	
	}

	
	function addVoucher($post_data)
	{
	
		if($this->usermodel->VoucherExist($post_data['username'])){			//check username for duplication 
			return false;
		}
		else
		{ 
			$query = $this->siteconfigmodel->getConfig('global_config');
			$gconf = $this->session->_unserialize($query->value);
			$billingplan_name = $gconf['reg_group'];
			
			$billingplan_detail = $this->billingplanmodel->getBillingPlan(null,null,array('name'=>$billingplan_name));
			
			if($billingplan_detail->num_rows()>0)
			{
		
			$billingplan=$billingplan_detail->row();
		
			//insert to database
			$groupname = $billingplan->groupname;
			$name = $billingplan->name;
			$value = $billingplan->amount;
			$valid_for = $billingplan->valid_for;
			
			if($this->usermodel->VoucherExist($post_data['username'])) 
			{
			
				//check username for duplication 
				$rep['rep'] = false;
				$rep['msg'] = sprintf($this->lang->line('user_message_add_exist'),$post_data['username']);

				return $rep;

			}
			else
			{
				
					//We want everything O.K
					$this->db->trans_start();
					
					//Message to admin
					$data = array(
							'username'=>$post_data['username'],
							'subject'=>$this->lang->line('signup_message_subject'),
							'message'=>sprintf($this->lang->line('signup_message_message'),
											$post_data['username'],
											$post_data['firstname'],
											$post_data['lastname'],
											$post_data['personal_id']),
							'date'=>date('Y-m-d H:i:s')
							);
					$this->db->insert('message',$data);
					
					
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
									'value'=>encryption($post_data['password'],$gconf['encryption'])
									);
					$this->db->insert($this->_table_radcheck,$radcheck);

					//radcheck table
					$radcheck = array(
									'username'=>$post_data['username'],
									'attribute'=>'Auth-Type',
									'op'=>':=',
									'value'=>$gconf['reg_confirm']
									);
					$this->db->insert($this->_table_radcheck,$radcheck);
					
					//Expiration with format = November 28 2007 20:26:43
					$month = date('F');
					$day = date('j');
					$year = date('Y');
					$time = '24:00:00';


					if(isset($post_data['valid_until']))
					{
						$data['username'] = $post_data['username'];

						$date = mktime(0,0,0, date('m'), $day+$post_data['valid_until'], $year);
						$date = date("F j Y", $date)." ".$time;
						
						$data['attribute'] = 'Expiration';
						$data['op'] = ':=';
						$data['value'] = $date;
						
						//radcheck
						$this->db->insert($this->_table_radcheck,$data);
						
						//radreply
						$date_radreply = mktime(0,0,0, date('m'), $day+$post_data['valid_until'], $year);
						$date_radreply = date("Y-n-j", $date_radreply)."T".$time;

						$radreply = array(
										'username' => $data['username'],
										'attribute' => 'WISPr-Session-Terminate-Time',
										'op' => ':=',
										'value' => $date_radreply
										);
						$this->db->insert($this->_table_radreply, $radreply);
						
						
					}
					else
					{
							
							$date = mktime(0,0,0, date('m'), $day+$valid_for, $year);
							
							$date = date("F j Y", $date)." ".$time;
							$radcheck = array(
											'username'=>$post_data['username'],
											'attribute'=>'Expiration',
											'op'=>':=',
											'value'=>$date
											);
							$this->db->insert($this->_table_radcheck,$radcheck);
							
							//radreply table
							$date_radreply = mktime(0,0,0, date('m'), $day+$valid_for, $year);
							$date_radreply = date("Y-n-j", $date_radreply)."T".$time;

							$radreply = array(
											'username' => $post_data['username'],
											'attribute' => 'WISPr-Session-Terminate-Time',
											'op' => ':=',
											'value' => $date_radreply
											);
							$this->db->insert($this->_table_radreply, $radreply);

					}
					
					/**********************************/
					/*		กำหนดคุณสมบัตรของผู้ใช้			  */
					/**********************************/
					// กำหนดอัตราดาวน์โหลด
					$radreply_down['username'] = $post_data['username'];
					$radreply_down['attribute']='WISPr-Bandwidth-Max-Down';
					$radreply_down['op'] = ':=';
					$radreply_down['value'] = $billingplan->bw_download;
					$this->db->insert($this->_table_radreply,$radreply_down);

					// กำหนดอัตราอัพโหลด
					$radreply_up['username'] = $post_data['username'];
					$radreply_up['attribute']='WISPr-Bandwidth-Max-Up';
					$radreply_up['op']=':=';
					$radreply_up['value'] = $billingplan->bw_upload;
					$this->db->insert($this->_table_radreply,$radreply_up);


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

						// กำหนด วัน เริมจากการไช้งานวันแรก  วันหมดอายุ 365 ชวันนับจากเริ่มไช้งงาน 1 วัน สำหรับกลุ่มชั่วโมง ลงใน Check
						$time_data['attribute']='Expire-After';
						$time_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$time_data);
					}
					
					
					// กำนหดโปรไฟล์จำนวนวันใช้งาน นับจากวันเริ่มใช้
					if($billingplan->profile=='timetofinish')
					{
						$timetofinish_data['username'] = $post_data['username'];
						$timetofinish_data['attribute']='Expire-After';
						$timetofinish_data['op']=':=';
						$timetofinish_data['value'] = $billingplan->amount*3600*24;

						$this->db->insert($this->_table_radcheck,$timetofinish_data);

						$timetofinish_data['attribute']='Max-All-Session';

						$this->db->insert($this->_table_radcheck,$timetofinish_data);
						$this->db->insert($this->_table_radreply,$timetofinish_data);
					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อครั้ง
					if($billingplan->profile=='timeout')
					{
						$timeout_data['username'] = $post_data['username'];
						$timeout_data['attribute']='Session-Timeout';
						$timeout_data['op']=':=';
						$timeout_data['value'] = $billingplan->amount*3600;
						
						$this->db->insert($this->_table_radcheck,$timeout_data);
						$this->db->insert($this->_table_radreply,$timeout_data);
						$timeout_data['attribute']='Expire-After';
						$timeout_data['value'] = $billingplan->valid_for*3600*24/1000;

						$this->db->insert($this->_table_radcheck,$timeout_data);
					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อวัน
					if($billingplan->profile=='daily')
					{
						$daily_data['username'] = $post_data['username'];
						$daily_data['attribute']='Max-Daily-Session';
						$daily_data['op']=':=';
						$daily_data['value'] = $billingplan->amount*3600;
						
						$this->db->insert($this->_table_radcheck,$daily_data);
						$this->db->insert($this->_table_radreply,$daily_data);
						$daily_data['attribute']='Expire-After';
						$daily_data['value'] = $billingplan->valid_for*3600*24/1000;
						$this->db->insert($this->_table_radcheck,$daily_data);

					}
					
					// กำหนดโปรไฟล์ชั่วโมงใช้งานต่อเดือน
					if($billingplan->profile=='monthly')
					{
						$monthly_data['username'] = $post_data['username'];
						$monthly_data['attribute']='Max-Monthly-Session';
						$monthly_data['op']=':=';
						$monthly_data['value'] = $billingplan->amount*3600;

						$this->db->insert($this->_table_radcheck,$monthly_data);
						$this->db->insert($this->_table_radreply,$monthly_data);
						$monthly_data['attribute']='Expire-After';
						$monthly_data['value'] = $billingplan->valid_for*3600*24/1000;
						$this->db->insert($this->_table_radcheck,$monthly_data);
					}
					
					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้
					if($billingplan->profile=='packets')
					{
						$packets_data['username'] = $post_data['username'];
						$packets_data['attribute']='Max-All-MB';
						$packets_data['op']=':=';
						$packets_data['value'] = $billingplan->amount*1024*1024;
						
						$this->db->insert($this->_table_radcheck,$packets_data);
						$packets_data['attribute']='Expire-After';
						$packets_data['value'] = $billingplan->valid_for*3600*24/1000;
						$this->db->insert($this->_table_radcheck,$packets_data);
					}
					
					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อวัน
					if($billingplan->profile=='packets_day')
					{
						$packets_day_data['username'] = $post_data['username'];
						$packets_day_data['attribute']='Mb-Per-Days';
						$packets_day_data['op']=':=';
						$packets_day_data['value'] = $billingplan->amount*1024*1024;
						
						$this->db->insert($this->_table_radcheck,$packets_day_data);
						$packets_day_data['attribute']='Expire-After';
						$packets_day_data['value'] = $billingplan->valid_for*3600*24/1000;
						$this->db->insert($this->_table_radcheck,$packets_day_data);
					}

					// กำหนดโปรไฟล์ปริมาณข้อมูลที่ใช้ ต่อเดือน
					if($billingplan->profile=='packets_month')
					{
						$packets_month_data['username'] = $post_data['username'];
						$packets_month_data['attribute']='Mb-Per-Month';
						$packets_month_data['op']=':=';
						$packets_month_data['value'] = $billingplan->amount*1024*1024;
						
						$this->db->insert($this->_table_radcheck,$packets_month_data);
						$packets_month_data['attribute']='Expire-After';
						$packets_month_data['value'] = $billingplan->valid_for*3600*24/1000;
						$this->db->insert($this->_table_radcheck,$packets_month_data);
					}

					/**********************************/
					/*		 						  */
					/**********************************/
				
					$user_data['firstname'] 	= (isset($post_data['firstname']) ? $post_data['firstname'] : '');
					$user_data['lastname'] 		= (isset($post_data['lastname']) ? $post_data['lastname'] : '');
					$user_data['surename'] 		= (isset($post_data['surename']) ? $post_data['surename'] : '');
					$user_data['gender'] 		= (isset($post_data['gender']) ? $post_data['gender'] : '');
					$user_data['web'] 			= (isset($post_data['web']) ? $post_data['web'] : '');
					$user_data['money'] 		= (isset($post_data['money']) ? $post_data['money'] : 0);
					$user_data['ip'] 	= (isset($post_data['ip']) ? $post_data['ip'] : '');
					$user_data['mac'] 	= (isset($post_data['mac']) ? $post_data['mac'] : '');
					$user_data['personal_id'] 	= (isset($post_data['personal_id']) ? $post_data['personal_id'] : '');
					$user_data['phone'] 		= (isset($post_data['phone']) ? $post_data['phone'] : '');
					$user_data['email'] 		= (isset($post_data['email']) ? $post_data['email'] : '');
					$user_data['address1'] 		= (isset($post_data['address1']) ? $post_data['address1'] : '');
					$user_data['address2'] 		= (isset($post_data['address2']) ? $post_data['address2'] : '');
					$user_data['district'] 		= (isset($post_data['district']) ? $post_data['district'] : '');
					$user_data['amphur'] 		= (isset($post_data['amphur']) ? $post_data['amphur'] : '');
					$user_data['province'] 		= (isset($post_data['province']) ? $post_data['province'] : '');
					$user_data['note'] 			= (isset($post_data['note']) ? $post_data['note'] : '');
					$user_data['pic_upload'] 	= (isset($post_data['file_name']) ? UPLOAD.$this->config->item('user_folder').$post_data['username'].'/'.$post_data['file_name'] : 'assets/images/noicon.jpg');
					$user_data['billingplan'] = (isset($post_data['billingplan']) ? $post_data['billingplan'] : $billingplan_name);

					$profile = $this->session->_serialize($user_data);
				
					//Voucher table
					$voucher = array(
					
						'username'		=>		$post_data['username'],
						'password'		=>		$post_data['password'],
						'billingplan'	=>		$billingplan_name,
						'created_by'	=>		$this->session->userdata('username'),
						'IdleTimeout'	=>		$billingplan->IdleTimeout,
						'valid_until'	=>		$date_radreply,
						'profile'		=>		$profile,
						'encryption'	=>		$gconf['encryption']
						
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
	}

}