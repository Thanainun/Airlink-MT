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

Class Statistic extends MY_Admin
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		//load the models 
		$this->load->model(array('statisticmodel','usermodel','onlineusermodel'));
		$this->load->helper('number'); 
		
	}
	
	function index()
	{	$data['start'] = $this->input->post('start');
		$data['end'] = $this->input->post('end');
		$data['pp'] = $this->statisticmodel->getAll();
		$data['get'] = $this->uri->segment(4);
        
		if($data['start'] !='' && $data['end'] != ''){
		$data['pp'] = $this->statisticmodel->get($data['start'],$data['end']);

		}
		if($this->uri->segment(4)== 'getm'){
		$data['pp'] = $this->statisticmodel->getm();
		}
		if($this->uri->segment(4)== 'getd'){
		$data['pp'] = $this->statisticmodel->getd();
		}
		if($this->uri->segment(4)== 'gety'){
		$data['pp'] = $this->statisticmodel->gety();
		}

		$js = "var get = '".$this->uri->segment(4)."/".$data['start']."/".$data['end']."'";
		
		
		$this->template	->add_css('datatable/table_jui.css?'._DATETIME)
						->add_js($js,'embed')
						->add_js('datatable/jquery.dataTables.min.js?'._DATETIME)
						->add_js('datatable/datetimepicker.js?'._DATETIME)
						->add_js('datatable/statistic.js?'._DATETIME)
						->write_view('left-content', 'admin/statistic/statistic_view',$data)
						->render();

	}

	function json()
	{
		
		$where = 'and start_time <= "'.date('Y-m-d H:i:s').'"';
		$where2 = 'and t.date <= "'.date('Y-m-d H:i:s').'"';
		$start = $this->uri->segment(5);
		$end = $this->uri->segment(6);
		
		
		
		// สำหรับเดือนนี้
		if($this->uri->segment(4)== 'getm'){
		
		$where = 'and start_time >= "'.date('Y-m').'-01 00:00:00" and  start_time <= "'.date('Y-m-d H:i:s').'" ';
		$where2 = 'and t.date >= "'.date('Y-m').'-01 00:00:00" and t.date <= "'.date('Y-m-d H:i:s').'" ';
		}
		if($start !='' && $end != ''){
		$where = 'and start_time >= "'.$start.' 00:00:00" and  start_time <= "'.$end.' 23:59:59"';
		$where2 = 'and t.date >= "'.$start.' 00:00:00" and t.date <= "'.$end.' 23:59:59" ';
		}
		if($this->uri->segment(4)== 'getd'){
		
		$where = 'and start_time >= "'.date('Y-m-d').' 00:00:00" and start_time <= "'.date('Y-m-d H:i:s').'" ';
		$where2 = 'and t.date >= "'.date('Y-m-d').' 00:00:00" and t.date <= "'.date('Y-m-d H:i:s').'" ';

		}
		if($this->uri->segment(4)== 'gety'){
		
		$where = 'and start_time >= "'.date('Y').'-01-01 00:00:00" and start_time <= "'.date('Y').'-12-31 23:59:59"  ';
		$where2 = 'and t.date >= "'.date('Y').'-01-01 00:00:00" and t.date  <= "'.date('Y').'-12-31 23:59:59"  ';
		}

		


		$user_list = $this->statisticmodel->getVoucherTopup("
		
		SELECT v.username, v.billingplan , IF( isnull(v.start_time), 'มีการเติมเงินแต่ยังไม่ได้ใช้งาน' ,v.start_time)as start_time,v.time_used,v.packet_used, count( t.username ) AS numrow, sum( t.price ) AS price
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username  $where2
		GROUP BY v.username
		union 
		SELECT username, billingplan , start_time,time_used,packet_used,'-' as numrow, price
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null  $where
		

		");
		
		
		$output = array("aaData" => array());
		
		$count=1;
		
		foreach($user_list->result() as $row)
		{
			$jdata = array();

			$jdata[] .= $count++;
			$jdata[] .= anchor('admin/statistic/history/'.$row->username.'/'.$row->price.'/'.$this->uri->segment(4).'/'.$start.'/'.$end,$row->username ,'title="ลายละเอียด"');
			$jdata[] .= $row->billingplan;
			$jdata[] .= $row->start_time;
			$jdata[] .= time_data($row->time_used,'hm');
			$jdata[] .= byte_format($row->packet_used);
			$jdata[] .= $row->numrow;
			$jdata[] .= number_format($row->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')). ' '.$this->config->item('currency_symbol_pdf');

			$output['aaData'][] = $jdata;
			
		}
		
		$this->output->enable_profiler(FALSE);
		print json_encode($output);
		
	}
	
	function history() 
	{	
		$js = "var uid = '".$this->uri->segment(4)."/".$this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8)."'";
		$data['datauser'] = $this->usermodel->getVoucher(null,array('username'=>$this->uri->segment(4)));
		$this->template ->add_css('datatable/table_jui.css?'._DATETIME)
						->add_js($js,'embed')
						->add_js('datatable/jquery.dataTables.min.js?'._DATETIME)
						->add_js('datatable/user_history.js?'._DATETIME)
						->write_view('left-content', 'admin/statistic/user_history', $data)
						->render();
	}
	
	function json_history()
	{
		$where = 'and date <= "'.date('Y-m-d H:i:s').'"';
		
		$start = $this->uri->segment(6);
		$end = $this->uri->segment(7);
		
		
		
		// สำหรับเดือนนี้
		if($this->uri->segment(5)== 'getm'){
		
		$where = 'and date >= "'.date('Y-m').'-01 00:00:00" and  date <= "'.date('Y-m-d H:i:s').'" ';
		
		}
		if($start !='' && $end != ''){
		$where = 'and date >= "'.$start.' 00:00:00" and  date <= "'.$end.' 23:59:59"';
		
		}
		if($this->uri->segment(5)== 'getd'){
		
		$where = 'and date >= "'.date('Y-m-d').' 00:00:00" and date <= "'.date('Y-m-d H:i:s').'" ';
		
		}
		if($this->uri->segment(5)== 'gety'){
		
		$where = 'and date >= "'.date('Y').'-01-01 00:00:00" and date <= "'.date('Y').'-12-31 23:59:59"  ';
		}

	$history = $this->statisticmodel->getVoucherTopup("SELECT * FROM topup_queue WHERE username =  '".$this->uri->segment(4)."' $where ");
	
		$output = array("aaData" => array());
		
		$count=1;
		foreach($history->result() AS $value)
		{
			
				$jdata = array();

				$jdata[] .= $count++;
				$jdata[] .= $value->billingplan;
				$jdata[] .=$value->detail;
				$jdata[] .= $value->date;
				$jdata[] .= $value->cashcard;
				$jdata[] .= number_format($value->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')). ' '.$this->config->item('currency_symbol_pdf');

				$output['aaData'][] = $jdata;
				
			
		}
		$this->output->enable_profiler(FALSE);
		print json_encode($output);
	}

	function daysused()
	{
		
		$this->output->enable_profiler(FALSE);

		for($i=0;$i<=31;$i++) {
		$j = $i;
		$monthuse[] =  $this->onlineusermodel->get_accessdays(date("Y-m").'-'.$i.' 00:00:00', date("Y-m").'-'.$j++.' 23:59:59');
		}
		
		$peak = 100;
		print "
		&title=".sprintf($this->lang->line('statistic_graph_headl'),date('F Y')).",{font-size:14px; color: #bcd6ff; margin:10px; background-color: #5E83BF; padding: 5px 15px 5px 15px;}&
		&x_axis_steps=1&
		&x_axis_3d=12&
		&y_legend=&
		&y_ticks=5,10,5&
		&bg_colour=#FFFFFF&
		&x_labels=01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31&
		&x_axis_colour=#909090&
		&x_grid_colour=#ADB5C7&
		&y_axis_colour=#909090&
		&y_grid_colour=#ADB5C7&
		&line_dot=3,#0066CC,".$this->lang->line('statistic_graph_user_login').",10,5&
		&y_min=0&
		&values=";


		for($i=1;$i<=31;$i++) {
			foreach($monthuse[$i]->result() as $row) {

				if($i==31) { print $row->accesscount.'&';
					if($row->accesscount>$peak) { $check=ceil($row->accesscount/$peak); $peak = $peak * $check; }
				 } else {
					print $row->accesscount.',';
					if($row->accesscount>$peak) { $check=ceil($row->accesscount/$peak); $peak = $peak * $check; }
				}
			}
		}

		print '&y_max='.$peak.'&';
	}

	function linegraph2()
	{
	
		$this->output->enable_profiler(FALSE);
		
		$peak = 1000;
		print "
		&title=สถิติรายรับ,{font-size:14px; color: #bcd6ff; margin:10px; background-color: #5E83BF; padding: 5px 15px 5px 15px;}&
		&x_axis_steps=1&
		&x_axis_3d=12&
		&y_legend=&
		&y_ticks=5,10,10&
		&bg_colour=#FFFFFF&
		&x_labels=มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม&
		&x_labels_2=มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม&
		&x_axis_colour=#909090&
		&x_grid_colour=#ADB5C7&
		&y_axis_colour=#909090&
		&y_grid_colour=#ADB5C7&
		&line_dot=3,#c40000,".(date('Y')-1).",10,5&
		&line_dot_2=3,#0066CC,".date('Y').",10,5&
		&y_min=0&";
		for($i=1;$i<=12;$i++){
			$pyear[] = $this->onlineusermodel->get_accessmonth((date('Y')-1).'-'.$i);
		}
		
		print "&values=";
		for($i=0;$i<=11;$i++){
			foreach($pyear[$i]->result() as $row) {
				if($row->price==null) { print ($i==11) ? '0& ' : '0,'; } else { print ($i==11) ? $row->price.'& ' : $row->price.','; }
				if($row->price>$peak) { $check=ceil($row->price/$peak); $peak = $peak * $check; }
			}
		}
		
		for($ii=1;$ii<=12;$ii++){
			$pyear2[] = $this->onlineusermodel->get_accessmonth((date('Y')).'-'.$ii);
		}
		
		print "&values_2=";
		for($i=0;$i<=11;$i++){
			foreach($pyear2[$i]->result() as $row) {
				if($row->price==null) { print ($i==11) ? '0& ' : '0,'; } else { print ($i==11) ? $row->price.'& ' : $row->price.','; }
				if($row->price>$peak) { $check=ceil($row->price/$peak); $peak = $peak * $check; }
			}
		}
		print "&y_max=$peak&";
	}
	
	function receipts()
	{
		$this->output->enable_profiler(FALSE);
		
		$peak = 1000;
		print "
		&title=".$this->lang->line('statistic_graph_headb').",{font-size:14px; color: #bcd6ff; margin:10px; background-color: #5E83BF; padding: 5px 15px 5px 15px;}&
		&x_label_style=11,#000000,2&
		&x_axis_steps=1&
		&y_legend=".$this->lang->line('statistic_graph_receipts').",12,#736AFF&
		&y_ticks=5,10,10&
		&x_labels=January,February,March,April,May,June,July,August,September,October,November,December&
		&y_min=0&
		&bg_colour=#FDFDFD&
		&x_axis_colour=#909090&
		&x_grid_colour=#D2D2FB&
		&y_axis_colour=#909090&
		&y_grid_colour=#D2D2FB&
		&bar_fade=55,#C31812,".(date('Y')-1).",10& ";
		for($i=1;$i<=12;$i++){
			$pyear[] = $this->onlineusermodel->get_accessmonth((date('Y')-1).'-'.$i);
		}
		
		print "&values=";
		for($i=0;$i<=11;$i++){
			foreach($pyear[$i]->result() as $row) {
				if($row->price==null) { print ($i==11) ? '0& ' : '0,'; } else { print ($i==11) ? $row->price.'& ' : $row->price.','; }
				if($row->price>$peak) { $check=ceil($row->price/$peak); $peak = $peak * $check; }
			}
		}
		
		print "&bar_fade_2=55,#424581,".date('Y').",10& ";
		
		for($ii=1;$ii<=12;$ii++){
			$pyear2[] = $this->onlineusermodel->get_accessmonth((date('Y')).'-'.$ii);
		}
		
		print "&values_2=";
		for($i=0;$i<=11;$i++){
			foreach($pyear2[$i]->result() as $row) {
				if($row->price==null) { print ($i==11) ? '0& ' : '0,'; } else { print ($i==11) ? $row->price.'& ' : $row->price.','; }
				if($row->price>$peak) { $check=ceil($row->price/$peak); $peak = $peak * $check; }
			}
		}
		print "&y_max=$peak&";
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
