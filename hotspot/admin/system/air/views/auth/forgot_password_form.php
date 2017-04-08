<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}

?>
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">
				
				<div class="widget-body">

						<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
						<header><div class="login-hd">Get a new password</div></header>
						<hr />
						<div class="clear">&nbsp;</div>	
						<table class="full">
							<tr>
								<td width="35%"><?php echo form_label($login_label, $login['id']); ?></td>
								<td><?php echo form_input($login); ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
							</tr>
						</table>
						<hr />
						<div class="clear">&nbsp;</div>	
						<div align="center"><?php echo form_submit('reset', 'Get a new password','class="btn btn-block btn-inverse"'); ?></div>	

						<div class="clear">&nbsp;</div>	
						<?php echo form_close(); ?>

					</div>
				<div class="widget-footer">
					<p class="glyphicons restart"><i></i>Please enter your username and password ...</p>
				</div>
			</div>
			<!-- // Box END -->          
                    