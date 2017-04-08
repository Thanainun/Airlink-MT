jQuery(document).ready(function($) {

	$('form#form_network').submit(function() {
		var form_data = $(this).serialize();
		var chilli_op = '/configchange/stop/chilli';
		var recon_op = '/configchange/reconfig/';
		
		$.post(base_url+'index.php/'+controller+'/saveconfig', form_data, function (data) {

			if(data.rep) {
				var d=dialog_msg('กำลังโหลดการตั้งค่าใหม่','<div id="message_config">Wait ...</div>')
				.dialog({
				resizable: false,
				height:320,
				width:600,
				//modal: true,
				close: function() {
					$(this).remove();
				}})
				var msg_id = $('div#message_config');
				msg_id.html('หยุดการทำงานของ chilli...');
				$.getJSON(base_url+'index.php/'+controller+chilli_op, function (data) {
					msg_id.html(data.msg);
					if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Apache2 ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'apache2', function (data) {
						if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Squid ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'squid', function (data) {
						if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Freeradius ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'freeradius', function (data) {
						if(data.rep) {
						msg_id.html('ล้างหน่วยความจำของระบบ');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'clear', function (data) {
						if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Chilli ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'chilli', function (data) {
						if(data.rep) {
						msg_id.html('การตั้งค่าเสร็จสมบูรณ์แล้ว! เครื่องลูกและอุปกรณ์เชื่อมต่อต้องรับไอพีใหม่');
					} else {
						d.dialog('close');
						dialog_msg('เกิดข้อผิดพลาด','Chilli ไม่สามารถเริ่มทำงานใหม่ได้','error');
					} });
					} else {
						d.dialog('close');
						dialog_msg('เกิดข้อผิดพลาด','Freeradius ไม่สามารถเริ่มทำงานใหม่ได้','error');
					} });
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