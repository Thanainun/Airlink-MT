<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="span12">
  <div class="widget_heading">
    <h4>ตอบกลับ </h4>
  </div>
  <div class="widget_container">
    <?=form_open('','name="msg_form" id="msg"')?>
    <?=form_label('จาก : '.$username.''.nbs(5),'Reply')?>
    <input type="hidden" value="<?=$this->uri->segment(4)?>" name="reply" />
    <?=form_label('ตอบกลับหัวข้อ:'.nbs(5),'subject')?>
    <?=form_input('subject',''.$subject.'','id="subject" autocomplete="off" class="validate[required] text-input"'). br(2);?>
    <?=form_label('ข้อความ:','message')?>
    <?=form_textarea(array('name'=>'message','style'=>'width:95%;','id'=>'message','class'=>'validate[required] text-input')).br(1);?>
    <input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="send" id="send" value="แสดงความคิดเห็น"/>
    <?=form_close()?>
  
  </div>
</div>

