
jQuery(document).ready(function($) {
		// Get the rows which are currently selected
		function fnGetSelected( oTableLocal )
		{
			var aReturn = new Array();
			var aTrs = oTableLocal.fnGetNodes();
			
			for ( var i=0 ; i<aTrs.length ; i++ )
			{
				if ( $(aTrs[i]).hasClass('row_selected') )
				{
					aReturn.push( aTrs[i] );
				}
			}
			return aReturn;
		}

		$('#form_delete').submit( function() {
		
			var d = $(this).parents('body').find('div#gen_form,div#user_form,div#confirm-delete').attr('id');
			if(d) { return false; }
			
			var sData = $('input[type="checkbox"]', oTable.fnGetNodes()).serializeArray();
			var anSelected = fnGetSelected( oTable );
			var user_data;

			$('<div id="confirm-delete" title="ลบข้อมูลผู้ใช้"><div title="Confirm" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>คำเตือน: </strong> ข้อมูลจะถูกลบอย่างถาวร จะไม่สามารถกู้คืนได้</p></div></div>').appendTo('body')
			.dialog({
				resizable: false,
				height:420,
				width:600,
				//modal: true,
				close: function() {
					$(this).remove();
				},
				buttons: {
					ยืนยัน: function() {
					
						$( this ).dialog( "close" ).remove();
						$('#checkAll').attr('checked',false);
						dialog_msg('Message','กำลังลบข้อมูล...');
					
						$.get(base_url+'index.php/'+controller+"/multidelete", {user_data: sData}, function(data) {

							if(data.rep) {
							
								$( "#alert-msg" ).dialog( "close" ).remove();
								oTable.fnClearTable();
								showmessage(data.msg, 'info');
								
							} else {
								
								$( "#alert-msg" ).dialog( "close" ).remove();
								dialog_msg('ผิดพลาด', data.msg, 'error');
								
							}

						}, "json");
						
					},
					ยกเลิก: function() {
						$( this ).dialog( "close" ).remove();
					}
				}
			});
			
			$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
			
			return false;
		});

		oTable = $('#hotspotuser').dataTable({
										"bProcessing": true,
										"bServerSide": true,
										"sAjaxSource": base_url+"index.php/"+controller+"/userdata",
										"sDom": sDom_tool,
										"bStateSave": true,
										"sPaginationType": "full_numbers",
										"oLanguage": {
												"sProcessing": lang_sProcessing,
												"sSearch": lang_sSearch,
												"sLengthMenu": lang_sLengthMenu,
												"sZeroRecords": lang_sZeroRecords,
												"sInfo": lang_sInfo,
												"sInfoEmpty": lang_sInfoEmpty,
												"sInfoFiltered": lang_sInfoFiltered,
												"oPaginate": {
														"sFirst":    lang_sFirst,
														"sPrevious": lang_sPrevious,
														"sNext":     lang_sNext,"sLast":     lang_sLast
												}
										},
										"aoColumns": [
											{"sWidth": "90px"},
											
											{"sWidth": "35px"},
											{"sWidth": "35px"},
											{"sWidth": "35px"},
											{"sWidth": "165px","sClass": "center"},
											{ "sWidth": "65px"},
											{ "sWidth": "65px"},
											{ "sWidth": "65px","sClass": "right"},
											{ "sWidth": "65px","sClass": "right"},
											{ "sWidth": "30px","sClass": "center"},
											{ "sWidth": "30px","sClass": "center"}
										],
										"aaSorting": [[0, "asc"]]
								}); 

		$(fnCreateSelect('sOftion')).appendTo('.dataTables_filter');


		$('select#sOftion').change( function () {
			oTable.fnFilter( $(this).val(), 1 );
		});

		$('div#hotspotuser_filter input[type=text]').attr('placeholder',lang_sPlaceholder);

		$('div a#add, td a#edit').live('click',function() {
		
			var d = $(this).parents('body').find('div#gen_form,div#user_form,div#confirm-delete').attr('id');
			if(d) { return false; }
			
			var href = $(this).attr('href');
			var lid = $(this).attr('id');
			var title = $(this).attr('info');

			$('<div style="display:none;" title="'+title+'" id="user_form"></div>').appendTo('body')
			.load(href, function() {
				var this_form  = $(this);
				var form = $("form#form");
				this_form.dialog({
					resizable: false,
					height:700,
					width:680,
					modal: true,
					buttons: {
						บันทึก: function() {

							var str = form.serialize();
							$.post("userform/submit/"+lid, str, function(data){

								if(data.rep) {
									showmessage(data.msg, 'info');
									this_form.dialog("close");
									oTable.fnClearTable();
								} else {
									jQuery('form#form').validationEngine('validate');
									showmessage(data.msg, 'warning');
								}

							}, "json");
							
						},
						ยกเลิก: function() {

							$('form#form').validationEngine('hideAll');
							this_form.remove();
						}
					},
					close: function() {
						$('form#form').validationEngine('hideAll');
						this_form.remove();
					}
				});
				
				$('.ui-dialog :button').blur(); 
				this_form.tabs();
			});

			return false;
		
		});
		
		$('#card_gen').click(function() {
			var d = $(this).parents('body').find('div#gen_form,div#user_form,div#confirm-delete').attr('id');
			if(d) { return false; }
			var gen_id = "gen_form";
			var link = $(this).attr('href');
			$('<div id="'+gen_id+'" title="สร้างบัตร"></div>').appendTo('body')
			.load(link, function() { 
				$(this).dialog({
					resizable: false,
					height:570,
					width:680,
					//modal: true,
					buttons : {
						เริ่มสร้าง: function() {
							var str = $("form#gen_form").serialize();
							var ele = $(this);
							dialog_msg('กำลังสร้างบัตร...', 'กรุณารอสักครู่...');
							$.post('userform/gen', str, function(data) {

								if(data.rep) {
									ele.dialog('close');
									$('div#alert-msg').dialog('close').remove();
									oTable.fnClearTable();
									$(ele).html(data.msg);
									gen_view(ele, data.gname);
								} else {
									$('div#alert-msg').dialog('close').remove();
									showmessage(data.msg, 'warning');
									$("form#gen_form").validationEngine('validate');
								}

							},"json");

						},
						ยกเลิก: function() {
							$("form#gen_form").validationEngine('hideAll');
							$(this).dialog('close').remove();
						}
					},
					close: function() {
						$("form#gen_form").validationEngine('hideAll');
						$(this).remove();
					}
				});
				
				$('.ui-dialog :button').blur(); 
				
			});

			return false;
			
		});
		
		oTable.fnFilter( '', 1 );
		
		function gen_view(ele, filename) {
			$(ele).dialog({
				resizable: false,
				height:650,
				width:580,
				modal: true,
				buttons: {
					"Download PDF": function() {
					
						$.get(base_url+'index.php/admin/userform/pdffile/'+filename+'/exist', function(data) {
							if(data.rep){
								window.location.href=base_url+'index.php/admin/userform/pdffile/'+filename+'/download';
							} else {
								showmessage(data.msg, 'warning');
							}
						},"json");
						
					}
				},
				close: function() {
					$(this).remove();
					$.get(base_url+'index.php/admin/userform/pdffile/'+filename+'/delete',function(data) {
						if(data.rep) { showmessage(data.msg, 'warning'); }
					},"json");
				}
			});
			
			$('.ui-dialog :button').blur(); 
			
		}
		
		$('form#gen_form').live('submit',function() { return false; });

		$( "tbody" ).selectable({
			stop: function() {
				$('tr').removeClass('row_selected');
				$("input[type=checkbox]").attr("checked",false);
				$( ".ui-selected", this ).each(function() {
					$( this ).find("input[type=checkbox]").attr("checked",true);
					$(this).addClass('row_selected'); 
				});
			}
		});
		
//************************/ คอนเท็กเมนู /****************************//

	var $cmenu = $('#context_menu');
	var menu_list = $('div#context_menu ul li');
	var menu_detail = $('div#context_menu ul li#detail');
	var menu_testauth = $('div#context_menu ul li#testauth');
	var menu_edit = $('div#context_menu ul li#edit');
	var menu_moveto = $('div#context_menu ul li#moveto');
	var menu_delete = $('div#context_menu ul li#delete');
	var menu_refresh = $('div#context_menu ul li#refresh');
	var menu_selectall = $('div#context_menu ul li#selectall');
	var menu_sellock = $('div#context_menu ul li#sellock');
	var menu_selunlock = $('div#context_menu ul li#selunlock');

	function screen_clear() {
        $cmenu.hide();
		$('.overlay').remove();
	}

	// เปิดคอนเท็กท์เมนู
	$('tbody').bind("contextmenu", function(e) {
		
		// สร้างโอเวอร์เลย์
		$('<div class="overlay"></div>').css({left : '0px', top : '0px',position: 'absolute', width:'100%', height: '100%', zIndex: '100' })
		.click(function() {
			$(this).remove();
			$cmenu.fadeOut(200);
		}).appendTo(document.body);
		$cmenu.css({ left: e.pageX, top: e.pageY, zIndex: '110' }).fadeIn(200);

		// ตรวจสอบ เช็คบ็อค
		$(menu_list).each(function(i, l) {
		
			var ckbox = $(":checkbox:checked").length;
			
			if(ckbox==1) {
				var _id = $(l).attr('id');
				$(l).removeClass('inactive').addClass('active');
			}
			
			if(ckbox==0) {
				var _id = $(l).attr('id');
				if(_id!='refresh' && _id!='selectall')
					$(l).removeClass('active').addClass('inactive');
			}
			
			if(ckbox>=2) {
				if(i>=3) $(l).removeClass('inactive').addClass('active');
					else
					$(l).removeClass('active').addClass('inactive');
			}
			
		});

		return false;
	});
	
	// ดูรายละเอียด
    menu_detail.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
			var Tr = $('tbody').parent().find('.ui-selected');
			var user;
			$('td',Tr).each(function(i, l) {
				if(i==0) user = $(l).html();
			});

			$('<div title="ข้อมูลผู้ใช้ '+user+'" id="show_detail"></div>').appendTo('body');
			$.get(base_url+'index.php/'+controller+"/info", {user_data: user}, function(data) {
				$('#show_detail').html(data)
				.dialog({
					resizable: false,
					height:640,
					width:870,
					modal: true,
					close: function() {
						$(this).remove();
					}
				});
			});

			screen_clear();
		}
    });
	
	// ทดสอบการล็อคอิน
    menu_testauth.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
		
			var Tr = $('tbody').parent().find('.ui-selected');
			var user;
			$('td',Tr).each(function(i, l) {
				if(i==0) user = $(l).html();
			});

			$('<div title="ทดสอบผู้ใช้งาน '+user+'" id="show_auth"></div>').appendTo('body')
			.html('<div style="background:#000000;opacity:0.1;z-index:1000;position:absolute;top:0px;left:0px;width:100%;height:100%;"></div>');
			$.get(base_url+'index.php/'+controller+'/user_auth/'+user, function(data) {
				$('#show_auth').html(data)
				.dialog({
					resizable: false,
					height:550,
					width:800,
					modal: true,
					close: function() {
						$(this).remove();
					}
				});
			});

			screen_clear();
		
		}
    });
	
	// แก้ไขข้อมูลผู้ใช้
    menu_edit.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
			var Tr = $('tbody').parent().find('.ui-selected');
			Tr.find('td a#edit').click();
			screen_clear();
		}
    });
	
	// ย้ายกลุ่มผู้ใช้
    menu_moveto.hover(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
			$('ul#subcontext').show();
			$('div#main',this).addClass('context_act');
		}
    },
	function() {
		$('ul#subcontext').hide();
		$('div#main',this).removeClass('context_act');
	});
	// เลือกกลุ่ม
	$('div#sub').bind('click',function() {
		var gname = $(this).parent('li').attr('id');
		var name = $(this).html();
		var user = $('#form_delete input[type=checkbox]').serializeArray();
		var ckbox = $(":checkbox:checked").length;
		
		if(ckbox>1) {
			
			$('<div title="ย้ายกลุ่มผู้ใช้" id="moveto_confirm"><div id="dialog-confirm" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>กำลังจะย้ายผู้ใช้ '+ckbox+' คน ไปที่กลุ่ม "'+name+'" กรุณายืนยัน</p></div></div>').appendTo('body').dialog({
				resizable: false,
				height:180,
				width:400,
				modal: true,
				buttons: {
					ตกลง: function() {
						$.post(base_url+'index.php/'+controller+'/moveto',  {username: user, group: gname}, function(data) {
							showmessage(data, 'info');
							oTable.fnClearTable();
						});
						$( this ).dialog( "close" ).remove();
					},
					ปิด: function() {
						$( this ).dialog( "close" ).remove();
					}
				},
				close: function() {
					$(this).remove();
				}
			});
			
			$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
			
		} else {
			$.post(base_url+'index.php/'+controller+'/moveto',  {username: user, group: gname}, function(data) {
				showmessage(data, 'info');
				oTable.fnClearTable();
			});
		}
		
		screen_clear();
	});
	
	// ลบที่เลือก
    menu_delete.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
			$('#form_delete').submit();
			screen_clear();
		}
    });
	
	// รีโหลดตาราง
    menu_refresh.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') oTable.fnClearTable();
        screen_clear();
    });
	
	// เลือกทั้งหมด
    menu_selectall.click(function() {
		var menu_status = $(this).attr('class');
		if(menu_status=='active') {
			$("tbody tr").addClass('row_selected').find('input[type=checkbox]').attr("checked",true); 
			screen_clear();
		}
    });
	
	// ล๊อกผู้ใช้ที่เลือก
    menu_sellock.click(function() {
		var menu_status = $(this).attr('class');
		
		var user = $('#form_delete').serializeArray();

		if(menu_status=='active') {

			// Unlock
			$.post(base_url+'index.php/'+controller+"/status_lock", {username: user, status: 'lock'}, function(data) {

				if(data.rep) {
					showmessage(data.msg, 'info');
					oTable.fnClearTable();
				} else {
					showmessage(data.msg, 'error');
				}

			},"json");

			screen_clear();
			
		}
    });
	
	// ปลดล๊อคผู้ใช้ที่เลือก
    menu_selunlock.click(function() {
		var menu_status = $(this).attr('class');
		var user = $('#form_delete').serializeArray();

		if(menu_status=='active') {

			// Unlock
			$.post(base_url+'index.php/'+controller+"/status_lock", {username: user, status: 'unlock'}, function(data) {

				if(data.rep) {
					showmessage(data.msg, 'info');
					oTable.fnClearTable();
				} else {
					showmessage(data.msg, 'error');
				}

			},"json");

			screen_clear();
		}
    });

	$('input[name=sl_group]').live('click',function() { 
		if($(this).attr("checked")) {
			$('#bw_download,#bw_upload').attr('disabled','disabled');
		} else {
			$('#bw_download,#bw_upload').removeAttr('disabled');
		}
	});
	
	$('#radcheck, #radreply').live('click', function() {
		var rad_type = $(this).attr('id');
		var attr_input = '<tr id="input-attr" role="dom_ele">';
			attr_input += '<td><input type="text" style="width:94%" value="" id="autocom" name="attr_'+rad_type+'[]"></td>';
			attr_input += '<td><select name="op_'+rad_type+'[]"><option selected="selected" value=":=">:=</option><option value="==">==</option></select></td>';
			attr_input += '<td><input type="text" id="attr_val" style="width:95%" value="" name="value_'+rad_type+'[]">';
			attr_input += '<div style="background:url(\''+base_url+'assets/images/delete.gif\');display:block;width:16px;height:16px;position:absolute;right:32px;margin-top:5px;cursor:pointer;" rel="dom_ele" id="del"></div></td>';
			attr_input += '</tr>';
			//alert(rad_type);
		$('#input-attr-'+rad_type).before(attr_input);

	});
	
	$('#del').live('click',function() {
		var tr_parent = $(this).parents('tr');
		var field_id = $(this).attr('rel');
		var table = $(this).attr('role');
		var hid_form = '<input type="hidden" name="record_del_'+table+'[]" value="'+field_id+'">';
		if(field_id!='dom_ele') $(hid_form).appendTo('form#form');
		tr_parent.remove();
	});
	
	$('#autocom').live('focus',function() {
		var autocom_options = { serviceUrl:base_url+'index.php/admin/dictionary/autocom',deferRequestBy: 500,minChars:3 };
		var autocom = $(this).autocomplete(autocom_options);
	});

}); 