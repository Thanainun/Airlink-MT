<?php

class Pdf
{

	function __construct()
	{

		$this->CI =& get_instance();
		
		$this->_username = $this->CI->session->userdata('username');
		$this->_user_id = $this->CI->session->userdata('user_id');
		
		if($this->_user_id==1)
		{
			$this->dir = UPLOAD.'card/';
			$this->dirname = set_realpath($this->dir, FALSE);
		}
		else
		{
			$this->dir = UPLOAD.$this->CI->config->item('user_folder').$this->_username.'/card/';
			$this->dirname = set_realpath($this->dir, FALSE);
			if(!file_exists($this->dirname)) @mkdir ($this->dirname, 0755 );
		}

	}
	
	function add_header($header='', $charset='utf8')
	{
		$this->CI->thaipdf->charset = $charset;
		
		$this->CI->thaipdf
					->SetThaiFont()
					->SetTextColor(0,0,0)
					->SetFont('FreesiaUPC','B',16)
					->SetHeader($header, 1, 'R', 1);
	}
	
	function add_footer($footer='')
	{
		$this->CI->thaipdf->SetFooter($footer, 1, 'L', 1);
	}
	
	function addpage()
	{
		$this->CI->thaipdf->SetTextColor(0,0,0)->AddPage();
	}
	
	function config_page($val, $posi, $row, $tpl)
	{
		// กำหนดขนาดเริ่มต้น ของบัตร แต่ละแบบ (0 = เต้มหน้า, 1 = 2x4, 2 = 3x7)
		//	$f = ทดขนาดฟอนท์ , $w = ความกว้างของรูป , $h = ความสูงของรูป , $pad = ระยะห่างของแตะละรูป , $div x หรือ  y = ปรับระยะด้านขวา และ ด้านล่าง
		if($tpl==0) : $f = 1; $w = 189; $h = 108; $pad = 130; $div_x = 2.3; $div_y = 2.3; endif;
		if($tpl==1) : $f = 1; $w = 92; $h = 50; $pad = 60; $div_x = 4.8; $div_y = 5; endif;
		if($tpl==2) : $f = 1.5; $w = 62; $h = 35; $pad = 36; $div_x = 7; $div_y = 7.6; endif;

		//เช็คว่า มีรูปหรือไม่ หากมี ให้กำหนดตำแหน่ง
		if(isset($val['images']) && $val['images']!='') : 
			if(file_exists($this->dirname.$val['images'])) $this->CI->thaipdf->Image($this->dirname.$val['images'],$posi+2,20 +  $row * $pad, $w, $h);
		endif; // ไม่มีรูป ไม่ต้องกำหนด

		// {{ เขียนค่า กรอบข้อความ แบบ Static ก่อน
		foreach($val['item_fix'] as $data) :
		
			$_fix = array('username','password');

			for($i=0;$i<2;$i++) : // รอบที่ 0 คือ username รอบที่ 1 คือ password

				$text = $data[ $_fix[$i] ];
				$Lx = Round(((int)$data[$_fix[$i].'_x']/$div_x),2);
				$Ly	= Round(((int)$data[$_fix[$i].'_y']/$div_y),2);
				$font_name = 	$data[$_fix[$i].'_font_name'];
				$font_size = 	($data[$_fix[$i].'_font_size']/$f);
				$font_style = 	$data[$_fix[$i].'_font_style'];
				$font_color_r = $data[$_fix[$i].'_font_color_r'];
				$font_color_g = $data[$_fix[$i].'_font_color_g'];
				$font_color_b = $data[$_fix[$i].'_font_color_b'];

				$this->CI->thaipdf->SetFont( $font_name, $font_style , $font_size)
								->SetTextColor( $font_color_r, $font_color_g, $font_color_b )
								->Text($posi+$Lx+1.5,23+$Ly + $row * $pad,$text);

			endfor;

		endforeach; // }} จบการเขียนค่า ชื่อผู้ใช้ และรหัสผ่าน
		
		// เขียนค่ากรอบข้อความ
		foreach($val['item_custom'] as $block => $item) : 

			$c = $b = 0;
			$num = (count($item))/9;
			
			for($ii=0;$ii<$num;$ii++)
			{
			
				if($b==1){ $c++; $b = 0; }
					
				if($num!=$ii)
				{
					$text = $item['custom_msg_'.$c];
					$Lx = Round(((int)$item['custom_x_'.$c]/$div_x),2);
					$Ly	= Round(((int)$item['custom_y_'.$c]/$div_y),2);
					$font_name = 	$item['custom_font_name_'.$c];
					$font_size = 	($item['custom_font_size_'.$c]/$f);
					$font_style = 	$item['custom_font_style_'.$c];
					$font_color_r = $item['custom_font_color_r_'.$c];
					$font_color_g = $item['custom_font_color_g_'.$c];
					$font_color_b = $item['custom_font_color_b_'.$c];

					$this->CI->thaipdf->SetFont( $font_name, $font_style , $font_size)
									->SetTextColor( $font_color_r, $font_color_g, $font_color_b )
									->Text($posi+$Lx+1.5,23+$Ly + $row * $pad,$text);
				}
				$b++;
			}

		endforeach;  // จบการเขียนกรอบข้อความ

	}

	function render($name='', $type='')
	{
		$this->CI->thaipdf->render($name, $type);
	}

}