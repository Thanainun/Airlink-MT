<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tabs-jui" >

	<?=form_open('admin/userform/submit/'.$this->uri->segment(4),array('id'=>'form','class'=>'form'))?>
            <ul>
                <li><a id="ui-link" href="#panes-1"><?=$this->lang->line('user_form_head_system')?></a></li>
                <li><a id="ui-link" href="#panes-2"><?=$this->lang->line('user_form_head_info')?></a></li>
                <li><a id="ui-link" href="#panes-3">Radcheck</a></li>
				<li><a id="ui-link" href="#panes-4">Radreply</a></li>
			</ul>
		
		<div id="panes-1" >
		<table width="100%">
			<tbody>
				<tr>
					<td width="34%"><?=form_label($this->lang->line('user_form_label_username'), 'username')?></td>
					<td width="25%"><?=form_input('username', $username, ($this->uri->segment(4)=='edit') ? 'readonly=TRUE' : ''.' type="text" class="validate[required,minSize[6],maxSize[9]] text-input" id="username"')?></td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_password'), 'password')?></td>
					<td><?=form_input('password', $password,' class="validate[required,minSize[6]] text-input" id="password"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_billingplan'), 'billingplan')?></td>
					<td><?=form_dropdown("billingplan", $plan, (isset($billingplan)) ? $billingplan : '','id="billingplan" class="validate[required] text-input"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label('จำนวนเงินคงเหลือ', 'money')?></td>
					<td><?=form_input('money', $money,'type="text" id="money"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_email'), 'email')?></td>
					<td><?=form_input('email', $email,'type="email" class="validate[custom[email]] text-input"  id="email"')?></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td colspan="3" width="100%"><hr><h3><?=$this->lang->line('user_form_head_detail')?></h3><hr></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_surename'), 'surename')?></td>
					<td><?=form_input('surename', $surename,'type="text" id="surename"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_gender'), 'gender')?></td>
					<td><?=form_dropdown('gender',array('male'=>'ชาย','famale'=>'หญิง'), $gender,'required="required" id="gender"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_web'), 'web')?></td>
					<td><?=form_input('web', $web,'type="text" class="validate[custom[url]] text-input" id="web"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_phone'), 'phone')?></td>
					<td><?=form_input('phone', $phone,'type="number" class="validate[custom[phone]] text-input" id="phone"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_note'), 'note')?></td>
					<td><?=form_input('note', $note,'type="number" id="note"')?></td>
					<td>&nbsp;</td>
				</tr>

			</tbody>
		</table>
		</div>
		
		<div id="panes-2" >
		<table width="100%">
			<tbody>
				<tr>
					<td width="34%"><?=form_label($this->lang->line('user_form_label_firstname'), 'firstname')?></td>
					<td width="25%"><?=form_input('firstname', $firstname,'type="text" maxlength="70" id="firstname"')?></td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_lastname'), 'lastname')?></td>
					<td><?=form_input('lastname', $lastname,'type="text" maxlength="70" id="lastname"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_personal_id'), 'personal_id')?></td>
					<td><?=form_input('personal_id', $personal_id,'type="number" class="validate[custom[onlyNumberSp],minSize[13],maxSize[13]] text-input" id="personal_id"')?></td>
					<td>&nbsp;</td>
				</tr>
                <tr>
					<td width="34%"><?=form_label($this->lang->line('user_form_label_ip_address'), 'IPAddress')?></td>
					<td width="25%"><?=form_input('ip', $ip,'type="text" maxlength="20" id="IPAddress"')?></td>
					<td width="40%">&nbsp;</td>
				</tr>
                <tr>
					<td width="34%"><?=form_label($this->lang->line('user_form_label_mac_address'), 'MacAddress')?></td>
					<td width="25%"><?=form_input('mac', $mac,'type="text" maxlength="20" id="MacAddress"')?></td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" width="100%"><hr><h3><?=$this->lang->line('user_form_head_addr')?></h3><hr></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_address').' 1', 'address1')?></td>
					<td><?=form_input('address1', $address1,'type="text" id="address1"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_address').' 2', 'address2')?></td>
					<td><?=form_input('address2', $address2,'type="text" id="address2"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_tumbol'), 'district')?></td>
					<td><?=form_input('district', $district,'type="text" id="district"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_aumpur'), 'amphur')?></td>
					<td><?=form_input('amphur', $amphur,'type="text" id="amphur"')?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('user_form_label_province'), 'province')?></td>
					<td><?=form_input('province', $province,'type="text" id="province"')?></td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
		</div>

		<div id="panes-3" >
		<table width="100%">
			<tbody>
				<tr>
					<td width="45%" align="center" style="font-weight:bold">Attribute</td>
					<td width="8%" align="center" style="font-weight:bold">OP</td>
					<td width="45%" align="center" style="font-weight:bold">Value</td>
				</tr>
<?php foreach($radcheck AS $d=>$e) : ?>
<?php if($e['attribute']=='Password') continue;
$readonly = ($e['attribute']!='Auth-Type' AND $e['attribute']!='Expiration') ? '' : 'readonly="readonly"';
$bg = ($readonly=='') ? '' : 'background-color:#EAEAEA;';
?>
				<tr>
					<td><?=form_input('attr_radcheck_id_'.$e['id'],$e['attribute'],'style="width:94%;'.$bg.'" '.$readonly)?></td>
					<td align="center"><?=form_dropdown('op_radcheck_'.$e['id'],array(':='=>':=','=='=>'=='),$e['op'],'')?></td>
					<td>
						<?=form_input('value_radcheck_id_'.$e['id'],$e['value'],'style="width:95%" id="attr_val"')?>
						<?php if(($e['attribute']!='Auth-Type') AND ($e['attribute']!='Expiration')) : ?><div id="del" role="check" rel="<?=$e['id']?>" style="background:url('<?=base_url().'assets/images/delete.gif'?>');display:block;width:16px;height:16px;position:absolute;right:32px;margin-top:5px;cursor:pointer;"></div><?php endif; ?>
					</td>
				</tr>
<?php endforeach; ?>
				<tr id="input-attr-radcheck">
					<td colspan="3" width="100%"><hr></td>
				</tr>
				<tr>
					<td align="right" colspan="3" width="100%">
						<div class="ui-dialog-buttonset">
							<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" id="radcheck" role="button">
								<span class="ui-button-text">Add new</span>
							</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		
		<div id="panes-4" >
		<table width="100%">
			<tbody>
				<tr>
					<td width="45%" align="center" style="font-weight:bold">Attribute</td>
					<td width="8%" align="center" style="font-weight:bold">OP</td>
					<td width="45%" align="center" style="font-weight:bold">Value</td>
				</tr>
<?php foreach($radreply AS $d=>$e) : ?>
<?php if($e['attribute']=='Password') continue; ?>
				<tr>
					<td><?=form_input('attr_radreply_id_'.$e['id'],$e['attribute'],'style="width:94%" id="autocom"')?></td>
					<td align="center"><?=form_dropdown('op_radreply_'.$e['id'],array(':='=>':=','=='=>'=='),$e['op'],'')?></td>
					<td>
						<?=form_input('value_radreply_id_'.$e['id'],$e['value'],'style="width:95%" id="attr_val"')?>
						<div id="del" role="reply" rel="<?=$e['id']?>" style="background:url('<?=base_url().'assets/images/delete.gif'?>');display:block;width:16px;height:16px;position:absolute;right:32px;margin-top:5px;cursor:pointer;"></div>
					</td>
				</tr>
<?php endforeach; ?>
				<tr id="input-attr-radreply">
					<td colspan="3" width="100%"><hr></td>
				</tr>
				<tr>
					<td align="right" colspan="3" width="100%">
						<div class="ui-dialog-buttonset">
							<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" id="radreply" role="button">
								<span class="ui-button-text">Add new</span>
							</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
	<?=form_close()?>

</div>
