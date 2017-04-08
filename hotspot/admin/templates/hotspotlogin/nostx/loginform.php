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

<!-- Navigation -->
<nav> <a href="dashboard"><?=$this->lang->line('gologin_service_buy') ?></a> | <a href="signup"><?=$this->lang->line('gologin_service_register') ?></a><a href=""></a>||<?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> || <?=anchor("gologin/languser/english","<span>English</span>") ?></nav>
<!-- Navigation -->

<!-- Main -->
<div id="section-1">
		<div class="bg-1"></div>
		<div class="bg-2"></div>
		<div class="bg-3"></div>
		<div class="bg-4"></div>
		
		<!-- Content -->
		<div id="main">
				<h2><?=$this->lang->line('gologin_title') ?></h2>
                        <h4><?=$this->lang->line('gologin_title_small') ?></h4>
				<p> 
              <form action="/hotspot/index.php/gologin" id="" name="form1" method="post" >
                <input id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>" class="txtfield">
                                          
                <input class="txtfield" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
               <br />
                <input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember">Remember Me</label>
               <br />
                <button title="Login" class="submit button style2" value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
 			</p>
                        </form>
                        	 <!-- {reply_msg} เอาวางตรงไหนก็ได้ แล้วแต่การออกแบบ -->
											<div style="color:red;" rel="reply" class="total_members">{message}</div>
		</p>
										
			
				
				
						<a href="#" id="help" class="button medium style1">ประกาศและข่าวสาร</a>
				
		
        <div id="main-features">
						{login_footer}
				
		</div>		
		</div>
        
		<!-- Content --> 
		
		<!-- Objects -->
		<div class="grass"></div>
		<div class="grass-2"></div>
		<div class="cloud-1"></div>
		<div class="leafs"></div>
		<div class="leaf-1"></div>
		<div class="leaf-2"></div>
		<div class="leaf-3"></div>
		<div class="bird">
				<div class="bird-wing"></div>
				<div class="bird-wing-2"></div>
		</div>
		<div class="bird-2">
				<div class="bird-wing"></div>
				<div class="bird-wing-2"></div>
		</div>
		
		<div class="meteor-1"></div>
		<div class="meteor-2"></div>
		
		<!-- Objects --> 
</div>


