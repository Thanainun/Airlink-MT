<?=$this->form_validation->error_string;?>

<!-- Left column/section -->
<? if ($complate) { ?>
<div id="login">
  <div class="widget widget-4">
    <div class="widget-head">
      <h4 class="heading glyphicons home">ลงทะเบียนสำเร็จแล้ว</h4>
    </div>
    <div class="widget-body">
      <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที</p>
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
<div class="separator"></div>
<? } else {?>
<body>
<?=$header ?>
Select language :
<?=anchor("signup/languser/thai","<span>ภาษาไทย</span>");?>
&nbsp;
<?=anchor("signup/languser/english","<span>English</span>");?>
<header>
  <div class="container">
    <h1 class="span8 offset2">
      <?=$this->lang->line('register_header') ?>
    </h1>
    <? if(!$invalid) { ?>
    <?=form_open($this->uri->segment(1).'/','id="form" class="contact clearfix" autocomplete="off"')?>
   </div>
      
  </header>
  
  		<div class="container">
        <div class="row-fluid">
        	<div class="span6">
          <p> 
            <!-- add class 'required' to all mandatory fields -->
            
            <?=form_input ('username','','type="text" maxlength="70" required="required" class="required" id="username" placeholder='.$this->lang->line('register_username').' ') ?>
          </p>
          <p>
            <?=form_input('password','','type="text" maxlength="70" required="required" id="password" placeholder='.$this->lang->line('register_password').'')?>
          </p>
         
          <p> 
            <!-- add class 'email' to email field in addition to 'required' -->
            <?=form_input('firstname','','type="text" maxlength="70" required="required" id="firstname" placeholder='.$this->lang->line('register_firstname').'')?>
          </p>
          <p>
            <?=form_input('lastname','','type="text" maxlength="70" required="required" id="lastname" placeholder='.$this->lang->line('register_lastname').'')?>
          </p>
          <p>
            <?=form_input(array('name'=>'personal_id','minlength'=>'13'),'',' title="'.$this->lang->line('register_personal_id').'" required="required" id="personal_id" placeholder='.$this->lang->line('register_personal_id').'')?>
          </p>
          <p>
            <?=form_input('surename','','type="text" placeholder='.$this->lang->line('register_surename').'')?>
          </p>
          <p>
            <?= form_dropdown('gender',array(''=>''.$this->lang->line('register_gender').'','male'=>'ชาย','famale'=>'หญิง'),'','')?>
          </p>
      
          <p>
            <?=form_input(array('name'=>'phone'),'','required="required" placeholder='.$this->lang->line('register_phone').'')?>
          </p>
          <p>
            <?=form_input(array('name'=>'email','type'=>'email'),'',' maxlength="75" required="required" id="email" placeholder='.$this->lang->line('register_email').'')?>
          </p>
          </div>
          <div class="span6">
          <p>
          
            <?
											$txtdata = array(
												'name'      => 'note',
												'id'        => 'note',
												'value'     => '',
												'rows'   	=> '5',
												'cols'      => '20',
												
												'placeholder' => ''.$this->lang->line('register_message').''
											);
											echo form_textarea($txtdata);
										?>
          </p>
          <p>
            <?=form_input('address1','','type="text" required="required" placeholder='.$this->lang->line('register_address1').'')?>
          </p>
          <p>
            <?=form_input('address2','','type="text" id="address2" placeholder='.$this->lang->line('register_address2').'')?>
          </p>
          <p>
            <?=form_input('district','','type="text" placeholder='.$this->lang->line('register_tambon').' ')?>
          </p>
          <p>
            <?=form_input('amphur','','type="text" placeholder='.$this->lang->line('register_amphor').' ')?>
          </p>
          <?=form_input('province','','type="text" placeholder='.$this->lang->line('register_city').'')?>
          <p>
            <button class="btn btn-notify btn-large" type="reset">
            <?=$this->lang->line('register_clear'); ?>
            </button>
            <button class="btn btn-notify btn-large" type="submit">
            <?=$this->lang->line('register_submit'); ?>
            </button>
          </p>
        
        </form>
        </div>
     </div>
     </div>
     
     
    <div class="container"> 
    <div class="row-fluid">
    <div class="span6">
  
    <h3>
      <?=$this->lang->line('register_where_we_are') ?>
    </h3>
    <div>
      <p><strong>
        <?=$address; ?>
        </strong> </p>
      <hr class="divider" />
      <ul class="custom-list contact-details">
        <li><i class="ico icon-phone"></i>
          <?=$tel; ?>
        </li>
        <li><i class="ico icon-envelope"></i>
          <?=$mail; ?>
        </li>
      </ul>
    </div>
 </div>
   <div class="span6"> 
    
    <!-- IP & MAC INFO: begin -->
    <h3>
          <?=$this->lang->line('register_tip') ?>
        </h3>
        <p>
          <label>
            <?=$this->lang->line('register_mac') ?>
            :</label>
          <?=form_input('mac',$mac,'type="text" readonly=TRUE')?>
          <br />
          <label>
            <?=$this->lang->line('register_ip') ?>
            &nbsp;  &nbsp; &nbsp;&nbsp;:</label>
          <?=form_input('ip',$ip,'type="text" readonly=TRUE')?>
        </p>
        <hr class="divider" />
        <ul class="custom-list contact-details">
          <li><i class="ico icon-exchange"></i>
            <?=$this->lang->line('register_ip_tip'); ?>
          </li>
          <li><i class="ico icon-cogs"></i>
            <?=$this->lang->line('register_mac_tip'); ?>
          </li>
        </ul>
      </div>
     </div>
     </div>
 

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
</div>
</div>
</section>
<!-- INTRODUCTION SECTION : end -->

</body>
