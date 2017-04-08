<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Group
 *
 * Group Controller
 *
 * @package		group
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Group extends MY_Admin
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('billingplanmodel','siteconfigmodel','card','jsonmodel'));
		$this->load->library('form_validation');

	}
	
	function index()
	{

		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->add_css('datatable/table_jui.css?'._DATETIME)
						->add_js('datatable/jquery.dataTables.min.js?'._DATETIME)
						->add_js('datatable/group.js?'._DATETIME)
						->write_view('left-content', 'admin/billingplan/billingplan_view',array())
						->render();

	}
	
	function addgroup()
	{
		$config = array(
					   array(
							 'field'   => 'name',
							 'label'   => 'Group name',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'profile',
							 'label'   => 'Profile',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'amount',
							 'label'   => 'Amount',
							 'rules'   => 'required'
						  ),   
					   array(
							 'field'   => 'valid_for',
							 'label'   => 'Valid for',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'price',
							 'label'   => 'Price',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'bw_download',
							 'label'   => 'Download',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'bw_upload',
							 'label'   => 'Upload',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'IdleTimeout',
							 'label'   => 'Idle Timeout',
							 'rules'   => 'required'
						  ),
					   
						  
					);

		$this->form_validation->set_rules($config); 
		
		if($this->form_validation->run()==FALSE)
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('globals_message_formerror');
		}
		else 
		{
			$rep = $this->billingplanmodel->BillingPlan($_POST);
		}
		
		print json_encode($rep);
		
	}
	
	function editgroup()
	{
		$config = array(
					   array(
							 'field'   => 'name',
							 'label'   => 'Group name',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'profile',
							 'label'   => 'Profile',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'amount',
							 'label'   => 'Amount',
							 'rules'   => 'required'
						  ),   
					   array(
							 'field'   => 'valid_for',
							 'label'   => 'Valid for',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'price',
							 'label'   => 'Price',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'bw_download',
							 'label'   => 'Download',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'bw_upload',
							 'label'   => 'Upload',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'IdleTimeout',
							 'label'   => 'Idle Timeout',
							 'rules'   => 'required'
						  ),
					  
			
					);

		$this->form_validation->set_rules($config); 
		
		if($this->form_validation->run()==FALSE)
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('globals_message_formerror');
		}
		else 
		{
			$rep = $this->billingplanmodel->BillingPlan($_POST);
		}
		
		print json_encode($rep);
		
	}
	
	/**
	 * Delete billing plan, defined by id on $this->uri->segment()
	 *
	 */
	function delete()
	{
		print json_encode($this->billingplanmodel->deleteBillingPlan());
	}
	
	function getform()
	{
		$group_data = array('name'=>'','groupname'=>'','profile'=>'','type'=>'','amount'=>'','valid_for'=>'','price'=>'','IdleTimeout'=>'5','simultaneous'=>'1','logintime'=>'Al','redirect_url'=>'','bw_upload'=>'256000','bw_download'=>'512000','hidden_group'=>'','disabled'=>'','no'=>'0',); 
		print $this->load->view('admin/billingplan/billingplan_form',$group_data);
	} 
	
	function editform($gname)
	{
		$group_data = $this->billingplanmodel->getBillingPlan(null,null,array('groupname'=>$gname))->row();
		$group_data->hidden_group = form_hidden('profile',$group_data->profile);
		$group_data->disabled = 'disabled=disabled';

		print $this->load->view('admin/billingplan/billingplan_form', $group_data);
	}
	
	function json()
	{
		
		$this->output->enable_profiler(FALSE);
		print $this->billingplanmodel->data_table();

	}
	
	function groupexist()
	{
		$return['status'] = $this->billingplanmodel->check_duplicate_billingplan($_GET['fieldValue']);
		print json_encode($return);
	}

	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน กลุ่มผู้ใช้งาน</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}

}

/* End of file group.php */
/* Location: ./system/nostradius/controllers/admin/group.php */
