<!DOCTYPE html><head>
	<title>{header}</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- 3 บรรทัด ตรงนี้เอาออกไม่ได้ -->
	{_styles} 
	{_scripts}

 

<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="{template_path}css/validationEngine.jquery.css?v=01" />
<link type="text/css" rel="stylesheet" href="{template_path}css/jquery.fancybox-1.3.4.css?v=01" />
 <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="{template_path}css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/social-icons.min.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/magnific-popup.min.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/default.css" />
        <link rel="stylesheet" type="text/css" href="{template_path}css/air.css" />
  

 <!--[if lte IE 8]>
            <script src="{template_path}js/html5.min.js" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="{template_path}css/oldie.css">
        <![endif]-->
        <!-- STYLESHEETS : end -->

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
<body id="top" class="frontpage fixed-header">

		{body}






<!-- กำหนดขนาดของ ป๊อบอัพ สำหรับเทมเพลตตัวนี้ -->
<div rel="popup_size" id="popup_size" width="525" height="425"></div>
 <!-- STYLE SWITCHER : begin -->
           
              

 <!-- SCRIPTS : begin -->
            
            <script src="{template_path}js/modernizr.min.js" type="text/javascript"></script>
            <script src="{template_path}js/jquery.isotope.min.js" type="text/javascript"></script>
            <script src="{template_path}js/jquery.magnific-popup.min.js" type="text/javascript"></script>
            
            <!--[if lte IE 8]>
                <script src="{template_path}js/css3pie.min.js" type="text/javascript"></script>
                <script src="{template_path}js/css3pie.custom.js" type="text/javascript"></script>
            <![endif]-->
            <script src="{template_path}js/scripts.js" type="text/javascript"></script>
            <!-- SCRIPTS : end -->
</body>
</html>

