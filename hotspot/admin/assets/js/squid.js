jQuery(document).ready(function($) {

	$('form#form_proxy').submit(function() {
		var form_data = $(this).serialize();
		var save_op = '/saveconfig/save';
		var squid_op = '/configchange/stop/squid3';
		var recon_op = '/configchange/reconfig/';

		$.post(base_url+'index.php/'+controller+'/saveconfig', form_data, function (data) {

			if(data.rep) {
				var d=dialog_msg('กำลังโหลดการตั้งค่าใหม่','<div id="message_config">Wait ...</div>');
				var msg_id = $('div#message_config');
				msg_id.html('บันทึกข้อมูลการตั้งค่า');
				$.getJSON(base_url+'index.php/'+controller+save_op, function (data) {
					msg_id.html(data.msg);
					if(data.rep) {
				msg_id.html('หยุดการทำงานของ squid...');
				$.getJSON(base_url+'index.php/'+controller+squid_op, function (data) {
					msg_id.html(data.msg);
					if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Squid ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'squid', function (data) {
						if(data.rep) {
						msg_id.html('ล้างหน่วยความจำและเคลียร์แคชทั้งหมดของระบบ');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'clear', function (data) {
						
						if(data.rep) {
						msg_id.html('การตั้งค่า Squid3 เสร็จสมบูรณ์แล้ว');
					} else {
						d.dialog('close');
						dialog_msg('เกิดข้อผิดพลาด','squid3 ไม่สามารถเริ่มทำงานใหม่ได้','error');
					} });
					} });
					} });
					} else {
						msg_id.html(data.msg);
					}
				});
			} else {
				dialog_msg('ข้อผิดพลาด',data.msg,'error');
			}
		},"json");
		
		return false;
	
	});

});