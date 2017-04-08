<!DOCTYPE html><head>
<meta charset="UTF-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes"> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<title>AKI INTERNET NETWORK </title>
{_styles}
{_scripts}



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
            <script src="assets/js/html5.min.js" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="assets/css/oldie.css">
        <![endif]-->
        <!-- STYLESHEETS : end -->

<script type="text/javascript" src="{template_path}js/jquery.fancybox-1.3.4.pack.js?v=01"></script>
<script type="text/javascript" src="{template_path}js/validation/jquery.validationEngine-en.js?v=01"></script>
<script type="text/javascript" src="{template_path}js/validation/jquery.validationEngine.js?v=01"></script>


</head>
  <body id="top" class="frontpage fixed-header">

        <!-- WRAPPER : begin -->
        <div id="wrapper">

            <!-- HEADER : begin -->
            <header>
                <div class="container">
                    <div class="header-inner clearfix">

                        <!-- HEADER BRANDING : begin -->
                        <div class="branding">{header}</div>
                        <!-- HEADER BRANDING : end -->
                         <!-- NAV TOGGLE : begin -->
                        <button class="nav-toggle"><i class="icon-reorder"></i></button>
                        <!-- NAV TOGGLE : end -->
                        <!-- MAIN NAV : begin -->
                        <nav class="main">
                            <p>
                            Select language :  <?=anchor("signup/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("signup/languser/english","<span>English</span>");?>
                            </p>
                            <div class="indicator"></div>


                    </div>
                </div>
            </header>
            <!-- HEADER : end -->

            <!-- INTRODUCTION SECTION : begin -->
            <section id="introduction" class="backstretch">
                <div class="container">
                    <div class="introduction-inner various-content">

                    {content}
				
			   </div>
                </div>
            </section>
            <!-- INTRODUCTION SECTION : end -->


            

            <!-- SCREEN WIDTH : begin -->
            <var id="screen-width"><span></span></var>
    
    
     <!-- SCRIPTS : begin -->
            
            <script src="{template_path}js/modernizr.min.js" type="text/javascript"></script>
            <script src="{template_path}js/jquery.isotope.min.js" type="text/javascript"></script>
            <script src="{template_path}js/jquery.magnific-popup.min.js" type="text/javascript"></script>
            
            <!--[if lte IE 8]>
                <script src="assets/js/css3pie.min.js" type="text/javascript"></script>
                <script src="assets/js/css3pie.custom.js" type="text/javascript"></script>
            <![endif]-->
            <script src="{template_path}js/scripts.js" type="text/javascript"></script>
            <!-- SCRIPTS : end -->
    
    
    
</body>
</html>