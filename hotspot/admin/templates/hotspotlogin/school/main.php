<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8 ieold"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html><!--<![endif]-->
<head>
	<title>{header}</title>
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700" />
     <meta name="viewport" content="width=device-width, user-scalable = no" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">

<!-- 3 บรรทัด ตรงนี้เอาออกไม่ได้ -->
	{_styles} 
	{_scripts}

 <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="{template_path}css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/font-awesome-ie7.min.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/responsiveslides.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/style.css" />
      
  <script type="text/javascript">
/* <![CDATA[ */
$(function() {
	var input = document.createElement("input");
    if(('placeholder' in input)==false) { 
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = $(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});
/* ]]> */
</script>

 <!--[if lte IE 8]>
            <script src="{template_path}js/html5.min.js" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="{template_path}css/oldie.css">
        <![endif]-->
        <!-- STYLESHEETS : end -->
</head>
<body class="">

		{body}
<!-- กำหนดขนาดของ ป๊อบอัพ สำหรับเทมเพลตตัวนี้ -->
<div rel="popup_size" id="popup_size" width="525" height="425"></div>
 <!-- STYLE SWITCHER : begin -->
</body>
</html>

