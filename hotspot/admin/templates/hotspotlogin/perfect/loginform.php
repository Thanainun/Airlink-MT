
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

	<!-- BEGIN HEADER -->
	
		<header>
		
		<p><?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");?></p>
			<h1>Airlink</h1>
			<h3>WiFi Hotspot</h3>
      </header>
		<!-- // END HEADER -->
						</div>
		<header class="login">
                    <form action="/hotspot/index.php/gologin" id="" name="form1" method="post" class="validate default-form various-content">
							<p>
							 <input class="input field primary" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>"></p><br />
                             
                              <input class="input field primary" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
                               <p>
                                 <input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember"><?=$this->lang->line('checkbox_label') ?></label>
                                            </p>   <br />
								<button title="Login" class="btn btn-small btn-primary " value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
					
                                                    <div style="color:red;" rel="reply" class="total_members">{message}</div>
                        </form>
                        
       <br>
      <p><a href="/hotspot/index.php/signup" title="<?=$this->lang->line('gologin_service_dashboard') ?>"><?=$this->lang->line('gologin_service_register') ?></a></p>
			<p><a href="/hotspot/index.php/dashboard" title="<?=$this->lang->line('gologin_service_refill') ?>"><?=$this->lang->line('gologin_service_buy') ?></a></p>
			<p><a href="/hotspot/index.php/clear" title="<?=$this->lang->line('gologin_service_clear') ?>"><?=$this->lang->line('gologin_service_clearbutton') ?></a></p> 
        
        
        </header>
		<!-- BEGIN BODY -->
		<section id="bottom">
		
			<!-- BEGIN SOCIAL -->
			 <div id="social"> 
				<div>
				<? php	/*<span>ติดตามเราได้ที่</span>
					<ul>
						<li class="twitter"><a href="<?= $twitter ?>" target="_blank"></a></li>
						<li class="facebook"><a href="<?= $facebook ?>" target="_blank"></a></li>
					</ul>
					*/?>
					<span>
					<a href="/hotspot/index.php/signup"><?=$this->lang->line('gologin_news_1') ?></a><br><br>
					<a href="#" id="help"><?=$this->lang->line('gologin_news_2') ?></a>&nbsp;  &nbsp; <?/*=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");*/?>
					</span>
				
				</div>
			</div>
			<!-- // END SOCIAL -->
			
			
		</section>
		<!-- // END BODY -->
		
		<div id="pattern"></div>
		<div id="ct" style="display:none"></div>
        
         <div id="dialog" title="Announcements">
         {login_content}
        
        </div>
        
        
        
        
        
        
        
        
