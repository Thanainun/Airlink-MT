<script>
	 $(function() {
    $( "#dialog" ).dialog({
	  height: 800,
	  width: 800,
	  top:80,
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500,
		
      },
      hide: {
        effect: "blind",
        duration: 500
      }
    });
 
    $( "#help" ).click(function() {
      $( "#dialog" ).dialog( "open" );
	  
    });
  });
</script>
<div id="dialog" title="Announcements">
         {login_content}
        
        </div>





        <!-- WRAPPER : begin -->
        <div id="wrapper">

            <!-- HEADER : begin -->
            <header>
                <div class="container">
                    <div class="header-inner clearfix">

                        <!-- HEADER BRANDING : begin -->
                        <div class="branding"><?=$header ?></div>
                        <!-- HEADER BRANDING : end -->

                        <!-- NAV TOGGLE : begin -->
                        <button class="nav-toggle"><i class="icon-reorder"></i></button>
                        <!-- NAV TOGGLE : end -->

                        <!-- MAIN NAV : begin -->
                        <nav class="main">
                       <p>
                              Select language :  <?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");?>                    <a href="#" id="help">ประกาศและข่าวสาร</a>

                           
                           </p>
                        </nav>
                        <!-- MAIN NAV : end -->

                    </div>
                </div>
            </header>
            <!-- HEADER : end -->

            <!-- INTRODUCTION SECTION : begin -->
            <section id="introduction" class="aligncenter backstretch">
                <div class="container">
                    <div class="introduction-inner various-content">
						<div class="form-fields various-content">

                        <h1><?=$this->lang->line('gologin_title') ?></h1>
                        <h2><?=$this->lang->line('gologin_title_small') ?></h2>

         
                        <!-- change the action URL for subsribe form -->
                        <form action="/hotspot/index.php/gologin" id="" name="form1" method="post" class="validate default-form various-content">

                           
                            <!-- FORM FIELDS : begin -->
                            <div class="form-fields">

                                    <div class="span4">
                                        <div class="table">
                                            <div class="tablecell">
                                                <p>
                                                    <input class="placeholder" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="table">
                                            <div class="tablecell">
                                                <p>
                                                   <input class="placeholder" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
                                                   
                                                  
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="table">
                                       
                                            <div class="tablecell">
                                                 <p>
                                               
                                                    <button title="Login" class="submit button style2" value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
                                                    <br  />
                                                   
                                                   <input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember">Remember Me</label>
                                                   
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- FORM FIELDS : end -->

                        </form>
		
										<p></p>		
							</div>					<div style="color:red;" rel="reply" class="total_members">{message}</div>
					</div>
                    </div> 
            </section>
            
            <!-- INTRODUCTION SECTION :
            
   <!-- SERVICES SECTION : begin -->
            <section id="services">

                <!-- SECTION TITLE : begin -->
                <div class="section-title">
                    <div class="container">
                        <h2><strong>Services</strong> <span>What Can We Offer?</span></h2>
                    </div>
                </div>
 <!-- SECTION TITLE : end -->
         <!-- SERVICES LIST : begin -->
                <div class="services-list">
                    <div class="container">
                        <div class="services-list-inner">
                            <div class="row-fluid">
                                <div class="span4">

                                    <!-- SERVICE 1 : begin -->
                                    <div class="service aligncenter">
                                        <span class="ico"><i class="icon-user"></i></span>
                                        <h2><?=$this->lang->line('gologin_service_1') ?></h2>
                                        <div class="various-content">
                                            <p><?=$this->lang->line('gologin_service_dashboard') ?></p>
                                            <a href="/hotspot/index.php/signup" id="signup" class="button medium style1" title="สมัครสมาชิก"><?=$this->lang->line('gologin_service_register') ?></a>
                                        </div>
                                    </div>
                                    <!-- SERVICE 1 : end -->

                                </div>
                                <div class="span4">

                                    <!-- SERVICE 2 : begin -->
                                    <div class="service aligncenter">
                                        <span class="ico"><i class="icon-btc"></i></span>
                                        <h2><?=$this->lang->line('gologin_service_2') ?></h2>
                                        <div class="various-content">
                                            <p><?=$this->lang->line('gologin_service_refill') ?></p>
                                            <a href="/hotspot/index.php/dashboard" id="topup" class="button medium style2"><?=$this->lang->line('gologin_service_buy') ?></a>
                                        </div>
                                    </div>
                                    <!-- SERVICE 2 : end -->

                                </div>
                                <div class="span4">

                                    <!-- SERVICE 3 : begin -->
                                    <div class="service aligncenter">
                                        <span class="ico"><i class="icon-unlock"></i></span>
                                        <h2><?=$this->lang->line('gologin_service_3') ?></h2>
                                        <div class="various-content">
                                            <p><?=$this->lang->line('gologin_service_clear') ?></p>
                                            <a href="/hotspot/index.php/clear" id="clear" class="button medium style1" title="ระบบเครียยูสเซอร์ออกจากระบบ ได้ด้วยตัวเองไม่จำเป็นต้องออกจากระบบที่เครื่องเดิม"><?=$this->lang->line('gologin_service_clearbutton') ?></a>
                                        </div>
                                    </div>
                                    <!-- SERVICE 3 : end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SERVICES LIST : end -->
            <!-- SCREEN WIDTH : begin -->
            <var id="screen-width"><span></span></var>

<div class="mmo_dp">
										
										  

										
                                         <div class="aligncenter">
										{login_footer}
                                        
                                        </div>

		<div id="script_container"></div>

		</div>
        
        