jQuery(document).ready(function($) {
		function init_table() {
			oTable = $('#dhcp_list').dataTable({
									"bProcessing": true,
									"bServerSide": false,
									"sAjaxSource": base_url+"index.php/"+controller+"/json",
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
											"sNext":     lang_sNext,
											"sLast":     lang_sLast
										}
									},
									"aoColumns": [
										{ "sWidth": "10px","sClass": "center" },
										{ "sWidth": "70px","sClass": "left" },
										{ "sWidth": "95px","sClass": "left" },
										{ "sWidth": "125px","sClass": "center" },
										{ "sWidth": "50px","sClass": "right" },
										{ "sWidth": "50px","sClass": "right" },
										{ "sWidth": "70px","sClass": "right" },
										{ "sWidth": "70px","sClass": "center" },
										{ "sWidth": "55px","bSortable": false,"sClass": "right" }
									],
									"aaSorting": [[0, "asc"]]
			}); 
		}

		init_table();
		
		$('div#dhcp_list_filter input[type=text]').attr('placeholder',lang_sPlaceholder);

		$('.action').live('click',function() {
		
			var title_ = $(this).attr('title');
			var href = $(this).attr('href');
			var msg_;
			
			switch (title_) {
				case 'Release' : msg_ = 'ระบบจะตัดการเชื่อมต่อ และแจกไอพีให้ Client ใหม่';
				break;
				case 'Bypass' : msg_ = 'ให้ Client เข้าใช้งานได้โดยไม่ต้องยืนยันตัวตน';
				break;
				case 'Disconnect' : msg_ = 'ตัดการเชื่อมต่อ และการ Bypass จะถูกยกเลิก';
				break;
				case 'Block' : msg_ = 'Client จะไม่สามารถใช้งานใด ๆ ในระบบเครือข่ายได้';
				break;
			}
			
			$('<div id="confirm-delete" title="'+title_+'"><div title="Confirm" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>'+title_+': </strong>'+msg_+'</p></div></div>').appendTo('body')
			.dialog({
				resizable: false,
				height:480,
				width:400,
				//modal: true,
				close: function() {
					$(this).remove();
				},
				buttons: {
					ยืนยัน: function() {
						window.location.href = href;
					},
					ยกเลิก: function() {
						$( this ).dialog( "close" ).remove();
					}
				}
			});
			
			$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
			
			return false;
			
		});
		
		$('#setup').click(function() {

			$.get(base_url+'index.php/'+controller+'/getfrom', function(data) {

				$('<div id="setup-list" title="Option">'+data+'</div>').appendTo('body')
				.dialog({
					resizable: false,
					height:420,
					width:600,
					close: function() {
						$(this).remove();
					},
					buttons: {
						ยืนยัน: function() {
							var str = $("form#setup_form").serialize();
							$.post(base_url+'index.php/'+controller+'/getfrom', str, function(d){
								showmessage(d, 'info');
								$( '#setup-list' ).dialog( "close" ).remove();
							});
						},
						ยกเลิก: function() {
							$( this ).dialog( "close" ).remove();
						}
					}
				});
				
			});

		});

});