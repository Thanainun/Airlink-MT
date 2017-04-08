
								<?=form_open('','id="setup_form" ')?>

									<table class="form" width="100%">
											<tr>
												<td width="20%"><label>ดาวโหลด</label></td>
												<td><?= form_dropdown('bw_download',array('64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps','4096000'=>'4 MBps','8192000'=>'8 MBps','10240000'=>'10 MBps'), $bw_download,'id="bw_download"')?></td>
												<td width="20%"></td>
											</tr>
											<tr>
												<td><label><?=$this->lang->line('group_thead_upload')?></label></td>
												<td><?= form_dropdown('bw_upload',array('64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps','4096000'=>'4 MBps','8192000'=>'8 MBps'), $bw_upload,'id="bw_upload"')?></td>
												<td class='up_custom'></td>
											</tr>
											<tr>
												<td><label>แสดงสถานะใน <em style="color:green;">"ผู้ใช้ออนไลน์"</em></label></td>
												<td><?= form_dropdown('acct_status',array('noacct'=>'NO', '' => 'YES'), $acct_status,'id="acct_status"')?></td>
												<td></td>
											</tr>
									</table>

								<?=form_close()?>