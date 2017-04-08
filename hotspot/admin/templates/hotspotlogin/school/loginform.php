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
 <section class="top-section section primary">
        <div class="wrap">
            <div class="row cf">
                <div class="col span5 deviceshot">
                    
                </div>
                        

                <div class="col col-right span7">
                    <h1 class="brand top"> <?=$header ?></h1>

                    <h2 class="hero-copy"><?=$this->lang->line('gologin_title') ?></h2>
                               <!-- change the action URL for subsribe form -->
                        <form action="/hotspot/index.php/gologin" id="" name="form1" method="post" class="notify-form cf">
                         <fieldset>
								 <input class="placeholder" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>">
								 <input class="placeholder" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
                          <button title="Login" class="notify-btn btn secondary" value='' type="submit"><?=$this->lang->line('button_login'); ?></button>
                                                   
 						<p><input name="is_remember" checked="checked" type="checkbox" ><label for="is_remember"> &nbsp;Remember Me</label></p>
<!-- {reply_msg} เอาวางตรงไหนก็ได้ แล้วแต่การออกแบบ -->   <div style="color:red;" rel="reply" class="total_members">{message}</div>
                        </fieldset>
                        </form>
                           

                  
                 </div>
            </div>

        </div>

        <div class="learn-more-tab">
             Select language :  <?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");?><i class="icon-caret-left" style="margin-left: 10px"></i>
        </div>
                        
 
    </section>
    <!-- /Top Section -->
<section class="section secondary">					<a href="#" id="help" class="button medium style1">ประกาศและข่าวสาร</a>
</section>
<footer class="section tertiary">

        <section class="wrap">
            <div class="col span6 social">
            <a href="/hotspot/index.php/signup" id="signup" class="button medium style1" title="สมัครสมาชิก"><?=$this->lang->line('gologin_service_register') ?></a>
              <a href="/hotspot/index.php/clear" id="clear" class="button medium style1" title="ระบบเครียยูสเซอร์ออกจากระบบ ได้ด้วยตัวเองไม่จำเป็นต้องออกจากระบบที่เครื่องเดิม"><?=$this->lang->line('gologin_service_clearbutton') ?></a>
              
            </div>
            

            <p class="col span6 copyright">{login_footer}</p>
        </section>
    </footer>
    <!-- /Footer -->


                       