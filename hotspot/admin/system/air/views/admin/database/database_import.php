<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>

jQuery(document).ready(function($) {

	var old_num = 100000;
	var p;
	var num_imp = <?=count($info)?>;
	var perc = 0;

	function get_num () {
		$.getJSON(base_url+'index.php/'+controller+'/progress_bar', function(data) {
			old_num = data.num;
		});
	}

	function update_progress () {
		if(perc!=100) {
			$.getJSON(base_url+'index.php/'+controller+'/progress_bar', function(data) {
				p = data.num - old_num;
				perc = (p * 100) / num_imp;
				perc = $.sprintf('%.2f', perc);
				if(perc>=0) $('div#perc').html('<dd><div id="hdd_color" class="progress progress-green"><span id="progress_bar" class="hdd_perc" style="width:'+perc+'%"><b>'+perc+'%</b></span></div></dd>');
			});
		}
	}
	
	$('form#import').submit(function () {
		get_num();
		var ck_box = $('input[type=checkbox]#ok_import').val();
		var post_url = $(this).attr('action');
		if(ck_box!=null) {
			dialog_msg( 'นำเข้าข้อมูล...' , '<div id="msg_warning">กำลังนำเข้าข้อมูล '+num_imp+' รายการ กรุณาอย่าปิดกรอบนี้ ...<br/><div id="perc"></div></div>', 'highlight');
			
			var progress = setInterval(function() {
				update_progress();
			}, 1000);
			
			$.post(post_url,  $(this).serialize() ,function(replay) {

				if(replay.rep) {
					if(parent.controller=='admin/user') parent.oTable.fnClearTable();
					$('div#msg_warning').html(replay.msg);
				} else {
					$('div#msg_warning').html(replay.msg);
				}
				
				$('button[role=button].ui-button').click(function() { window.location.href=base_url+'index.php/'+controller; });
				
			},"json");
		}
		return false;
	});

});
</script>

			<div class="widget_heading">
  <h4>นำเข้าข้อมูลผู้ใช้งาน</h4>
</div>
<div class="widget_container">
							<?=form_open('admin/database/import_run','id="import"')?>
							<table class="paginate  full">
								<thead>
									<tr>
										<th width="10px"><?=nbs()?></th>
										<th width="15px">ลำดับ</th>
										<th width="90px">ชื่อผู้ใช้</th>
										<th width="90px">รหัสผ่าน</th>
										<th width="120px">กลุ่ม</th>
										<th>ชื่อ-นามสกุล</th>
									</tr>
								</thead>
								<tbody>
								<?php $cou = 1; foreach($info AS $val) : ?>
									<tr>
										<td><?=form_checkbox('ok_import['.$val['username'].']', $val['username'], TRUE, 'id="ok_import"')?></td>
										<td><?=$cou++?></td>
										<td><?=$val['username']?></td>
										<td><?=$val['password']?></td>
										<td><?=$group?></td>
										<td><?=(isset($val['firstname'])? $val['firstname'] : '-') .' '.(isset($val['lastname']) ? $val['lastname'] : '-')?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
							<hr />

							<div align="right">
								<button type="submit" class="btn btn-small btn-primary">Import</button>
								<?=anchor('admin/database','ยกเลิก','class="btn btn-small btn-warning"') ?>
							</div>
							<?=form_hidden('skip_user',$skip_user)?>
							<?=form_hidden('file_import',$file_import)?>
							<?=form_hidden('group',$group)?>
							<?=form_close()?>
						</div>
                    </div>
				</div>