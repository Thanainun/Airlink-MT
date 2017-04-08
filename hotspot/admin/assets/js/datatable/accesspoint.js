jQuery(document).ready(function($) {

				var opts = {
					cssClass : 'el-rte',
					height   : 200,
					toolbar  : 'complete',
					cssfiles : [base_url+'assets/css/elrte/elrte-inner.css'],
					fmOpen : function(callback) {
						$('<div id="myelfinder" />').elfinder({
							url : base_url+'index.php/admin/files/connector',
							lang : 'en',
							dialog : { width : 570, modal : true, title : 'elFinder - จัดการไฟล์' },
							closeOnEditorCallback : true,
							editorCallback : callback
						})
					}
				}
			
		function ap_initTable()
		{
			oTable = $('#aptable').dataTable({
									"bProcessing": true,
									"bServerSide": true,
									"sAjaxSource": base_url+'index.php/'+controller+"/json",
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
										{"sWidth": "110px"},
										{"sWidth": "42px","sClass": "center"},
										{"sWidth": "145px"},
										{"sWidth": "145px","sClass": "center"},
										{"sWidth": "145px"},
										{"sWidth": "20px","bSortable": false, "sClass": "center"},
										{"sWidth": "60px","bSortable": false ,"sClass": "center"}
									],
									"aaSorting": [[0, "asc"]]
							}); 
		}
		
		$('<div style="display:none;" id="accesspoint_form"></div>').appendTo('body');
		
		$('a.btn#form_add, a.apedit#edit').live('click',function() {
		
			var ck = $(this).parents('body').find('div.tabs-jui').attr('id');
			
			if(ck) { return false; }
			
			var href = $(this).attr('href');

			$('div#accesspoint_form').load(href,function() {
		
				$('div.tabs-jui').dialog({
					autoOpen: true,
					height: 820,
					width: 850,
					//modal: true,
					resizable: false,
					buttons: {
						บันทึก: function() {
							var act = $('form#form_ap').attr('action');
							var form_data = $('form#form_ap').serialize();
							$.post(act , form_data, function(data) {
								if(data.rep) {
									$('form#form_ap').attr('action', base_url+'index.php/'+controller+'/action/edit');
									$('form#form_ap').submit();
									setTimeout("$('div.tabs-jui').dialog('close').remove(); oTable.fnClearTable();", 1500);
									oTable.fnClearTable();
									showmessage(data.msg, 'info');
								} else {
									showmessage(data.msg, 'warning');
									$('form#form_ap').validationEngine("validate");
								}
							},"json");
						},
						ยกเลิก: function() {
							$('form#form_ap').validationEngine('hideAll');
							$(this).dialog('close').remove();
						}
					},
					close: function() {
						$('form#form_ap').validationEngine('hideAll');
						$(this).remove();
					}
				});
				
				$('.ui-dialog :button').blur(); 
				
				$('#login_page').elrte(opts);
				$('#popup_page').elrte(opts);
				$('#announced_page').elrte(opts);
				$('#help').elrte(opts);
				$( ".tabs-jui" ).tabs();

			});
			
			

			return false;
			
		});
		
		$('#item_delete').live('click', function() {
		
			var url = $(this).attr('href');
		
			$('<div id="ap-delete" title="ลบจุดเชื่อมต่อ"><div id="dialog-confirm" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>คำเตือน: </strong> ลบจุดเชื่อมต่อ</p></div></div>').appendTo('body');
		
			$( "#ap-delete" ).dialog({
				resizable: false,
				height:180,
				width:400,
				modal: true,
				buttons: {
					ยืนยัน: function() {
						$.get(url,function(data) {
							if(data.rep){
								showmessage(data.msg, 'info');
								$( "#ap-delete" ).dialog('close').remove();
								oTable.fnClearTable();
							}
						},"json");
					},
					ยกเลิก: function() {
						$( this ).dialog('close').remove();
					}
				},
				close: function() {
					$( this ).remove();
				}
			});
			
			$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
			
			return false;
			
		});
		
		ap_initTable();
		$('div#aptable_filter input[type=text]').attr('placeholder',lang_sPlaceholder);


		// Tooltip
		$('table tbody').hover(function() {
			var tbody = $(this);
			var icon_apedit = 'a.apedit';
			var icon_delete = '#item_delete';
			var icon_print = 'a.print';
			var icon_ap = 'a.connect_ap';

			$('tr td '+icon_ap, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var apName = $(nTds[0]).text();
				this.setAttribute( 'title', 'เชื่อมต่อ '+apName );
			});

			$('tr td '+icon_apedit, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var apName = $(nTds[0]).text();
				this.setAttribute( 'title', 'แก้ไข '+apName );
			});

			$('tr td '+icon_delete, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var apName = $(nTds[0]).text();
				this.setAttribute( 'title', 'ลบ '+apName );
			});
			
			$('tr td '+icon_print, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var apName = $(nTds[0]).text();
				this.setAttribute( 'title', 'โหลดการตั้งค่า '+apName );
			});

			$(icon_delete+','+icon_apedit+','+icon_print+','+icon_ap).tooltip({
				track: true,
				delay: 0,
				showURL: false,
				showBody: " - ",
				fade: 250
			});
		});

});