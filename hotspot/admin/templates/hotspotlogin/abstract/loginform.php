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

<header class="social">
		<div class="centerContainer">
			
			<div class="logo">
				<?=$header ?>
			</div>
			
			<div class="navigation">
				
				<nav>
				    <ul>
				    	<li><?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?></li>
						<li><?=anchor("gologin/languser/english","<span>English</span>");?></li>
				    </ul>
				</nav> <!-- End Nav -->
			</div> <!-- End Navigation -->

			<div class="vs clearfix">
            <div class="counter">
				
						 <h1><?=$this->lang->line('gologin_title') ?></h1>
                       
					</div>
				
				
				<div class="centerContainer vstext">
					<form action="/hotspot/index.php/gologin" id="" name="form1" method="post" class="gologin">

                           
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
                                                
                                                <p class="remember"> <input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember">Remember Me</label></p> 
                                                 <p>
                                                    <button title="Login" class="submit button style2" value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
                                                    <br  />
                                                   
                                                  
                                                   
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- FORM FIELDS : end -->
                        </form>
                        <div style="color:red;" rel="reply" class="total_members">{message}</div>
				</div> <!-- End VS TEXT -->
			</div> <!-- End VS -->
			
			<div class="header-bottom">
                   <a href="#" id="help" class="button medium style1">ประกาศและข่าวสาร</a>
				<a href="dashboard" class="button"><?=$this->lang->line('gologin_service_buy') ?></a>
                <a href="signup" class="button"><?=$this->lang->line('gologin_service_register') ?></a>
				<a href="clear" class="button"><?=$this->lang->line('gologin_service_clearbutton') ?></a>
                
			</div> <!-- End Header Bottom -->
			 
		</div> <!-- End Big Center Container -->
	</header> <!-- End Header -->
   
	<footer class="clearfix">
	
			<p class="copyright"> {login_footer} </p>
		</div> <!-- End Big Center Container -->
	</footer> <!-- End More News -->


										
                                      
        
        