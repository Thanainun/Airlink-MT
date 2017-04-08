<!DOCTYPE html>
<html>
<head>
	<title>{header}</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- Styles -->
    <link href="{template_path}css/bootstrap.min.css" rel="stylesheet" />
    <link href="{template_path}css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="{template_path}css/bootstrap-overrides.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{template_path}css/theme.css" />
  

    <link rel="stylesheet" type="text/css" href="{template_path}css/lib/animate.css" media="screen, projection" />
    <link rel="stylesheet" href="{template_path}css/sign-up.css" type="text/css" media="screen" />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- 3 บรรทัด ตรงนี้เอาออกไม่ได้ -->
	{_styles} 
	{_scripts}
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
           
              

 <!-- SCRIPTS : begin -->
            
         <script src="{template_path}js/bootstrap.min.js"></script>
  	  	 <script src="{template_path}js/theme.js"></script>
</body>
</html>

