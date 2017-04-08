<!DOCTYPE HTML>
<html lang="en" class="no-js">

<head>
<meta charset="utf-8">

<!-- Site Title -->
<title>{header}</title>

<!-- Site Style -->
<link rel="stylesheet" href="{template_path}css/style.css">
<link rel="stylesheet" href="{template_path}css/mediaqueries.css">
<!--[If lte IE 9]><link href="{template_path}css/ie9.css" rel="stylesheet"><![endif]-->
<!--[If lte IE 8]><link href="{template_path}css/ie8.css" rel="stylesheet"><![endif]-->
<!--[If IE 7]><link href="{template_path}css/ie7.css" rel="stylesheet"><![endif]-->



<!-- JS -->
<script src="{template_path}js/jquery-1.10.2.min.js"></script><!-- jQuery Library -->
<script src="{template_path}js/modernizr.custom.50158.js"></script><!-- Modenizr -->
<script src="{template_path}js/jquery.easing.min.js"></script><!-- jQuery Easing -->
<script src="{template_path}js/script.js"></script><!-- Other Script -->
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
           
              

 
</body>
</html>

