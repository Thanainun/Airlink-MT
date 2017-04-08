<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Globals {

	function __construct()
	{
		
		$this->CI =& get_instance();
		
		$this->_username = $this->CI->session->userdata('username');
		$this->_user_id = $this->CI->session->userdata('user_id');
		
		if($this->_user_id==1)
		{
			$this->dir = UPLOAD.'card/';
			$this->dirname = set_realpath($this->dir.'card', FALSE);
		}
		else
		{
			$this->dir = UPLOAD.$this->CI->config->item('user_folder').$this->_username.'/card/';
			$this->dirname = set_realpath($this->dir, FALSE);
			if(!file_exists($this->dirname)) @mkdir ($this->dirname, 0755 );
		}
		
	}
	
	function build_menu($active)
	{
	
		$main_menu = array('dashboard','analyse','user','group','accesspoint','onlineuser','statistic','network','setting');
		$quick_menu = array('files','proxy','advproxy','database','analyzer');
		$mt_menu = array('clients','connections','dnscache');
		$output = '';
		
		// สร้างเมนูหลัก
		foreach($main_menu as $value)
		{
			$output .= ($active==$value || ($active=='' && $value=='dashboard')) ? '<li class="active">': '<li>';
			$output .= anchor('admin/'.$value,$this->CI->lang->line('main-nav_'.$value),'').'</li>';
		}
		
		$output .= '<li id="quick-links"><a href="#">'.$this->CI->lang->line('mt_header').'<span>&darr;</span></a><ul>';
		
		foreach($mt_menu as $value)
		{
			$menu_lang = $this->CI->lang->line('mt_'.$value);
			$output .= '<li>'.anchor('admin/'.$value,$menu_lang,'title="'.$menu_lang.'"').'</li>';
		}
		
		$output .= '</ul><li>';
		
		// สร้าง เมนูตั้งค่า
		$output .= '<li id="quick-links"><a href="#">'.$this->CI->lang->line('quick-links_header').'<span>&darr;</span></a><ul>';
		
		foreach($quick_menu as $value)
		{
			$menu_lang = $this->CI->lang->line('quick-links_'.$value);
			$output .= '<li>'.anchor('admin/'.$value,$menu_lang,'title="'.$menu_lang.'"').'</li>';
		}
		
		$output .= '</ul><li>';
		
		return $output;
	
	}
	
	function setMsg($msg)
	{
		$attr = array('class','id');
		$data = '';

		( ! is_array($msg)) ? $msg = array('id'=>'','class'=>'','msg'=>$msg) : '' ;

		$data .= '<div';
		foreach($attr as $attr_val) {
			$data .= (isset($msg[$attr_val])) ? ' '.$attr_val.'="'.$msg[$attr_val].'"' : '';
		}

		$data .= '>'.$msg['msg'].'</div>';
		$this->CI->session->set_flashdata('flashMessage', $data);

		return true;
	}
	
	function get_expir($profile, $data, $valid, $exp_days)
	{
		$output='';
		
		if( $data != null ) 
		{
			$output = preg_replace('/00:00:00/', '', unix_to_human($exp_days, TRUE, 'th')); 
		}
		else if($profile != 'timetofinish' ||  $data == null ) 
		{ 
			$output = preg_replace('/24:00:00/', '', $valid); 
		} 
		else 
		{ 
			$output = '---';
		}
		
		return $output;
	}
	
	function get_packet_remain($packet, $start, $profile)
	{
		$output='';
		
		if($packet == '' || $packet == 'null' || $packet < 0) 
		{
			if(($start==null) or ($profile!='packets')) 
			{ 
				$output = '---'; 
			} 
			else 
			{ 
				$output = '0'; 
			}
		} 
		else 
		{ 
			$output = byte_format($packet) ; 
		}
		
		return $output;
		
	}
	
	function get_used($data, $type)
	{

		if($data == '' || $data == 'null' || $data <= 0)  
		{
			return  '---'; 
		}
		else
		{
			return  ($type=='time') ? time_data($data,'hm') : byte_format($data);
		}
		
	}
	
	function get_status($profile, $valid, $start_time, $exp_days, $publish, $valid_until)
	{
		$output = '';
	
		if($publish!='Reject') 
		{		$output = '<img class="master_key" src="'.base_url().ASSETS.'images/unlock.png" >';
			 
				if(strtotime(date('Y-m-d H:i:s'))>=$exp_days && $start_time!=null) 
				{
					$output = '<img width="16" height="16" src="'.base_url().ASSETS.'images/reddot.png" >';
				}
				 if($valid == 'exp'&& $profile != 'timetofinish') 
				{
					$output = '<img width="16" height="16" src="'.base_url().ASSETS.'images/reddot.png" >';
				}
			 if( date('Y-m-d H:i:s')>= date( "Y-m-d H:i:S", strtotime( $valid_until ) )  ) 
				{
					$output = ' <img width="16" height="16" src="'.base_url().ASSETS.'images/reddot.png" >';
				}
			
			
		} 
		else 
		{ 
			$output = '<img class="master_key" src="'.base_url().ASSETS.'images/lock.png" >'; 
		}
		
		return $output;
	}
	
	function get_action_table($username, $url)
	{
		return anchor($url.'form/action/edit/'.$username, '#','class="edit tooltip" info="แก้ไขข้อมูล : '.$username.'" style="display:none;" id="edit"');
	}
	
	function datethai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear เวลา  $strHour:$strMinute:$strSeconds";
	}

	
	function thaidate($str) 
	{
		$str = preg_replace('/24:00:00/', '', $str);
		
		$m = substr($str, 0, 3);
		$d = substr($str, 4, 2);
		$y = substr($str, 7, 4) + 543;
		$month = array("January"=>"ม.ค.", "February"=>"ก.พ.", "March"=>"มี.ค", "April"=>"เม.ย.", "May"=>"พ.ค.", "June"=>"มิ.ย.", "July"=>"ก.ค.", "August"=>"ส.ค.", "September"=>"ก.ย.", "October"=>"ต.ค.", "November"=>"พ.ย.", "Dec"=>"ธ.ค.");
		
		return $d." ".$month[$m]." ".$y;
	}
	
	function getCardimg()
	{

		$this->CI->load->helper('file');

		$all_file = get_filenames($this->dir);

		$htmlOut = '';

		for($i=0;$i<count($all_file);$i++)
		{
			$c = $i+1;
			(isset($all_file[$i]) && (strtolower(substr($all_file[$i], -3))=='gif' || strtolower(substr($all_file[$i], -3))=='jpg' || strtolower(substr($all_file[$i], -3))=='png')) ?
				$htmlOut .= '<div class="scroll-content-item ui-widget-header">'.img(array('src'=>$this->dir.$all_file[$i],'id'=>$all_file[$i],'width'=>'100%','height'=>'100%')).'</div>'
			:
				$htmlOut .= '<div class="scroll-content-item ui-widget-header">'.$c.'</div>';
		}

		return $htmlOut;

	}
	
	function conv_date($amount)
	{
	
		$month = date('F');
		$day = date('j');
		$year = date('Y');
		$time = '24:00:00';
		$date = mktime(0,0,0, date('m'), $day+$amount, $year);
		
		$out['radcheck'] = date("F j Y", $date)." ".$time;
		$out['radreply'] = date("Y-n-j", $date)."T".$time;
		
		return $out;
		
	}
	
}