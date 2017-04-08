		function doTime() {
			var t = $("input#auto_refresh").attr("checked");
			window.setTimeout( "doTime()", 10000 );
			if(t) { oTable.fnClearTable(); }
		}jQuery(document).ready(function($) {		function init_table()
		{
			oTable = $('#onlineuser').dataTable({
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
										}
									},
									"aoColumns": [ 
										{ "sClass": "left", "bSortable": false},
										null,
										null,
										
										{ "sClass": "center"},
										{ "sClass": "center"},
										{ "sClass": "center"},
										{ "sClass": "right"},
										{ "bSortable": false ,"sClass": "center"}
									],
									"aaSorting": [[4, "asc"]]
							}); 
		}
		
		init_table();
		$('div#onlineuser_filter input[type=text]').attr('placeholder',lang_sPlaceholder);
		
		$('button#refresh').click(function() {
			oTable.fnClearTable();
		});
		
		$('a.disconnect').live('click',function() {
		
			var user = $(this).parents('tr').find('a[id=info]').html();

			var href = $(this).attr('href');		
			$('<div id="disconnect" title="ตัดการเชื่อมต่อ '+user+'"><div title="Confirm" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>ตัดการเชื่อมต่อ: </strong> ยืนยันการตัดการเชื่อมต่อผู้ใช้</p></div></div>').appendTo('body')
			.dialog({
				resizable: false,
				height:195,
				width:400,
				modal: true,
				close: function() {
					$(this).remove();
				},
				buttons: {
					'ตกลง': function () {
						var dialog_id = $(this);
						dialog_id.dialog('close').remove();
						dialog_msg('กำลังดำเนินการ','กรุณารอสักครู่...');
						$.get(href , function (data) {
							if(data.rep) {
								$('div#alert-msg').dialog('close').remove();
								oTable.fnClearTable();
							}
						},"json");
					},
					'ยกเลิก': function () {
						$(this).dialog('close').remove();
					}
				}
			});
			
			$('.ui-dialog :button').blur().parents('.ui-dialog-buttonpane button:eq(1)').focus(); 

			return false;
			
		});
		
		$('a[id=info]').live('click', function() {
			var link = $(this);
			var url  = link.attr('href');
			var user = link.html();
			var cl = $('div[rel='+user+']#userinfo').attr('rel');

			if(cl==null) {
				$.get(url,function(e) {
					$('<div title="Info - '+user+'" rel="'+user+'" id="userinfo"></div>').appendTo('body').html(e).dialog({
						resizable: true,
						height:640,
						width:770,
						close: function() {
							$(this).remove();
						}
					});
					
					$('.'+user).fadeIn(100).delay(350, function() { $('.effect_'+user).fadeIn(300); });
					
				});
			}
			
			return false;
			
		});
		
		doTime();
});

