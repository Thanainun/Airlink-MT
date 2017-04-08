<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="navbar transparent navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="signup"> <strong>
      <?=$header ?>
      </strong> </a>
      <div class="nav-collapse collapse">
        <div class="nav pull-right"> Select language :
          <?=anchor("signup/languser/thai","<span>ภาษาไทย</span>");?>
          &nbsp;
          <?=anchor("signup/languser/english","<span>English</span>");?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="header_bottom">
  <?=$this->form_validation->error_string;?>
  
  <!-- Left column/section -->
  <? if ($complate) { ?>
  <div class="container">
    <div class="row-fluid">
      <div class="span7">
        <div class="widget widget-4">
          <div class="widget-head">
            <h4 class="heading glyphicons home"><i></i>ลงทะเบียนสำเร็จแล้ว</h4>
          </div>
          <div class="widget-body">
            <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
            <p>Username และ Password ของท่านคือ</p>
            <li>Username 	=
              <?=$user?>
            </li>
            <li>Password 	=
              <?=$pass?>
            </li>
            <p>Username และ Password ได้รับเพ็ํค
              <?=$plan?>
              และสามารใช้งานได้ทันที</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="separator"></div>
  <? } else {?>
  <? if(!$invalid) { ?>
  <section id="contact"> 
    
    <!-- SECTION CONTENT : begin -->
    <div class="section-content">
    <div class="container">
    <div class="row-fluid">
    <div class="span7"> 
      
      <!-- CONTACT FORM : begin -->
      <section class="various-content">
        <h3>
          <?=$this->lang->line('register_header') ?>
        </h3>
        <?=form_open($this->uri->segment(1).'/','id="form" class="validate default-form various-content" autocomplete="off"')?>
        
        <!-- FORM VALIDATION ERROR MESSAGE : begin -->
        <p class="alert warning validation" style="display: none;"><i class="ico icon-warning-sign"></i><strong>Fields with (*) are required!</strong><br />
          All required fields must be filled correctly.</p>
        <!-- FORM VALIDATION ERROR MESSAGE : end --> 
        
        <!-- SENDING REQUEST ERROR MESSAGE : begin -->
        <p class="alert warning request" style="display: none;"><i class="ico icon-warning-sign"></i><strong>Form not sent!</strong><br />
          There was a connection problem. Try again later.</p>
        <!-- SENDING REQUEST ERROR MESSAGE : end --> 
        
        <!-- FORM FIELDS : begin -->
        <div class="form-fields various-content">
        <div class="row-fluid">
        <div class="span6">
          <p> 
            <!-- add class 'required' to all mandatory fields -->
            
            <?=form_input('username','','type="text" maxlength="70" required="required" class="required" id="username" placeholder='.$this->lang->line('register_username').' ')?>
          </p>
        </div>
        <div class="span6">
          <p>
            <?=form_input('password','','type="text" maxlength="70" required="required" id="password" placeholder='.$this->lang->line('register_password').'')?>
          </p>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <p> 
              <!-- add class 'email' to email field in addition to 'required' -->
              <?=form_input('firstname','','type="text" maxlength="70" required="required" id="firstname" placeholder='.$this->lang->line('register_firstname').'')?>
            </p>
          </div>
          <div class="span6">
            <p>
              <?=form_input('lastname','','type="text" maxlength="70" required="required" id="lastname" placeholder='.$this->lang->line('register_lastname').'')?>
            </p>
          </div>
        </div>
        <p>
          <?=form_input(array('name'=>'personal_id','minlength'=>'13'),'',' title="รหัสประจำตัวประชาชน" id="personal_id" placeholder='.$this->lang->line('register_personal_id').'')?>
        </p>
        <div class="row-fluid">
        <div class="span6">
          <p>
            <?=form_input('surename','','type="text" placeholder='.$this->lang->line('register_surename').'')?>
          </p>
        </div>
        <div class="span6">
          <p>
            <?= form_dropdown('gender',array(''=>''.$this->lang->line('register_gender').'','male'=>'ชาย','famale'=>'หญิง'),'','')?>
          </p>
        </div>
        <div class="row-fluid">
        <div class="span6">
          <p>
            <?=form_input(array('name'=>'phone'),'','placeholder='.$this->lang->line('register_phone').'')?>
          </p>
        </div>
        <div class="span6">
          <p>
            <?=form_input(array('name'=>'email','type'=>'email'),'',' maxlength="75" id="email" placeholder='.$this->lang->line('register_email').'')?>
          </p>
        </div>
        <div class="row-fluid">
        <div class="span12">
          <p>
            <?
											$txtdata = array(
												'name'      => 'note',
												'id'        => 'note',
												'value'     => '',
												'rows'   	=> '5',
												'cols'      => '20',
												'style'     => 'width:480px',
												'placeholder' => ''.$this->lang->line('register_message').''
											);
											echo form_textarea($txtdata);
										?>
          </p>
        </div>
        <div class="row-fluid">
        <div class="span6">
          <p>
            <?=form_input('address1','','type="text" required="required" placeholder='.$this->lang->line('register_address1').'')?>
          </p>
        </div>
        <div class="span6">
          <p>
            <?=form_input('address2','','type="text" required="required" id="address2" placeholder='.$this->lang->line('register_address2').'')?>
          </p>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <p>
              <?=form_input('district','','type="text" placeholder='.$this->lang->line('register_tambon').' ')?>
            </p>
          </div>
          <div class="span6">
            <p>
              <?=form_input('amphur','','type="text" placeholder='.$this->lang->line('register_amphor').' ')?>
            </p>
          </div>
          <?=form_input('province','','type="text" placeholder='.$this->lang->line('register_city').'')?>
          <p>
          <div class="row-fluid">
            <div class="span6">
              <button class="submit button style2" type="reset">
              <?=$this->lang->line('register_clear'); ?>
              </button>
            </div>
            <div class="span6">
              <button class="submit button style1" type="submit">
              <?=$this->lang->line('register_submit'); ?>
              </button>
            </div>
          </div>
          </p>
        </div>
        <!-- FORM FIELDS : end -->
        
        </form>
      </section>
      <!-- CONTACT FORM : end --> 
    </div>
  </section>
  <!-- CONTACT INFO: end --> 
  
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- CONTACT : end --> 

<!-- CONTACT INFO: begin -->
<section class="various-content">
  <div class="content-box various-content">
    <div class="content">
      <div class="container"> <strong>
        <?=$address; ?>
        &nbsp;</strong> Tel :
        <?=$tel; ?>
        &nbsp;   E-mail :
        <?=$mail; ?>
      </div>
    </div>
  </div>
</section>
<? } else if ($invalid) {?>
<div class="columns">
  <div class="grid_5 first">
    <hr >
    <div  class="message warning">
      <div align="center">
        <h3>ขออภัย <br />
          ระบบยังไม่เปิดรับลงทะเบียน</h3>
      </div>
    </div>
  </div>
</div>
<? 
		}
	
	} 
?>
<div class="clear">&nbsp;</div>
</section>

<!-- SCRIPTS : begin --> 

