<?php
function get_jslogin($result,$loginpath,$uamip,$uamport,$plantype,$gourl,$timeleft='',$uid='',$location='Airlink')
{

	$check_url = site_url('gologin/check_user');
	$attemp_login = site_url('gologin/attemp_login');

	return "

		var blur = 0;
		var chillispot_popup = false;
		var msg_ck = false;
		var plantype = '$plantype';
		var format_time;

		
	$(document).ready(function() {
				/*
				*   Examples - images
				*/
				$(\"#help\").fancybox({
					'width'				: '75%',
					'height'			: '100%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
				});
				
				$(\"#signup\").fancybox({
					'width'				: '75%',
					'height'			: '100%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
				});
				
				$(\"#oklungtung\").fancybox({
					'width'				: '60%',
					'height'			: '60%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
				});
				
				$(\"#oklove\").fancybox({
					'width'				: '60%',
					'height'			: '60%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
				});
				
				$(\"#okhook\").fancybox({
					'width'				: '62%',
					'height'			: '72%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
				});
		
		function popUp(URL) {
		  if (self.name != \"chillispot_popup\") {
			chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=375');
		  }
		}

		function doOnLoad(result, URL, redirurl) {
		  if ((result == 1) && (self.name == \"chillispot_popup\")) {
			doTime();
		  }
		  if ((result == 1) && (self.name != \"chillispot_popup\")) {
			chillispot_popup = window.open(URL, 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=375');
		  }
		  if ((result == 2) || result == 5) {
			document.form1.UserName.focus()
		  }
		  if ((result == 2) && (self.name != \"chillispot_popup\")) {
			chillispot_popup = window.open('', 'chillispot_popup', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');
			chillispot_popup.close();
		  }
		  if ((result == 12) && (self.name == \"chillispot_popup\")) {
			opener.location = redirurl;
			$(\"div.mmo_notice_bd\").load(base_url+\"index.php/remote/ajax_pop/$location\");
			var refreshId = setInterval(function() {
				$(\"div.mmo_notice_bd\").load(base_url+\"index.php/remote/ajax_pop/$location?randval=\"+ Math.random());
			}, 30000);
			self.focus();
			blur = 0;
		  }
		  if ((result == 13) && (self.name == \"chillispot_popup\")) {
			self.focus();
			blur = 1;
		  }
		  if(result == 3) {
			window.close();
		  }
		}

		function doOnBlur(result) {
		  if ((result == 12) && (self.name == \"chillispot_popup\")) {
			if (blur == 0) {
			  blur = 1;
			  self.focus();
			}
		  }
		}

				if(plantype=='timetofinish' || plantype=='packets') {
					format_time = 'DHMS';
				} else {
					format_time = 'HMS';
				}

				$('div.countdown_section').countdown({until: '$timeleft', format: format_time, expiryUrl: '$loginpath?res=popup3&uamip=$uamip&uamport=$uamport'});

				doOnLoad($result, '$loginpath?res=popup2&uamip=$uamip&uamport=$uamport&userurl=$gourl&redirurl=$gourl&timeleft=$timeleft&uid=$uid','$gourl');
				doOnBlur($result);
				
				function check_cookie() {
					if(($.cookie(\"username\")!=null) && ($.cookie(\"password\")!=null)) {
						return true;
					} else {
						return false;
					}
				}
				
				$(\"input.mmo_btn\").click(function() {

					if(($('#username').val()!='') || ($('#password').val()!='')) {

						var str = $(this).serialize();
						popUp('$loginpath?res=popup1&uamip=$uamip&uamport=$uamport');
						var user = $('input[name=UserName]').val();
						
						if($('#is_remember').attr( 'checked' )) {
						
							$.cookie(\"username\", null);
							$.cookie(\"password\", null);
						
							$.cookie(\"username\", $('#username').val(), { expires: 7 });
							$.cookie(\"password\", $('#password').val(), { expires: 7 });
						
							$.getJSON('$check_url', {username: user} , function(check) {

								if(check.rep) {
								/*
									$.post('$attemp_login', str, function(data){
										window.location = data.url;
									},\"json\");
								*/
								$(\"form[name=form1]#loginform\").submit();
								} else {
									$('div.total_members').html(check.msg);
									chillispot_popup.close();
								}

							});

						} else {
						
							$.cookie(\"username\", null);
							$.cookie(\"password\", null);

							$.getJSON('$check_url', {username: user} , function(check) {

								if(check.rep) {
								/*
									$.post('$attemp_login', str, function(data){
										window.location = data.url;
									},\"json\");
								*/
								$(\"form[name=form1]#loginform\").submit();
								} else {
									$('div.total_members').html(check.msg);
									chillispot_popup.close();
								}

							});
							
						}

					}

					return false;
				});
				
				$('input#send').live('click',function() {
					if(msg_ck==false) {
						var form = $('form#msg');
						var str = form.serialize();
						var action = form.attr('action');

						$.post(action+'?uid=$uid', str ,function(data) {
							if(data.sucess) {
								$('div#message_box').html(data.message);
							}
						},\"json\");

						msg_ck = true;
					} else {
						$('div#message_box').html('<div align=\"center\">ไม่สามารถส่งข้อความซ้ำหลายครั้งได้</div>');
					}
					return false;
				});
				
				if(check_cookie()) {
					$('#username').val($.cookie(\"username\"));
					$('#password').val($.cookie(\"password\"));
					$('#is_remember').attr( 'checked', 'checked' );
				} else {
					$('#is_remember').attr( 'checked', false );
				}
				
				var t_txt = 'เข้าสู่ระบบด้วยชื่อนี้ทุกครั้ง';
				var t_html = 'ให้จำชื่อนี้ไว้เสมอ';
				$('#is_remember').attr( 'title', t_txt );
				$('label[for=is_remember]').attr( 'title', t_txt );
				$('label[for=is_remember]').html(t_html);

				 $.ajaxSetup({ cache: false });
	});
	";

}