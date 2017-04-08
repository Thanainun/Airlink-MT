<link type="text/css" rel="stylesheet" href="<?=$cssfiles ?>css/validationEngine.jquery.css?v=01" />
<link type="text/css" rel="stylesheet" href="<?=$cssfiles ?>css/jquery.fancybox-1.3.4.css?v=01" />
 <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/social-icons.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/magnific-popup.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/default.css" id="css-skin" />
        <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/air.css" />
  
<script type="text/javascript" src="<?=$cssfiles ?>jquery.min.js"></script>
 <!--[if lte IE 8]>
            <script src="<?=$cssfiles ?>js/html5.min.js" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="<?=$cssfiles ?>css/oldie.css">
        <![endif]-->
        <!-- STYLESHEETS : end -->
        
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