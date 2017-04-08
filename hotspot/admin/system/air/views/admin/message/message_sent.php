<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

			<div class="clear">&nbsp;</div>

                <div class="columns">
                    <div class="column grid_5 first">
					
						<div class="panel">
							
				<?=form_open('','name="msg_form" id="msg"')?>
				<?=form_label('ถึง :'.nbs(5),'Reply')?>
				<?=form_input('reply','','id="reply" autocomplete="off" class="validate[required] text-input"'). br(2)?>
				
				<?=form_label('หัวข้อ:'.nbs(5),'subject')?>
				<?=form_input('subject','','id="subject" autocomplete="off" class="validate[required] text-input"'). br(2);?>
				<?=form_label('ข้อความ:','message')?>
				<?=form_textarea(array('name'=>'message','style'=>'width:100%;','id'=>'message','class'=>'validate[required] text-input')).br(1);?>
				<input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="send" id="send" value="ส่งข้อความ"/>
				<?=form_close()?>
				<hr />
							
							
							<div><?=anchor('admin/message','กลับ','class="button button-blue"')?></div>
						</div>
						
                    </div>
				</div>
 