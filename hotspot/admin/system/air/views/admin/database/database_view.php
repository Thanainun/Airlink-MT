<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$upload = array(
              'name'        => 'excel_upload',
              'id'          => 'excel_upload',
              'value'       => '',
			  'class'		=> 'validate[required] text-input'
            );

 ?>
 
			<div class="widget_heading">
  <h4>สำรองและจัดการฐานข้อมูล/ผู้ใช้</h4>
</div>
<div class="widget_container">
							<?=form_open_multipart('admin/database/import')?>
							<table align="center">
								<tr>
									<td><?=form_label('อัพโหลด (<em>.xlsx, .xls</em>)','excel_upload')?></td>
									<td><?=form_upload($upload)?></td>
									<td></td>
								</tr>
								<tr>
									<td><?=form_label('เลือกกลุ่มที่ต้องการนำเข้า','group_import')?></td>
									<td><?=form_dropdown('group_import', $plan, '','id="group_import" class="validate[required] text-input"')?></td>
									<td></td>
								</tr>
								<tr><td></td>
									<td><button type="submit" class="btn btn-small btn-primary">นำเข้าไฟล์ Excel</button></td>
								</tr>
							</table>

							<?=form_close()?>
							<hr />
							<head><h4>สำรองข้อมูลผู้ใช้</h4></head>
							<?=form_open('admin/database/export','id="export"')?>
							<table class="paginate  full">
								<tr>
									<td width="35%">เลือกกลุ่มผู้ใช้ ที่ต้องการสำรองข้อมูล<br/>สามารถเลือกได้ครั้งละหลายกลุ่ม</td>
									<td width="35%"><?=form_multiselect('select_group[]', $plan, '','id="select_group" size="6" style="width:100%" class="validate[required] text-input"')?></td>
									<td align="right"></td>
								</tr>
								<tr>
									<td>นามสกุลไฟล์</td>
									<td>
										<?php
											echo form_radio('ext', 'xls', TRUE,'id="xls"');
											echo form_label(' .xls','xls');
											echo nbs(3)."|".nbs(3);
											echo form_radio('ext', 'xlsx', FALSE,'id="xlsx"');
											echo form_label(' .xlsx','xlsx');
										?>
									</td>
									<td ></td>
								</tr>
								<tr>
									<td colspan="2">ไฟล์ถูกเก็บที่ backups ในเมนู จัดการไฟล์</td>
									<td align="center"><button type="submit" class="btn btn-small btn-primary">สำลองข้อมูล Excel</button></td>
								</tr>
							</table>

							<?=form_close()?>
							<hr />
							<head><h4>สำรองข้อมูลทั้งหมด (<em>*.sql</em>)</h4></head>
							
							<?php print $table ?>
							<hr />

							<?=form_open('admin/database/backup','')?>
							<div align="right">
								<?=form_checkbox('download', '1', FALSE).form_label('ดาวโหลดเป็น ZIP ไฟล์','accept')?>
								<button type="submit" class="btn btn-small btn-primary">สำรองข้อมูล </button>
							</div>
							<?=form_close()?>

						</div>
                    </div>
				</div>
