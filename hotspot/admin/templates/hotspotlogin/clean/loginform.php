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

    <div class="navbar transparent navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand">
               <?=$header ?>
            </a>
            <div class="nav-collapse collapse">
              
                <ul class="nav pull-right">
                
                    <li><a class="btn-header active" href="gologin">Go login</a></li>
                    <li><a class="btn-header" href="signup">Register</a></li>
                     <li><a class="btn-header" href="dashboard">User Dashboard</a></li>
                </ul>
            </div>
            
        </div>
        
      </div>
      
    </div>

    <!-- Sign In Option 1 -->
    <div id="sign_up1">
        <div class="container">
            <div class="row">
                <div class="span12 header">
                    <h4><?=$this->lang->line('gologin_title') ?></h4>
                    <p>
                        <?=$this->lang->line('gologin_title_small') ?>.</p>

                    
                <div class="span3 division">
                    <div class="line l"></div>
                    <span>*****</span>
                    <div class="line r"></div>
                </div>

                <div class="span12 division footer">
                    <form action="/hotspot/index.php/gologin" id="" name="form1" method="post" class="validate default-form various-content"> 
                        <input id="username" name="UserName" type="text" class="name" placeholder="<?=$this->lang->line('username_login'); ?>" />
                        <input id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>" />
                        <button type="submit" placeholder="Confirm Password" value="sign up" class="button" /><?=$this->lang->line('button_login'); ?></button>
                  
                   <!--- <div class="span6 remember">
                   <label for="is_remember" class="checkbox">
                        <input name="is_remember" checked="checked" type="checkbox"> Remember me
                    </label> </div> -->
                 </form>
                 <div style="color:red;" rel="reply" class="total_members">{message}</div>
                </div>

                
                  
               

                <div class="span12 dosnt">
                    <span>Select language :&nbsp;<?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("gologin/languser/english","<span>English</span>");?></span>
               
           
                    
                </div>
                
  
            </div>
            
        </div>
        
    </div>
<div class="contenter"><a href="#" id="help" class="button medium style1">ประกาศและข่าวสาร</a></div>
    

    <!-- starts footer -->
    <footer id="footer">
        <div class="container">
            <div class="row info">
                <div class="span6 residence">
                    <ul>
                        <li><?=$address ?></li>
                       
                    </ul>
                </div>
                <div class="span5 touch">
                    <ul>
                        <li><strong>Phone</strong> <?=$tel ?></li>
                        <li><strong>E-mail</strong><a href="#">  <?=$mail ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="row credits">
               
                    </div>
                    <div class="row copyright">
                        <div class="span12">
                            <?=$copyright ?>.
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </footer>

   
    
