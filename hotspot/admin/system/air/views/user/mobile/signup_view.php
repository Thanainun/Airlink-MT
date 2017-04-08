<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<body>

<?=$this->form_validation->error_string;?>


                <? if ($complate) { ?>
                <div class="topbar">
	<div class="header">
		<a href="#"><div class="logo"></div><div class="logo-small"></div></a>
		<div class="lang"><?=anchor("signup/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("signup/languser/english","<span>English</span>");?></div>
		
	</div>
	<div class="search-container"></div>
</div>
<div class="topbar_margin"></div>
<div class="row-welcome">
	<div class="row-body">
		<div class="welcome-inner">
			<div class="welcome-message">
				<div class="welcome-title">
					<?=$this->lang->line('register_header') ?>
				</div>
				<div class="welcome-desc">
					
				</div>
				<div class="welcome-about">
					
				</div>
			</div>
			<div class="welcome-inputs">  
    					
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                <ul>
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
                                </ul>
                                <p>Username และ Password ได้รับเพ็ํค <?=$plan?>และสามารใช้งานได้ทันที</p>


	</div>
		</div>
	</div>
</div>
	<? } else {?>
    	<? if(!$invalid) { ?>
    
<div class="topbar">
	<div class="header">
		<a href="#"><div class="logo"></div><div class="logo-small"></div></a>
		<div class="lang"><?=anchor("signup/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("signup/languser/english","<span>English</span>");?></div>
		
	</div>
	<div class="search-container"></div>
</div>
<div class="topbar_margin"></div>
<div class="row-welcome">
	<div class="row-body">
		<div class="welcome-inner">
			<div class="welcome-message">
				<div class="welcome-title">
					<?=$this->lang->line('register_header') ?>
				</div>
				<div class="welcome-desc">
					
				</div>
				<div class="welcome-about">
					
				</div>
			</div>
			<div class="welcome-inputs">
	<?=form_open($this->uri->segment(1).'/','id="form" autocomplete="off"')?>
			
			<?=form_input ('username','','type="text" maxlength="70" required="required" class="required" id="username" placeholder='.$this->lang->line('register_username').' ') ?> 			<?=form_input('password','','type="text" maxlength="70" required="required" id="password" placeholder='.$this->lang->line('register_password').'')?>
			<?=form_input('firstname','','type="text" maxlength="70" required="required" id="firstname" placeholder='.$this->lang->line('register_firstname').'')?>		
            <?=form_input('lastname','','type="text" maxlength="70" required="required" id="lastname" placeholder='.$this->lang->line('register_lastname').'')?>        
           	<?=form_input(array('name'=>'personal_id','minlength'=>'13'),'',' title="รหัสประจำตัวประชาชน" id="personal_id" placeholder='.$this->lang->line('register_personal_id').'')?>          <?=form_input('surename','','type="text" placeholder='.$this->lang->line('register_surename').'')?>
            <?= form_dropdown('gender',array(''=>''.$this->lang->line('register_gender').'','male'=>'ชาย','famale'=>'หญิง'),'','')?>        
            <?=form_input(array('name'=>'phone'),'','required="required" placeholder='.$this->lang->line('register_phone').'')?>        
			<?=form_input(array('name'=>'email','type'=>'email'),'',' maxlength="75" required="required" id="email" placeholder='.$this->lang->line('register_email').'')?>
            <?
											$txtdata = array(
												'name'      => 'note',
												'id'        => 'note',
												'value'     => '',
												'rows'   	=> '5',
												'cols'      => '20',
												'width'		=> 'auto',
												
												'placeholder' => ''.$this->lang->line('register_message').''
											);
											echo form_textarea($txtdata);
										?>
            <?=form_input('address1','','type="text" required="required" placeholder='.$this->lang->line('register_address1').'')?>                            
            <?=form_input('address2','','type="text" id="address2" placeholder='.$this->lang->line('register_address2').'')?>                            
            <?=form_input('district','','type="text" placeholder='.$this->lang->line('register_tambon').' ')?>
            <?=form_input('amphur','','type="text" placeholder='.$this->lang->line('register_amphor').' ')?>
            <?=form_input('province','','type="text" placeholder='.$this->lang->line('register_city').'')?>
             <button class="clear-button" type="reset"><?=$this->lang->line('register_clear'); ?></button><button class="register-button" type="submit"><?=$this->lang->line('register_submit'); ?></button>
                                              
                                        </form>
            
            		
			</div>
		</div>
	</div>
</div>
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
                
