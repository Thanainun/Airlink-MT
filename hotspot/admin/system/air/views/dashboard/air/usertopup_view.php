<? if ($complate) { ?>
					<div class="clear">&nbsp;</div>
                    <div class="columns leading"> 
                        <div class="grid_5 first">
						
							<div  class="message info" align="center">
                                <h3>ท่านเติมเวลาสำเร็จแล้ว</h3>
								<p>ท่านเติมเวลาด้วยเพ็คเก็ต <?=$plan?> </p>
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								
								<?=anchor('dashboard','กลับ',' class="button button-blue" info="กลับ" id="selectplan"');?>
							</div>
                        </div>
                    </div>

	<? }else { ?>  <section class="grid_5 first">
				
					<div class="clear">&nbsp;</div>
                    <div class="columns">
                        <div class="grid_5 first">
							<hr >
							<div  class="message warning">
								<div align="center"><h3>การเติมเงินไม่สำเร็จ หรือผิดพลาด เนื่องจาก<br/><br/><?=$error;?></h3></div>
								<div align="center">
								  <?=anchor('dashboard','กลับ',' class="button button-blue" info="กลับ" id="selectplan"');?>
							      </div>
							</div>
                        </div>
                    </div>

                </section><? }?>