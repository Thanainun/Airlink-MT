<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<title>{header}</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- 3 บรรทัด ตรงนี้เอาออกไม่ได้ -->
	{_styles} 
	{_scripts}

 

<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="{template_path}css/validationEngine.jquery.css?v=01" />
<link type="text/css" rel="stylesheet" href="{template_path}css/jquery.fancybox-1.3.4.css?v=01" />
 <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,700' rel='stylesheet' type='text/css'>
 <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="{template_path}css/flexslider.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/jquery-ui-theme.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/main.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/mq-32.css" media="screen and (min-width: 32.5em)" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/mq-48.css" media="screen and (min-width: 48em)"  />
        <link rel="stylesheet" type="text/css" href="{template_path}css/mq-67.css" media="screen and (min-width: 67.5em)" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/normalize.css" />
  
 
  <!--[if (lt IE 9)&(!IEMobile)]>
          <link rel="stylesheet" href="{template_path}css/foundation-ie8.css">
          <link rel="stylesheet" href="{template_path}css/mq-32.css"/>
          <link rel="stylesheet" href="{template_path}css/mq-48.css"/>
          <link rel="stylesheet" href="{template_path}css/mq-67.css"/>
        <![endif]-->  
 
<script type="text/javascript" src="{template_path}js/jquery.fancybox-1.3.4.pack.js?v=01"></script>
<script type="text/javascript" src="{template_path}js/validation/jquery.validationEngine-en.js?v=01"></script>
<script type="text/javascript" src="{template_path}js/validation/jquery.validationEngine.js?v=01"></script>
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

</head>
<body>

		{body}






<!-- กำหนดขนาดของ ป๊อบอัพ สำหรับเทมเพลตตัวนี้ -->
<div rel="popup_size" id="popup_size" width="525" height="425"></div>
 <!-- STYLE SWITCHER : begin -->
           
</body>
</html>

