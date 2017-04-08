<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?=$this->form_validation->error_string;?>


                <!-- Left column/section -->
                <? if ($complate) { ?>
                <div id="login">
                <div class="widget widget-4">
	<div class="widget-head"><h4 class="heading glyphicons home"><i></i>ลงทะเบียนสำเร็จแล้ว</h4></div>
	<div class="widget-body"> 
    					
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
                                
                                <p>Username และ Password ได้รับเพ็ํค <?=$plan?>และสามารใช้งานได้ทันที</p>


</div>
</div></div>
<div class="separator"></div>
	<? } else {?>
		<? if(!$invalid) { ?>
                    <div class="separator"></div>
                    <div class="innerLR">
	<div class="widget widget-4">
		<div class="widget-head">
			<h3 class="heading"> Registration Area!</h3>
		</div>
		<div class="widget-body">
			<p> WiFi ให้บริการอินเทอร์เน็ตสารธารณะสำหรับทุกคน</p>
		</div>
	</div>
    						<div class="widget widget-gray widget-body-white">
		<div class="widget-head">
			<h4 class="heading">Input controls</h4>
		</div>
		<div class="widget-body" style="padding: 10px 0 0;">
							<div class="row-fluid">
							<div class="span6">
                            <?=form_open($this->uri->segment(1).'/','id="form" class="form-horizontal" autocomplete="off"')?>
																			<header><div class="login-hd">ระบบสมัครสมาชิกเพื่อทดลองใช้งาน </div></header>
																			 <hr />
                                <header><h2><?=$this->lang->line('user_form_head_info')?> <em style="color:red;">(*) ส่วนที่จำเป็นต้องกรอกข้อมูล</em></h2></header>

                                <hr />
                                <fieldset>
                                    <dl><dt></dt><dd><label>ชื่อผู้ไช้(ภาษาอังกฤษหรือตัวเลข) *</label><?=form_input('username','','type="text" maxlength="70" required="required" id="username"')?></dd>
                                        <dt></dt><dd><label>รหัสผ่าน (ภาษาอังกฤษหรือตัวเลข)*</label><?=form_input('password','','type="text" maxlength="70" required="required" id="password"')?></dd>
                                        
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_firstname')?> *</label><?=form_input('firstname','','type="text" maxlength="70" required="required" id="firstname"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_lastname')?> *</label><?=form_input('lastname','','type="text" maxlength="70" required="required" id="lastname"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_personal_id')?> *</label><?=form_input(array('name'=>'personal_id','type'=>'number','minlength'=>'13'),'',' title="รหัสประจำตัวประชาชน" required="required" id="personal_id"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_gender')?></label><?= form_dropdown('gender',array('male'=>'ชาย','famale'=>'หญิง'),'','')?></dd>
                                	</dl>

                                </fieldset>
                                <hr />
								<header><h2>ข้อมูลทั่วไป </h2></header>
								
                                <hr />
                                <fieldset>
                                    <dl>
                                        <dt></dt><dd><label>ชื่อเล่น</label><?=form_input('surename','','type="text"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_phone')?></label><?=form_input(array('name'=>'phone','type'=>'number'),'',' required="required"')?></dd>
										<dt></dt><dd><label><?=$this->lang->line('user_form_label_email')?></label><?=form_input(array('name'=>'email','type'=>'email'),'',' maxlength="75" required="required" id="email"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_note')?></label>
										<?
											$txtdata = array(
												'name'      => 'note',
												'id'        => 'note',
												'value'     => '',
												'rows'   	=> '5',
												'cols'      => '20',
												'style'     => 'width:145',
											);
											echo form_textarea($txtdata);
										?>
										</dd>
                                	</dl>
                            
                                </fieldset>

                                <hr />
                                <header><h2>รายละเอียดที่อยู่</h2></header>

                                <hr />
                                <fieldset>
                                    <dl>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_address')?><em>เลขที่ [Ex. 338/373 ]*</em></label><?=form_input('address1','','type="text" required="required"')?></dd>
										<dt></dt><dd><label> <em>ตึกที่  [ Ex. 9- 23]*</em></label><?=form_input('address2','','type="text" id="address2"')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_tumbol')?></label><?=form_input('district','','type="text"  ')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_aumpur')?></label><?=form_input('amphur','','type="text"  ')?></dd>
                                        <dt></dt><dd><label><?=$this->lang->line('user_form_label_province')?></label><?=form_input('province','','type="text" ')?></dd>
                                	</dl>

                                </fieldset>
                                <hr />
                                <button class="button button-gray" type="reset">ล้างเริ่มไหม่</button><button class="button button-green" type="submit">ลงทะเบียน</button>
							<?=form_close()?>
								
                      </div></div></div></div>
		<? } else if ($invalid) {?>

                    <div class="columns">
                        <div class="grid_5 first">
							<hr >
							<div  class="message warning">
								<div align="center"><h3>ขออภัย <br /> ระบบยังไม่เปิดรับลงทะเบียน</h3></div>
							</div>
                        </div>
                    </div>
<? 
		}
	}
?>
                    <div class="clear">&nbsp;</div>
                </section>