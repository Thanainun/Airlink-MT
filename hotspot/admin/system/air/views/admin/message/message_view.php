<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

			<div class="span8">
							<div class="widget_heading">
  <h4>กล่องข้อความ 		<div align="right"><a onclick="return confirm('ลบข้อความทั้งหมด')" href="<?php echo base_url('index.php/admin/message/delete_all') ?>" class="btn btn-danger">เครียร์ข้อความทั้งหมด</a></div></h4>
</div>
<div class="widget_container">
							<?php print $table ?>
							<hr />

						</div>
                    </div>

<div class="span4">
<div class="widget_heading">
  <h4>ส่งข้อความถึงผู้ใช้งาน</h4>
</div>
<div class="widget_container"><?=form_open('admin/message/sentto','name="msg_form" id="msg"')?>
				<?=form_label('ถึง :'.nbs(5),'Reply')?>
				<?=form_input('reply','','id="reply" autocomplete="off" class="validate[required] text-input"'). br(2)?>
				
				<?=form_label('หัวข้อ:'.nbs(5),'subject')?>
				<?=form_input('subject','','id="subject" autocomplete="off" class="validate[required] text-input"'). br(2);?>
				<?=form_label('ข้อความ:','message')?>
				<?=form_textarea(array('name'=>'message','style'=>'width:100%;','id'=>'message','class'=>'validate[required] text-input')).br(1);?>
				<input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="send" id="send" value="ส่งข้อความ"/>
				<?=form_close()?>
				<hr />


						</div>
                        </div> 