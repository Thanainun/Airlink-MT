<?php
$username = array(
	'name'	=> 'user',
	'id'	=> 'user',
	'value' => set_value('username'),
	'size' 	=> 10,
);
$password = array(
	'name'	=> 'pass',
	'id'	=> 'pass',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 10,
);

?>
<body id="top" class="frontpage fixed-header">

<!-- WRAPPER : begin -->
        <div id="wrapper">

            <!-- HEADER : begin -->
            <header>
                <div class="container">
                    <div class="header-inner clearfix">

                        <!-- HEADER BRANDING : begin -->
                        <div class="branding"><?=$logo ?></div>
                        <!-- HEADER BRANDING : end -->
                         <!-- NAV TOGGLE : begin -->
                        <button class="nav-toggle"><i class="icon-reorder"></i></button>
                        <!-- NAV TOGGLE : end -->
                        <!-- MAIN NAV : begin -->
                        <nav class="main">
                            <p>
                            Select language :<?=anchor("dashboard/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("dashboard/languser/english","<span>English</span>");?>
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
							<?=form_open('dashboard/loginuser','id="form" class="validate default-form various-content"')?>							
								<div class="cta-message aligncenter">
									<h3><i class="icon-user"></i>  <?=$this->lang->line('user_refill_header') ?></h3>
								</div>
								<hr class="divider">
							
						
								<?=form_input(array('name'=>'user','type'=>'text','minlength'=>'4'),'',' autocomplete="off" title="ชื่อผู้ใช้เดิมที่จะเติม" placeholder='.$this->lang->line('user_refill_u').' required="required" id="user"' )?>
						   
								<?=form_input(array('name'=>'pass','type'=>'password','minlength'=>'4'),'',' autocomplete="off" title="รหัสเดิมที่จะเติม" placeholder='.$this->lang->line('user_refill_p').' required="required" id="pass"')?>
							    
									<div class="aligncenter">
										<?php echo form_submit('login', $this->lang->line('user_refill_button').'','class="button big style2"'); ?>
										<p></p>
										<?=anchor('signup',$this->lang->line('register_submit').'',' class="button submit style2" info="'.$this->lang->line('register_submit').'" id="selectplan"');?>
									</div>
					
							<?php echo form_close(); ?>
                        	</div>
                          </div>
                          
                          <div class="span6">
                          <section class="various-content">
                          <div class="content-box various-content">
                          <h3 class="aligncenter"><i class="icon-dashboard"></i> <?=$this->lang->line('user_dashboard_head') ?> </h3>
                         
                          <ul class="custom-list contact-details">
                          <li><i class="ico icon-retweet"></i>  <?=$this->lang->line('user_dashboard_topic1') ?></li>
                           <li><i class="ico icon-random"></i>  <?=$this->lang->line('user_dashboard_topic2') ?></li>
                           <li><i class="ico icon-bar-chart"></i>  <?=$this->lang->line('user_dashboard_topic3') ?></li>
                           <li><i class="ico icon-eye-close"></i>  <?=$this->lang->line('user_dashboard_topic4') ?></li>
                           <li><i class="ico icon-certificate"></i>  <?=$this->lang->line('user_dashboard_topic5') ?></li>
                            <li><i class="ico icon-envelope"></i>  <?=$this->lang->line('user_dashboard_topic6')?></li>
                           
                          </ul>
                         <hr class="divider">
                         <div class="aligncenter">
                         <p></p>
						 
						 <?=anchor('forgot_password',$this->lang->line('forgot_password').'',' class="button submit style1" info="'.$this->lang->line('forgot_password').'" id="selectplan"');?> <a href="../../repass/" class="submit button style1"><?=$this->lang->line('chang_password')?></a> <a href="http://172.0.0.1/" class="submit button style1">LogIn WiFi</a>
                         <!--a href="signup" class="submit button style2">ลงทะเบียน</a> <a href="#" class="submit button style1">ลืมรหัสผ่าน</a> <a href="gologin" class="submit button style1">Go login</a-->
                         </div>
                          </div>
                          </section>
                          
                          </div>
                          
                        </div>
                      </div>
                   </div>
                </div>
            </section>
            <!-- INTRODUCTION SECTION : end -->
            
           
            <!-- SCRIPTS : begin -->
            
           <script src="<?=$cssfiles ?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script src="<?=$cssfiles ?>js/modernizr.min.js" type="text/javascript"></script>
            <script src="<?=$cssfiles ?>js/jquery.isotope.min.js" type="text/javascript"></script>
            <script src="<?=$cssfiles ?>js/jquery.magnific-popup.min.js" type="text/javascript"></script>
            
            <!--[if lte IE 8]>
                <script src="assets/js/css3pie.min.js" type="text/javascript"></script>
                <script src="assets/js/css3pie.custom.js" type="text/javascript"></script>
            <![endif]-->
            <script src="<?=$cssfiles ?>js/scripts.js" type="text/javascript"></script>
            <!-- SCRIPTS : end -->                     

					
</body>
