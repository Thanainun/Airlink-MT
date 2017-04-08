<?php

	function checkall($checkAll,$table_class) 
	{
		$call = "
		
			var _class;
			var ckall;
			$(document).ready(function() {
				$('#".$checkAll."').click(function(){
					ckall = $(this).prop('checked');
					$(this).parents('.".$table_class."').find('.slck')
					.attr('checked',ckall);
					
					_class = $(this).parents('.".$table_class."').find('tr').attr('class');

					if(_class=='row_selected' && ckall==false) { 
						$('tr').removeClass('row_selected'); 
					} else { 
						$('tr').addClass('row_selected'); 
					}
				
				});
			});
			
			";
		return $call;
	}
	
	function ajaxtable($data)
	{
		$output = '';
		$output .= 'oTable = $(\'#'.$data['id'].'\').dataTable({ '.
			'"bProcessing": true,'.
			'"bServerSide": '.(isset($data['ServerSide']) ? 'true' : 'false' ).','.
			'"sAjaxSource": '.$data['url'].','.
			'"sDom": sDom_tool,'.
			'"bStateSave": true,'.
			'"sPaginationType": "full_numbers",';
		$output .= '"oLanguage": {'.
				'"sProcessing": lang_sProcessing,'.
				'"sSearch": lang_sSearch,'.
				'"sLengthMenu": lang_sLengthMenu,'.
				'"sZeroRecords": lang_sZeroRecords,'.
				'"sInfo": lang_sInfo,'.
				'"sInfoEmpty": lang_sInfoEmpty,'.
				'"sInfoFiltered": lang_sInfoFiltered,'.
				'"oPaginate": {'.
					'"sFirst":    lang_sFirst,'.
					'"sPrevious": lang_sPrevious,'.
					'"sNext":     lang_sNext,'.
					'"sLast":     lang_sLast } }, ';
		
		if(isset($data['columns']))
		{
			$output .= ' "aoColumns": [ ';
			foreach($data['columns'] as $val)
			{
				$output .= $val.',';
			}
			$output .= ' ],';
		}

		$output .= (isset($data['sorting']) ? ' "aaSorting": ['.$data['sorting'].'], ' : '');
		
		return $output .= ' }); ';
		
	}

	function tooltip_popup() {

		return true;

	}
?>
