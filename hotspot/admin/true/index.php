<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>airlink True Money Refill!</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
	<!-- Modernizr
  ================================================== -->
  	<script src="js/modernizr.custom.js"></script>
    
	<!-- Fonts
  ================================================== -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700">
    <link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Cabin">
    <link id="f-sheet" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
    <link class="changeme" rel="stylesheet" href="css/layout3.css">
    
    <link rel="stylesheet" href="assets/flexslider/flexslider.css">
    <link rel="stylesheet" href="css/magnific-popup.css"> 

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
  ================================================== -->
	<link rel="shortcut icon" href="images/favicon.html">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.html">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.html">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.html">
    
    <!-- Scripts, other js in footer
  ================================================== -->
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/scripts.js"></script>

		
<script type="text/javascript">
function countDown(secs) {
	var btn = document.getElementById('btn');
	btn.value = "Please wait while system checking in "+secs+" second(s)";
	if(secs < 1) {
		clearTimeout(timer);
		btn.disabled = false;
		btn.value = 'Go! Dashboard';
	}
	secs--;
	var timer = setTimeout('countDown('+secs+')',1000);
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
?>
<!-- header section-->
	<h1 class="intro-title">
  	<img src="logo-true.png" />
    </h1>
  

  
  
 
 
 <!-- purchase section -->   
	<a id="purchase-marker" class="marker"></a> 
	<div class="purchase-section">
		<div class="container">
			<div class="row sixteen columns title-row">
                <h3 class="white-title-alt">
                	<i class="title-icon icon-angle-right"></i> True money refill. The easy way to refill <i class="title-icon icon-angle-left"></i>
                </h3>
                 <div class="row six columns"><img src="professor.png" width="220px" height="380px"></div>
                 <div class="row six columns"><img src="cardtmn.jpg"><img src="cardprice.jpg"></div>
      		</div>
      		
            <div class="row sixteen columns title-row">
      			<div class="white-title-alt">
    				<form name="form1" method="post" action="<?=$actual_link ?>/hotspot/index.php/dashboard">
    <input disabled type="submit" id="btn" value="Please wait.." style="text-align:center">
    </form>
     			</div>
			</div>

		</div>
	</div><!-- /purchase section -->
 
 
 
<script type="text/javascript">countDown(25);</script>
<!-- Scripts
  ================================================== -->
	<script src="js/jquery.sidr.min.js"></script>
	<script src="js/fitvids.js"></script>
    <script src="assets/flexslider/jquery.flexslider.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script> 
    <script src="js/screen.js"></script>
</body>
</html>