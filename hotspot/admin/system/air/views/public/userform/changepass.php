<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="dialog-form">
	<?=form_open('gologin/changepw','class="form" id="formpw"')?>
		<table width="100%">
			<tr>
				<td>
				<label for="old_password">รหัสผ่านเก่า:</label>
				<input type="text" autocomplete="off" name="old_password" id="old_password" value="" class="validate[required,minSize[4]] text-input" />
				</td>
			</tr>
			<tr>
				<td>
				<label for="new_password">รหัสผ่านใหม่</label>
				<input type="password" name="new_password" id="new_password" value="" class="validate[required,minSize[4]] text-input" />
				</td>
			</tr>
			<tr>
				<td>
				<label for="comfirm_password">ยืนยันรหัสผ่านใหม่</label>
				<input type="password" name="comfirm_password" id="comfirm_password" value="" class="validate[required,equals[new_password]] text-input" />
				</td>
			</tr>
			<tr>
				<td>
				<label></label>
				<input class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="submit" name="Change" value="บันทึก"/>
				</td>
			</tr>
		</table>
		<input type="hidden" name="username" value="<?=$username?>"/>
	<?=form_close()?>
</div>
