<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);

?>
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						
						<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
						<header><div class="login-hd">Delete account</div></header>
						<hr />
							
						<table>
							<tr>
								<td width="120px"><?php echo form_label('Password', $password['id']); ?></td>
								<td><?php echo form_password($password); ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
							</tr>
						</table>
						<hr />
						<div class="clear">&nbsp;</div>	
						<div align="center"><?php echo form_submit('cancel', 'Delete account','class="button button-blue"'); ?></div>	

						<div class="clear">&nbsp;</div>	
						<?php echo form_close(); ?>

						</div>
					</div>