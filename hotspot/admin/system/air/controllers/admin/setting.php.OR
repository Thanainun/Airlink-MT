<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Setting
 *
 * Setting Controller
 *
 * @package		setting
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Setting extends MY_Admin
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model(array('siteconfigmodel','billingplanmodel'));

		$this->_user_id = $this->session->userdata('user_id');
	}
	
	function index()
	{
	
		$this->output->enable_profiler(FALSE);

		//get billingplan
		$billingplans = $this->billingplanmodel->getBillingPlan('id,name,groupname','');

		$rules = array(
						array(
							'field'=>'create_amount',
							'label'=>'Create amount',
							'rules'=>'required'
							),
						array(
							'field'=>'reg_on_off',
							'label'=>'Reg on off',
							'rules'=>'required'
							),
						array(
							'field'=>'reg_group',
							'label'=>'Reg group',
							'rules'=>'required'
							),
						array(
							'field'=>'encryption',
							'label'=>'Encryption',
							'rules'=>'required'
							)
					);
					
		$this->form_validation->set_rules($rules);
		
		//โหลดค่า ทั่วไป
		$global = $this->siteconfigmodel->getConfig('global_config');
		$val = $this->session->_unserialize($global->value);
		
		$val['sl'] = array();
		foreach($billingplans->result() as $option)
		{
			$val['sl'][$option->name] = $option->name;
		}
		
		$data = get_dir_file_info(ASSETS.'css/jquery-ui/', $top_level_only = TRUE);
		foreach($data AS $d=>$b)
		{
			$val['theme_name'][$d] = $d;
		}
		//ดึงโฟลเดอร์ธีมหน้าล็อกอินทั้งหมด
		$data = get_dir_file_info('templates/hotspotlogin', $top_level_only = TRUE);
		
		foreach($data AS $d=>$b)
		{	
				$val['themeslogin'][$d] = $d;
				
		}
		
		//ดึงโฟลเดอร์ธีมหน้าลงทะเบียนทั้งหมด
		$data = get_dir_file_info(APPPATH.'/views/user', $top_level_only = TRUE);
		
		foreach($data AS $d=>$b)
		{	
				$val['themeregis'][$d] = $d;
				
		}
		
		//ดึงโฟลเดอร์ธีมหน้าล็อกอินทั้งหมดสำหรับโทรศัพท์
		$data = get_dir_file_info('templates/mobilelogin', $top_level_only = TRUE);
		
		foreach($data AS $d=>$b)
		{	
				
				$val['mobilelogin'][$d] = $d;
				
		}

		$data = get_dir_file_info('templates/mobileview/', $top_level_only = TRUE);
		
		foreach($data AS $d=>$b)
		{	
				
				$val['mobileview'][$d] = $d;
				
		}
		$data = get_dir_file_info('templates/logo/', $top_level_only = TRUE);
		
		foreach($data AS $d=>$b)
		{	
				$val['logos'][$d] = $d;
				
		}
		
		if($this->form_validation->run() == FALSE){
		
		$js_editer = "
			$().ready(function() {
				var opts = {
					cssClass : 'el-rte',
					height   : 150,
					toolbar  : 'complete',
					cssfiles : ['assets/css/elrte/elrte-inner.css'],
				fmOpen : function(callback) {
					$('<div id=\"myelfinder\" />').elfinder({
						url : base_url+'index.php/admin/files/connector',
						lang : 'en',
						dialog : { width : 570, modal : true, title : 'elFinder - จัดการไฟล์' },
						closeOnEditorCallback : true,
						editorCallback : callback
					})
				}
				}
				$('#editor').elrte(opts);
			});
		";
		
		$mobile_editor = "
			$().ready(function() {
				var opts = {
					cssClass : 'el-rte',
					height   : 150,
					toolbar  : 'complete',
					cssfiles : ['assets/css/elrte/elrte-inner.css'],
				fmOpen : function(callback) {
					$('<div id=\"myelfinder\" />').elfinder({
						url : base_url+'index.php/admin/files/connector',
						lang : 'en',
						dialog : { width : 570, modal : true, title : 'elFinder - จัดการไฟล์' },
						closeOnEditorCallback : true,
						editorCallback : callback
					})
				}
				}
				$('#mobile_editor').elrte(opts);
			});
		";
		
		
		$this->template	->add_css('elrte/elrte.min.css?'._DATETIME)
						->add_css('elfinder/elfinder.css?'._DATETIME)
						->add_js('elrte/elrte.min.js?'._DATETIME)
						->add_js('elrte/elrte.ru.js?'._DATETIME)
						->add_js('elfinder/elfinder.min.js?'._DATETIME)
						->add_js($js_editer, 'embed')
						->add_js($mobile_editor, 'embed')
						->write_view('left-content', 'admin/setting/setting_view', $val)
						->render();

			}else{
			
				if($this->_user_id==1)
				{
					$data_p = array('value'=>$this->session->_serialize($_POST));
					$this->siteconfigmodel->updateConfig('global_config',$data_p);

					if($_POST['debuging']=='on') { $this->session->set_userdata('debug', 'on'); } else { $this->session->unset_userdata('debug', 'off'); }
				}
				
				redirect('admin/setting', 'location');
				
			}
	}

	function help()
	{
	
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน การตั้งค่าระบบ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
		
	}
	
}
/* End of file setting.php */
/* Location: ./system/nostradius/controllers/admin/setting.php */