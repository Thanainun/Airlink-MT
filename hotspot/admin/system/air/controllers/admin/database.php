<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Database
 *
 * Database Controller
 *
 * @package		database
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

Class Database extends My_Admin
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->model(array('billingplanmodel','usermodel','databasemodel'));
		$this->load->plugin('phpexcel');
		
	}
	
	function index()
	{
	
		$this->load->library('table');
		$this->load->helper('date');
		$this->load->helper('number');

		$tmpl = array ( 'table_open'  => '<table class="paginate  full">' );
		$db_lang = array('no','filename','createdate', 'filesize','action');
		$heading = array();
		for($i=0;$i<count($db_lang);$i++)
		{
			$heading[] = $this->lang->line('database_thead_'.$db_lang[$i]);
		}
		
		$this->table->set_template($tmpl);
		$this->table->set_heading($heading);

		$files = get_dir_file_info($this->config->item('backup_folder'), array('filenames','filesize','dates','permission'));

		$count = 1;

		foreach($files as $key => $value)
		{
		
			if(substr($value['name'], -3)=='zip' || substr($value['name'], -3)=='sql')
			{
			$number_row = array('data'=>$count,'width'=>'15px','align'=>'center');
			$time_row = array('data'=>unix_to_human($value['date'],TRUE,'th'),'align'=>'center');
			$byte_row = array('data'=>byte_format($value['size']),'align'=>'center');
			$act_row = array('data'=>anchor('admin/'.$this->uri->segment(2).'/download/'.$value['name'],'<img width="16" height="16" src='.other_asset_url('status-download.png','','images').'>','id="download" title="'.$this->lang->line('database_table_download').'"').' '.
							anchor('admin/'.$this->uri->segment(2).'/delete/'.$value['name'],'<img width="16" height="16" src='.other_asset_url('delete.gif','','images').'>','id="delete" title="'.$this->lang->line('database_table_delete').'"'),
							'width'=>'80px','align'=>'center');

			$this->table->add_row($number_row,$value['name'],$time_row,$byte_row,$act_row);
			$count++;
			}
		}

		$data['table'] = $this->table->generate();
		
		$allplan = $this->billingplanmodel->getBillingPlan('name');
		
		foreach($allplan->result() AS $plan_val)
		{
			$data['plan'][$plan_val->name] = $plan_val->name;
		}
		
		$js = "$(document).ready(function($) { $('form#export').validationEngine({promptPosition : 'topRight'}); });";
		
		$this->template	->add_css('validation/validationEngine.jquery.css?'._DATETIME)
						->add_js('validation/jquery.validationEngine-en.js?'._DATETIME)
						->add_js('validation/jquery.validationEngine.js?'._DATETIME)
						->add_js($js, 'embed')
						->write_view('left-content', 'admin/database/database_view', $data)
						->render();

	}

	function backup()
	{	
		$prefs = array(
						'tables'      => array(),  // Array of tables to backup.
						'ignore'      => array('traffic,trafficSummaries'),           // List of tables to omit from the backup
						'format'      => 'zip',             // gzip, zip, txt
						'filename'    => 'hotspot_database.sql',    // File name - NEEDED ONLY WITH ZIP FILES
						'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
						'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
						'newline'     => "\n"               // Newline character used in backup file
					  );

		$backup =& $this->dbutil->backup($prefs); 
		
		(isset($_POST['download'])) ? force_download('hotspotbackup.zip', $backup)  : write_file($this->config->item('backup_folder').date('d-M-Y_H:i').'.zip', $backup); 
		redirect('admin/database','location');
		
	}
	
	function import()
	{
		$config['upload_path'] = 'tmp/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '10000000';

		$this->load->library('upload', $config);

		$output = array();
		$data = array();
		$output['skip_user'] = '';
		
		if ( ! $this->upload->do_upload('excel_upload'))
		{
			$output['error'] = $this->upload->display_errors();

			//print $error;
		}
		else
		{
			$file_data = $this->upload->data();
			$objPHPExcel = new PHPExcel();
			
			if($file_data['file_ext']=='.xls' || $file_data['file_ext']=='.xlsx')
			{
				$objPHPExcel = PHPExcel_IOFactory::load($file_data['full_path']);
				$objWorksheet = $objPHPExcel->getActiveSheet();

				$col = $objWorksheet->getHighestColumn();
				
				for($i=2;$i<=$objWorksheet->getHighestRow();$i++)
				{
					$userdata = array();
					if($objWorksheet->getCell("A" . $i)->getCalculatedValue()!='')
					{
						if($col>="B")
						{
							for($ii="A";$ii<=$col;$ii++)
							{
								$dd = $objWorksheet->getCell($ii . 1)->getCalculatedValue();
								$userdata[$dd] = $objWorksheet->getCell($ii . $i)->getCalculatedValue();
								if($dd=='username') $output['skip_user'] = $ii;
							}
						}
						$data[] = $userdata;
					}
				}
			}

		}

		$output['info'] = $data;
		$allplan = $this->billingplanmodel->getBillingPlan('name',NULL,array('name'=>$_POST['group_import']))->row();
		$output['group'] = $allplan->name;
		$output['file_import'] = (isset($file_data['full_path'])) ? $file_data['full_path'] : '';

		$this->template	->write_view('left-content', 'admin/database/database_import', $output)
						->render();

	}
	
	function import_run()
	{

		$objPHPExcel = new PHPExcel();
		$dub = 0;
		
		if(isset($_POST['ok_import']))
		{
			$objPHPExcel = PHPExcel_IOFactory::load($_POST['file_import']);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$col = $objWorksheet->getHighestColumn();
				
			for($i=2;$i<=$objWorksheet->getHighestRow();$i++)
			{
				$userdata = array();
				$ckeck_skip = $objWorksheet->getCell($_POST['skip_user'] . $i)->getCalculatedValue();
				if($objWorksheet->getCell("A" . $i)->getCalculatedValue()!='' && (isset($_POST['ok_import'][(string)$ckeck_skip]) && $_POST['ok_import'][(string)$ckeck_skip]==(string)$ckeck_skip))
				{
					if($col>="B")
					{
						for($ii="A";$ii<=$col;$ii++)
						{
							$dd = $objWorksheet->getCell($ii . 1)->getCalculatedValue();
							$userdata[$dd] = (string)$objWorksheet->getCell($ii . $i)->getCalculatedValue();
						}
					}
					//เอาไปใส่ลงฐาน
					$userdata['billingplan'] = $_POST['group'];
					$reply = $this->databasemodel->database_import($userdata);
					if($reply['rep']==FALSE) $dub++;
					
					$reply['debug1'] = $dub;
				}
				
			}

			$all = count($_POST['ok_import']);
			$num_imp = $all - $dub;

			if($num_imp==$all)
			{
				$reply['rep'] = TRUE;
				$reply['msg'] = 'นำเข้าข้อมูลสำเร็จ '.$num_imp.' จากที่เลือก '.$all.' และมีีชื่อซ้ำ '.$dub.' รายการ';
			}
			else 
			{
				$reply['rep'] = FALSE;
				$reply['msg'] = 'นำเข้าข้อมูลสำเร็จ '.$num_imp.' จากที่เลือก '.$all.' และมีีชื่อซ้ำ '.$dub.' รายการ';
			}
			
			$reply['goback'] = base_url()."admin/database";

		}

		if (file_exists($_POST['file_import'])) unlink($_POST['file_import']);

		print json_encode($reply);

	}
	
	function export()
	{

		$db_temp = set_realpath('upload/backups/', FALSE);
		$date_backup = date('d-M-Y H:i:s').'/';
		if (!file_exists($db_temp)) @mkdir($db_temp);
		@mkdir($db_temp.'/'.$date_backup.'/');

		foreach($_POST['select_group'] AS $group)
		{
		
			$objPHPExcel = new PHPExcel();

			$output_data = $db_temp.$date_backup.$group.'.'.$_POST['ext'];

			$query = $this->usermodel->getdataVoucher('username,password,profile',array('billingplan'=>$group));
			$result_list = $query->result_array();
			
			$profile_column = array('firstname','lastname','surename','gender','web','mac','ip','personal_id','phone','email','address1','address2','district','amphur','province','note','pic_upload');

			$objPHPExcel->getActiveSheet()->setTitle('Group '.$group);
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'username');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'password');
			

			$col = "D";
			foreach($profile_column AS $data_column)
			{
				$objPHPExcel->getActiveSheet()->setCellValue($col.'1', $data_column);
				$col++;
			}

			$all_row = count( $result_list );
			for( $row=0; $row<$all_row; $row++ ) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, $row+2, $row+1);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, $row+2, $result_list[$row]['username']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, $row+2, $result_list[$row]['password']);
				
				
				$r = $row+2;
				$c = 3;
				$profile = $this->session->_unserialize($result_list[$row]['profile']);
				for($pro=0;$pro<count($profile_column);$pro++)
				{
					(isset($profile[$profile_column[$pro]])) ? $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $profile[$profile_column[$pro]]) : $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($c, $r, '');
					$c++;
				}
			}
			if (!file_exists($db_temp)) @mkdir($db_temp,755);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, ($_POST['ext']=='xlsx') ? 'Excel2007' : 'Excel5');
			$objWriter->save($output_data);

		}

		redirect('admin/database','location');

	}

	function delete()
	{
		$dirname = set_realpath($this->config->item('backup_folder'), TRUE);
		if (file_exists($dirname.$this->uri->segment(4))) unlink($dirname.$this->uri->segment(4));

		redirect('admin/database','location');
	}

	function download()
	{
		$dirname = set_realpath($this->config->item('backup_folder'), TRUE);
		$data = file_get_contents($dirname.$this->uri->segment(4)); // Read the file's contents
		$name = 'hotspotbackup.zip';

		force_download($name, $data);  
	}
	
	function progress_bar()
	{
		$uid = $this->usermodel->getdataVoucher('id');
		$progress['num'] = count($uid->result());
		$progress['rep'] = TRUE;
		print json_encode($progress);
	}

}
/* End of file database.php */
/* Location: ./system/nostradius/controllers/admin/database.php */