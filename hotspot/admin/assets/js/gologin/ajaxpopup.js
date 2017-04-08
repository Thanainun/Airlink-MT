(function($) {

	$.get(base_url+'index.php/gologin/dcontent', function(data) {
		$('[rel=dynamic_content]').html(data);
	});

})(jQuery);