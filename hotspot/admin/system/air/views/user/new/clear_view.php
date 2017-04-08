<body>

<style>
	#nav li {margin:0px !important; padding:3px !important; font-size:10px; line-height:13px}
	#nav li a {padding:3px 5px; display:block; float:right; clear:right; width:35px}
</style>
<? if ($complate) { ?>
 <!-- header section-->
  	<h1 class="intro-title"><img src=<?=base_url().'templates/common/images/logo.png />'?></h1>  
	<!-- /header section -->
    <div class="screenshots-section">
		<div class="container">
		  <div class="row sixteen columns title-row">
				<h3 class="white-title-alt">
                	<i class="title-icon icon-angle-right"></i>Ok! Congratulation :) now we disconnect your session out of system see your detail below<i class="title-icon icon-angle-left"></i>
                </h3>
   		  </div>
                               
<div class="row">
                       
 </div> 
                        <div class="six columns news-col"><img src=<?=base_url().'templates/common/images/professer.png />'?></div>
					<div class="five columns news-col">
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
									<p>Username และ Password นี้สามารถใช้งานได้ทันที่ครับ</p>    

                                <p><a href="http://172.0.0.1" class="button">Go! login</a></p>
							</div>
                        </div>
                    </div>

	<? } else {?>
    
    <!-- header section-->
  	<h1 class="intro-title"><?=$logo?></h1>  
	<!-- /header section -->
    <div class="screenshots-section">
		<div class="container">
		  <div class="row sixteen columns title-row">
				<h3 class="white-title-alt">
                	<i class="title-icon icon-angle-right"></i> <?=$this->lang->line('clear_user_header')?> <i class="title-icon icon-angle-left"></i>
                </h3>
   		  </div>
      
            <div class="row">
						<?=$this->lang->line('clear_user_des')?>
                        </div>
						 
					<div class="six columns news-col"><img src=<?=$img.'/professer.png'?> height="300px"/></div>
					<div class="five columns news-col">
                    <?=form_open($this->uri->segment(1).'/','id="form"')?>
					<p>
					<?=form_input(array('name'=>'user','type'=>'text','minlength'=>'4'),'',' required="required" id="user" autocomplete="off" placeholder='.$this->lang->line('clear_user_name').'')?>
					</p>
                    <p>
					<?=form_input(array('name'=>'pass','type'=>'text','minlength'=>'4'),'',' required="required" id="pass" autocomplete="off" placeholder='.$this->lang->line('clear_user_pass').'')?>
						</p>	 
						
						<?php echo form_submit('topup',$this->lang->line('clear_user_button'),'class="button"'); ?>
	
						<?php echo form_close(); ?>

					
					<? }?>
			  Select language : <?=anchor("clear/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("clear/languser/english","<span>English</span>");?>
            </div>
         
		</div>
	</div>
