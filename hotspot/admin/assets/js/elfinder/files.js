$().ready(function() {
	$('#finder').elfinder({
		url : base_url+'index.php/'+controller+'/connector',
		lang : 'th',
		docked : true
	});
	$('#themes').elfinder({
		url : base_url+'index.php/'+controller+'/media',
		lang : 'th',
		docked : true
	});
});