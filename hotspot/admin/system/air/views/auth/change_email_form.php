<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'type'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$this->load->view('auth/header');

?>
<?php echo form_open($this->uri->uri_string(), array('id' => 'form','class'=>'login-box-top')); ?>
<header><div class="login-hd">Change E-mail</div></header>
<hr />
	
<table>
	<tr>
		<td width="120px"><?php echo form_label('Password', $password['id']); ?>:</td>
		<td><?php echo form_password($password); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('New email address', $email['id']); ?>:</td>
		<td><?php echo form_input($email); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
</table>
<hr />
<div align="center"><?php echo form_submit('change', 'Send confirmation email','class="button button-blue"'); ?></div>

<div class="clear">&nbsp;</div>	
<?php echo form_close(); ?>

<?php $this->load->view('auth/footer'); ?>