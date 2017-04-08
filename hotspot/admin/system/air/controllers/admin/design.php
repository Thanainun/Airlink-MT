<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Design
 *
 * Design Controller
 *
 * @package		design
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Design extends Admin_Fancybox
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('card','billingplanmodel'));
		
		$this->_username = $this->session->userdata('username');
		$this->_user_id = $this->session->userdata('user_id');
		
		if($this->_user_id==1)
		{
			$this->dir = UPLOAD.'card/';
			$this->dirname = set_realpath($this->dir, FALSE);
			if(!file_exists($this->dirname)) @mkdir ($this->dirname, 0755 );
		}
		else
		{
			$this->dir = UPLOAD.$this->config->item('user_folder').$this->_username.'/card/';
			$this->dirname = set_realpath($this->dir, FALSE);
			if(!file_exists($this->dirname)) @mkdir ($this->dirname, 0755 );
		}
		
		(!$this->tank_auth->is_logged_in()) ? redirect('/login/') : '';
		
	}
	
	function index()
	{

		if(isset($_POST['send']))
		{

			$item_fix = array();
			$item_custom = array();

			foreach($_POST as $key => $value)
			{
				if($key=='username' || $key=='password' || substr_replace($key ,"",9)=='username_'  || substr_replace($key ,"",9)=='password_')
				{
					$item_fix[$key] = $value;
				}
				else if(substr_replace($key ,"",7)=='custom_')
				{
					$item_custom[$key] = $value;
				}
			}
			
			$item_data = array(
						'item_fix'=>array('item'=>$item_fix),
						'item_custom'=>array('item'=>$item_custom),
						'images'=>$_POST['image'],
						);
			
			$data = array('value'=>$this->session->_serialize($item_data),'page'=>$_POST['paper']);
			$this->card->update($data);

		}

		$vf = array('x','y','font_color_r','font_color_g','font_color_b','font_style','font_size','font_name');
		
		$query = $this->card->getCardtpl('',$this->uri->segment(3));
		$val = $this->session->_unserialize($query->value);
		
		$username_html = '';
		$password_html = '';
		$custom_html = '';
		
		foreach($val['item_fix'] as $data)
		{
			//Username
			for($e=0;$e<count($vf);$e++) :
				$username_html .= '<input type="hidden" id="'.$vf[$e].'" class="in" value="'.(isset($data['username_'.$vf[$e]]) ? $data['username_'.$vf[$e]] : '').'" name="username_'.$vf[$e].'"/>';
			endfor;
			//Password
			for($e=0;$e<count($vf);$e++) :
				$password_html .= '<input type="hidden" id="'.$vf[$e].'" class="in" value="'.(isset($data['password_'.$vf[$e]]) ? $data['password_'.$vf[$e]] : '').'" name="password_'.$vf[$e].'"/>';
			endfor;
			
		}

		foreach($val['item_custom'] as $data => $value)
		{
			$c = 0;
			$b = 0;
			$num = (count($value))/(count($vf)+1);
			
			for($i=0;$i<$num;$i++)
			{

				if($b==1){ $c++; $b = 0; }

				if($num!=$i)
				{
					$custom_html .= '<div class="positionable" style="left: -1000px; top: 0px;">';
					$custom_html .= '<span id="text_tool" class="ui-icon ui-icon-circle-triangle-e"></span>';
					$custom_html .= '<div title="'.$this->lang->line('card_field_tooltip').'" id="example_text">'.$value['custom_msg_'.$c].'</div>';
					$custom_html .= '<input type="text" class="hidden" value="'.$value['custom_msg_'.$c].'" id="text_msg" name="custom_msg_'.$c.'" size="15"/>';

					for($f=0;$f<count($vf);$f++) :
						$custom_html .= '<input type="hidden" id="'.$vf[$f].'" class="in" value="'.(isset($value['custom_'.$vf[$f].'_'.$c]) ? $value['custom_'.$vf[$f].'_'.$c] : '').'" name="custom_'.$vf[$f].'_'.$c.'"/>';
					endfor;
					
					$custom_html .= '</div>';
				}
				$b++;
			}
		}
		
		$output['username_html'] = $username_html;
		$output['password_html'] = $password_html;
		$output['custom_html'] = $custom_html;
		$output['num'] = $num;
		$output['img_url'] = base_url().$this->dir.$val['images'];
		$output['img_name'] = $val['images'];

		$plan = $this->billingplanmodel->getBillingPlan('name',null, array('groupname'=>$query->template_name))->row();
		$output['template_name'] = $plan->name;
		
		$output['page'] = $query->page;

		$output['all_img'] = $this->globals->getCardimg();
		
		$this->template	->add_css('card.css?'._DATETIME)
						->add_js('jquery.tooltip.pack.js?'._DATETIME)
						->add_js('card.js?'._DATETIME)
						->write_view('content', 'admin/card/card_design', $output)
						->render();

	}
	
	function example()
	{
	
		$this->load->library('thaipdf');
		$this->load->library('pdf');

		$this->pdf->add_header($this->lang->line('card_example'));
		$this->pdf->add_footer($this->lang->line('card_example'));

		for($i=10;$i<38;$i++)
		{
			$user_data[] = 	array('username' => 'USER'.$i, 'password' => '123456', 'group' => 'TEST', 'expir' => 'May 16 2011 24:00:00');
		}

		$this->card->write_data($user_data);
		
		$this->pdf->render();

	}

	function getimg()
	{
		$t = $this->globals->getCardimg();
		print $t;
	}
	
}
/* End of file design.php */
/* Location: ./system/nostradius/controllers/admin/design.php */