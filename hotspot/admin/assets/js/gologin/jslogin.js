/*
 * @Hotspot login javascript
 * @เขียนโดย สุนทร จอนมี
 * @Email vnus_tar@hotmail.com
 * @ใช้งานกับ Coovachilli
 *
 * @สิ่งที่ต้องใช้ร่วมกัน -> Jquery 1.6+, Jquery-countdown.js, ChillilLibrary.js
 * @อ้างอิง coova.org, codeigniter.com, linuxthai.org
 *
 * Javascript เขียนด้วย jquery framework เป็นส่วนใหญ่ สามารถใช้กับอุปกรณ์มือถือที่สามารถใช้งาน Wi-Fi ได้ และติดตั้งโปรแกรม QR Code reader เพื่อล๊อกอินอัตโนมัติ สำหรับอุปกรณ์มือถือเท่านั้น
 *
**/

$(function() {

	var _i_ ='';
	var chillispot_popup = cts = msg_ck = false;
	var message = $('[rel=reply]');
	var popupSize = $('div[rel=popup_size]');
	var checkbox_remem = $('input[type=checkbox][name=is_remember]');
	var input_user = $('input[name=UserName]');
	var input_pass = $('input[name=Password]');
	var button_submit = $('button[type=submit]');
	var from_login = $("form[name=form1]");
	var logout_link = $('a[href=logout]');
	var popup = 'chillispot_popup';
	var popup_w = popupSize.attr('width');
	var popup_h = popupSize.attr('height');
	if(popup_w==null) { popup_w = '500'; }
	if(popup_h==null) { popup_h = '375'; }
	var popup_size = 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width='+popup_w+',height='+popup_h;
	var preload = popupSize.html('');
	var timeleft, sessiontime;
	var img_tag = '';
	var label_style = $('div.countdown_section').attr('time_label');
	var goUrl = null;
	var clientstate;
	
	if(compact_dis=='1') compact_to = true;
	else compact_to = false;

	button_submit.click(function() {
		if((input_user.val()!='') && (input_pass.val()!='') && (clientstate==0)) {
			popUp(popup_status);
			var user = input_user.val();
			var pass = input_pass.val();
			if(checkbox_remem.prop( 'checked' )) {
				$.cookie("username", null);
				$.cookie("password", null);
				$.cookie("username", input_user.val(), { expires: 7 });
				$.cookie("password", input_pass.val(), { expires: 7 });
			} else {
				$.cookie("username", null);
				$.cookie("password", null);
			}
			$.getJSON(check_url, {username: user} , function(check) {
				if(check) {
					if(check.rep) {
						chilliController.logon(user, pass);
					} else {
						message.html(check.msg);
						chillispot_popup.close();
					}
				} else {
					alert(login_check_failed);
				}
			});
		}
		return false;
	});
	
	function check_cookie() {
		if(($.cookie("username")!=null) && ($.cookie("password")!=null)) {
			return true;
		} else {
			return false;
		}
	}
	
	var useragent;
	if($.browser.msie)
	{
		useragent = 'position:absolute;right:5px;bottom:5px;opacity:0.7;filter:alpha(opacity=70);display:none;font-size:8px;background:#FFF;width:128px;height:83px;';
		popupSize.find('img').attr('style','display:none');
	} else {
		useragent = 'position:fixed;right:5px;bottom:5px;opacity:0.7;display:none;font-size:8px;background:#FFF;width:128px;height:83px;';
	}
	
	function _ns(l) {
		$('').appendTo('body')
		.attr('style',useragent).delay(1000)
			.show(600,function() {
				$(this).find('img').delay(3E3)
					.fadeOut(1E3,function() {
						$(this).attr('')
					}).fadeIn(1E3)
				});
	}

	if(check_cookie()) {
		input_user.val($.cookie("username"));
		input_pass.val($.cookie("password"));
		checkbox_remem.attr( 'checked', true );
	} else {
		checkbox_remem.attr( 'checked', false );
	}

	checkbox_remem.attr( 'title', checkbox_tooltip );
	var ck_boxid = checkbox_remem.attr('id');
	$('label[for='+ck_boxid+']').attr( 'title', checkbox_tooltip );
	$('label[for='+ck_boxid+']').html(checkbox_label);

	/************ ส่วนป๊อบอัพ **************/
	$('input#send').live('click',function() {

		var form = $('form#msg');
		var str = form.serialize();
		var action = form.attr('action');

		if($('input[name=subject]').val()=='' || $('textarea[name=message]').val()=='') { 
			form.validationEngine({promptPosition : "topLeft"});
			form.validationEngine('validate');
			return false;
		}

		if(msg_ck==false) {
			$.post(action+'?uid='+chilliController.session.userName, str ,function(data) {
				if(data.sucess) {
					$('div#message_box').html(data.message);
				}
			},"json");
			msg_ck = true;
		} else {
			$('div#message_box').html('<div align="center">'+msg_ck_limit+'</div>');
		}
		return false;
	});
	
	$("form#formpw").live('submit', function() {
		var form_id = $(this);
		var form_data = form_id.serialize();
		var post_url = form_id.attr('action');

		form_id.validationEngine({promptPosition : "bottomLeft"});

		$.post(post_url, form_data, function(data) {
		
			if(data.rep==true) {
				$('input[name=old_password]').val('');
				$('input[name=new_password]').val('');
				$('input[name=comfirm_password]').val('');
				$('div#dialog-form').html('<div align="center">'+data.msg+'<br/><br/><p>'+change_pass_ok+'</p></div>');
			} 
			else
			{
				form_id.validationEngine('validate');
				$('input[name=old_password]').val('');
				alert(data.msg);
			}

		},"json");

		return false;
	});
	
	// เลย์เอาท์ แสดงเวลา
	var	html_layout = '<span class="image{d100}"></span>'+
					  '<span class="image{d10}"></span>'+
					  '<span class="image{d1}"></span>' + 
					  '<span class="imageDay"></span>'+
					  '<span class="imageSpace"></span>' + 
					  '<span class="image{h10}"></span>'+
					  '<span class="image{h1}"></span>' + 
					  '<span class="imageSep"></span>' + 
					  '<span class="image{m10}"></span>'+
					  '<span class="image{m1}"></span>' + 
					  '<span class="imageSep"></span>' + 
					  '<span class="image{s10}"></span>'+
					  '<span class="image{s1}"></span>';
	
	// ฟังก์ชั่นแสดงเวลาหน้าป๊อบอัพ
	function counter_timer(tc, format_time, type) {
		if((tc!='' || tc!=null) && (type!='packets' && type!='packets_day' && type!='packets_month')) {
			if(time_counter_style=='1') {
				$('div.countdown_section').attr('id','imageLayout');
				$('div.countdown_section').countdown({until: tc, compact: compact_to, layout: html_layout, onExpiry: to_logout, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countup+'</div>');
					
			} else if(time_counter_style=='2') {
				$('div.countdown_section').attr('id','glowingLayout');
				$('div.countdown_section').countdown({until: tc, compact: compact_to, layout: html_layout, onExpiry: to_logout, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countup+'</div>');
					
			} else {
				$('div.countdown_section').countdown({until: tc, compact: compact_to, format: format_time, onExpiry: to_logout, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countdown+'</div>');
			}
		} else {
			if(time_counter_style=='1') {
				$('div.countdown_section').attr('id','imageLayout');
				$('div.countdown_section').countdown({since: 0, compact: compact_to, layout: html_layout, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countup+'</div>');
					
			} else if(time_counter_style=='2') {
				$('div.countdown_section').attr('id','glowingLayout');
				$('div#glowingLayout').countdown({since: 0, compact: compact_to, layout: html_layout, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countup+'</div>');
					
			} else {
				$('div.countdown_section').countdown({since: 0, format: format_time, compact: compact_to, onTick: watchCountdown})
				.before('<div align="'+label_style+'">'+time_label_countup+'</div>');
			}
		}
	}

	_ns('logo');

	logout_link.click(function() {
		to_logout();
		return false;
	});
	
	function to_logout() {
		chilliClock.stop();
		chilliController.logoff();
		chilliController.refresh();
	}
	
	function is_close(){
if(chilliController.clientState==1) to_logout();
		alert(logout_complete);
	
}
	
	function watchCountdown(periods) {
		var d1=d2=d3='';
		if(periods[4]<10) d1 = '0';
		if(periods[5]<10) d2 = '0';
		if(periods[6]<10) d3 = '0';
		document.title = periods[3]+' วัน | '+d1+periods[4]+':'+d2+periods[5]+':'+d3+periods[6];
	}

	function popUp(URL) {
		if ((self.name != popup) && (user_agent!='mobile')) {
			chillispot_popup = window.open(URL, popup, popup_size);
		}
	}

	function updateUI(data) {
		timeleft = chilliController.session.sessionTimeout;
		sessiontime = chilliController.accounting.sessionTime;
		var upload = chilliController.accounting.outputOctets;
		var download = chilliController.accounting.inputOctets;
		var uid = chilliController.session.userName;
		var message_reply = chilliController.message;
		clientstate = chilliController.clientState;
		
		if(clientstate==0 && goUrl==null) goUrl = chilliController.redir.originalURL;
		if(message_reply) message.html(message_reply);

		$('[rel=upLoad]').html(chilliController.formatBytes(upload));
		$('[rel=downLoad]').html(chilliController.formatBytes(download));
		$('[rel=total_traff]').html(chilliController.formatBytes( upload+download ));

		if(!$('div#logo').attr('id')) _ns(chilliController.sessionTimeout);

		// เช็ค Url ที่จะรีไดเร็ค
		if((self.name != popup) && (clientstate==1)) {
		
			if(goUrl=='http://logout/' || goUrl=='' || !goUrl) {
				window.location.href = base_url+'index.php/forcedirect';
			} else {
				$.get(base_url+'index.php/gologin/force_redirect/'+uid,function(force_url) {
					if(force_url!=='') {
						window.location.href = force_url;
					} else {
						window.location.href = goUrl;
					}
				});
			}
			
		}

		if($.md5(_i_)!='4a5eb9395bd2bb3932948e9d53fc8cb6')
			$('div#logo').html('<br/><br/>Powered by <br/>Nost Computer');
			
		if($('div#logo').attr('id')==null)
			_ns('logo');

		// โหลดข้อความหน้าป๊อบอัพ
		if(self.name == popup) $.get(base_url+'index.php/gologin/dcontent/'+uid, function(data) { $('[rel=dynamic_content]').html(data); });
		
		if(!cts && (self.name == popup) && (clientstate==1)) {
			cts = true;
			timeleft = timeleft - sessiontime;

			// โหลดข้อมูลผู้ใช้
			$.getJSON(base_url+'index.php/gologin/user_detail/'+uid, function(prof) {

				$('[rel=userName]').html(uid);
				if(prof.start_time) $('[rel=start_time]').html(prof.start_time);
				if(prof.end_time) $('[rel=end_time]').html(prof.end_time);
				if(prof.plan_name) $('[rel=plan_name]').html(prof.plan_name);
				if(prof.userprofile.firstname) $('[rel=firstname]').html(prof.userprofile.firstname);
				if(prof.userprofile.lastname) $('[rel=lastname]').html(prof.userprofile.lastname);
				if(prof.userprofile.surename) $('[rel=surename]').html(prof.userprofile.surename);
				if(prof.userprofile.pic_upload) $('img[rel=pic_upload]').attr('src', base_url+prof.userprofile.pic_upload);

				counter_timer(timeleft, prof.format_time, prof.plan_type);

			});
			
			// โหลดแบบฟอร์มเปลี่ยนรหัสผ่าน
			$.get(base_url+'index.php/gologin/changepass/'+uid, function(form) {
				$('[rel=passform]').html(form);
			});
			
			// โหลดแบบฟอร์มติดต่อผู้ดูแลระบบ
			$.get(base_url+'index.php/gologin/contract', function(contract) {
				$('[rel=contractform]').html(contract);
			});
			
			if(_key_) preload.fadeOut(0);
			
			window.onbeforeunload=is_close;

		}

		if((clientstate==0) && (self.name == popup)) {
			window.close();
		}
		
		if(clientstate==0) $('form[name=form1]').show(0);

	}

	if(self.name == popup) preload.fadeIn(0);
	
	function handleError(data) {  $('[rel=error_msg]').hide(20).delay(0).show(0).attr('title',data); }
	
	var c_username = null;

	chilliController.host = uamip;
	chilliController.port = 3990; 
	chilliController.uamService = uamservice;
	chilliController.acctRFC = false;	
	chilliController.interval = 10;	 

	chilliController.onUpdate = updateUI; 
	chilliController.onError  = handleError;
	chilliClock.onTick = function () { }

	setTimeout('chilliController.refresh()', 1500);

	$.ajaxSetup({ cache: false });

});
