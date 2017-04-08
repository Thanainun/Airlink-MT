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
<div class="page home">

          <header role="banner" class="cf">
          
            <div class="top-wrap">
                <div class="row">
                    <div class="large-3 columns">
                    <div class="logo">
                        <a href="<?=$this->uri->segment('1')?>"><?= $logotext ?></a>
                    </div>
                    </div>
                    <nav class="large-4 columns">
                        <ul class="rr main-menu">
                          
                        </ul>
                    </nav>
                    <div class="large-4 columns">
                        <div class="account cf">
                            <a href="signup" class="input button blue tertiary icon plus">Signup</a>
                            <a href="dashboard" class="input button transparent tertiary">User Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-slider-wrap">
              <div class="row">
                <div class="large-12 columns large-centered">
                  <div class="main-slider flexslider white">
                   <div class="large-6 columns large-centered">
                   <h1><?=$this->lang->line('gologin_title') ?></h1>
                   </div>
                     <div class="large-6 columns large-centered">
                   <h2 class="alt"><?=$this->lang->line('gologin_title_small') ?></h2>
                   </div>
                        <div class="row">
                          <div class="large-8 columns large-centered">
                            <div class="content">
                             
                               <!-- change the action URL for subsribe form -->
                        <form action="/hotspot/index.php/gologin"  id="" name="form1" method="post" class="validate default-form various-content">
							<p>
							 <input class="input field primary" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>">
                              </p>
                              <p>
                              <input class="input field primary" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
                                 </p>
                                 <input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember">Remember Me</label>
                                 <p>                  
								<button title="Login" class="input button primary red" value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
						</p>
                                                    <div style="color:red;" rel="reply" class="total_members">{message}</div>
                                               
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- FORM FIELDS : end -->

                        </form>
                        
                            </div>
                          </div>
                        </div>
                    
                  </div>
                </div>
              </div>
            </div>

        <div class="search-wrap stripe-white">
              <div class="row">
               
               
               
                  <div class="small-6 large-8 columns">
                  <p class="label">
                   Select language :  <?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");?>
                  </p>
                  
                  </div>
                   <div class="large-5 columns">
                   <div class="account cf">
					<a href="#" id="help" class="input button blue tertiary icon plus">ประกาศและข่าวสาร</a>
                    <a href="clear" class="input button primary red">Clear</a>
                    <a href="topup" class="input button primary">Topup</a>
                    </div>
                  </div>
                </form>              
              </div>
            </div>
            
          </header>
										
		<footer>		
           <div class="stripe-darker footer-wrap">
              <div class="row">
                <div class="large-3 columns">
                  <div class="logo">
                    <a href="#">Airlink</a>
                  </div>
                </div>
                <div class="large-6 columns">
                  <div class="copyright">  {login_footer}</div>
                </div>
                <div class="large-3 columns">
                  <ul class="rr social">
                    <li><a href="<?= $twitter ?>" class="ir tw">Twitter</a></li>
                    <li><a href="<?= $facebook ?>" class="ir fb">Facebook</a></li>
                  </ul>
                </div>
              </div>
            </div>                              
                                       
	</footer>

	
        
        