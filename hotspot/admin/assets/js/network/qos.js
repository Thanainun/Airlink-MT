jQuery(document).ready(function($) {

	$('form#form_qos').submit(function() { 
		var form_data = $(this).serialize();
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
						if(data.rep) {
						msg_id.html('กำลังเริ่มการทำงาน Firewall ใหม่กรุณารอสักครู่');
					$.getJSON(base_url+'index.php/'+controller+recon_op+'qos', function (data) {
						if(data.rep) {
						msg_id.html('การตั้งค่าเสร็จสมบูรณ์แล้ว! โปรแกรมตรวจสอบสถาน่ะการทำงานของ Firewall');
					} else {
						d.dialog('close');
						dialog_msg('เกิดข้อผิดพลาด','firewall ไม่สามารถเริ่มทำงานใหม่ได้','error');
					} 
					});
					
					} else {
						msg_id.html(data.msg);
					}
				
			} else {
				dialog_msg('ข้อผิดพลาด',data.msg,'error');
			}
		},"json");
		
		return false;
	
	});

});