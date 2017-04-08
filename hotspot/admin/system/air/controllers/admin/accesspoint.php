<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Accesspoint
 *
 * Accesspoint Controller
 *
 * @package		accesspoint
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Accesspoint extends MY_Admin
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('remotemodel');
		$this->load->helper('js');
		
	}

	function index()
	{
		$da = date('YmdHis');
	
		$this->template	->add_css('datatable/table_jui.css?'.$da)
						->add_css('validation/validationEngine.jquery.css?'.$da)
						->add_css('elrte/elrte.min.css?'.$da)
						->add_css('elfinder/elfinder.css?'.$da)
						->add_js('elrte/elrte.min.js?'.$da)
						->add_js('elfinder/elfinder.min.js?'.$da)
						->add_js('validation/jquery.validationEngine-en.js?'.$da)
						->add_js('validation/jquery.validationEngine.js?'.$da)
						->add_js('datatable/jquery.dataTables.min.js?'.$da)
						->add_js('datatable/accesspoint.js?'.$da)
						->write_view('left-content', 'admin/accesspoint/accesspoint_view',array())
						->render();

	}
	
	function apform()
	{

		$data['submit'] = 'action/'.$this->uri->segment(4);
		
		if($this->uri->segment(4)=='edit')
		{
			//get current data
			$where = array('name'=>$this->uri->segment(5));
			$data['accesspoint'] = $this->remotemodel->getAccesspoint('',$where,'');
		}
		
		$this->load->view('admin/accesspoint/accesspoint_from',$data);
		
	}
	
	function del()
	{
		print json_encode($this->remotemodel->deleteAp($this->uri->segment(4)));
	}
	
	function json()
	{
		$this->output->enable_profiler(FALSE);
		print $this->remotemodel->jsonQuery();
	}
	
	function action()
	{
		$config = array(
					   array(
							 'field'   => 'name',
							 'label'   => 'AP name',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'nasname',
							 'label'   => 'Nasname',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'secret',
							 'label'   => 'Secret',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'type',
							 'label'   => 'Type',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'calledstationid',
							 'label'   => 'IP address',
							 'rules'   => 'required'
						  ),
					   array(
							 'field'   => 'location',
							 'label'   => 'Location',
							 'rules'   => 'required'
						  ),

					);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE)
		{
		
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('globals_message_formerror');

		}
		else
		{

			$rep = ($this->uri->segment(4)=='edit') ? $this->remotemodel->edit($_POST) : $this->remotemodel->addAp($_POST);

		}
		
		print json_encode($rep);

	}
	
	function config()
	{
	
		//get the voucher data
		$data['accesspoint'] = $this->remotemodel->getAccesspoint(NULL,array('name'=>$this->uri->segment(4)),NULL);
		$data['dynip'] = base_url()."remote/address/".$this->uri->segment(4);		
		echo $this->load->view('admin/accesspoint/accesspoint_pdf',$data, TRUE);
	
	}

	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน จุดเชื่อมต่อ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
}
/* End of file accesspoint.php */
/* Location: ./system/nostradius/controllers/admin/accesspoint.php */