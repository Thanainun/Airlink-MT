jQuery(document).ready(function($) {
		function init_table() {
			oTable = $('#used_list').dataTable({
									"bProcessing": true,
									"bServerSide": false,
									"sAjaxSource": base_url+"index.php/"+controller+"/json",
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
										{ "sClass": "center"},
										null,
										null,
										{ "sClass": "center"},
										{ "sClass": "right"},
										{ "sClass": "right"},
										{ "sClass": "right"}
									],
									"aaSorting": [[0, "asc"]]
			}); 
		}

		init_table();
		
		$('div#used_list_filter input[type=text]').attr('placeholder',lang_sPlaceholder);
		
});