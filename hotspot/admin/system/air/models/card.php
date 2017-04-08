<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class Card extends CI_Model {

	function __construct()
	{
	
		parent::__construct();
		
		$this->_table = "card";
		
		$this->load->library('pdf');
		
	}
	
	function getCardtpl($field='*' , $tpl)
	{
		$where['template_name'] = $tpl;
		
		return $this->db->select($field)
						->where($where)
						->get($this->_table)
						->row();
	}

	function write_data($user_data)
	{
	
		(isset($_POST['billingplan'])) ? $tpl = $_POST['billingplan'] : $tpl = $this->uri->segment(4);
	
		$query = $this->card->getCardtpl('value,page',$tpl);
		
		// $setFlag => 0 = เต็มหน้า , 1 = ชนาด 2X4, 2 = ขนาด 3X7
		($this->uri->segment(5)=='2x4') ? $fl = 1 : $fl = 2;
		$setFlag = ($this->uri->segment(4)=='') ? $query->page : $fl; 
	
		$position[0] = array(8);
		$position[1] = array(8,106); 
		$position[2] = array(8,71,134); 
		$item_num = array(1,8,21);

		$row = 0;
		$flag = 0;
		foreach ($user_data as $value)
		{
			if($row % $item_num[$setFlag] == 0) :
				$this->pdf->addpage();
				$newrow = 0;
			endif;

			$value = $this->card->parsing($value, $query->value);
			$value = $this->session->_unserialize($value);

			$this->pdf->config_page($value, $position[$setFlag][$flag], $newrow, $setFlag);

			if($flag>=$setFlag) { $newrow++; $flag=0; } else { $flag++; }
			$row++;

		}
	}

	function parsing($user_data, $card_template)
	{

		$card_template = str_replace('%USER%', $user_data['username'], $card_template);
		$card_template = str_replace('%PASS%', $user_data['password'], $card_template);

		return $card_template;

	}
	
	function addPdfcard($tpl_name)
	{
		
		$origin_data = array(
								'template_name'=>$tpl_name,
								'value'=>'a:3:{s:8:"item_fix";a:1:{s:4:"item";a:18:{s:8:"username";s:7:"%USER%";s:10:"username_x";s:3:"214";s:10:"username_y";s:2:"99";s:21:"username_font_color_r";s:1:"0";s:21:"username_font_color_g";s:1:"0";s:21:"username_font_color_b";s:1:"0";s:19:"username_font_style";s:0:"";s:18:"username_font_size";s:2:"14";s:18:"username_font_name";s:10:"AngsanaNew";s:8:"password";s:6:"%PASS%";s:10:"password_x";s:3:"216";s:10:"password_y";s:3:"143";s:21:"password_font_color_r";s:1:"3";s:21:"password_font_color_g";s:1:"3";s:21:"password_font_color_b";s:1:"4";s:19:"password_font_style";s:0:"";s:18:"password_font_size";s:2:"14";s:18:"password_font_name";s:10:"AngsanaNew";}}s:11:"item_custom";a:1:{s:4:"item";a:0:{}}s:6:"images";s:7:"001.png";}',
								'page'=>'1'
							);
		
		$this->db->trans_start();
		
		$this->db->insert($this->_table,$origin_data);
		
		$this->db->trans_complete();
		
	}
	
	function create($name='',$type='')
	{
		$this->pdf->render($name,$type);
	}
	
	function update($data)
	{
		$this->db->trans_start();
		
		$this->db->where(array('template_name'=>$this->uri->segment(3)));
		$this->db->update('card',$data);
		
		$this->db->trans_complete();
	}
	
}

?>