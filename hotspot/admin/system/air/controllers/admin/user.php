<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User
 *
 * User Controller
 *
 * @package		user
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class User extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		
		//load models
		$this->load->model(array('billingplanmodel','usermodel','gologinmodel','siteconfigmodel'));
		//load libraries
		$this->load->library(array('form_validation','table'));
		$this->load->helper(array('js','freeradius','mikrotik'));
		
	}
	
	function index()
	{
	
		$data['form_open'] = form_open('',array('id'=>'form_delete'));
		
		$group = $this->billingplanmodel->getBillingPlan('name,groupname');

		foreach($group->result() AS $row)
		{
			$data['gdata'][$row->groupname] = $row->name;
		}
		
		$this->template	->add_css('datatable/table_jui.css?v='._DATETIME)
						->add_css('validation/validationEngine.jquery.css?v='._DATETIME)
						->add_css('jquery.autocomplete.css?v='._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?v='._DATETIME)
						->add_js('validation/jquery.validationEngine.js?v='._DATETIME)
						->add_js('datatable/jquery.dataTables.min.js?v='._DATETIME)
						->add_js('datatable/user.js?v='._DATETIME) //เพิ่ม javascript ลงในเทมเพลต
						->add_js('jquery.autocomplete-min.js?v='._DATETIME) //เพิ่ม javascript ลงในเทมเพลต
						->write_view('left-content', 'admin/user/user_table', $data)
						->render();

	}
	
	function multidelete()
	{
		$this->output->enable_profiler(FALSE);

		if(isset($_GET['user_data']) && $_GET['user_data']!='')
		{
		
			$number = count($_GET['user_data']);
		
			foreach($_GET['user_data'] as $value)
			{
			
				if($value['name']=="check_del")
				{
					$this->usermodel->multidelete($value['value']);
					$rep['rep'] = TRUE;
					if($number>1) { $rep['msg'] = sprintf($this->lang->line('user_message_multidelete_success'), $number); }
					else { $rep['msg'] = sprintf($this->lang->line('user_message_delete_success'), $value['value']); }
				}
				
			}

		}
		else
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('user_message_delete_error');
		}
		
		print json_encode($rep);

	}
	
	function moveto()
	{
		$this->output->enable_profiler(FALSE);

		$post_user = $this->input->post('username', TRUE);
		$post_group = $this->input->post('group', TRUE);
		$billingplan = $this->billingplanmodel->getBillingPlan(null,null,array('groupname'=>$post_group))->row();
		$price=$billingplan->price;
		$bname=$billingplan->name;
		
		
		foreach($post_user AS $user)
		{	
			$this->billingplanmodel->changeGroup($user['value'],$post_group);
			
				$this->db->where('username',$user['value']);
				$this->db->delete('radacct');
				
				$datetime=date("Y-m-d H:i:s");
				$topup = array(
								'username'=>$user['value'],
								'cashcard'=>'money',
								'billingplan'=>$bname,
								'date'=> $datetime,
								'price' =>$price,
								'detail'=>'Admin'
								);
				$this->db->insert('topup_queue',$topup);
								
		}
		
		print "เติมเวลาด้วยเพ็คเก็ต $bname   สำเร็จ";

	}
	
	function vprint()
	{

		$this->output->enable_profiler(FALSE);
		
		$this->lang->load('date');
		$this->lang->load('number');

		//get the voucher data
		$data['voucher'] = $this->usermodel->getVoucher(null,array('username'=>$this->uri->segment(4)),null);

		$this->usermodel->setPrintedVoucher();
		
		$html = $this->load->view('admin/user/user_print',$data);

	}
	
	function info() 
	{
		$this->output->enable_profiler(FALSE);
	
		$user = (isset($_GET['user_data'])) ?  $_GET['user_data'] : $this->uri->segment(4);

		if($user)
		{
			$data['datauser'] = $this->usermodel->getVoucher(null,array('username'=>$user));
			$data['history'] = $this->usermodel->getAccountUsage('',array('username'=>$user));
			
			$data['userprofile'] = $this->session->_unserialize($data['datauser']->row()->userprofile);
			
			$this->load->view('admin/user/ajax_info', $data);
		}
		$this->output->enable_profiler(FALSE);
	}
	
	function userdata()
	{
		$this->output->enable_profiler(FALSE);
		
		print $this->usermodel->data_table();
	}

	function status_lock()
	{
	
		$this->output->enable_profiler(FALSE);
	
		$count = 0;
		foreach($_POST['username'] as $value)
		{

			if($value['name']=="check_del")
			{
				$this->usermodel->updatePublish(array('username'=>$value['value'],'status'=>$_POST['status']));
				$count++;
			}

		}

		$rep['rep'] = TRUE;
		if($count>1)
		{
			$rep['msg'] = ($_POST['status']=='unlock') ? sprintf($this->lang->line('user_message_multi_lock'), $count) : 
							sprintf($this->lang->line('user_message_multi_unlock'), $count);
		}
		else
		{
			$rep['msg'] = ($_POST['status']=='unlock') ? sprintf($this->lang->line('user_message_lock'), $value['value']) : 
							sprintf($this->lang->line('user_message_unlock'), $value['value']);
		}
		
		print json_encode($rep);
		
	}
	
	
	function user_auth()
	{
		$this->output->enable_profiler(FALSE);

		$this->load->helper(array('randomuser'));
		$option = array('count'=>1,'requests'=>1,'retries'=>3,'timeout'=>5);
		$pass = $this->usermodel->getdataVoucher('password,encryption',array('username'=>$this->uri->segment(4)))->row();
		print freeradius_auth($option,$this->uri->segment(4),encryption($pass->password,$pass->encryption),$this->config->item('radiuscommand'),$this->config->item('radiusserver_auth'),$this->config->item('radiussecret'));
	}

	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ส่วนจัดการผู้ใช้</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
}
/* End of file user.php */
/* Location: ./system/nostradius/controllers/admin/user.php */