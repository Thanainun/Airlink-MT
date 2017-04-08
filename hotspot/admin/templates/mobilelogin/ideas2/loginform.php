<body data-spy="scroll">

<!-- TOP MENU NAVIGATION -->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
	
			<a class="brand pull-left" href="gologin">
			Airlink
			</a>
	
			<a href="gologin" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
				<ul id="nav-list" class="nav pull-right hidden-desktop">
					<li><?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?></li>
					<li><?=anchor("gologin/languser/english","<span>English</span>");?></li>
				</ul>
		
			<div class="nav-collapse collapse">
				<ul id="nav-list" class="nav pull-right">
					<li><a href="gologin">Refresh Page (F5)</a></li>
					<li><?=anchor("gologin/languser/thai","<span>ภาษาไทย</span>");?></li>
					<li><?=anchor("gologin/languser/english","<span>English</span>");?></li>
				</ul>
			</div>
		
		</div>
	</div>
</div>


<!-- MAIN CONTENT -->
<div class="container content container-fluid" id="home">



	<!-- HOME -->
	<div class="row-fluid">
  
		<!-- PHONES IMAGE FOR DESKTOP MEDIA QUERY -->
		<div class="span5 visible-desktop">
			<img src="../templates/hotspotlogin/ideas2/img/phones.png">
		</div>
	
		<!-- APP DETAILS -->
		<div class="span7">
	
			<!-- ICON -->
			<div class="visible-desktop" id="icon">
				<img src="../templates/hotspotlogin/ideas2/img/app_icon.png" />
			</div>
			
			<!-- APP NAME -->
			<div class="visible-desktop"id="app-name">
				<h1>Airlink</h1>
			</div>
            
			<!-- TAGLINE -->
			<div class="visible-desktop"id="tagline">
				Welcome to Wi-Fi hotspot.
			</div>
		
			<!-- PHONES IMAGE FOR TABLET MEDIA QUERY -->
			<div class="hidden-desktop" id="phones">
				<img src="../templates/hotspotlogin/ideas2/img/phones.png">
			</div>
            
			<!-- DESCRIPTION -->
			<div id="description">
								<form action="{auth_url}" id="user_login" name="form1" method="post">
        <fieldset>
          <div class="formFieldWrap">
           
           <input class="contactField requiredField" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>" >
          </div>
          <div class="formFieldWrap">
           
            <input class="contactField" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
			<input name="is_remember" checked="checked" type="checkbox" for="is_remember" title="<?=$this->lang->line('checkbox_label') ?>">
          </div>

          <div class="formTextareaWrap">
           <div class="formSubmitButtonErrorsWrap">{message} </div>
            <!-- form errors end -->
            <button title="Login" class="buttonWrap buttonDefault" value='Login' type="submit"><?=$this->lang->line('button_login'); ?></button>
            
          </div>
          {hidden_form}
        </fieldset>
      </form>
        </div>
					
					
	<!-- FEATURES -->
			<ul id="features">
        <li><a href="/hotspot/index.php/signup" title="<?=$this->lang->line('gologin_service_dashboard') ?>"><?=$this->lang->line('gologin_service_register') ?></a></li>
				<li><a href="/hotspot/index.php/dashboard" title="<?=$this->lang->line('gologin_service_refill') ?>"><?=$this->lang->line('user_refill_header') ?></a></li>
				<li><a href="/hotspot/index.php/topup" title="<?=$this->lang->line('user_dashboard_topic1') ?>"><?=$this->lang->line('user_dashboard_topic1') ?></a></li>
				<li><a href="/hotspot/index.php/clear" title="<?=$this->lang->line('gologin_service_clear') ?>"><?=$this->lang->line('gologin_service_clearbutton') ?></a></li>
			</ul>
			
			<!-- News -->

	</div>
	
	
	
	<!-- SCREENSHOTS -->
	<div class="row-fluid" id="screenshots">
		
		<h2 class="page-title" id="scroll_up">
				Publish
				<a href="gologin" class="arrow-top">
				<img src="../templates/hotspotlogin/ideas2/img/arrow-top.png">
				</a>
			</h2>
		
		<!-- SCREENSHOT IMAGES ROW 1-->
		<div class="Publish">

{login_content}
	</div>
	<br />

</div>

<!-- FOOTER -->
<div class="footer container container-fluid">

	<!-- COPYRIGHT - EDIT HOWEVER YOU WANT! -->
	<div id="copyright">
		Copyright &copy; 2013 Airlink, Inc.<br>
		Licensed under <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>. Built on <a href="#">Airlink</a>.<br />
    <b><?=$this->lang->line('contact_2') ?></b>	{login_footer}
	</div>
	
	<!-- CREDIT - PLEASE LEAVE THIS LINK! -->
	<div id="credits">
		<a href="">Theme</a> by <a href="https://www.facebook.com/pages/Airlink/208467359335675">iDeas</a>.
	</div>

</div>

<script src="../templates/hotspotlogin/ideas2/js/bootstrap.min.js"></script>
<script src="../templates/hotspotlogin/ideas2/js/bootstrap-collapse.js"></script>
<script src="../templates/hotspotlogin/ideas2/js/bootstrap-scrollspy.js"></script>
<script src="../templates/hotspotlogin/ideas2/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script src="../templates/hotspotlogin/ideas2/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="../templates/hotspotlogin/ideas2/js/init.js"></script>

</body>


