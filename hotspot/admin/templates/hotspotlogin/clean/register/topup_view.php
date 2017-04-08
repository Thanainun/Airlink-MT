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
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						<?=form_open($this->uri->segment(1).'/','id="form" class="login-box-top"')?>
						
												
						<header><div class="login-hd">ระบบเติมเงินด้วยบัตร AKI WIFI</div></header>
						<hr />
							<center><p>ท่านสามารถ เติมเวลาให้ รหัสเก่าของท่าน ด้วยบัตร AKI WIFI ท่านสมมารถหาซื้อได้ที่ 0871694680 </p></center>
						
						    <hr />
							
						<table width="25%" class="full">
							<tr>
							  <td width="2%" ></td>
								<td width="37%" ></td>
								<td width="61%" align="left"><div style="color:red;" rel="reply" class="total_members"><img src="https://172.0.0.1/admin/upload/card/user.jpg" width="109" height="38" />
							    <?=$error?></div></td>
						    </tr>
							<tr>
							  <td  rowspan="2">&nbsp;</td>
								<td ><label>ชื่อผู้ใช้ (ของคุณ)</label></td>
								<td><?=form_input(array('name'=>'user','type'=>'text','minlength'=>'13'),'',' title="ชื่อผู้ใช้เดิมที่จะเติม" required="required" id="user"')?></td>
						    </tr>

							<tr>
							  <td ><label>รหัสผ่าน(ของคุณ)</label></td>
								<td><?=form_input(array('name'=>'pass','type'=>'text','minlength'=>'13'),'',' title="รหัสเดิมที่จะเติม" required="required" id="pass"')?></td>
							    </tr>
							</table>
						  <hr />
						<table width="25%" class="full">
                              <tr>
                                <td width="2%" ></td>
                                <td width="37%" ></td>
                                <td width="61%" align="left"><div style="color:red;" rel="reply" class="total_members"><span class="total_members" style="color:red;"><img src="https://10.0.0.1/admin/upload/card/cardred.png" alt="" width="109" height="38" /></span><span class="total_members" style="color:red;">
                                  <?=$error2?>
                                </span></div></td>
                          </tr>
                              <tr>
                                <td  rowspan="2">&nbsp;</td>
                                <td ><label>ชื่อผู้ใช้ (บัตร)</label></td>
                                <td><?=form_input(array('name'=>'user_card','type'=>'text','minlength'=>'13'),'',' title="รหัสบัตร User AKI WIFI ที่จะใช้เติม" required="required" id="user_card"')?></td>
                              </tr>
                              <tr>
                                <td ><label>รหัสผ่าน(บัตร)</label></td>
                                <td><?=form_input(array('name'=>'pass_card','type'=>'text','minlength'=>'13'),'',' title="รหัสบัตร Password AKI WIFI ที่จะใช้เติม" required="required" id="pass_card"')?></td>
                              </tr>
                            </table>
					      <hr />
						<div class="clear"></div>	
						<div align="center">
						<?php echo form_submit('topup', 'เติมเวลาจากบัตร','class="button button-blue"'); ?></div>
<div class="clear"><p><center>หลังจากทำการเติมเวลาจะถูกแทนที่ด้วยเวลาตามบัตรที่ท่านเติม</center> </p></div>	
						<div class="clear">&nbsp;</div>		
						<?php echo form_close(); ?>

						</div>
					</div>
					<? }?>