<meta charset="UTF-8">
<html>
<head>
	<title><?php echo $title ?></title>
 <!-- STYLESHEETS : begin -->

		<link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/social-icons.min.css" />
        <link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/magnific-popup.min.css" />
        <link rel="stylesheet" type="text/css" href="../..//hotspot/templates/hotspotlogin/air/css/default.css" />
        <link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/air.css" />
     
        <link rel="stylesheet" type="text/css" href="../../hotspot/templates/hotspotlogin/air/css/zozo.tabs.min.css" />
        <script type="text/javascript" src="../../hotspot/templates/hotspotlogin/air/js/jquery.min.js"></script>
        <script type="text/javascript" src="../../hotspot/templates/hotspotlogin/air/js/zozo.tabs.min.js"></script>
        
      <!-- TAB STYLES END -->
        
        <!-- TAB STYLES END -->
        
</head>


<body id="top" class="frontpage fixed-header">

<!-- WRAPPER : begin -->
        <div id="wrapper">

            <!-- HEADER : begin -->
            <header>
                <div class="container">
                    <div class="header-inner clearfix">

                        <!-- HEADER BRANDING : begin -->
                        <div class="branding"><img src=../../hotspot/templates/logo/logo_air.png></div>
                        <!-- HEADER BRANDING : end -->
                         <!-- NAV TOGGLE : begin -->
                        <button class="nav-toggle"><i class="icon-reorder"></i></button>
                        <!-- NAV TOGGLE : end -->
                        <!-- MAIN NAV : begin -->
                        <nav class="main">
                            <p>
                            Select language :  <?=anchor("forgot_password/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("forgot_password/languser/english","<span>English</span>");?>
                            </p>
                            <div class="indicator"></div>
						</nav>
                        <!-- MAIN NAV : end -->

                    </div>
                </div>
            </header>
            <!-- HEADER : end -->
              <!-- INTRODUCTION SECTION : begin -->
            <section id="introduction" class="backstretch">
                <div class="container">
                    <div class="introduction-inner various-content">
                    	<div class="container">
                        <div class="row-fluid">
                        <div class="span6">
                        	<div class="content-box various-content">
						<form action="<?php echo base_url('index.php/forgot_password/check') ?>" id="form" class="validate default-form various-content" method="post" accept-charset="utf-8">						
							<div class="cta-message aligncenter">
								<h3><i class="icon-user"></i> <?=$this->lang->line('uforgot_password') ?></h3>
                        </div>
						<hr class="divider">
							
						
								<input type="text" class="form-control" name="id_card" id="user" title="รหัสบัตรประจำตัวประชาชน" placeholder="<?=$this->lang->line('personal_id1')?>" required="required"  />						    
						 
						<input type="submit" name="login" value="<?=$this->lang->line('iforgot_confirm')?>" class="button big style2" />	
					
						</form>                        	</div>
                          </div>
                          
                          <div class="span6">
                          <section class="various-content">
                          <div class="content-box various-content">
                          <h3 class="aligncenter"><i class="icon-dashboard"></i> <?=$this->lang->line('iforgot_password')?>?</h3>
                         
                          <ul class="custom-list contact-details">
                          <li><i class="ico icon-retweet"></i> <?=$this->lang->line('iforgot_phone')?> : <?=$tel_text?></li>
                          <li><i class="ico icon-envelope"></i> <?=$this->lang->line('iforgot_cont')?></li>
                           
                          </ul>
                         <hr class="divider">
                          </div>
                          </section>
                          
                          </div>
                          
                        </div>
                      </div>
                   </div>
                </div>
            </section>
					
</body>

 <!-- FOOTER : begin -->
            <footer>
                <div class="container">
                    <div class="footer-inner">

                        <div class="row-fluid">
                            <div class="span8">

                                <!-- COPYRIGHT : begin -->
                                <div class="copyright various-content">
                                    <p>&copy; 2013 Airlink WiFi Hotspot.All right reserve</p>
                                </div>
                                <!-- COPYRIGHT : end -->

                            </div>
                            <div class="span4">

                                

                            </div>
                        </div>

                    </div>
                </div>
            </footer>
            <!-- FOOTER : end -->
</html>