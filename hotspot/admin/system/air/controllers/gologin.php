<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Gologin
 *
 * Glologin Controller
 *
 * @package		gologin
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 * @Customization By Sarto nice
 * @Facebook facebook.com/sartonice
 * @Published 12/08/13 version 1.0 initial release
 * @Contact sartonice@gmail.com
 */
 
Class Gologin extends Hotspotlogin_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('security'));
		$this->load->library(array('form_validation','globals','user_agent'));
 		$this->load->model('Tracker_model');
		$this->Tracker_model->add_visit();
		

		$this->location = $this->uri->segment(3);
		
		if($this->agent->browser()=='Internet Explorer' && $this->agent->version()<7) $this->ie6 = TRUE;
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$use_template = (($this->agent->is_mobile()) || (isset($this->ie6))) ?  TEMPLATES: $conf_data['themes'];

		$template_url = str_replace(':3990','',base_url());
		
		$this->template->write('template_path',$template_url.'templates/hotspotlogin/'.$use_template.'/');

	}

	function index()
	{
		$auto_add_visit = TRUE; 
		//โหลดค่าทั่วไปจากการตั้งค่า
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		//-----
	
		if($this->agent->browser()=='Internet Explorer' && $this->agent->version()<7) $ie6 = TRUE;

		if($this->agent->is_mobile() || isset($this->ie6))
		
		{
			
		
			$state = $this->input->get('res', TRUE);
			$userurl = $this->input->get('userurl', TRUE);
			$redirurl = $this->input->get('redirurl', TRUE);
			$reply = $this->input->get('reply', TRUE);
			
			
			if($conf_data['mobile_redirect'] == '0') $gourl = 'mobileview';
			if($conf_data['mobile_redirect'] == '1') $gourl = $userurl;
	
			
			$form = array(
					'challenge'=>$this->input->get('challenge', TRUE),
					'uamip'=>$this->input->get('uamip', TRUE),
					'uamport'=>$this->input->get('uamport', TRUE),
					'userurl'=>$this->input->get('userurl', TRUE),
					);
		
			if($state=="success") 
			
			$this->template->write('meta_refresh', meta('refresh', '0;url='.$gourl, 'equiv'));
			
			if($reply) $this->template->write('message', $reply);
			
			$post_url = str_replace(':3990','',site_url('/mobile'.$this->uri->segment(3)));
			
			$copyright = $conf_data['copy_right'];
			
			$logo_mobile = '<img src='.base_url().'templates/mobilelogin/'.$conf_data['themesmobile'].'/images/'.$conf_data['mobilelogo'].'>';
			$this->template	->write('auth_url',$post_url)
							->write('logo',$logo_mobile)
							->write('login_copy',$copyright)
							->parse_view('hidden_form', 'public/mobile/hidden', $form);
		}
		
		
		$sigupnurl = ($conf_data['reg_on_off']==1) ? anchor('signup','Signup','id="signup"') : '';
		$login_header =($conf_data['hotspot']);
		$login_title = ($conf_data['hotspot_small']);
		$login_footer = 'ที่อยู่'."&nbsp;".$conf_data['address_text']."&nbsp;".$conf_data['tel_text']."&nbsp;".$conf_data['mail_text'];
		$ap = $this->remotemodel->getAccesspoint('accesspoint.login_page,accesspoint.register',array('nas.nasname'=>'internal'));
		$content_login = $ap->row();
		$login_page = $content_login->login_page;
		$content = (isset($this->ie6)) ? $this->template ->write_view('login_content','public/mobile/agen_view',array('login_page'=>$login_page)) :  $this->template->write('login_content',$login_page);
		
		$content_footer = (isset($this->ie6)) ? $this->template ->write_view('login_footer','public/mobile/agen_view',array('login_page'=>$login_footer)) :  $this->template->write('login_footer',$login_footer);
		$copyright = $conf_data['copy_right'];
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		$form ['address'] = $conf_data['address_text'];
		$form ['tel'] = $conf_data['tel_text'];
		$form ['mail'] = $conf_data['mail_text'];
		$form ['copyright'] = $conf_data['copy_right'];
		$form['header'] = '<img src='.base_url().'templates/'.'logo/'.$conf_data['hotspot'].'>';
		$form['facebook'] = $conf_data['facebook'];
		$form['twitter'] = $conf_data['twitter'];
		$form['site'] = $conf_data['blog'];
		$form['google'] = $conf_data['google'];
		$form['logotext'] = $conf_data['hotspottext'];
		$this->template ->write('site-name','')
						->write('header',($login_title))
						->write('signup_url', ($content_login->register==1) ? $sigupnurl : '')
						->parse_view('body', 'themes/hotspotlogin/loginform', $form)
						->render();
	}
	
	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("gologin","refresh");
		}
	
	
	function auth()
	{
		$uamsecret = $this->config->item('uamsecret');

		$username = (isset($_GET['username'])) ? $_GET['username'] : '' ;
		$password = (isset($_GET['password'])) ? $_GET['password'] : '' ;
		$challenge = (isset($_GET['challenge'])) ? $_GET['challenge'] : '' ;
		
		$user = $this->gologinmodel->getEncryption($username);

		$hexchal = @pack ("H32", $challenge);
		if ($uamsecret) {
			$newchal = pack ("H*", md5($hexchal . $uamsecret));
		} else {
			$newchal = $hexchal;
		}

		$encryption = (isset($user->encryption) ? $user->encryption : '' );

		switch($encryption) {
			case 'md5' :  $pass_decode = substr(md5($password),0,15);
						  break;
			case 'crypt' : $pass_decode = crypt($password,"BL");
						  break;
			case 'md5ums' : $pass_decode = substr(md5("O]O" . $password . "O[O"),0,15);
						  break;
			default : $pass_decode = $password;
		}

		$response['response'] = md5("\0" . $pass_decode . $newchal);
		
		print "chilliJSON.reply(".json_encode($response).")";
		
	}
	
	function md5($ab=null) 
	{
		print md5($ab);
	}

	function popup()
	{
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		
		$ap = $this->remotemodel->getAccesspoint('accesspoint.popup_page,accesspoint.announced_page',array('nas.nasname'=>'internal'));
		$content_login = $ap->row();
		
		$form_data = array(
						'changepwd_url'=>site_url('/gologin/changepass'),
						'contract_url'=>site_url('/gologin/contract'),
						'popup_message'=>$content_login->popup_page,
						'popup_announced'=>$content_login->announced_page,
						'popup_content'=>$conf_data['editor']
						);

		// โหลดป๊อบอัพ
		$this->template ->add_css('forms.css')
						->write('site-name','สถานะ ผูไช้งาน')
						->parse_view('body', 'themes/hotspotlogin/popup', $form_data)
						->render();

	}
	
	function dcontent($uid)
	{
		$data = $this->gologinmodel->getPopupcontent($uid);
		if(isset($data->popup_page))
		{
			$_str = str_replace(':81','',$data->popup_page);
			$_str = str_replace('https://','http://',$_str);
		}
		else
		{
			$_str = '';
		}
		print $_str;
	}
	
	function macdeny()
	{
		$this->template ->add_region('title')
						->write('site-name','Your device is not allow')
						->parse_view('body', 'themes/hotspotlogin/mac',array())
						->render();
	}
	
	function changepass()
	{
		$data = array('username'=>$this->uri->segment(3));
		$this->load->view('public/userform/changepass',$data);
	}

	function contract()
{ 
$this->load->model('usermodel');
$this->load->model('messagemodel');
$this->session->userdata('user');
$message_field = array(
array(
'field' => 'subject',
'label' => 'Subject',
'rules' => 'required'
),
array(
'field' => 'message',
'label' => 'Message',
'rules' => 'required'
)
);

$this->form_validation->set_rules($message_field);
$qu="";

if($this->form_validation->run() == TRUE)
{
$data = array(
'username'=>$this->session->userdata('user'),
'subject'=>$_POST['subject'],
'message'=>$_POST['message'],
'date'=>date('Y-m-d H:i:s')
);
$this->db->insert('message',$data);
//--------------------
$qu="<center><h3>ข้อความจาก Airlink</h3> </center><hr/><hr/>";
$msg_admin = $this->messagemodel->getMessage('id,username,subject,message',array('reply'=>$this->session->userdata('user')),"asc");
foreach($msg_admin->result() as $msg_data_admin)
{	
$qu.= "ผู้ดูแลระบบ :".$msg_data_admin->subject." :: ".nl2br($msg_data_admin->message).br(1);


}
$qu.="</br><hr/><center><h3>ข้อความ โต้ตอบ ติดต่อสอบถาม จากคุณ</h3> </center><hr/>";
$msg = $this->messagemodel->getMessage('id,username,subject,message',array('username'=>$this->session->userdata('user')));
foreach($msg->result() as $msg_data)
{	
$msgre = $this->messagemodel->getMessage('id,username,subject,message',array('reply'=>$msg_data->id),"asc");
$qu.= "<hr/>".$msg_data->username." ถาม :".$msg_data->subject." :: ".nl2br($msg_data->message).br(1);
foreach($msgre->result() as $msg_re)
{	
$qu.="->".$msg_re->username." ตอบกลับหัวข้อ :".$msg_re->subject." ว่า ".nl2br($msg_re->message).br(1);

}

}
$qu.="<hr/>".form_open('','name="msg_form" id="msg"').
form_label('หัวข้อ:'.nbs(5),'subject').
form_input('subject','','id="subject" autocomplete="off" class="validate[required] text-input"'). br(2).
form_label('ข้อความ:','message').
form_textarea(array('name'=>'message','style'=>'width:100%;','id'=>'message','class'=>'validate[required] text-input')).br(1)."
<input type=\"submit\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" name=\"send\" id=\"send\" value=\"ส่งข้อความ\"/>".
form_close();
//--------------------
print json_encode(array('sucess'=>true,'message'=>'<div align="center">ข้อความถูกส่งแล้ว</div>'.br(1).$qu));
}else{

//--------------------
$qu="<center><h3>ข้อความจาก Airlink</h3> </center><hr/><hr/>";
$msg_admin = $this->messagemodel->getMessage('id,username,subject,message',array('reply'=>$this->session->userdata('user')),"asc");
foreach($msg_admin->result() as $msg_data_admin)
{	
$qu.= "ผู้ดูแลระบบ :".$msg_data_admin->subject." :: ".nl2br($msg_data_admin->message).br(1);


}
$qu.="</br><hr/><center><h3>ข้อความ โต้ตอบ ติดต่อสอบถาม จากคุณ</h3> </center><hr/>";
$msg = $this->messagemodel->getMessage('id,username,subject,message',array('username'=>$this->session->userdata('user')),"asc");
foreach($msg->result() as $msg_data)
{	
$msgre = $this->messagemodel->getMessage('id,username,subject,message',array('reply'=>$msg_data->id),"asc");
$qu.= "<hr/>".$msg_data->username." ถาม :".$msg_data->subject." :: ".nl2br($msg_data->message).br(1);
foreach($msgre->result() as $msg_re)
{	
$qu.="->".$msg_re->username." ตอบกลับหัวข้อ :".$msg_re->subject." ว่า ".nl2br($msg_re->message).br(1);

}

}
$qu.="<hr/>".form_open('','name="msg_form" id="msg"').
form_label('หัวข้อ:'.nbs(5),'subject').
form_input('subject','','id="subject" autocomplete="off" class="validate[required] text-input"'). br(2).
form_label('ข้อความ:','message').
form_textarea(array('name'=>'message','style'=>'width:100%;','id'=>'message','class'=>'validate[required] text-input')).br(1)."
<input type=\"submit\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" name=\"send\" id=\"send\" value=\"ส่งข้อความ\"/>".
form_close();
//--------------------
$msg = $this->messagemodel->getMessage('id,username,subject,message',array('username'=>$this->session->userdata('user')));
echo "<div id=\"message_box\">";
echo $qu;
echo "</div>";

}

}
	
	function changepw()
	{
		$old_password = $this->input->post('old_password', TRUE);
		$new_passowrd = $this->input->post('new_password', TRUE);
		$confirm_password = $this->input->post('comfirm_password', TRUE);
		$username = $this->input->post('username', TRUE);
		
		$this->load->model('usermodel');
		
		$oldpass = $this->usermodel->getVoucher('password,userprofile',array('username'=>$username))->row();
		$user_data = $this->session->_unserialize($oldpass->userprofile);

		if($oldpass->password==$old_password)
		{
			if($new_passowrd!=$confirm_password)
			{
				$rep['rep'] = FALSE;
				$rep['msg'] = $this->lang->line('confirm_newpass');
			}
			else
			{
				$user_data['password'] = $new_passowrd;
				$user_data['username'] = $username;
				$rep = $this->usermodel->editVoucher($user_data);
			}
		}
		else
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = $this->lang->line('old_pass_false');
		}

		print json_encode($rep);
		
	}

	function check_user()
	{

		$die = $this->gologinmodel->checkUserdie($_GET['username']);
		if($die) 
		{
			$rep['rep'] = FALSE;
			$rep['msg'] = sprintf($this->lang->line('online_check_false'),$_GET['username']);
		}
		else
		{
			$rep['rep'] = TRUE;
			$rep['msg'] = sprintf($this->lang->line('online_check_true'),$_GET['username']);
		}

		print json_encode($rep);

	}


	function user_detail()
	{
		$this->load->helper('number');
		$user_data = $this->gologinmodel->getUserdata($this->uri->segment(3));
		$time_t=$user_data->valid_for/1000 ;
		
		if($user_data->type!='timeout' && $user_data->type!='monthly' && $user_data->type!='daily')
		{
			$time = ($user_data->type=='timetofinish') ? unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($user_data->start_time)) . ' + '.$user_data->amount.' day'), TRUE, 'th') : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($user_data->start_time)) . ' + '.$time_t.' day'), TRUE, 'th');
		}
		else
		{
			$time = '-';
		}
		
		if($user_data->type=='timetofinish') {
			$format_time = 'DHMS';
		} else {
			$format_time = 'HMS';
		}
	
		$profile = $this->session->_unserialize($user_data->userprofile);
		$time_th_e= $this->globals->datethai($time);
		$time_th_s= $this->globals->datethai($user_data->start_time);
		$data = array(
					'plan_type'=>$user_data->type,
					'plan_name'=>$user_data->plan,
					'start_time'=>$time_th_s,
					'packet_used'=>$user_data->packet_used,
					'end_time'=>$time_th_e,
					//'end_th'=>$time_th,
					//'end_time_v'=>$this->globals->thaidate($time),
					'format_time'=>$format_time,
					'userprofile'=>$profile
					);
		
		print json_encode($data);
		
	}
	
	function force_redirect()
	{
		$user_data = $this->gologinmodel->getUserdata($this->uri->segment(3));
		print prep_url($user_data->redirect_url);
	}
	
	function help()
	{
		return TRUE;
	}
	
}

/* End of file gologin.php */
/* Location: ./system/nostradius/controllers/gologin.php */