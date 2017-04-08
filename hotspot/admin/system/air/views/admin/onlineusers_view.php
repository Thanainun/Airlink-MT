<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="span12">   
 <div class="widget_heading">
	<h4>ผู้ใช้งานที่กำลังออนไลน์ในขณะนี้</h4></div>
    <div class="widget_container">
					
<div class="bt-right"><input type="checkbox" id="auto_refresh"> อัตโนมัติ <button type="button" id="refresh" class="btn btn-small btn-primary">เรียกใหม่</button></div>

						
                            <table id="onlineuser" class="paginate sortable full">
                                <thead>
                                    <tr style="cursor:pointer;">
										<th width="10px"><?=$this->lang->line('onlineuser_table_no')?></th>
										<th width="60px"><?=$this->lang->line('onlineuser_table_username')?></th>
                                       
										<th width="110px"><?=$this->lang->line('onlineuser_table_client_ip')?></th>
										<th width="120px"><?=$this->lang->line('onlineuser_table_mac')?></th>
										<th width="145px"><?=$this->lang->line('onlineuser_table_start')?></th>
										<th width="79px"><?=$this->lang->line('onlineuser_table_timeuse')?></th>
										<th width="79px"><?=$this->lang->line('onlineuser_table_packetuse')?></th>
										<th width="30px"><?=$this->lang->line('onlineuser_table_kick')?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<tr>
										<td align='center' colspan='10'><?=img(other_asset_url('loader.gif','','images'))?></td>
									</tr>
                                </tbody>
                            </table>

                        </div>
				</div>