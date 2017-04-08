<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

?>
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						
						<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
						<header><div class="login-hd">Send again</div></header>
						<hr />
							
						<table>
							<tr>
								<td width="120px"><?php echo form_label('Email Address', $email['id']); ?></td>
								<td><?php echo form_input($email); ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
							</tr>
						</table>
						<hr />
						<div class="clear">&nbsp;</div>	
						<div align="center"><?php echo form_submit('send', 'Send','class="button button-blue"'); ?></div>

						<div class="clear">&nbsp;</div>	
						<?php echo form_close(); ?>

						</div>
					</div>