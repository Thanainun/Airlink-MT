jQuery(document).ready(function($) {
		function init_table()
		{
			oTable = $('#group_table').dataTable({
										"bProcessing": true,
										"bServerSide": true,
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
											} },
											"aoColumns": [ 
												{"sWidth": "12px","sClass": "left","b": false},
												null,
												
												{"sWidth": "5px"},
												{"sWidth": "90px"},
												{"sWidth": "65px"},
												{ "sWidth": "65px","sClass": "right"},
												{ "sWidth": "110px","sClass": "right"},
												{ "sWidth": "60px","bSortable": false,"sClass": "center"}
											],
											"aaSorting": [[1, "asc"]]
									}); 
		}
		
		init_table();
		$('div#group_table_filter input[type=text]').attr('placeholder',lang_sPlaceholder);

		$('[rel=form_groups]').live('click',function() {
			var d = $('body').find('div#group_form_add').attr('id');
			if(d) { return; }
			
			if($(this).attr('id')=='add_group') {
				//alert($(this).attr('id'));
				var form_post = base_url+'index.php/'+controller+'/addgroup';
				var load_url = base_url+'index.php/'+controller+'/getform';
				var title_ = "สร้างกลุ่มผู้ใช้";
			}
			else {
				var form_post = base_url+'index.php/'+controller+'/editgroup/'+$(this).attr('gname');
				var load_url = base_url+'index.php/'+controller+'/editform/'+$(this).attr('gname');
				var title_ = "แก้ไขกลุ่มผู้ใช้";
				//alert(load_url);
			}

			$('<div style="display:none;" title='+title_+' id="group_form_add"></div>').appendTo('body')
			.load(load_url, function() {
				var form_add = $(this);
					form_add.dialog({
						autoOpen: true,
						height: 690,
						width:880,
						//modal: true,
						resizable: false,
						buttons: {
							บันทึก: function() {
								var str = $("form#form").serialize();
								$.post(form_post, str, function(data){
								
									if(data.rep) {
										showmessage(data.msg, 'info');
										oTable.fnClearTable();
										form_add.remove();
									} else {
										jQuery('form#form').validationEngine('validate');
										showmessage(data.msg, 'warning');
									}
									
								}, "json");

							},
							ยกเลิก: function() {
								$('#form').validationEngine('hideAll');
								form_add.remove();
							}
						},
						close: function() {
							$('#form').validationEngine('hideAll');
							form_add.remove();
						}
					});
				
				$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
				
				
				
				var in_bw_download = '<input type="text" name="bw_download" value="" type="text" id="custom_bw_download"  size="10" class="validate[required,maxSize[7],custom[onlyNumberSp]] text-input" />';
				var re_bw_download = '';

				var in_bw_upload = '<input type="text" name="bw_upload" value="" type="text" id="custom_bw_upload" size="10" class="validate[required,maxSize[7],custom[onlyNumberSp]] text-input" />';
				var re_bw_upload = '';
				
				
			
				
				//Toggle form between bw_download/bw_upload
				$('#bw_download').change(function(){
					var bw_download = $(this).val();
					if(bw_download == ''){
						$('.dow_custom').html(in_bw_download);
					}else {
						$('.dow_custom').html(re_bw_download);
					}
				});

				//Toggle form between bw_download/bw_upload
				$('#bw_upload').change(function(){
					var bw_upload = $(this).val();
					if(bw_upload == ''){
						$('.up_custom').html(in_bw_upload);
					}else {
						$('.up_custom').html(re_bw_upload);
					}
				});
				
				$('#reset').click(function() {
					$('.dow_custom').html(re_bw_download);
					$('.up_custom').html(re_bw_upload);
				});

			});
			
			return false;
			
		});

			
			$('#item_delete').live('click', function(){
			
				var title = $(this).attr('gname');
				var href = $(this).attr('href');
				var type = 'highlight';
				var msg = $(this).attr('info');
				var icon = 'info';
			
				$('<div id="item-delete" title="ลบกลุ่ม '+title+'"><div id="dialog-confirm" title="'+title+'" class="ui-state-'+type+' ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-'+icon+'" style="float: left; margin-right: .3em;"></span><strong>คำเตือน: </strong> '+msg+'</p></div></div>').appendTo('body');

				$( "#item-delete" ).dialog({
					resizable: false,
					height:380,
					width:600,
					modal: true,
					buttons: {
						ยืนยัน: function() {

							$( this ).dialog( "close" ).remove();
							dialog_msg('กำลังลบข้อมูล...','กำลังลบข้อมูล...');
						
							$.getJSON(href , function(data) {
							
								if(data.res==true) {

									$( "#alert-msg" ).dialog( "close" ).remove();
									showmessage(data.msg, 'info');
									oTable.fnClearTable();

								} else {

									$( "#alert-msg" ).dialog( "close" ).remove();
									dialog_msg('ผิดพลาด', data.msg, 'error');

								}
							
							});
							
						},
						ยกเลิก: function() {
							$( this ).dialog( "close" ).remove();
						}
					},
					close: function() {
							$( this ).remove();
						}
				});
				
				$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 
				
				return false;
				
			});
			
		// Tooltip
		$('table tbody').hover(function() {
			var tbody = $(this);
			var img_design = 'a.card_design';
			var img_edit = 'a.edit';
			var img_delete = 'a.delete';

			$('tr td '+img_design, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var group = $(nTds[1]).text();
				this.setAttribute( 'title', ' เทมเพลตบัตร '+group );
			});
			
			$('tr td '+img_edit, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var group = $(nTds[1]).text();
				this.setAttribute( 'title', ' แก้ไขกลุ่ม '+group );
			});

			$('tr td '+img_delete, this).each( function() {
				var nTds = $(this).parents('tr').find('td');
				var group = $(nTds[1]).text();
				this.setAttribute( 'title', 'ลบกลุ่ม '+group );
			});

			$(img_delete+','+img_edit+','+img_design).tooltip({
				track: true,
				delay: 0,
				showURL: false,
				showBody: " - ",
				fade: 250
			});
		});
});