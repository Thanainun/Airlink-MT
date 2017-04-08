jQuery(document).ready(function($) {
		function init_table() {
			oTable = $('#used_history').dataTable({
									"bProcessing": true,
									"bServerSide": false,
									"sAjaxSource": base_url+"index.php/"+controller+"/json_history/"+uid,
									"sDom": sDom_tool,"bStateSave": true,
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
										{ "sWidth":"30px","sClass": "center" },
										{ "sWidth":"40px" },
										{ "sWidth":"30px","sClass": "center" },
										{ "sWidth":"30px","sClass": "right" },
										{ "sWidth":"30px","sClass": "right" },
										{ "sWidth":"30px","sClass": "right" }
									],
									"aaSorting": [[0, "asc"]]
			}); 
		}

		init_table();
		
		$('div#used_history_filter input[type=text]').attr('placeholder',lang_sPlaceholder);
		
});