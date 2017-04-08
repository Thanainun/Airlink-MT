<?php

?>
<? if ($complate) { ?>
					<div class="clear">&nbsp;</div>
                    <div class="columns leading"> 
                        <div class="grid_5 first">
						
							<div  class="message info" align="center">
                                <h3>ระบบได้ทำการออกจากระบบให้ท่านเรียบร้อยแล้ว</h3>

                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
									<p>Username และ Password นี้สามารถใช้งานได้ทันที่ครับ</p>    

                                <p>หากมีปัญหาการเติมเวลาติดต่อ 0871694680 24 ชม.</p>
							</div>
                        </div>
                    </div>

	<? } else {?>
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						<?=form_open($this->uri->segment(1).'/','id="form" class="login-box-top"')?>
						
												
						<header><div class="login-hd">ระบบเครียผู้ใช้งานที่ค้างในระบบ AKI WIFI</div></header>
						<hr />
							<center>
							  <p>แก้ไขปัญหาผู้ใช้ค้างในระบบ (มีการล็อกอินหรือยังไม่ออกจากระบบมาจากเครื่องอื่น)ย้ายไปเล่นเครื่อใหนก็ได้ไม่ต้องรอถึง10นาที ระบบนี้สามารถเครียให้ท่านได้ หรือติดต่อ 0871694680 </p>
						  </center>
						
						    <hr />
							
						<table width="25%" class="full">
							<tr>
							  <td width="2%"  rowspan="2">&nbsp;</td>
								<td width="37%" ><label>ชื่อผู้ใช้ (ของคุณ)</label></td>
								<td width="61%"><?=form_input(array('name'=>'user','type'=>'text','minlength'=>'13'),'',' title="ชื่อผู้ใช้เดิมที่จะเติม" required="required" id="user"')?></td>
						    </tr>

							<tr>
							  <td ><label>รหัสผ่าน(ของคุณ)</label></td>
								<td><?=form_input(array('name'=>'pass','type'=>'text','minlength'=>'13'),'',' title="รหัสเดิมที่จะเติม" required="required" id="pass"')?></td>
							    </tr>
							</table>
						  <hr />
						
					      <hr />
						<div class="clear"></div>	
						<div align="center">
						<?php echo form_submit('topup', 'เครีย ผู้ใช้งานออกจากระบบ ค้างในระบบ !!!','class="button button-blue"'); ?></div>
<div class="clear"></div>	
						<div class="clear">&nbsp;</div>		
						<?php echo form_close(); ?>

						</div>
					</div>
					<? }?>