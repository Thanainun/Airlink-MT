<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'class' => 'input-block-level',
	
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'ชื่อผู้ไช้ หรือ อีเมล';
} else if ($login_by_username) {
	$login_label = 'เข้าสู่ระบบ';
} else {
	$login_label = 'อีเมล';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' => 'input-block-level margin-none',  
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);

?>
					
                    
     
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">
				
				<div class="widget-body">
				<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
					<!-- Form -->
					<form method="post" action="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full">
						<label><?php echo form_label($login_label, $login['id']); ?></label>
						<?php echo form_input($login); ?>
                        <label> <?php echo anchor('/forgotpass/', 'ลืมรหัสผ่าน','class="password"'); ?></label>
						<label><?php echo form_label('รหัสผ่าน', $password['id']); ?></label>
						<?php echo form_password($password); ?>
						<div class="separator bottom"></div> 
						<div class="row-fluid">
							<div class="span8">
								<div class="uniformjs"><label class="checkbox" for="remember"><input type="checkbox" value="1" id="remember">Remember me</label></div>
							</div>
							<div class="span4 center">
                                <?php echo form_submit('submit', 'เข้าสู่ระบบ','class="btn btn-block btn-inverse"'); ?>
							</div>
						</div>
					</form>
					<!-- // Form END -->
						<?php echo form_close(); ?>	
                        <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
                        <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
				</div>
				<div class="widget-footer">
					<p class="glyphicons restart"><i></i>Please enter your username and password ...</p>
				</div>
			</div>
			<!-- // Box END -->          
                    
      