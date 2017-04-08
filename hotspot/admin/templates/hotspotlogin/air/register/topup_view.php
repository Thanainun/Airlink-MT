<?php
$username = array(
	'name'	=> 'user',
	'id'	=> 'user',
	'value' => set_value('username'),
	'size' 	=> 10,
);
$password = array(
	'name'	=> 'pass',
	'id'	=> 'pass',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 10,
);
$username_card = array(
	'name'	=> 'user_card',
	'id'	=> 'user_card',
	'maxlength'	=> set_value('username'),
	'size' 	=> 10,
);
$password_card = array(
	'name'	=> 'pass_card',
	'id'	=> 'pass_card',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 10,
);
?>
<? if ($complate) { ?>
					<div class="clear">&nbsp;</div>
                    <div class="columns leading"> 
                        <div class="grid_5 first">
						
							<div  class="message info" align="center">
                                <h3>ท่านเติมเวลาสำเร็จแล้ว</h3>
								<p>ท่านเติมเวลาด้วยเพ็คเก็ต <?=$plan?> </p>
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
									<p>Username และ Password นี้สามารถใช้งานได้ทันที่ครับ</p>    
                                   <p>ใช้แทนรหัสด้านล่างนี้ เวลาการใช้งานขึ้นอยู่กับบัตรที่เอามาเติม</p>
									
                                    <li>Username 	= 	<?=$user_card?></li>
                                    <li>Password 	= 	<?=$pass_card?></li>
                                <p>หากมีปัญหาการเติมเวลาติดต่อ .</p>
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
                	<i class="title-icon icon-angle-right"></i> <?=$this->lang->line('topup_user_header')?> <i class="title-icon icon-angle-left"></i>
                </h3>
   		  </div>
      
            <div class="row">
						<?=$this->lang->line('clear_user_des')?>
                        </div>
						 
					<div class="six columns news-col"><img src=<?=$img.'/professer.png'?> height="300px"/></div>
					<div class="five columns news-col">
						
							    <?=$error?>
						  
								<?=form_input(array('name'=>'user','type'=>'text','minlength'=>'13'),'',' title="ชื่อผู้ใช้เดิมที่จะเติม" required="required" id="user"')?>
						   
								<?=form_input(array('name'=>'pass','type'=>'text','minlength'=>'13'),'',' title="รหัสเดิมที่จะเติม" required="required" id="pass"')?>
							
                                  <?=$error2?>
                               
                             <?=form_input(array('name'=>'user_card','type'=>'text','minlength'=>'13'),'',' title="รหัสบัตร User AKI WIFI ที่จะใช้เติม" required="required" id="user_card"')?>
                             
                                <?=form_input(array('name'=>'pass_card','type'=>'text','minlength'=>'13'),'',' title="รหัสบัตร Password AKI WIFI ที่จะใช้เติม" required="required" id="pass_card"')?>
						<?php echo form_submit('topup', 'เติมเวลาจากบัตร','class="button button-blue"'); ?></div>

						<?php echo form_close(); ?>

					<? }?>
					 </div>
         
		</div>
	</div>