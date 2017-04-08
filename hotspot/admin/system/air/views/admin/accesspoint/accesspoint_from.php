<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 

	(isset($accesspoint)) ? $data=$accesspoint->row() : ''; //fetching user information
	
	$name 		= (isset($data->name)) 		? $data->name : '';
	$nasname 	= (isset($data->nasname)) 	? $data->nasname : '';
	$secret 	= (isset($data->secret)) 	? $data->secret : '';
	$type 		= (isset($data->type)) 		? $data->type : '';
	$ipaddr		= (isset($data->ipaddr)) 	? $data->ipaddr : '';
	$calledstationid	= (isset($data->calledstationid)) 	? $data->calledstationid : '';
	$ports		= (isset($data->ports)) 	? $data->ports : '';
	$date		= (isset($data->date)) 		? $data->date : '';
	$address	= (isset($data->address)) 	? $data->address : '';
	$location 	= (isset($data->location)) 	? $data->location : '';
	$tambon		= (isset($data->tambon)) 	? $data->tambon : '';
	$aumpur		= (isset($data->aumpur)) 	? $data->aumpur : '';
	$province	= (isset($data->province)) 	? $data->province : '';
	$login_page = (isset($data->login_page)) ? $data->login_page : $this->lang->line('accesspoint_msg_login');
	$popup_page = (isset($data->popup_page)) ? $data->popup_page : $this->lang->line('accesspoint_msg_popup');
	$announced_page = (isset($data->announced_page)) ? $data->announced_page : $this->lang->line('accesspoint_msg_announced');
	$help		= (isset($data->help))		? $data->help : 'ช่วยเหลือ';
	$register 	= (isset($data->register)) 	? $data->register : '';

?>

        <div class="tabs-jui" id="ap_form">
		<?=form_open('admin/accesspoint/'.$submit,'id="form_ap" class="form" target="submit_iframe"')?>
            <ul>
                <li><a id="ui-link" href="#panes-1"><?=$this->lang->line('accesspoint_form_detail')?></a></li>
                <li><a id="ui-link" href="#panes-2"><?=$this->lang->line('accesspoint_form_location')?></a></li>
                <li><a id="ui-link" href="#panes-3"><?=$this->lang->line('accesspoint_form_login')?></a></li>
                <li><a id="ui-link" href="#panes-4"><?=$this->lang->line('accesspoint_form_popup')?></a></li>
                <li><a id="ui-link" href="#panes-5"><?=$this->lang->line('accesspoint_form_annouced')?></a></li>
				<li><a id="ui-link" href="#panes-6"><?=$this->lang->line('accesspoint_form_help')?></a></li>
			</ul>
								
            <!-- tab "panes" -->
            <div id="panes-1">
            <table >
                <tr>
                    <td width="35%"><?=form_label($this->lang->line('accesspoint_label_ssidname'),'name')?></td><td><?=form_input('name',$name, ($submit=='action/edit') ? 'readonly=true' : ' type="text" class="validate[required] text-input" id="name"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_nasname'),'nasname')?></td><td><?=form_input('nasname',$nasname,'type="text" class="validate[required] text-input" id="nasname"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_uamsecret'),'secret')?></td><td><?=form_input('secret',$secret,'type="text" class="validate[required] text-input" id="secret"')?></td>
				</tr>
				<tr>
	                <td><?=form_label($this->lang->line('accesspoint_label_type'),'type')?></td><td><?=form_input('type',$type,'type="text" class="validate[required] text-input" id="type"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_ipaddr'),'ipaddr')?></td><td><?=form_input('ipaddr',$ipaddr,'type="text"  class="validate[required] text-input" id="ipaddr"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_mac'),'calledstationid')?></td><td><?=form_input('calledstationid',$calledstationid,'type="text" class="validate[required,custom[mac]] text-input" id="calledstationid"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_ports'),'ports')?></td><td><?=form_input('ports',$ports,'type="number" class="validate[required,custom[onlyNumberSp]] text-input" id="ports"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_register'),'register')?></td><td><?=form_dropdown('register',array('0'=>'OFF','1'=>'ON'),$register)?></td>
                </tr>
            </table>
			</div>
								
            <!-- tab "panes" -->
            <div id="panes-2">
            <table class="full">
				<tr>
					<td width="35%"><?=form_label($this->lang->line('accesspoint_label_location'),'location')?></td><td><?=form_input('location',$location,'type="text" class="validate[required] text-input" id="location"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_address'),'address')?></td><td><?=form_input('address',$address,'type="text" id="address"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_tumbol'),'tambon')?></td><td><?=form_input('tambon',$tambon,'type="text" id="tambon"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_aumpur'),'aumpur')?></td><td><?=form_input('aumpur',$aumpur,'type="text" id="aumpur"')?></td>
				</tr>
				<tr>
					<td><?=form_label($this->lang->line('accesspoint_label_province'),'province')?></td><td><?=form_input('province',$province,'type="text" id="province"')?></td>
				</tr>
			</table>
			</div>

            <!-- tab "panes" -->
            <div id="panes-3">
            <fieldset>
			<div id="login_page">
				<?=$login_page?>
			</div>
			</fieldset>
			</div>
								
            <!-- tab "panes" -->
            <div id="panes-4">
			<fieldset>
			<div id="popup_page">
				<?=$popup_page?>
			</div>
            </fieldset>
			</div>
             <!-- tab "panes" -->
            <div id="panes-5">
			<fieldset>
			<div id="announced_page">
				<?=$announced_page?>
			</div>
            </fieldset>
			</div>

            <!-- tab "panes" -->
            <div id="panes-6">
			<fieldset>
			<div id="help">
				<?=$help?>
			</div>
            </fieldset>
			</div>
			
		<?=form_close()?>
		<iframe name="submit_iframe" width="0" height="0" frameborder="0"></iframe>
        </div>
