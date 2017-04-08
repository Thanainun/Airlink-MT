<?php

$profile_name = array('','timetofinish','packets','packets_day','packets_month','time','timeout','daily','monthly');


$profile_value = array();

foreach($profile_name AS $pdata)
{
	$profile_value[$pdata] = ($pdata=='') ? $this->lang->line('group_dis_profileSelect') : 
											$this->lang->line('group_dis_'.$pdata);
}
if($profile=='time'||$profile=='timeout'||$profile=='daily'||$profile=='monthly'||$profile=='packets'||$profile=='packets_day'||$profile=='packets_month')
			{
					$valid_for=$valid_for/1000;
				}

?>


								<?=form_open('','id="form" ')?>

									<table class="form" width="100%">
											<tr>
												<td width="30%"><label><?=$this->lang->line('group_thead_name')?> *</label></td>
												<td width="15%"><?= form_input('name',$name,'title="'.$this->lang->line('group_dialog_groupName').'" class="validate[required] text-input" type="text" id="groupname"')?></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_thead_profile')?> *</label></td>
												<td><?= form_dropdown('profile',$profile_value, $profile,'id="type" '.$disabled.' class="validate[required] text-input"')?></td>
												<td>&nbsp;</td>
											</tr>
                                            
                                           <tr>
												<td><label>เวลาเข้าใช้งาน</label></td>
												<td><?= form_input(array('size'=>'15','name'=>'logintime'),$logintime,'id="time-restriction"')?></td>
												<td>&nbsp;</td>
											</tr>
                                          
											<tr>
												<td><label><?=$this->lang->line('group_label_value')?> *</label></td>
												<td><?= form_input(array('size'=>'5','name'=>'amount'),$amount,'id="value" class="validate[required,custom[onlyNumberSp]] text-input"')?></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_thead_invalid')?> </label></td>
												<td><?= form_input(array('size'=>'5','name'=>'valid_for','class'=>'validate[required,custom[onlyNumberSp]] text-input'),$valid_for,'id="valid"')?></td>
																							<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_thead_price')?> *</label></td>
												<td><?= form_input(array('size'=>'5','name'=>'price','class'=>'validate[required,custom[onlyNumberSp]] text-input' ),$price,'id="price"')?></td>
												<td>&nbsp;</td>
											</tr>
											
											<tr>
												<td><label><?=$this->lang->line('group_thead_download')?></label></td>
												<td><?= form_dropdown('bw_download',array('524288'=>'512 kbps', '786432'=>'768 kbps','1048576'=>'1 MBps','2097152'=>'2 MBps', '3145728'=>'3 MBps', '4194304'=>'4 MBps', '5242880'=>'5 Mbps', '6291456'=>'6 Mbps', '7340032'=>'7 Mbps','8388608' => '8 Mbps','9437184'=>'9 Mbps','10485760' => '10 Mbps','11534336'=>'11 Mbps','12582912'=>'12 Mpbs','13631488'=>'13 Mpbs','14680064'=>'14 Mpbs', '15728640' => '15 Mbps','18874368' => '18 Mbps', '20971520' => '20 Mbps','31457280'=>'30 Mpbs','41943040'=>'40 Mpbs','0'=>'ไม่จำกัด',''=>$this->lang->line('group_form_custom')),$bw_download,'id="bw_download"')?></td>
												<td class='dow_custom'></td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_thead_upload')?></label></td>
												<td><?= form_dropdown('bw_upload',array('65536'=>'64 kbps', '98304' => '96 kbps', '131072' => '128 kbps',  '196608' => '192 kbps','262144'=>'256 kbps', '524288'=>'512 kbps', '786432'=>'768 kbps', '1048576'=>'1 MBps','2097152'=>'2 MBps','3145728'=>'3 Mpbs','4194304'=>'4 MBps','5242880'=>'5 Mpbs','6291456'=>'6 Mbps', '7340032'=>'7 Mbps','8388608' => '8 Mbps','9437184'=>'9 Mbps','10485760' => '10 Mbps','11534336'=>'11 Mbps','12582912'=>'12 Mpbs','13631488'=>'13 Mpbs','14680064'=>'14 Mpbs', '15728640' => '15 Mbps','18874368' => '18 Mbps', '20971520' => '20 Mbps','31457280'=>'30 Mpbs',''=>$this->lang->line('group_form_custom')),$bw_upload,'id="bw_upload"')?></td>
												<td class='up_custom'></td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_label_timeout')?> *</label></td>
												<td><?= form_input(array('size'=>'5','name'=>'IdleTimeout'),$IdleTimeout,'id="idletime" class="validate[required,custom[onlyNumberSp]] text-input"')?></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_label_simultaneous')?></label></td>
												<td><?= form_input(array('size'=>'5','name'=>'simultaneous'),$simultaneous,'id="simultaneous"')?></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label>ลำดับวางขาย</label></td>
												<td><?= form_input(array('size'=>'5','name'=>'no'),$no,'id="no"')?></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_label_redirect')?></label></td>
												<td colspan="2"><?= form_input(array('size'=>'25','name'=>'redirect_url'),$redirect_url,'id="redirect_url"')?></td>
											</tr>
									</table>
									<?=$hidden_group?>
								<?=form_close()?>
