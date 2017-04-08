<?php if(! defined('BASEPATH')) exit ('No Direct Script access allowed');

//Author : Bank Jirapan


		
 Class forgot_password extends Hotspotlogin_Controller{

 	public function index(){
		$config = $this->siteconfigmodel->getConfig('global_config');
		$conf_data = $this->session->_unserialize($config->value);
		$langselect = $conf_data['language'];
		$lang = $this->session->userdata("lang")==null?"$langselect":$this->session->userdata("lang");
		$this->lang->load($lang,$lang);
		
 		$data['title'] = "ผู้ใช้ลืมรหัสผ่าน";
		$data ['tel_text'] = $conf_data['tel_text'];
		//$data ['address'] = $reg['address_text'];
 		$this->load->view('forgot/forgot_view',$data);

 } 
  	function languser($type)
	{
		$this->session->set_userdata('lang',$type);
		redirect ("forgot_password","refresh");
		}
		
 function check(){
    $this->load->library('My_PHPMailer');
 	$id_card_in = $this->input->post('id_card');
 	$where = "personal_id = '$id_card_in'";
 	$this->db->select('personal_id,email,username,password');
//ดึงข้อมูลออกมา
 	$get_data = $this->db->get_where('voucher',$where)->result();

//ดึงข้อมูลการตั้งค่า จากฐานข้อมูล maill
	$mail_set = $this->db->get('mail_setting')->result();

// วนลูป สร้างตัวแปร
  foreach ($mail_set as $mail_set){
	$protocol = $mail_set->protocol;
	$host = $mail_set->host;
	$port = $mail_set->port;
	$user = $mail_set->user;
	$pass = $mail_set->password;
	$head = $mail_set->header_mg;
	$sub  = $mail_set->sub_mg;
  }
 //--------------------------------------
 	foreach ($get_data as $key) {
 		$card_id =  $key->personal_id;
 		$email_card = $key->email;
 		$username = $key->username;
 		$password = $key->password;
 	}

 	    if($card_id != $id_card_in){
       echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('ไม่มีข้อมูลรหัสบัตรประชาชนเลขที่ . $id_card_in ในระบบ')
    window.location.href='../../index.php/forgot_password';
    </SCRIPT>");
      } else {
			 $this->load->library('My_PHPMailer');
			   date_default_timezone_set("Asia/Bangkok"); 
				$message = '<html><body>';
				$message .='สวัสดีครับ คุณ'.$username.'คุณทำรายการลืมรหัสเมื่อเวลา<br>'.date('d-m-Y ,H:i:s');
				$message .='<br>';
				$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$message .= "<tr style='background: #eee;'><td><strong>ชื่อเข้าใช้งาน:</strong> </td><td>".$username;"</td></tr>";
				$message .= "<tr><td><strong>รหัสผ่าน:</strong> </td><td>".$password;"</td></tr>";
				$message .= "<tr><td><strong>ขอขอบคุณที่ใช้บริการครับบ ^^</strong>";
				$message .= "</table>";
				$message .= "</body></html>";
			 $mail = new PHPMailer();

				$mail->IsSMTP(); // we are going to use SMTP
				$mail->CharSet = "UTF-8";
				$mail->SMTPAuth   = true; // enabled SMTP authentication
				$mail->SMTPSecure = $protocol;  // prefix for secure protocol to connect to the server
				$mail->Host       = $host;      // setting GMail as our SMTP server
				$mail->Port       = $port;                   // SMTP port to connect to GMail
				$mail->Username   = $user;  // user email address
				$mail->Password   = $pass;            // password in GMail
				$mail->setFrom($user,$head);
				$mail->addAddress($email_card, 'User : '.$username);     // Add a recipient 
				$mail->isHTML(true);       
				$mail->Subject = $sub;
				$mail->Body    = $message;
		if(!$mail->send()) {
			echo 'ไม่สามารถส่งข้อความได้';
			echo 'อีเมล์ ไม่ถูกต้อง: ' . $mail->ErrorInfo;
		} else {
			$data['mail'] = $email_card;
			$this->load->view('forgot/finish_view',$data);
		 }
        
	  }
 }
 }
 	
 