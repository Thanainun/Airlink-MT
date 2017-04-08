<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="widget_heading">
  <h4>สร้าง/แก้ไข จุดเชื่อมต่อ</h4>
</div>
<div class="widget_container">
<div class="panel" align="right">
<?=anchor('admin/accesspoint/apform/add','สร้างจุดเชื่อมต่อ','class="btn btn-small btn-primary" id="form_add"')?>
</div>
                            <table class="paginate full" id="aptable">
                                <thead>
                                    <tr style="cursor:pointer;">
										<th><?=$this->lang->line('accesspoint_table_apname')?></th>
										<th width="50px"><?=$this->lang->line('accesspoint_table_type')?></th>
										<th width="120px">Calling Station Id</th>
										<th width="130px"><?=$this->lang->line('accesspoint_table_update')?></th>
										<th><?=$this->lang->line('accesspoint_table_location')?></th>
										<th width="30px"><?=$this->lang->line('accesspoint_table_status')?></th>
										<th width="70px"><?=$this->lang->line('accesspoint_table_action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<tr>
										<td align='center' colspan='7'><?=img(other_asset_url('loader.gif','','images'))?></td>
									</tr>
                                </tbody>
                            </table>
							</div>
                             