<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);

?>
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						
						<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
						<header><div class="login-hd">Reset Password</div></header>
						<hr />
							
						<table>
							<tr>
								<td width="120px"><?php echo form_label('New Password', $new_password['id']); ?></td>
								<td><?php echo form_password($new_password); ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></td>
							</tr>
							<tr>
								<td><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?></td>
								<td><?php echo form_password($confirm_new_password); ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></td>
							</tr>
						</table>

						<hr />
						<div class="clear">&nbsp;</div>	
						<div align="center"><?php echo form_submit('change', 'Change Password','class="button button-blue"'); ?></div>	

						<div class="clear">&nbsp;</div>	
						<?php echo form_close(); ?>
						
						</div>
					</div>