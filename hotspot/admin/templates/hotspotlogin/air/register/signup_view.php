<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{site-name}:{header}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">

<!-- 3 บรรทัด ตรงนี้เอาออกไม่ได้ -->
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
<?=$this->form_validation->error_string;?>


                <!-- Left column/section -->
                <? if ($complate) { ?>
                <div id="login">
                <div class="widget widget-4">
	<div class="widget-head"><h4 class="heading glyphicons home"><i></i>ลงทะเบียนสำเร็จแล้ว</h4></div>
	<div class="widget-body"> 
    					
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
                                
                                <p>Username และ Password ได้รับเพ็ํค <?=$plan?>และสามารใช้งานได้ทันที</p>


</div>
</div></div>
<div class="separator"></div>
	<? } else {?>
		<? if(!$invalid) { ?>
                   
             <section id="contact">


                <!-- SECTION CONTENT : begin -->
                <div class="section-content">
                    <div class="container">
                        <div class="section-content-inner various-content">
                        

                            <div class="row-fluid">
                                <div class="span7">

                                    <!-- CONTACT FORM : begin -->
                                    <section class="various-content">

                                        <h3><?=$this->lang->line('register_header') ?></h3>
                                        <?=form_open($this->uri->segment(1).'/','id="form" class="validate default-form various-content" autocomplete="off"')?>
                           

                                            <!-- FORM VALIDATION ERROR MESSAGE : begin -->
                                            <p class="alert warning validation" style="display: none;"><i class="ico icon-warning-sign"></i><strong>Fields with (*) are required!</strong><br />All required fields must be filled correctly.</p>
                                            <!-- FORM VALIDATION ERROR MESSAGE : end -->

                                            <!-- SENDING REQUEST ERROR MESSAGE : begin -->
                                            <p class="alert warning request" style="display: none;"><i class="ico icon-warning-sign"></i><strong>Form not sent!</strong><br />There was a connection problem. Try again later.</p>
                                            <!-- SENDING REQUEST ERROR MESSAGE : end -->

                                            <!-- FORM FIELDS : begin -->
                                            <div class="form-fields various-content">
												<div class="row-fluid">
                                                    <div class="span6">
                                               			 <p>
                                                    <!-- add class 'required' to all mandatory fields -->
                                                    
                                                    <?=form_input('username','','type="text" maxlength="70" required="required" class="required" id="username" placeholder='.$this->lang->line('register_username').' ')?>
                                                 
                                                </p>
                                                 </div>
                                                 <div class="span6">
                                                <p>
                                                  <?=form_input('password','','type="text" maxlength="70" required="required" id="password" placeholder='.$this->lang->line('register_password').'')?>
                                                </p>
                                               
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span6">
                                                        <p>
                                                            <!-- add class 'email' to email field in addition to 'required' -->
                                                            <?=form_input('firstname','','type="text" maxlength="70" required="required" id="firstname" placeholder='.$this->lang->line('register_firstname').'')?>
                                                        </p>
                                                    </div>
                                                    <div class="span6">
                                                        <p>
                                                            <?=form_input('lastname','','type="text" maxlength="70" required="required" id="lastname" placeholder='.$this->lang->line('register_lastname').'')?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <p>
                                                    <?=form_input(array('name'=>'personal_id','minlength'=>'13'),'',' title="รหัสประจำตัวประชาชน" id="personal_id" placeholder='.$this->lang->line('register_personal_id').'')?>
                                                </p>
                                               <div class="row-fluid">
                                                    <div class="span6">
                                                        <p>
                                                        <?=form_input('surename','','type="text" placeholder='.$this->lang->line('register_surename').'')?>
                                                        </p>
                                                  </div>
                                                    <div class="span6">
                                                        <p>      
                                                    <?= form_dropdown('gender',array(''=>''.$this->lang->line('register_gender').'','male'=>'ชาย','famale'=>'หญิง'),'','')?>
                                                </p>
                                                </div>
                                               
                                                
                                               
                                               	<div class="row-fluid">
                                                	<div class="span6">
                                                    <p>
                                                    <?=form_input(array('name'=>'phone'),'','placeholder='.$this->lang->line('register_phone').'')?>
                                                    </p>
                                                    </div> 
                                                    <div class="span6">
                                                    <p><?=form_input(array('name'=>'email','type'=>'email'),'',' maxlength="75" id="email" placeholder='.$this->lang->line('register_email').'')?></p>
                                                    </div>
                                               <div class="row-fluid">
                                               	<div class="span12">
                                                <p>
                                                <?
											$txtdata = array(
												'name'      => 'note',
												'id'        => 'note',
												'value'     => '',
												'rows'   	=> '5',
												'cols'      => '20',
												
												'placeholder' => ''.$this->lang->line('register_message').''
											);
											echo form_textarea($txtdata);
										?>
                                        </p>
                                                </div>
                                                
                                               
                                               <div class="row-fluid">
                                               	<div class="span6">
                                                <p>
                                               <?=form_input('address1','','type="text" required="required" placeholder='.$this->lang->line('register_address1').'')?>
												</p>
                                                </div>
                                                
                                                <div class="span6">
                                                <p>
                                                <?=form_input('address2','','type="text" required="required" id="address2" placeholder='.$this->lang->line('register_address2').'')?>
                                                </p>
                                                </div>
                                                 <div class="row-fluid">
                                               	<div class="span6">
                                                <p>
                                               <?=form_input('district','','type="text" placeholder='.$this->lang->line('register_tambon').' ')?>
                                               </p>
                                               </div>
                                               <div class="span6">
                                               <p>
                                               <?=form_input('amphur','','type="text" placeholder='.$this->lang->line('register_amphor').' ')?>
                                               </p>
                                               </div>
                                               <?=form_input('province','','type="text" placeholder='.$this->lang->line('register_city').'')?>
                                               
                                                <p>
                                                
                                                <button class="submit button style2" type="reset"><?=$this->lang->line('register_clear'); ?></button><button class="submit button style1" type="submit"><?=$this->lang->line('register_submit'); ?></button>
                                                  
                                                </p>

                                            </div>
                                            <!-- FORM FIELDS : end -->

                                        </form>
                                    </section>
                                    <!-- CONTACT FORM : end -->

                                </div>
                                <div class="span5">

                                    <!-- CONTACT INFO: begin -->
                                    <section class="various-content">

                                        <h3><?=$this->lang->line('register_where_we_are') ?></h3>
                                        <div class="content-box various-content">
                                            <p><strong><?=$address; ?></strong>
                                           
                                           </p>
                                            <hr class="divider" />
                                            <ul class="custom-list contact-details">
                                                <li><i class="ico icon-phone"></i> <?=$tel; ?></li>
                                                <li><i class="ico icon-envelope"></i> <?=$mail; ?></li>
                                            </ul>
                                        </div>

                                    </section>
                                    <!-- CONTACT INFO: end -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- SECTION CONTENT : begin -->


            </section>
            <!-- CONTACT : end -->

                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
		<? } else if ($invalid) {?>

                    <div class="columns">
                        <div class="grid_5 first">
							<hr >
							<div  class="message warning">
								<div align="center"><h3>ขออภัย <br /> ระบบยังไม่เปิดรับลงทะเบียน</h3></div>
							</div>
                        </div>
                    </div>
<? 
		}
	}
?>
                    <div class="clear">&nbsp;</div>
                </section>
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

