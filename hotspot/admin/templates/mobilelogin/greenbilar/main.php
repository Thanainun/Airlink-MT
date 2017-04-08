<!DOCTYPE html>
<html>
<head>
<title>{header}</title>
<!-- meta tags start -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<!-- meta tags end -->
<!-- fav icon starts -->
<link rel="shortcut icon" href="{template_path}images/common/favicon.ico" type="image/x-icon" />
<!-- fav icon ends -->
<!-- google fonts start -->
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
<!-- google fonts ends -->
<!-- css files start -->
<link href="{template_path}css/framework.css" rel="stylesheet" type="text/css" media="all" />
<link href="{template_path}css/colorbox.css" rel="stylesheet" type="text/css" media="all" />
<link href="{template_path}css/elements.css" rel="stylesheet" type="text/css" media="all" />
<link href="{template_path}css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{template_path}css/responsive.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{template_path}css/hidpi.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{template_path}css/skin.css" rel="stylesheet" type="text/css" media="all" />
<link href="{template_path}css/custom.css" rel="stylesheet" type="text/css" media="all" />
<!-- css files end -->
<!-- javascript files start -->
<script type="text/javascript" src="{template_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{template_path}js/effects.jquery-ui.min.js"></script>

<script type="text/javascript" src="{template_path}js/jquery.colorbox.min.js"></script>
<script type="text/javascript" src="{template_path}js/custom.js"></script>
<!-- javascript files end -->
{meta_refresh}
</head>
<body>

<!-- website wrap starts -->
<div class="websiteWrap"> 
  
  <!-- main menu wrap starts -->
  <ul class="mainMenuWrap">
    <li class="currentPage"><a href="dashboard">Dashboard</a></li>
    <li><a href="clear">Clear</a></li>
    <li><a href="topup">Topup</a></li>
  </ul>
  <!-- main menu wrap ends --> 
  
  <!-- header wrap starts -->
  <div class="headerOuterWrap">
    <div class="headerWrap">{logo}<a href="#" class="mainMenuButton"></a></div>
  </div>
  <!-- header wrap ends --> 
		{body}
<div class="pageBreak headerBreak"></div>
  
  <div class="sectionBreak"></div>
  <p><a href="signup">ลงทะเบียน</a></p>
    <div class="lang">Select language : <?=anchor("gologin/languser/thai","ไทย");?>&nbsp; <?=anchor("gologin/languser/english","English");?></div>
  <!-- footer wrap starts -->
  <div class="footerTopDeco"></div>
  <div class="footerWrap"> 
    <!-- copyright wrap starts -->
    <div class="copyrightWrap"> 
      <!-- copyright starts --> 
      <span class="copyright">&copy; copyright {login_copy}.</span> 
      <!-- copyright ends --> 
      <!-- back to top button starts --> 
      <a href="#" class="backToTopButton"></a> 
      <!-- back to top button ends --> 
    </div>
    <!-- copyright wrap ends --> 
  </div>
  <!-- footer wrap ends --> 
  
</div>
<!-- website wrap ends -->

</body>
</html>
