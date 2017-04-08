<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Stiatistic
 *
 * Stiatistic Controller
 *
 * @package		stiatistic
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Analyzer extends MY_Admin
{ 
	function __construct()
	{
		parent::__construct();
		
		//load the models 
		$this->load->model(array('analyzermodel','logmodel'));
		$this->load->helper('number'); 
		
	} 
	
	function index()
	{
		$this->template	->add_css('datatable/table_his.css?')
						->add_js('datatable/jquery.dataTablesh.min.js?')
						->add_js('datatable/analyzer.js')
						->write_view('left-content', 'admin/analyzer/analyzer_view')
						->render();

	}

	function json()
	{	
		$this->db->limit(20000,0);
		$logs_list = $this->logmodel->getUserlogs(NULL,NULL,NULL,array('seq '=>'asc'));
		
		$output = array("aaData" => array());
		
		$count=1;
		
		foreach($logs_list->result() as $row)
		{
			$jdata = array();

			$jdata[] .= $count++;
			$jdata[] .= $row->host;
			$jdata[] .= $row->facility;
			$jdata[] .= $row->priority;
			$jdata[] .= $row->datetime;
			$jdata[] .= $row->program;
			$jdata[] .= $row->msg;
			$output['aaData'][] = $jdata;
			
		}
		
		$this->output->enable_profiler(FALSE);
		print json_encode($output);
		
	}
	
	
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน การแสดงสถิติระบบ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}

}
	
/* End of file statistic.php */
/* Location: ./system/nostradius/controllers/admin/statistic.php */
