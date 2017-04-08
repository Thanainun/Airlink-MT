<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?=$title ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
	<!-- Modernizr
  ================================================== -->
  	<script src="<?=$style ?>js/modernizr.custom.js"></script>
    <script src="<?=$style ?>js/jquery.min.js"></script>
	<!-- Fonts
  ================================================== -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700">
    <link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Cabin">
    <link id="f-sheet" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

	<!-- CSS
  ================================================== -->
   <!-- css : begin -->
		
	<link rel="stylesheet" href="<?=$style ?>css/base.css">
	<link rel="stylesheet" href="<?=$style ?>css/skeleton.css">
    <link rel="stylesheet" href="<?=$style ?>css/layout1.css">
    <link rel="stylesheet" href="<?=$style ?>css/flexslider.css">
    <link rel="stylesheet" href="<?=$style ?>css/magnific-popup.css"> 

	<!--[if lt IE 9]>
		<script src="<?=$style ?>js/html5.js"></script>
	<![endif]-->

    
    <!-- Scripts, other js in footer
  ================================================== -->
	<script src="<?=$style ?>js/jquery-1.8.2.min.js"></script>
	<script src="<?=$style ?>js/scripts.js"></script>
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