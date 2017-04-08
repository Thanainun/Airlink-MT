<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Message
 *
 * Message Controller
 *
 * @package		message
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Message extends My_Admin
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('messagemodel');
		$this->load->library(array('form_validation','globals'));
	}
	
	function index()
	{
		$this->load->library('table');
		$this->load->helper('date');
		$this->load->helper('number');

		$tmpl = array ( 'table_open'  => '<table class="paginate  full">' );
		$db_lang = array('no','username','subject', 'date','action');
		$heading = array();
		for($i=0;$i<count($db_lang);$i++)
		{
			$heading[] = $this->lang->line('message_thead_'.$db_lang[$i]);
		}
		
		$this->table->set_template($tmpl);
		$this->table->set_heading($heading);

		$msg = $this->messagemodel->getMessage();

		foreach($msg->result() as $value)
		{
		
			$mail_icon = ($value->read==0) ? other_asset_url('email.png','','images') : other_asset_url('mail_open_document_text.png','','images');

			$number_row = array('data'=>img(array('src'=>$mail_icon)),'width'=>'15px','align'=>'center');
			$username = array('data'=>anchor('admin/message/read/'.$value->id,$value->subject),'align'=>'left','width'=>'270px');
			$message = array('data'=>$value->date,'align'=>'center','width'=>'150px');
			$act_row = array('data'=>anchor('admin/message/delete/'.$value->id,'<img width="16" height="16" src='.other_asset_url('delete.gif','','images').'>','id="delete" title="'.$this->lang->line('database_table_delete').'"'),
							'width'=>'25px','align'=>'center');

			$this->table->add_row($number_row,$value->username,$username,$message,$act_row);


		}
 
		$data['table'] = $this->table->generate();
	
		$this->template	->write_view('left-content', 'admin/message/message_view', $data)
						->render();
	}
	function sentto()
	{
		

		$message_field = array(
							   array(
									 'field'   => 'subject',
									 'label'   => 'Subject',
									 'rules'   => 'required'
								  ),
							   array(
									 'field'   => 'reply',
									 'label'   => 'Reply',
									 'rules'   => 'required'
								 ),
							   array(
									 'field'   => 'message',
									 'label'   => 'Message',
									 'rules'   => 'required'
								  )
							);

		$this->form_validation->set_rules($message_field);

		if($this->form_validation->run() == TRUE)
		{
			$data = array(
					'username'=>$this->session->userdata('username'),//จาก session
					'subject'=>$_POST['subject'],
					'message'=>$_POST['message'],
					'reply'=>$_POST['reply'],//ส่งถึง
					'date'=>date('Y-m-d H:i:s')
					);
			$this->db->insert('message',$data);
			print '<div align="center">ระบบได้ส่งข้อความไปถึงคุณ '.$_POST['reply']. 'เรียบร้อยแล้ว</div>';
			redirect('admin/message');
		}
		else
		{	$this->template	->write_view('left-content', 'admin/message/message_view')
						->render();
			
		}
	}
	function read()
	{
		$read_id = $this->uri->segment(4);
		$msg = $this->messagemodel->getMessage('username,subject,message',array('id'=>$read_id));
		$msg_data = $msg->result_array();
		
		$this->messagemodel->setRead($read_id);
		
		$this->template	->write_view('left-content', 'admin/message/message_read', $msg_data[0])
						->render();
						
		
		$message_field = array(
							   array(
									 'field'   => 'subject',
									 'label'   => 'Subject',
									 'rules'   => 'required'
								  ),
							   array(
									 'field'   => 'reply',
									 'label'   => 'Reply',
									 'rules'   => 'required'
								 ),
							   array(
									 'field'   => 'message',
									 'label'   => 'Message',
									 'rules'   => 'required'
								  )
							);

		$this->form_validation->set_rules($message_field);

		if($this->form_validation->run() == TRUE)
		{
			$data = array(
					'username'=>$this->session->userdata('username'),//จาก session
					'subject'=>$_POST['subject'],
					'message'=>$_POST['message'],
					'reply'=>$_POST['reply'],//ส่งถึง
					'date'=>date('Y-m-d H:i:s')
					);
			$this->db->insert('message',$data);
			print '<div align="center">ระบบได้ส่งข้อความเรียบร้อยแล้ว</div>';
			
		}
		$msg = $this->messagemodel->getMessage('id,username,subject,message',array('reply'=>$read_id),"asc");
		foreach($msg->result() as $msg_data)
		{
		
		$this->messagemodel->setRead($msg_data->id);
		
		$this->template	->write_view('left-content', 'admin/message/message_re', $msg_data)
						->render();		
		}
		
		
			$this->template	->write_view('left-content', 'admin/message/message_reply')
						->render();
			
		
	}
	
	function delete()
	{
		$delete_id = $this->uri->segment(4);
		$this->messagemodel->msgDelete($delete_id);
		redirect('admin/message');
	}
	
	function message_ckecker()
	{
		$this->load->model('messagemodel');
		$amount = $this->messagemodel->check_new();
		
		$rep['amount'] = $amount;
		$rep['msg'] = sprintf($this->lang->line('message_box_newmsg'),$amount);
		$rep['alert'] = sprintf($this->lang->line('globals_message_boxalert'),$amount);
		
		print json_encode($rep);
	}

	function delete_all(){
		if($this->db->empty_table('message')){
		//$this->db->empty_table('message');
	 	redirect('admin/message');
	 	} 
	}
	
}